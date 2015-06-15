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

namespace Diaporamas\Event\Base;

use Thelia\Core\Event\ActionEvent;
use Diaporamas\Model\DiaporamaImage;

/**
* Class DiaporamaImageEvent
* @package Diaporamas\Event\Base
* @author TheliaStudio
*/
class DiaporamaImageEvent extends ActionEvent
{
    protected $id;
    protected $diaporamaId;
    protected $file;
    protected $visible;
    protected $position;
    protected $title;
    protected $description;
    protected $chapo;
    protected $postscriptum;
    protected $diaporamaImage;
    protected $locale;

    public function getLocale()
    {
        return $this->locale;
    }

    public function setLocale($v)
    {
        $this->locale = $v;

        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function getDiaporamaId()
    {
        return $this->diaporamaId;
    }

    public function setDiaporamaId($diaporamaId)
    {
        $this->diaporamaId = $diaporamaId;

        return $this;
    }

    public function getFile()
    {
        return $this->file;
    }

    public function setFile($file)
    {
        $this->file = $file;

        return $this;
    }

    public function getVisible()
    {
        return $this->visible;
    }

    public function setVisible($visible)
    {
        $this->visible = $visible;

        return $this;
    }

    public function getPosition()
    {
        return $this->position;
    }

    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    public function getChapo()
    {
        return $this->chapo;
    }

    public function setChapo($chapo)
    {
        $this->chapo = $chapo;

        return $this;
    }

    public function getPostscriptum()
    {
        return $this->postscriptum;
    }

    public function setPostscriptum($postscriptum)
    {
        $this->postscriptum = $postscriptum;

        return $this;
    }

    public function getDiaporamaImage()
    {
        return $this->diaporamaImage;
    }

    public function setDiaporamaImage(DiaporamaImage $diaporamaImage)
    {
        $this->diaporamaImage = $diaporamaImage;

        return $this;
    }
}
