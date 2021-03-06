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

namespace Diaporamas\Loop;

use Diaporamas\Model\DiaporamaImageQuery;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Thelia\Core\Template\Element\LoopResultRow;
use Thelia\Core\Template\Loop\Argument\ArgumentCollection;
use Thelia\Core\Template\Loop\Image;

/**
 * Class DiaporamaImage
 * @package Diaporamas\Loop
 */
class DiaporamaImage extends Image
{
    /**
     * @return \Thelia\Core\Template\Loop\Argument\ArgumentCollection
     */
    protected function getArgDefinitions()
    {
        $imageCollection = parent::getArgDefinitions();

        $collection = new ArgumentCollection();

        foreach ($imageCollection as $argument) {
            if (!in_array($argument->name, $this->possible_sources) and $argument->name != 'source') {
                $collection->addArgument($argument);
            }
        }

        return $collection;
    }

    /**
     * Dynamically create the search query, and set the proper filter and order
     *
     * @param  string        $source    a valid source identifier (@see $possible_sources)
     * @param  int           $object_id the source object ID
     * @return ModelCriteria the propel Query object
     */
    protected function createSearchQuery($source, $object_id)
    {
        $search = DiaporamaImageQuery::create();
        !is_null($object_id) and $search->filterByDiaporamaId($object_id);

        $orders  = $this->getOrder();

        // Results ordering
        foreach ($orders as $order) {
            switch ($order) {
                case "alpha":
                    $search->addAscendingOrderByColumn('i18n_TITLE');
                    break;
                case "alpha-reverse":
                    $search->addDescendingOrderByColumn('i18n_TITLE');
                    break;
                case "manual-reverse":
                    $search->orderByPosition(Criteria::DESC);
                    break;
                case "manual":
                    $search->orderByPosition(Criteria::ASC);
                    break;
                case "random":
                    $search->clearOrderByColumns();
                    $search->addAscendingOrderByColumn('RAND()');
                    break(2);
                    break;
            }
        }

        return $search;
    }

    /**
     * Dynamically create the search query, and set the proper filter and order
     *
     * @param  string        $object_type (returned) the a valid source identifier (@see $possible_sources)
     * @param  string        $object_id   (returned) the ID of the source object
     * @return ModelCriteria the propel Query object
     */
    protected function getSearchQuery(&$object_type, &$object_id)
    {
        $search = null;

        // Check form source="product" source_id="123" style arguments
        $source = 'diaporama';

        $source_id = $this->getSourceId();
        $id = $this->getId();

        if (is_null($source_id) and is_null($id)) {
            throw new \InvalidArgumentException("If 'source' argument is specified, 'id' or 'source_id' argument should be specified");
        }

        $search = $this->createSearchQuery($source, $source_id);

        $object_type = $source;
        $object_id   = $source_id;

        return $search;
    }

    /**
     * Use this method in order to add fields in sub-classes
     * @param LoopResultRow $loopResultRow
     * @param \Diaporamas\Model\DiaporamaImage $item
     *
     */
    protected function addOutputFields(LoopResultRow $loopResultRow, $item)
    {
        $loopResultRow->set('OBJECT_ID', $item->getDiaporamaId());
    }
}
