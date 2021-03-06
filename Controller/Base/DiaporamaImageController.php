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

namespace Diaporamas\Controller\Base;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Thelia\Controller\Admin\AbstractCrudController;
use Thelia\Core\Security\Resource\AdminResources;
use Thelia\Tools\URL;
use Diaporamas\Event\DiaporamaImageEvent;
use Diaporamas\Event\DiaporamaImageEvents;
use Diaporamas\Model\DiaporamaImageQuery;
use Thelia\Core\Event\ToggleVisibilityEvent;
use Thelia\Core\Event\UpdatePositionEvent;

/**
 * Class DiaporamaImageController
 * @package Diaporamas\Controller\Base
 * @author TheliaStudio
 */
class DiaporamaImageController extends AbstractCrudController
{
    public function __construct()
    {
        parent::__construct(
            "diaporama_image",
            "manual",
            "order",
            AdminResources::MODULE,
            DiaporamaImageEvents::CREATE,
            DiaporamaImageEvents::UPDATE,
            DiaporamaImageEvents::DELETE,
            DiaporamaImageEvents::TOGGLE_VISIBILITY,
            DiaporamaImageEvents::UPDATE_POSITION,
            "Diaporamas"
        );
    }

    /**
     * Return the creation form for this object
     */
    protected function getCreationForm()
    {
        return $this->createForm("diaporama_image.create");
    }

    /**
     * Return the update form for this object
     */
    protected function getUpdateForm($data = array())
    {
        if (!is_array($data)) {
            $data = array();
        }

        return $this->createForm("diaporama_image.update", "form", $data);
    }

    /**
     * Hydrate the update form for this object, before passing it to the update template
     *
     * @param mixed $object
     */
    protected function hydrateObjectForm($object)
    {
        $data = array(
            "id" => $object->getId(),
            "diaporama_id" => $object->getDiaporamaId(),
            "file" => $object->getFile(),
            "visible" => (bool) $object->getVisible(),
            "position" => $object->getPosition(),
            "title" => $object->getTitle(),
            "description" => $object->getDescription(),
            "chapo" => $object->getChapo(),
            "postscriptum" => $object->getPostscriptum(),
        );

        return $this->getUpdateForm($data);
    }

    /**
     * Creates the creation event with the provided form data
     *
     * @param mixed $formData
     * @return \Thelia\Core\Event\ActionEvent
     */
    protected function getCreationEvent($formData)
    {
        $event = new DiaporamaImageEvent();

        $event->setDiaporamaId($formData["diaporama_id"]);
        $event->setFile($formData["file"]);
        $event->setVisible($formData["visible"]);
        $event->setTitle($formData["title"]);
        $event->setDescription($formData["description"]);
        $event->setChapo($formData["chapo"]);
        $event->setPostscriptum($formData["postscriptum"]);

        return $event;
    }

    /**
     * Creates the update event with the provided form data
     *
     * @param mixed $formData
     * @return \Thelia\Core\Event\ActionEvent
     */
    protected function getUpdateEvent($formData)
    {
        $event = new DiaporamaImageEvent();

        $event->setId($formData["id"]);
        $event->setDiaporamaId($formData["diaporama_id"]);
        $event->setFile($formData["file"]);
        $event->setVisible($formData["visible"]);
        $event->setTitle($formData["title"]);
        $event->setDescription($formData["description"]);
        $event->setChapo($formData["chapo"]);
        $event->setPostscriptum($formData["postscriptum"]);

        return $event;
    }

    /**
     * Creates the delete event with the provided form data
     */
    protected function getDeleteEvent()
    {
        $event = new DiaporamaImageEvent();

        $event->setId($this->getRequest()->request->get("diaporama_image_id"));

        return $event;
    }

    /**
     * Return true if the event contains the object, e.g. the action has updated the object in the event.
     *
     * @param mixed $event
     */
    protected function eventContainsObject($event)
    {
        return null !== $this->getObjectFromEvent($event);
    }

    /**
     * Get the created object from an event.
     *
     * @param mixed $event
     */
    protected function getObjectFromEvent($event)
    {
        return $event->getDiaporamaImage();
    }

    /**
     * Load an existing object from the database
     */
    protected function getExistingObject()
    {
        return DiaporamaImageQuery::create()
            ->findPk($this->getRequest()->query->get("diaporama_image_id"))
        ;
    }

    /**
     * Returns the object label form the object event (name, title, etc.)
     *
     * @param mixed $object
     */
    protected function getObjectLabel($object)
    {
        return $object->getTitle();
    }

    /**
     * Returns the object ID from the object
     *
     * @param mixed $object
     */
    protected function getObjectId($object)
    {
        return $object->getId();
    }

    /**
     * Render the main list template
     *
     * @param mixed $currentOrder , if any, null otherwise.
     */
    protected function renderListTemplate($currentOrder)
    {
        $this->getParser()
            ->assign("order", $currentOrder)
        ;

        return $this->render("diaporama-images");
    }

    /**
     * Render the edition template
     */
    protected function renderEditionTemplate()
    {
        $this->getParserContext()
            ->set(
                "diaporama_image_id",
                $this->getRequest()->query->get("diaporama_image_id")
            )
        ;

        return $this->render("diaporama-image-edit");
    }

    /**
     * Must return a RedirectResponse instance
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    protected function redirectToEditionTemplate()
    {
        $id = $this->getRequest()->query->get("diaporama_image_id");

        return new RedirectResponse(
            URL::getInstance()->absoluteUrl(
                "/admin/module/Diaporamas/diaporama_image/edit",
                [
                    "diaporama_image_id" => $id,
                ]
            )
        );
    }

    /**
     * Must return a RedirectResponse instance
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    protected function redirectToListTemplate()
    {
        return new RedirectResponse(
            URL::getInstance()->absoluteUrl("/admin/module/Diaporamas/diaporama_image")
        );
    }

    protected function createToggleVisibilityEvent()
    {
        return new ToggleVisibilityEvent($this->getRequest()->query->get("diaporama_image_id"));
    }

    protected function createUpdatePositionEvent($positionChangeMode, $positionValue)
    {
        return new UpdatePositionEvent(
            $this->getRequest()->query->get("diaporama_image_id"),
            $positionChangeMode,
            $positionValue
        );
    }
}
