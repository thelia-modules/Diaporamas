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
use Diaporamas\Model\Diaporama;

/**
* Class DiaporamaEvent
* @package Diaporamas\Event\Base
* @author TheliaStudio
*/
class DiaporamaEvent extends ActionEvent
{
    protected $id;
    protected $title;
    protected $shortcode;
    protected $diaporama;
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

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    public function getShortcode()
    {
        return $this->shortcode;
    }

    public function setShortcode($shortcode)
    {
        $this->shortcode = $shortcode;

        return $this;
    }

    public function getDiaporama()
    {
        return $this->diaporama;
    }

    public function setDiaporama(Diaporama $diaporama)
    {
        $this->diaporama = $diaporama;

        return $this;
    }
}
