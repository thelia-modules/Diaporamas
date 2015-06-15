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

namespace Diaporamas\Event\Module\Base;

/**
 * Class DiaporamasEvents
 * @package Diaporamas\Event\Module\Base
 * @author TheliaStudio
 */
class DiaporamasEvents
{
    const DIAPORAMA_CREATE = "action.diaporama.create";
    const DIAPORAMA_UPDATE = "action.diaporama.update";
    const DIAPORAMA_DELETE = "action.diaporama.delete";
    const DIAPORAMA_IMAGE_CREATE = "action.diaporama_image.create";
    const DIAPORAMA_IMAGE_UPDATE = "action.diaporama_image.update";
    const DIAPORAMA_IMAGE_DELETE = "action.diaporama_image.delete";
    const DIAPORAMA_IMAGE_UPDATE_POSITION = "action.diaporama_image.update_position";
    const DIAPORAMA_IMAGE_TOGGLE_VISIBILITY = "action.diaporama_image.toggle_visilibity";
}
