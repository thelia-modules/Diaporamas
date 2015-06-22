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

namespace Diaporamas;

use SmartyFilter\Model\SmartyFilterQuery;
use Symfony\Component\Filesystem\Filesystem;
use Thelia\Model\ConfigQuery;
use Thelia\Module\BaseModule;
use Propel\Runtime\Connection\ConnectionInterface;
use Thelia\Install\Database;

/**
 * Class Diaporamas
 * @package Diaporamas
 */
class Diaporamas extends BaseModule
{
    const MESSAGE_DOMAIN = "diaporamas";
    const BO_MESSAGE_DOMAIN = "diaporamas.bo.default";
    const ROUTER = "router.diaporamas";
    const SMARTY_FILTER = 'diaporamas.filter.shortcodes';

    public function postActivation(ConnectionInterface $con = null)
    {
        $database = new Database($con);
        $database->insertSql(null, [__DIR__ . "/Config/create.sql", __DIR__ . "/Config/insert.sql"]);

        // Creating the folder for diaporama
        $fs = new Filesystem();
        $diaporamaImagesFolder = Diaporamas::getDiaporamaImagesFolder();
        !$fs->exists($diaporamaImagesFolder) and $fs->mkdir($diaporamaImagesFolder);

        // Activate the Smarty filter for shortcodes
        $smartyFilter = SmartyFilterQuery::create()->findOneByCode(self::SMARTY_FILTER);
        if (!(is_null($smartyFilter) or $smartyFilter->getActive())) {
            $smartyFilter->setActive(true);
            $smartyFilter->save();
        }
    }

    public function postDeactivation(ConnectionInterface $con = null)
    {
        // Deactivate the Smarty filter for shortcodes
        $smartyFilter = SmartyFilterQuery::create()->findOneByCode(self::SMARTY_FILTER);
        if (!is_null($smartyFilter) and $smartyFilter->getActive()) {
            $smartyFilter->setActive(false);
            $smartyFilter->save();
        }
    }

    public static function getDiaporamaImagesFolder()
    {
        return sprintf(
            "%s%s/diaporama",
            THELIA_ROOT,
            ConfigQuery::read('images_library_path', 'local'.DS.'media'.DS.'images')
        );
    }

    public function destroy(ConnectionInterface $con = null, $deleteModuleData = false)
    {
        if ($deleteModuleData) {
            $fs = new Filesystem();
            $diaporamaImagesFolder = Diaporamas::getDiaporamaImagesFolder();
            $fs->exists($diaporamaImagesFolder) and $fs->remove($diaporamaImagesFolder);
        }

        return parent::destroy($con, $deleteModuleData);
    }
}
