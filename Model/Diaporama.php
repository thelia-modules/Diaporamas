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

use Diaporamas\Model\Base\Diaporama as BaseDiaporama;

/**
 * Class Diaporama
 * @package Diaporamas\Model
 */
class Diaporama extends BaseDiaporama
{
    const SHORTCODE_OPENING_TAG = '[£ ';

    const SHORTCODE_CLOSING_TAG = ' £]';

    const SHORTCODE_REGEX = '/^[\w\-]{1,32}$/';

    const SHORTCODETAG_REGEX = '/\[£\s[\w\-]{1,32}\s£\]/';

    const SHORTCODETAG_HTMLENTITIES_REGEX = '/\[(£|&pound;)(\s|&nbsp;)+[\w\-]{1,32}(\s|&nbsp;)+(£|&pound;)\]/';

    /**
     * Retrieving a diaporama with its shortcode
     * @param string $shortcode Diaporama shortcode
     * @return Diaporama|null The diaporama whose shortcode is [£ $shortcode £] if it exists, null otherwise.
     */
    public static function getByShortcode($shortcode)
    {
        return DiaporamaQuery::create()->findOneByShortcode($shortcode);
    }

    /**
     * Telling if a diaporama exists according to its shortcode
     * @param string $shortcode Diaporama shortcode
     * @return Diaporama|null true if the diaporama with the [£ $shortcode £] shortcode exists, false otherwise.
     */
    public static function existsByShortcode($shortcode)
    {
        return DiaporamaQuery::create()->filterByShortcode($shortcode)->count() > 0;
    }

    /**
     * Building the shortcode tag
     * @return string [£shortcode£]
     */
    public function getShortcodeTag()
    {
        return self::SHORTCODE_OPENING_TAG.$this->shortcode.self::SHORTCODE_CLOSING_TAG;
    }

    /**
     * Retrieving diaporama's images
     * @return array Diaporama's images.
     */
    public function getImages()
    {
        return DiaporamaImageQuery::create()->findByDiaporamaId($this->getId());
    }
}
