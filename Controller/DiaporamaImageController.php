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

use Diaporamas\Controller\Base\DiaporamaImageController as BaseDiaporamaImageController;
use Diaporamas\Event\DiaporamaEvent;
use Diaporamas\Event\DiaporamaImageEvent;
use Diaporamas\Model\DiaporamaImage;
use Diaporamas\Model\DiaporamaImageQuery;
use Propel\Runtime\Exception\PropelException;
use Thelia\Core\Event\File\FileCreateOrUpdateEvent;
use Thelia\Core\Event\TheliaEvents;
use Thelia\Core\HttpFoundation\Response;
use Thelia\Core\Security\AccessManager;
use Thelia\Core\Security\Resource\AdminResources;
use Thelia\Log\Tlog;
use Thelia\Tools\URL;

/**
 * Class DiaporamaImageController
 * @package Diaporamas\Controller
 */
class DiaporamaImageController extends BaseDiaporamaImageController
{
    /**
     * Load a object for modification, and display the edit template.
     *
     * @return \Thelia\Core\HttpFoundation\Response the response
     */
    public function updateAction()
    {
        // Check current user authorization
        if (null !== $response = $this->checkAuth($this->resourceCode, $this->getModuleCode(), AccessManager::UPDATE)) {
            return $response;
        }

        $image = $this->getExistingObject();

        if (is_null($image)) {
            return $this->pageNotFound();
        }

        $redirectUrl = $image->getRedirectionUrl();

        return $this->render('diaporama-image-edit', array(
            'diaporama_image_id' => $image->getId(),
            'redirectUrl' => $redirectUrl,
            'breadcrumb' => $image->getBreadcrumb(
                $this->getRouter($this->getCurrentRouter()),
                $this->container,
                'images',
                $this->getCurrentEditionLocale()
            )
        ));
    }

    /**
     * Put in this method post object update processing if required.
     *
     * @param  DiaporamaImageEvent  $updateEvent the update event
     * @return Response a response, or null to continue normal processing
     */
    protected function performAdditionalUpdateAction($updateEvent)
    {
        $this->updateImageFile($updateEvent->getDiaporamaImage());
        return null;
    }

    /**
     * Updating the image. Inspired by FileController::updateFileAction().
     *
     * @param DiaporamaImage $file   Diaporama Image ID.
     * @param string $eventName  the event type.
     *
     * @return DiaporamaImage
     */
    protected function updateImageFile(DiaporamaImage $file)
    {
        $fileUpdateForm = $this->createForm($file->getUpdateFormId());
        try {
            if (null === $file) {
                throw new \InvalidArgumentException(sprintf('%d image id does not exist', $file->getId()));
            }

            $event = new FileCreateOrUpdateEvent(null);

            $event->setModel($file);
            $event->setOldModel($file);

            $fileForm = $this->getRequest()->files->get($fileUpdateForm->getName());

            if (isset($fileForm['file'])) {
                $event->setUploadedFile($fileForm['file']);
            }

            $this->dispatch(TheliaEvents::IMAGE_SAVE, $event);

            $fileUpdated = $event->getModel();

            $this->adminLogAppend(
                AdminResources::MODULE,
                AccessManager::UPDATE,
                sprintf('Image with Ref %s (ID %d) modified', $fileUpdated->getTitle(), $fileUpdated->getId())
            );

            if ($this->getRequest()->get('save_mode') == 'close') {
                return $this->generateRedirect(
                    URL::getInstance()->absoluteUrl($file->getRedirectionUrl(), ['current_tab' => 'images'])
                );
            } else {
                return $this->generateSuccessRedirect($fileUpdateForm);
            }
        } catch (PropelException $e) {
            $message = $e->getMessage();
        } catch (\Exception $e) {
            $message = sprintf('Sorry, an error occurred: %s', $e->getMessage().' '.$e->getFile());
        }

        if (isset($message)) {
            Tlog::getInstance()->error(sprintf('Error during image editing : %s.', $message));

            $fileUpdateForm->setErrorMessage($message);

            $this->getParserContext()->addForm($fileUpdateForm)->setGeneralError($message);
        }

        return $file;
    }

    public function deleteImageAction($imageId)
    {
        // Check current user authorization
        if (null !== $response = $this->checkAuth($this->resourceCode, $this->getModuleCode(), AccessManager::DELETE)) {
            return $response;
        }

        try {
            $diaporama_image = DiaporamaImageQuery::create()->findPk($imageId);
            $event = new DiaporamaImageEvent($imageId);
            $event->setId($imageId);
            $this->dispatch($this->deleteEventIdentifier, $event);
            $this->performAdditionalDeleteAction($event);
            return $this->generateRedirect($diaporama_image->getRedirectionUrl());
        } catch (\Exception $e) {
            return $this->renderAfterDeleteError($e);
        }
    }
}
