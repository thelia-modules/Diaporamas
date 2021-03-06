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

use Diaporamas\Diaporamas;
use Thelia\Form\BaseForm;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
 * Class DiaporamaImageCreateForm
 * @package Diaporamas\Form\Base
 * @author TheliaStudio
 */
class DiaporamaImageCreateForm extends BaseForm
{
    const FORM_NAME = "diaporama_image_create";

    public function buildForm()
    {
        $translationKeys = $this->getTranslationKeys();
        $fieldsIdKeys = $this->getFieldsIdKeys();

        $this->addDiaporamaIdField($translationKeys, $fieldsIdKeys);
        $this->addFileField($translationKeys, $fieldsIdKeys);
        $this->addVisibleField($translationKeys, $fieldsIdKeys);
        $this->addTitleField($translationKeys, $fieldsIdKeys);
        $this->addDescriptionField($translationKeys, $fieldsIdKeys);
        $this->addChapoField($translationKeys, $fieldsIdKeys);
        $this->addPostscriptumField($translationKeys, $fieldsIdKeys);
        $this->addLocaleField();
    }

    public function addLocaleField()
    {
        $this->formBuilder->add(
            'locale',
            'hidden',
            [
                'constraints' => [ new NotBlank() ],
                'required'    => true,
            ]
        );
    }

    protected function addDiaporamaIdField(array $translationKeys, array $fieldsIdKeys)
    {
        $this->formBuilder->add("diaporama_id", "integer", array(
            "label" => $this->trans($this->readKey("diaporama_id", $translationKeys)),
            "label_attr" => ["for" => $this->readKey("diaporama_id", $fieldsIdKeys)],
            "required" => true,
            "constraints" => array(
                new NotBlank(),
            ),
            "attr" => array(
            )
        ));
    }

    protected function addFileField(array $translationKeys, array $fieldsIdKeys)
    {
        $this->formBuilder->add('file', 'file', array(
            "label" => $this->trans($this->readKey("file", $translationKeys)),
            "label_attr" => ["for" => $this->readKey("file", $fieldsIdKeys)],
            "required" => true,
            "constraints" => array(
                new NotBlank(),
            ),
            "attr" => array(
            )
        ));
    }

    protected function addVisibleField(array $translationKeys, array $fieldsIdKeys)
    {
        $this->formBuilder->add("visible", "checkbox", array(
            "label" => $this->trans($this->readKey("visible", $translationKeys)),
            "label_attr" => ["for" => $this->readKey("visible", $fieldsIdKeys)],
            "required" => false,
            "constraints" => array(
            ),
            "attr" => array(
            )
        ));
    }

    protected function addTitleField(array $translationKeys, array $fieldsIdKeys)
    {
        $this->formBuilder->add("title", "text", array(
            "label" => $this->trans($this->readKey("title", $translationKeys)),
            "label_attr" => ["for" => $this->readKey("title", $fieldsIdKeys)],
            "required" => false,
            "constraints" => array(
            ),
            "attr" => array(
            )
        ));
    }

    protected function addDescriptionField(array $translationKeys, array $fieldsIdKeys)
    {
        $this->formBuilder->add("description", "textarea", array(
            "label" => $this->trans($this->readKey("description", $translationKeys)),
            "label_attr" => ["for" => $this->readKey("description", $fieldsIdKeys)],
            "required" => false,
            "constraints" => array(
            ),
            "attr" => array(
            )
        ));
    }

    protected function addChapoField(array $translationKeys, array $fieldsIdKeys)
    {
        $this->formBuilder->add("chapo", "textarea", array(
            "label" => $this->trans($this->readKey("chapo", $translationKeys)),
            "label_attr" => ["for" => $this->readKey("chapo", $fieldsIdKeys)],
            "required" => false,
            "constraints" => array(
            ),
            "attr" => array(
            )
        ));
    }

    protected function addPostscriptumField(array $translationKeys, array $fieldsIdKeys)
    {
        $this->formBuilder->add("postscriptum", "textarea", array(
            "label" => $this->trans($this->readKey("postscriptum", $translationKeys)),
            "label_attr" => ["for" => $this->readKey("postscriptum", $fieldsIdKeys)],
            "required" => false,
            "constraints" => array(
            ),
            "attr" => array(
            )
        ));
    }

    public function getName()
    {
        return static::FORM_NAME;
    }

    public function readKey($key, array $keys, $default = '')
    {
        if (isset($keys[$key])) {
            return $keys[$key];
        }

        return $default;
    }

    public function getTranslationKeys()
    {
        return array(
            "diaporama_id" => "diaporama_image.create.diaporama_id",
            "file" => "diaporama_image.create.file",
            "visible" => "diaporama_image.create.visible",
            "position" => "diaporama_image.create.position",
            "title" => "diaporama_image.create.title",
            "description" => "diaporama_image.create.description",
            "chapo" => "diaporama_image.create.chapo",
            "postscriptum" => "diaporama_image.create.postscriptum",
        );
    }

    public function getFieldsIdKeys()
    {
        return array(
            "diaporama_id" => "diaporama_image_diaporama_id",
            "file" => "diaporama_image_file",
            "visible" => "diaporama_image_visible",
            "position" => "diaporama_image_position",
            "title" => "diaporama_image_title",
            "description" => "diaporama_image_description",
            "chapo" => "diaporama_image_chapo",
            "postscriptum" => "diaporama_image_postscriptum",
        );
    }

    public function trans($key, array $parameters = array(), $domain = Diaporamas::BO_MESSAGE_DOMAIN)
    {
        return $this->translator->trans($key, $parameters, $domain);
    }
}
