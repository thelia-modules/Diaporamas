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

use Diaporamas\Action\Base\DiaporamaAction;
use Diaporamas\Event\DiaporamaEvents;
use Thelia\Core\Template\TemplateHelper;

class DiaporamaFrontAction extends DiaporamaAction
{
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
            TemplateHelper::getInstance()->getActiveFrontTemplate()
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
        // Those 2 events only. Parent events are already subscribed in the parent action.
        return array(
            DiaporamaEvents::DIAPORAMA_HTML_FRONT => array('getDiaporamaDescription', 128),
            DiaporamaEvents::DIAPORAMA_PARSE_FRONT => array('parseDiaporamaDescription', 128),
        );
    }
}
