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

use Diaporamas\Controller\Base\DiaporamaController as BaseDiaporamaController;
use Diaporamas\Diaporamas;
use Diaporamas\Event\DiaporamaEvent;
use Diaporamas\Event\DiaporamaEvents;
use Diaporamas\Loop\DiaporamaImage as DiaporamaImageLoop;
use Diaporamas\Model\Diaporama;
use Diaporamas\Model\DiaporamaImage;
use Diaporamas\Model\DiaporamaImageQuery;
use Thelia\Core\HttpFoundation\JsonResponse;
use Thelia\Core\HttpFoundation\Request;
use Thelia\Core\HttpFoundation\Response;
use Thelia\Core\Security\AccessManager;
use Thelia\Core\Template\Element\LoopResult;
use Thelia\Core\Template\Element\LoopResultRow;
use Thelia\Form\Exception\FormValidationException;

/**
 * Class DiaporamaController
 * @package Diaporamas\Controller
 */
class DiaporamaController extends BaseDiaporamaController
{
    public function deleteAction()
    {
        // Check current user authorization
        if (null !== $response = $this->checkAuth($this->resourceCode, $this->getModuleCode(), AccessManager::DELETE)) {
            return $response;
        }

        try {
            $form = $this->createForm('diaporama.delete');
            $valform = $this->validateForm($form);
            $event = new DiaporamaEvent();
            $event->setId($valform->getData()['diaporama_id']);
            $this->dispatch($this->deleteEventIdentifier, $event);
            $this->performAdditionalDeleteAction($event);
            return $this->generateSuccessRedirect($form);
        } catch (FormValidationException $e) {
            return $this->renderAfterDeleteError($e);
        } catch (\Exception $e) {
            return $this->renderAfterDeleteError($e);
        }
    }

    public function getDiaporamaHtmlAction($shortcode)
    {
        $width = $this->getRequest()->query->get('width');
        $height = $this->getRequest()->query->get('height');
        $event = new DiaporamaEvent();
        $event->__set('image_width', $width);
        $event->__set('image_height', $height);
        $this->dispatch(DiaporamaEvents::DIAPORAMA_HTML, $event);
        return new Response($event->__get('diaporama_html'));
    }

    public function replaceShortcodesAction()
    {
        $description = $this->getRequest()->request->get('description');
        $event = new DiaporamaEvent();
        $event->__set('entity_description', $description);
        $this->dispatch(DiaporamaEvents::DIAPORAMA_PARSE, $event);
        return new Response($event->__get('entity_description'));
    }

    public function getDiaporamaDataAction($shortcode)
    {
        $diaporama = Diaporama::getByShortcode($shortcode);

        if (is_null($diaporama)) {
            $result = array(
                'error' => $this->translator->trans(
                    'diaporama.read.no_shortcode %shortcode',
                    array('shortcode' => $shortcode),
                    Diaporamas::BO_MESSAGE_DOMAIN
                )
            );
        } else {
            $result = array(
                'id' => $diaporama->getId(),
                'title' => $diaporama->getTitle(),
                'shortcode' => $diaporama->getShortcode(),
                'created_at' => $diaporama->getCreatedAt(),
                'updated_at' => $diaporama->getUpdatedAt(),
                'locale' => $diaporama->getLocale(),
                'images' => array(),
            );

            // Data for images
            $loop = new DiaporamaImageLoop($this->getContainer());
            $loop->initializeArgs(array(
                'source_id' => $diaporama->getId(),
                'order' => 'manual',
            ));
            /** @var DiaporamaImageQuery $query */
            $query = $loop->buildModelCriteria();
            $res= $query->find();
            $diaporamaImagesRows = $loop->parseResults(new LoopResult($res));

            /** @var LoopResultRow $row */
            foreach ($diaporamaImagesRows as $row) {
                $result['images'][] = array(
                    'id' => $row->get('ID'),
                    'position' => $row->get('POSITION'),
                    'visible' => boolval($row->get('VISIBLE')),
                    'title' => is_null($row->get('TITLE')) ? '' : $row->get('TITLE'),
                    'chapo' => is_null($row->get('CHAPO')) ? '' : $row->get('CHAPO'),
                    'description' => is_null($row->get('DESCRIPTION')) ? '' : $row->get('DESCRIPTION'),
                    'postscriptum' =>is_null($row->get('POSTSCRIPTUM')) ? '' : $row->get('POSTSCRIPTUM'),
                    'image_url' => $row->get('IMAGE_URL'),
                    'processing_error' => boolval($row->get('PROCESSING_ERROR')),
                );
            }
        }

        return new JsonResponse($result);
    }
}
