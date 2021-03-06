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

namespace Diaporamas\Model;

use Diaporamas\Diaporamas;
use Diaporamas\Form\DiaporamaImageUpdateForm;
use Diaporamas\Model\Base\DiaporamaImage as BaseDiaporamaImage;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Routing\Router;
use Thelia\Core\HttpFoundation\Request;
use Thelia\Core\Translation\Translator;
use Thelia\Files\FileModelInterface;
use Thelia\Files\FileModelParentInterface;
use Thelia\Form\BaseForm;
use Thelia\Model\Breadcrumb\BreadcrumbInterface;
use Thelia\Model\Tools\ModelEventDispatcherTrait;
use Thelia\Model\Tools\PositionManagementTrait;
use Propel\Runtime\Connection\ConnectionInterface;
use Thelia\Tools\URL;

/**
 * Class DiaporamaImage
 * @package Diaporamas\Model
 */
class DiaporamaImage extends BaseDiaporamaImage implements FileModelInterface, BreadcrumbInterface
{
    use ModelEventDispatcherTrait;
    use PositionManagementTrait;

    public function preInsert(ConnectionInterface $con = null)
    {
        $this->setPosition($this->getNextPosition());

        return true;
    }

    /**
     * Set file parent id
     *
     * @param int $parentId parent id
     *
     * @return $this
     */
    public function setParentId($parentId)
    {
        return $this->setDiaporamaId($parentId);
    }

    /**
     * Get file parent id
     *
     * @return int parent id
     */
    public function getParentId()
    {
        return $this->getDiaporamaId();
    }

    /**
     * @return FileModelParentInterface the parent file model
     */
    public function getParentFileModel()
    {
        return new Diaporama();
    }

    /**
     * Get the ID of the form used to change this object information
     *
     * @return BaseForm the form
     */
    public function getUpdateFormId()
    {
        return 'diaporama_image.update';
    }

    /**
     * Get the form instance used to change this object information
     *
     * @param Request $request the current request
     *
     * @return BaseForm the form
     */
    public function getUpdateFormInstance(Request $request)
    {
        return new DiaporamaImageUpdateForm($request);
    }

    /**
     * @return string the path to the upload directory where files are stored, without final slash
     */
    public function getUploadDir()
    {
        return Diaporamas::getDiaporamaImagesFolder();
    }

    /**
     * @param int $objectId the object ID
     *
     * @return string the URL to redirect to after update from the back-office
     */
    public function getRedirectionUrl()
    {
        return "/admin/module/Diaporamas/diaporama/edit?diaporama_id={$this->getDiaporamaId()}";
    }

    /**
     * Get the Query instance for this object
     *
     * @return ModelCriteria
     */
    public function getQueryInstance()
    {
        return DiaporamaImageQuery::create();
    }

    /**
     * Create a breadcrumb from the current object, that will be displayed to the file management UI
     *
     * @param Router $router the router where to find routes
     * @param ContainerInterface $container the container
     * @param string $tab the tab to return to (probably 'image' or 'document')
     * @param string $locale the current locale
     *
     * @return array an array of (label => URL)
     */
    public function getBreadcrumb(Router $router, ContainerInterface $container, $tab, $locale)
    {
        $translator = Translator::getInstance();
        $breadcrumb = [
            $translator->trans('Home') => $router->generate('admin.home.view', [], Router::ABSOLUTE_URL),
            $translator->trans('Diaporamas') => URL::getInstance()->absoluteUrl('/admin/module/Diaporamas/diaporama'),
            $translator->trans('Diaporama') => $this->getRedirectionUrl(),
        ];

        return $breadcrumb;
    }

    public function createQuery()
    {
        $query = DiaporamaImageQuery::create();
        !is_null($this->diaporama_id) and $query->filterByDiaporamaId($this->diaporama_id);
        return $query;
    }
}
