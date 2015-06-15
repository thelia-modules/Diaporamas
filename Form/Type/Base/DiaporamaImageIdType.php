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

namespace Diaporamas\Form\Type\Base;

use Thelia\Core\Form\Type\Field\AbstractIdType;
use Diaporamas\Model\DiaporamaImageQuery;

/**
 * Class DiaporamaImage
 * @package Diaporamas\Form\Base
 * @author TheliaStudio
 */
class DiaporamaImageIdType extends AbstractIdType
{
    const TYPE_NAME = "diaporama_image_id";

    protected function getQuery()
    {
        return new DiaporamaImageQuery();
    }

    public function getName()
    {
        return static::TYPE_NAME;
    }
}
