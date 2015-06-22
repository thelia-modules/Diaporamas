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

use Diaporamas\Event\DiaporamaEvent;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class ShortcodeFilter
{
    protected $dispatcher;

    public function __construct(EventDispatcherInterface $dispatcher)
    {
        $this->dispatcher = $dispatcher;
    }

    public function filter($tpl_output, $smarty)
    {
        $event = new DiaporamaEvent();
        $event->__set('entity_description', $tpl_output);
        $event->setDispatcher($this->dispatcher);
        $this->dispatcher->dispatch('diaporamas.diaporama.replace_shortcodes.front', $event);
        return $event->__get('entity_description');
    }
}
