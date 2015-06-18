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
    protected $entityDescription = null;

    /** @var int */
    protected $imageWidth = null;

    /** @var int */
    protected $imageHeight = null;

    /** @var string */
    protected $diaporamaHtml = null;

    /**
     * @return string
     */
    public function getEntityDescription()
    {
        return $this->entityDescription;
    }

    /**
     * @param string $entityDescription
     */
    public function setEntityDescription($entityDescription)
    {
        $this->entityDescription = $entityDescription;
    }

    /**
     * @return int
     */
    public function getImageWidth()
    {
        return $this->imageWidth;
    }

    /**
     * @param int $imageWidth
     */
    public function setImageWidth($imageWidth)
    {
        $this->imageWidth = $imageWidth;
    }

    /**
     * @return int
     */
    public function getImageHeight()
    {
        return $this->imageHeight;
    }

    /**
     * @param int $imageHeight
     */
    public function setImageHeight($imageHeight)
    {
        $this->imageHeight = $imageHeight;
    }

    /**
     * @return string
     */
    public function getDiaporamaHtml()
    {
        return $this->diaporamaHtml;
    }

    /**
     * @param string $diaporamaHtml
     */
    public function setDiaporamaHtml($diaporamaHtml)
    {
        $this->diaporamaHtml = $diaporamaHtml;
    }
}
