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

use Diaporamas\Form\DiaporamaCreateForm;
use Diaporamas\Form\Type\DiaporamaIdType;

/**
 * Class DiaporamaUpdateForm
 * @package Diaporamas\Form
 */
class DiaporamaUpdateForm extends DiaporamaCreateForm
{
    const FORM_NAME = "diaporama_update";

    public function buildForm()
    {
        parent::buildForm();
        $this->formBuilder->add("id", DiaporamaIdType::TYPE_NAME);
    }
}
