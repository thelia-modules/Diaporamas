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

use Diaporamas\Diaporamas;
use Diaporamas\Model\DiaporamaQuery;
use Symfony\Component\Validator\Constraints\Callback;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\ExecutionContextInterface;
use Thelia\Form\BaseForm;

class DiaporamaDeleteForm extends BaseForm
{
    const FORM_NAME = 'diaporama_delete';

    /**
     * @return string the name of you form. This name must be unique
     */
    public function getName()
    {
        return self::FORM_NAME;
    }

    /**
     *
     * in this function you add all the fields you need for your Form.
     * Form this you have to call add method on $this->formBuilder attribute :
     *
     * $this->formBuilder->add("name", "text")
     *   ->add("email", "email", array(
     *           "attr" => array(
     *               "class" => "field"
     *           ),
     *           "label" => "email",
     *           "constraints" => array(
     *               new \Symfony\Component\Validator\Constraints\NotBlank()
     *           )
     *       )
     *   )
     *   ->add('age', 'integer');
     *
     * @return null
     */
    protected function buildForm()
    {
        $this->formBuilder->add('diaporama_id', 'hidden', array(
            'label' => $this->trans('diaporama.delete.content'),
            'label_attr' => array('for' => 'diaporama_id'),
            'constraints' => array(
                new NotBlank(),
                new Callback(array(
                    'methods' => array(
                        array($this, 'checkValidDiaporama'),
                    ),
                )),
            )
        ));
    }

    public function checkValidDiaporama($value, ExecutionContextInterface $context)
    {
        $value = intval($value);
        if (is_null(DiaporamaQuery::create()->findOneById($value))) {
            $context->addViolation($this->trans(
                'diaporama.delete.invalid_diaporama %diaporama_id',
                array('diaporama_id' => $value)
            ));
        }
    }

    public function trans($code, array $parameters = array(), $domain = Diaporamas::BO_MESSAGE_DOMAIN)
    {
        return $this->translator->trans($code, $parameters, $domain);
    }
}
