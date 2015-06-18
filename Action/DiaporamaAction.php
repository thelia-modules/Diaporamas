<?php
/*************************************************************************************/
/*      This file is part of the "Diaporamas" Thelia 2 module.                       */
/*                                                                                   */
/*      Copyright (c) OpenStudio                                                     */
/*      email : dev@thelia.net                                                       */
/*      web : http://www.thelia.net                                                  */
/*                                                                                   */
/*      For the full copyright and license information, please view the LICENSE.txt  */
/*      file that was distributed with this source code.                             */
/*************************************************************************************/

namespace Diaporamas\Action;

use Diaporamas\Action\Base\DiaporamaAction as  BaseDiaporamaAction;
use Diaporamas\Event\DiaporamaEvent;
use Diaporamas\Event\DiaporamaEvents;
use Diaporamas\Event\DiaporamaHtmlEvent;
use Diaporamas\Model\Diaporama;
use Thelia\Core\Template\ParserInterface;
use Thelia\Core\Template\TemplateHelper;

/**
 * Class DiaporamaAction
 * @package Diaporamas\Action
 */
class DiaporamaAction extends BaseDiaporamaAction
{
    protected $parser;

    public function __construct(ParserInterface $parser)
    {
        $this->parser = $parser;
    }

    /**
     * Returns an array of event names this subscriber wants to listen to.
     *
     * The array keys are event names and the value can be:
     *
     *  * The method name to call (priority defaults to 0)
     *  * An array composed of the method name to call and the priority
     *  * An array of arrays composed of the method names to call and respective
     *    priorities, or 0 if unset
     *
     * For instance:
     *
     *  * array('eventName' => 'methodName')
     *  * array('eventName' => array('methodName', $priority))
     *  * array('eventName' => array(array('methodName1', $priority), array('methodName2'))
     *
     * @return array The event names to listen to
     *
     * @api
     */
    public static function getSubscribedEvents()
    {
        $subscribedEvents = parent::getSubscribedEvents();

        $newSubscriptions = array(
            DiaporamaEvents::DIAPORAMA_HTML => array('getDiaporamaDescription', 128),
            DiaporamaEvents::DIAPORAMA_PARSE => array('parseDiaporamaDescription', 128),
        );

        return array_merge($subscribedEvents, $newSubscriptions);
    }

    /**
     * Get Diaporama HTML code to put in a page.
     * @param DiaporamaEvent $event
     */
    public function getDiaporamaDescription(DiaporamaHtmlEvent $event)
    {
        $event->setDiaporamaHtml(
            $this->getShortcodeHTML($event->getShortcode(), $event->getImageWidth(), $event->getImageHeight())
        );
    }

    /**
     * Parsing a description, in order to replace shortcodes with their HTML codes
     * @param DiaporamaEvent $event
     */
    public function parseDiaporamaDescription(DiaporamaHtmlEvent $event)
    {
        $event->setEntityDescription($this->updateDescription($event->getEntityDescription()));
    }

    /**
     * Parsing a description, in order to replace shortcodes with their HTML codes.
     *
     * Internal and reusable method to do it.
     * @param string $description The description
     */
    protected function updateDescription($description)
    {
        $shortcodeTags = array();

        if (preg_match_all(Diaporama::SHORTCODETAG_REGEX, $description, $shortcodeTags)) {
            $tagFormat = "[£ %s £]";
        } elseif (preg_match_all(Diaporama::SHORTCODETAG_HTMLENTITIES_REGEX, $description, $shortcodeTags)) {
            $tagFormat = "[&pound; %s &pound;]";
        } else {
            return $description;
        }

        $shortcodeTags = array_unique($shortcodeTags[0]);

        $diaporamaHtmlCodes = array();

        foreach ($shortcodeTags as $shortcodeTag) {
            sscanf($shortcodeTag, $tagFormat, $shortcode);
            $diaporamaHtmlCodes[$shortcodeTag] = $this->getShortcodeHTML($shortcode, 200, 100);
        }

        return str_replace(array_keys($diaporamaHtmlCodes), array_values($diaporamaHtmlCodes), $description);
    }

    /**
     * Internal and reusable method to retrieve HTML code
     * @param string $shortcode The shortcode
     * @param int $width Width for images
     * @param int $height Height for images
     * @return string The HTML code
     */
    protected function getShortcodeHTML($shortcode, $width, $height)
    {
        $this->parser->setTemplateDefinition(
            TemplateHelper::getInstance()->getActiveAdminTemplate()
        );
        return $this->parser->render(
            'diaporama-html.html',
            array(
                'shortcode' => $shortcode,
                'width' => $width,
                'height' => $height
            )
        );
    }
}
