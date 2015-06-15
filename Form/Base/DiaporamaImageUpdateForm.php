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

namespace Diaporamas\Form\Base;

use Diaporamas\Form\DiaporamaImageCreateForm as ChildDiaporamaImageCreateForm;
use Diaporamas\Form\Type\DiaporamaImageIdType;

/**
 * Class DiaporamaImageForm
 * @package Diaporamas\Form
 * @author TheliaStudio
 */
class DiaporamaImageUpdateForm extends ChildDiaporamaImageCreateForm
{
    const FORM_NAME = "diaporama_image_update";

    public function buildForm()
    {
        parent::buildForm();

        $this->formBuilder->add("id", DiaporamaImageIdType::TYPE_NAME);
    }
}
