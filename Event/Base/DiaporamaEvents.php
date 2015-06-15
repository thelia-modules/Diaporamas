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
 * Class DiaporamaEvents
 * @package Diaporamas\Event\Base
 * @author TheliaStudio
 */
class DiaporamaEvents
{
    const CREATE = ChildDiaporamasEvents::DIAPORAMA_CREATE;
    const UPDATE = ChildDiaporamasEvents::DIAPORAMA_UPDATE;
    const DELETE = ChildDiaporamasEvents::DIAPORAMA_DELETE;
}
