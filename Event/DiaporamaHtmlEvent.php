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

namespace Diaporamas\Event;

/**
 * DiaporamaEvent extension for retrieving Diaporama HTML code.
 * @package Diaporamas\Event
 */
class DiaporamaHtmlEvent extends DiaporamaEvent
{
    /** @var string */
    protected $entity_description = null;

    /** @var int */
    protected $image_width = null;

    /** @var int */
    protected $image_height = null;

    /** @var string */
    protected $diaporama_html = null;

    /**
     * @return string
     */
    public function getEntityDescription()
    {
        return $this->entity_description;
    }

    /**
     * @param string $entity_description
     */
    public function setEntityDescription($entity_description)
    {
        $this->entity_description = $entity_description;
    }

    /**
     * @return int
     */
    public function getImageWidth()
    {
        return $this->image_width;
    }

    /**
     * @param int $image_width
     */
    public function setImageWidth($image_width)
    {
        $this->image_width = $image_width;
    }

    /**
     * @return int
     */
    public function getImageHeight()
    {
        return $this->image_height;
    }

    /**
     * @param int $image_height
     */
    public function setImageHeight($image_height)
    {
        $this->image_height = $image_height;
    }

    /**
     * @return string
     */
    public function getDiaporamaHtml()
    {
        return $this->diaporama_html;
    }

    /**
     * @param string $diaporama_html
     */
    public function setDiaporamaHtml($diaporama_html)
    {
        $this->diaporama_html = $diaporama_html;
    }
}
