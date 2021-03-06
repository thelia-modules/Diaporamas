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

use Diaporamas\Model\Map\DiaporamaTableMap;
use Diaporamas\Event\DiaporamaEvent;
use Diaporamas\Event\DiaporamaEvents;
use Diaporamas\Model\DiaporamaQuery;
use Diaporamas\Model\Diaporama;
use Thelia\Action\BaseAction;
use Thelia\Core\Event\ToggleVisibilityEvent;
use Thelia\Core\Event\UpdatePositionEvent;
use Propel\Runtime\Propel;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Thelia\Core\Event\TheliaEvents;
use \Thelia\Core\Event\TheliaFormEvent;

/**
 * Class DiaporamaAction
 * @package Diaporamas\Action
 * @author TheliaStudio
 */
class DiaporamaAction extends BaseAction implements EventSubscriberInterface
{
    public function create(DiaporamaEvent $event)
    {
        $this->createOrUpdate($event, new Diaporama());
    }

    public function update(DiaporamaEvent $event)
    {
        $model = $this->getDiaporama($event);

        $this->createOrUpdate($event, $model);
    }

    public function delete(DiaporamaEvent $event)
    {
        $this->getDiaporama($event)->delete();
    }

    protected function createOrUpdate(DiaporamaEvent $event, Diaporama $model)
    {
        $con = Propel::getConnection(DiaporamaTableMap::DATABASE_NAME);
        $con->beginTransaction();

        try {
            $model->setLocale($event->getLocale());

            if (null !== $id = $event->getId()) {
                $model->setId($id);
            }

            if (null !== $title = $event->getTitle()) {
                $model->setTitle($title);
            }

            if (null !== $shortcode = $event->getShortcode()) {
                $model->setShortcode($shortcode);
            }

            $model->save($con);

            $con->commit();
        } catch (\Exception $e) {
            $con->rollback();

            throw $e;
        }

        $event->setDiaporama($model);
    }

    protected function getDiaporama(DiaporamaEvent $event)
    {
        $model = DiaporamaQuery::create()->findPk($event->getId());

        if (null === $model) {
            throw new \RuntimeException(sprintf(
                "The 'diaporama' id '%d' doesn't exist",
                $event->getId()
            ));
        }

        return $model;
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
            DiaporamaEvents::CREATE => array("create", 128),
            DiaporamaEvents::UPDATE => array("update", 128),
            DiaporamaEvents::DELETE => array("delete", 128),
            TheliaEvents::FORM_BEFORE_BUILD . ".diaporama_create" => array("beforeCreateFormBuild", 128),
            TheliaEvents::FORM_BEFORE_BUILD . ".diaporama_update" => array("beforeUpdateFormBuild", 128),
            TheliaEvents::FORM_AFTER_BUILD . ".diaporama_create" => array("afterCreateFormBuild", 128),
            TheliaEvents::FORM_AFTER_BUILD . ".diaporama_update" => array("afterUpdateFormBuild", 128),
        );
    }
}
