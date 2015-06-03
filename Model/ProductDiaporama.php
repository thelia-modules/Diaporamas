<?php

namespace Diaporamas\Model;

use Diaporamas\Model\Map\DiaporamaTableMap;


/**
 * Skeleton subclass for representing a row from one of the subclasses of the 'diaporama' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 */
class ProductDiaporama extends Diaporama
{

    /**
     * Constructs a new ProductDiaporama class, setting the diaporama_type_id column to DiaporamaTableMap::CLASSKEY_1.
     */
    public function __construct()
    {
        parent::__construct();
        $this->setDiaporamaTypeId(DiaporamaTableMap::CLASSKEY_1);
    }

} // ProductDiaporama
