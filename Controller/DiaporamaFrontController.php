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

use Diaporamas\Event\DiaporamaEvents;
use Diaporamas\Event\DiaporamaHtmlEvent;
use Thelia\Controller\Front\BaseFrontController;
use Thelia\Core\HttpFoundation\Response;

class DiaporamaFrontController extends BaseFrontController
{

    public function getDiaporamaHtmlAction($shortcode)
    {
        $width = $this->getRequest()->query->get('width');
        $height = $this->getRequest()->query->get('height');
        $event = new DiaporamaHtmlEvent();
        $event->setShortcode($shortcode);
        $event->setImageWidth($width);
        $event->setImageHeight($height);
        $this->dispatch(DiaporamaEvents::DIAPORAMA_HTML_FRONT, $event);
        return new Response($event->getDiaporamaHtml());
    }

    public function replaceShortcodesAction()
    {
        $description = $this->getRequest()->request->get('description');
        $event = new DiaporamaHtmlEvent();
        $event->setEntityDescription($description);
        $this->dispatch(DiaporamaEvents::DIAPORAMA_PARSE_FRONT, $event);
        return new Response($event->getEntityDescription());
    }
}
