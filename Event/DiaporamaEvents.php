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

use Diaporamas\Event\Base\DiaporamaEvents as BaseDiaporamaEvents;

/**
 * Class DiaporamaEvents
 * @package Diaporamas\Event
 */
class DiaporamaEvents extends BaseDiaporamaEvents
{
    const DIAPORAMA_HTML = 'diaporamas.diaporama.html';
    const DIAPORAMA_PARSE = 'diaporamas.diaporama.replace_shortcodes';
    const DIAPORAMA_HTML_FRONT = 'diaporamas.diaporama.html.front';
    const DIAPORAMA_PARSE_FRONT = 'diaporamas.diaporama.replace_shortcodes.front';
}
