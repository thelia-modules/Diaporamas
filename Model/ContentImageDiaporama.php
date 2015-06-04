<?php

namespace Diaporamas\Model;

use Diaporamas\Model\Map\DiaporamaImageTableMap;


/**
 * Skeleton subclass for representing a row from one of the subclasses of the 'diaporama_image' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 */
class ContentImageDiaporama extends DiaporamaImage
{

    /**
     * Constructs a new ContentImageDiaporama class, setting the diaporama_type_id column to DiaporamaImageTableMap::CLASSKEY_5.
     */
    public function __construct()
    {
        parent::__construct();
        $this->setDiaporamaTypeId(DiaporamaImageTableMap::CLASSKEY_5);
    }

} // ContentImageDiaporama