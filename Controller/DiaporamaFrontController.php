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


namespace Diaporamas\Controller;

use Diaporamas\Event\DiaporamaEvent;
use Diaporamas\Event\DiaporamaEvents;
use Thelia\Controller\Front\BaseFrontController;
use Thelia\Core\HttpFoundation\Response;

class DiaporamaFrontController extends BaseFrontController
{
    public function getDiaporamaHtmlAction($shortcode)
    {
        $width = $this->getRequest()->query->get('width');
        $height = $this->getRequest()->query->get('height');
        $event = new DiaporamaEvent();
        $event->__set('image_width', $width);
        $event->__set('image_height', $height);
        $this->dispatch(DiaporamaEvents::DIAPORAMA_HTML_FRONT, $event);
        return new Response($event->__get('diaporama_html'));
    }

    public function replaceShortcodesAction()
    {
        $description = $this->getRequest()->request->get('description');
        $event = new DiaporamaEvent();
        $event->__set('entity_description', $description);
        $this->dispatch(DiaporamaEvents::DIAPORAMA_PARSE_FRONT, $event);
        return new Response($event->__get('entity_description'));
    }
}
