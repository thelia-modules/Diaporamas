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

use Diaporamas\Model\Base\DiaporamaImageI18n as BaseDiaporamaImageI18n;
use Thelia\Model\Tools\I18nTimestampableTrait;

/**
 * Class DiaporamaImageI18n
 * @package Diaporamas\Model
 */
class DiaporamaImageI18n extends BaseDiaporamaImageI18n
{
    use I18nTimestampableTrait;
}
