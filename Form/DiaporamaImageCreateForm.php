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

use Diaporamas\Form\Base\DiaporamaImageCreateForm as BaseDiaporamaImageCreateForm;

/**
 * Class DiaporamaImageCreateForm
 * @package Diaporamas\Form
 */
class DiaporamaImageCreateForm extends BaseDiaporamaImageCreateForm
{
    public function getTranslationKeys()
    {
        return array(
            "diaporama_id" => "Diaporama id",
            "file" => "File",
            "visible" => "Visible",
            "title" => "Title",
            "description" => "Description",
            "chapo" => "Chapo",
            "postscriptum" => "Postscriptum",
        );
    }
}
