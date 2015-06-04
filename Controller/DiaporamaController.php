<?php
/**
* This class has been generated by TheliaStudio
* For more information, see https://github.com/thelia-modules/TheliaStudio
*/

namespace Diaporamas\Controller;

use Diaporamas\Controller\Base\DiaporamaController as BaseDiaporamaController;
use Diaporamas\Model\DiaporamaTypeQuery;
use Thelia\Core\HttpFoundation\JsonResponse;

/**
 * Class DiaporamaController
 * @package Diaporamas\Controller
 */
class DiaporamaController extends BaseDiaporamaController
{
    public function retrieveEntityChoicesAction($diaporama_type_id)
    {
        $documentTypes = DiaporamaTypeQuery::create()->orderBy('id')->find()->toKeyValue('id', 'code');
        $response = array();

        if (in_array($diaporama_type_id, array_keys($documentTypes))) {
            $diaporama_type = ucfirst($documentTypes[$diaporama_type_id]);
            $queryClass = '\\Thelia\\Model\\'.$diaporama_type.'Query';
            $typeTable = $diaporama_type;
            $typeTableI18n = $diaporama_type.'I18n';
            $id_field = "$typeTable.Id";
            $title_field = "$typeTableI18n.Title";
            $response = $queryClass::create()
                ->join("$typeTable.$typeTableI18n")
                ->where("$typeTableI18n.Locale = ?", $this->getTranslator()->getLocale())
                ->select(array($id_field, $title_field))
                ->find()
                ->toKeyValue($id_field, $title_field)
            ;
        }

        return new JsonResponse($response);
    }
}
