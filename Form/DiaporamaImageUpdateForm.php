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

namespace Diaporamas\Form;

use Diaporamas\Form\Type\DiaporamaIdType;
use Diaporamas\Form\Type\DiaporamaImageIdType;
use Thelia\Form\Image\ImageModification;

/**
 * Class DiaporamaImageUpdateForm
 * @package Diaporamas\Form
 */
class DiaporamaImageUpdateForm extends ImageModification
{
    const FORM_NAME = "diaporama_image_update";

    public function getName()
    {
        return static::FORM_NAME;
    }

    public function buildForm()
    {
        parent::buildForm();
        $this->formBuilder
            ->add("id", DiaporamaImageIdType::TYPE_NAME)
            ->add("diaporama_id", DiaporamaIdType::TYPE_NAME)
        ;
    }
}
