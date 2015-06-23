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

namespace Diaporamas\Filter;

use Diaporamas\Event\DiaporamaEvents;
use Diaporamas\Event\DiaporamaHtmlEvent;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Thelia\Core\HttpFoundation\Session\Session;
use Thelia\Core\Template\ParserInterface;
use Thelia\Core\Template\TemplateDefinition;

class ShortcodeFilter
{
    protected $dispatcher;
    protected $parser;

    public function __construct(EventDispatcherInterface $dispatcher, ParserInterface $parser)
    {
        $this->dispatcher = $dispatcher;
        $this->parser = $parser;
    }

    public function filter($tpl_output, $smarty)
    {
        // Are we front or back?
        if ($this->parser->getTemplateDefinition()->getType() == TemplateDefinition::FRONT_OFFICE) {
            $event = new DiaporamaHtmlEvent();
            $event->setEntityDescription($tpl_output);
            $event->setDispatcher($this->dispatcher);
            $this->dispatcher->dispatch(DiaporamaEvents::DIAPORAMA_PARSE_FRONT, $event);
            return $event->getEntityDescription();
        } else {
            return $tpl_output;
        }

    }
}
