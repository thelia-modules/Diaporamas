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

use Diaporamas\Event\Module\DiaporamasEvents as ChildDiaporamasEvents;

/*
 * Class DiaporamaImageEvents
 * @package Diaporamas\Event\Base
 * @author TheliaStudio
 */
class DiaporamaImageEvents
{
    const CREATE = ChildDiaporamasEvents::DIAPORAMA_IMAGE_CREATE;
    const UPDATE = ChildDiaporamasEvents::DIAPORAMA_IMAGE_UPDATE;
    const DELETE = ChildDiaporamasEvents::DIAPORAMA_IMAGE_DELETE;
    const UPDATE_POSITION = ChildDiaporamasEvents::DIAPORAMA_IMAGE_UPDATE_POSITION;
    const TOGGLE_VISIBILITY = ChildDiaporamasEvents::DIAPORAMA_IMAGE_TOGGLE_VISIBILITY;
}
