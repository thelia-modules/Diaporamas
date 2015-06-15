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

namespace Diaporamas\Action\Base;

use Diaporamas\Model\Map\DiaporamaImageTableMap;
use Diaporamas\Event\DiaporamaImageEvent;
use Diaporamas\Event\DiaporamaImageEvents;
use Diaporamas\Model\DiaporamaImageQuery;
use Diaporamas\Model\DiaporamaImage;
use Thelia\Action\BaseAction;
use Thelia\Core\Event\ToggleVisibilityEvent;
use Thelia\Core\Event\UpdatePositionEvent;
use Propel\Runtime\Propel;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Thelia\Core\Event\TheliaEvents;
use \Thelia\Core\Event\TheliaFormEvent;

/**
 * Class DiaporamaImageAction
 * @package Diaporamas\Action
 * @author TheliaStudio
 */
class DiaporamaImageAction extends BaseAction implements EventSubscriberInterface
{
    public function create(DiaporamaImageEvent $event)
    {
        $this->createOrUpdate($event, new DiaporamaImage());
    }

    public function update(DiaporamaImageEvent $event)
    {
        $model = $this->getDiaporamaImage($event);

        $this->createOrUpdate($event, $model);
    }

    public function delete(DiaporamaImageEvent $event)
    {
        $this->getDiaporamaImage($event)->delete();
    }

    protected function createOrUpdate(DiaporamaImageEvent $event, DiaporamaImage $model)
    {
        $con = Propel::getConnection(DiaporamaImageTableMap::DATABASE_NAME);
        $con->beginTransaction();

        try {
            $model->setLocale($event->getLocale());

            if (null !== $id = $event->getId()) {
                $model->setId($id);
            }

            if (null !== $diaporamaId = $event->getDiaporamaId()) {
                $model->setDiaporamaId($diaporamaId);
            }

            if (null !== $file = $event->getFile()) {
                $model->setFile($file);
            }

            if (null !== $visible = $event->getVisible()) {
                $model->setVisible($visible);
            }

            if (null !== $position = $event->getPosition()) {
                $model->setPosition($position);
            }

            if (null !== $title = $event->getTitle()) {
                $model->setTitle($title);
            }

            if (null !== $description = $event->getDescription()) {
                $model->setDescription($description);
            }

            if (null !== $chapo = $event->getChapo()) {
                $model->setChapo($chapo);
            }

            if (null !== $postscriptum = $event->getPostscriptum()) {
                $model->setPostscriptum($postscriptum);
            }

            $model->save($con);

            $con->commit();
        } catch (\Exception $e) {
            $con->rollback();

            throw $e;
        }

        $event->setDiaporamaImage($model);
    }

    protected function getDiaporamaImage(DiaporamaImageEvent $event)
    {
        $model = DiaporamaImageQuery::create()->findPk($event->getId());

        if (null === $model) {
            throw new \RuntimeException(sprintf(
                "The 'diaporama_image' id '%d' doesn't exist",
                $event->getId()
            ));
        }

        return $model;
    }

    public function updatePosition(UpdatePositionEvent $event)
    {
        $this->genericUpdatePosition(new DiaporamaImageQuery(), $event);
    }

    public function toggleVisibility(ToggleVisibilityEvent $event)
    {
        $this->genericToggleVisibility(new DiaporamaImageQuery(), $event);
    }

    public function beforeCreateFormBuild(TheliaFormEvent $event)
    {
    }

    public function beforeUpdateFormBuild(TheliaFormEvent $event)
    {
    }

    public function afterCreateFormBuild(TheliaFormEvent $event)
    {
    }

    public function afterUpdateFormBuild(TheliaFormEvent $event)
    {
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
        return array(
            DiaporamaImageEvents::CREATE => array("create", 128),
            DiaporamaImageEvents::UPDATE => array("update", 128),
            DiaporamaImageEvents::DELETE => array("delete", 128),
            DiaporamaImageEvents::UPDATE_POSITION => array("updatePosition", 128),
            DiaporamaImageEvents::TOGGLE_VISIBILITY => array("toggleVisibility", 128),
            TheliaEvents::FORM_BEFORE_BUILD . ".diaporama_image_create" => array("beforeCreateFormBuild", 128),
            TheliaEvents::FORM_BEFORE_BUILD . ".diaporama_image_update" => array("beforeUpdateFormBuild", 128),
            TheliaEvents::FORM_AFTER_BUILD . ".diaporama_image_create" => array("afterCreateFormBuild", 128),
            TheliaEvents::FORM_AFTER_BUILD . ".diaporama_image_update" => array("afterUpdateFormBuild", 128),
        );
    }
}
