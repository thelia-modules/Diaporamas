<?php

namespace Diaporamas\Model\Map;

use Diaporamas\Model\DiaporamaImage;
use Diaporamas\Model\DiaporamaImageQuery;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\InstancePoolTrait;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\DataFetcher\DataFetcherInterface;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\RelationMap;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Map\TableMapTrait;


/**
 * This class defines the structure of the 'diaporama_image' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class DiaporamaImageTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;
    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'Diaporamas.Model.Map.DiaporamaImageTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'thelia';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'diaporama_image';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\Diaporamas\\Model\\DiaporamaImage';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'Diaporamas.Model.DiaporamaImage';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 5;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 5;

    /**
     * the column name for the ID field
     */
    const ID = 'diaporama_image.ID';

    /**
     * the column name for the DIAPORAMA_ID field
     */
    const DIAPORAMA_ID = 'diaporama_image.DIAPORAMA_ID';

    /**
     * the column name for the DIAPORAMA_TYPE_ID field
     */
    const DIAPORAMA_TYPE_ID = 'diaporama_image.DIAPORAMA_TYPE_ID';

    /**
     * the column name for the ENTITY_ID field
     */
    const ENTITY_ID = 'diaporama_image.ENTITY_ID';

    /**
     * the column name for the POSITION field
     */
    const POSITION = 'diaporama_image.POSITION';

    /**
     * The default string format for model objects of the related table
     */
    const DEFAULT_STRING_FORMAT = 'YAML';

    /** A key representing a particular subclass */
    const CLASSKEY_1 = '1';

    /** A key representing a particular subclass */
    const CLASSKEY_PRODUCTIMAGEDIAPORAMA = '\\Diaporamas\\Model\\ProductImageDiaporama';

    /** A class that can be returned by this tableMap. */
    const CLASSNAME_1 = '\\Diaporamas\\Model\\ProductImageDiaporama';

    /** A key representing a particular subclass */
    const CLASSKEY_2 = '2';

    /** A key representing a particular subclass */
    const CLASSKEY_CATEGORYIMAGEDIAPORAMA = '\\Diaporamas\\Model\\CategoryImageDiaporama';

    /** A class that can be returned by this tableMap. */
    const CLASSNAME_2 = '\\Diaporamas\\Model\\CategoryImageDiaporama';

    /** A key representing a particular subclass */
    const CLASSKEY_3 = '3';

    /** A key representing a particular subclass */
    const CLASSKEY_BRANDIMAGEDIAPORAMA = '\\Diaporamas\\Model\\BrandImageDiaporama';

    /** A class that can be returned by this tableMap. */
    const CLASSNAME_3 = '\\Diaporamas\\Model\\BrandImageDiaporama';

    /** A key representing a particular subclass */
    const CLASSKEY_4 = '4';

    /** A key representing a particular subclass */
    const CLASSKEY_FOLDERIMAGEDIAPORAMA = '\\Diaporamas\\Model\\FolderImageDiaporama';

    /** A class that can be returned by this tableMap. */
    const CLASSNAME_4 = '\\Diaporamas\\Model\\FolderImageDiaporama';

    /** A key representing a particular subclass */
    const CLASSKEY_5 = '5';

    /** A key representing a particular subclass */
    const CLASSKEY_CONTENTIMAGEDIAPORAMA = '\\Diaporamas\\Model\\ContentImageDiaporama';

    /** A class that can be returned by this tableMap. */
    const CLASSNAME_5 = '\\Diaporamas\\Model\\ContentImageDiaporama';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        self::TYPE_PHPNAME       => array('Id', 'DiaporamaId', 'DiaporamaTypeId', 'EntityId', 'Position', ),
        self::TYPE_STUDLYPHPNAME => array('id', 'diaporamaId', 'diaporamaTypeId', 'entityId', 'position', ),
        self::TYPE_COLNAME       => array(DiaporamaImageTableMap::ID, DiaporamaImageTableMap::DIAPORAMA_ID, DiaporamaImageTableMap::DIAPORAMA_TYPE_ID, DiaporamaImageTableMap::ENTITY_ID, DiaporamaImageTableMap::POSITION, ),
        self::TYPE_RAW_COLNAME   => array('ID', 'DIAPORAMA_ID', 'DIAPORAMA_TYPE_ID', 'ENTITY_ID', 'POSITION', ),
        self::TYPE_FIELDNAME     => array('id', 'diaporama_id', 'diaporama_type_id', 'entity_id', 'position', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'DiaporamaId' => 1, 'DiaporamaTypeId' => 2, 'EntityId' => 3, 'Position' => 4, ),
        self::TYPE_STUDLYPHPNAME => array('id' => 0, 'diaporamaId' => 1, 'diaporamaTypeId' => 2, 'entityId' => 3, 'position' => 4, ),
        self::TYPE_COLNAME       => array(DiaporamaImageTableMap::ID => 0, DiaporamaImageTableMap::DIAPORAMA_ID => 1, DiaporamaImageTableMap::DIAPORAMA_TYPE_ID => 2, DiaporamaImageTableMap::ENTITY_ID => 3, DiaporamaImageTableMap::POSITION => 4, ),
        self::TYPE_RAW_COLNAME   => array('ID' => 0, 'DIAPORAMA_ID' => 1, 'DIAPORAMA_TYPE_ID' => 2, 'ENTITY_ID' => 3, 'POSITION' => 4, ),
        self::TYPE_FIELDNAME     => array('id' => 0, 'diaporama_id' => 1, 'diaporama_type_id' => 2, 'entity_id' => 3, 'position' => 4, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, )
    );

    /**
     * Initialize the table attributes and columns
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('diaporama_image');
        $this->setPhpName('DiaporamaImage');
        $this->setClassName('\\Diaporamas\\Model\\DiaporamaImage');
        $this->setPackage('Diaporamas.Model');
        $this->setUseIdGenerator(true);
        $this->setSingleTableInheritance(true);
        // columns
        $this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
        $this->addForeignKey('DIAPORAMA_ID', 'DiaporamaId', 'INTEGER', 'diaporama', 'ID', true, null, null);
        $this->addForeignKey('DIAPORAMA_TYPE_ID', 'DiaporamaTypeId', 'INTEGER', 'diaporama_type', 'ID', true, null, null);
        $this->addColumn('ENTITY_ID', 'EntityId', 'INTEGER', true, null, null);
        $this->addColumn('POSITION', 'Position', 'INTEGER', true, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Diaporama', '\\Diaporamas\\Model\\Diaporama', RelationMap::MANY_TO_ONE, array('diaporama_id' => 'id', ), null, null);
        $this->addRelation('DiaporamaType', '\\Diaporamas\\Model\\DiaporamaType', RelationMap::MANY_TO_ONE, array('diaporama_type_id' => 'id', ), null, null);
    } // buildRelations()

    /**
     *
     * Gets the list of behaviors registered for this table
     *
     * @return array Associative array (name => parameters) of behaviors
     */
    public function getBehaviors()
    {
        return array(
            'validate' => array('positionRule' => array ('column' => 'position','validator' => 'GreaterThan','options' => array ('value' => 0,),), ),
        );
    } // getBehaviors()

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_STUDLYPHPNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     */
    public static function getPrimaryKeyHashFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        // If the PK cannot be derived from the row, return NULL.
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
    }

    /**
     * Retrieves the primary key from the DB resultset row
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, an array of the primary key columns will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_STUDLYPHPNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {

            return (int) $row[
                            $indexType == TableMap::TYPE_NUM
                            ? 0 + $offset
                            : self::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)
                        ];
    }

    /**
     * The returned Class will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @param array   $row ConnectionInterface result row.
     * @param int     $colnum Column to examine for OM class information (first is 0).
     * @param boolean $withPrefix Whether or not to return the path with the class name
     * @throws PropelException Any exceptions caught during processing will be
     *         rethrown wrapped into a PropelException.
     */
    public static function getOMClass($row, $colnum, $withPrefix = true)
    {
        try {

            $omClass = null;
            $classKey = $row[$colnum + 2];

            switch ($classKey) {

                case DiaporamaImageTableMap::CLASSKEY_1:
                    $omClass = DiaporamaImageTableMap::CLASSNAME_1;
                    break;

                case DiaporamaImageTableMap::CLASSKEY_2:
                    $omClass = DiaporamaImageTableMap::CLASSNAME_2;
                    break;

                case DiaporamaImageTableMap::CLASSKEY_3:
                    $omClass = DiaporamaImageTableMap::CLASSNAME_3;
                    break;

                case DiaporamaImageTableMap::CLASSKEY_4:
                    $omClass = DiaporamaImageTableMap::CLASSNAME_4;
                    break;

                case DiaporamaImageTableMap::CLASSKEY_5:
                    $omClass = DiaporamaImageTableMap::CLASSNAME_5;
                    break;

                default:
                    $omClass = DiaporamaImageTableMap::CLASS_DEFAULT;

            } // switch
            if (!$withPrefix) {
                $omClass = preg_replace('#\.#', '\\', $omClass);
            }

        } catch (\Exception $e) {
            throw new PropelException('Unable to get OM class.', $e);
        }

        return $omClass;
    }

    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param array  $row       row returned by DataFetcher->fetch().
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                 One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_STUDLYPHPNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @throws PropelException Any exceptions caught during processing will be
     *         rethrown wrapped into a PropelException.
     * @return array (DiaporamaImage object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = DiaporamaImageTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = DiaporamaImageTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + DiaporamaImageTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = static::getOMClass($row, $offset, false);
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            DiaporamaImageTableMap::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @param DataFetcherInterface $dataFetcher
     * @return array
     * @throws PropelException Any exceptions caught during processing will be
     *         rethrown wrapped into a PropelException.
     */
    public static function populateObjects(DataFetcherInterface $dataFetcher)
    {
        $results = array();

        // populate the object(s)
        while ($row = $dataFetcher->fetch()) {
            $key = DiaporamaImageTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = DiaporamaImageTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                // class must be set each time from the record row
                $cls = static::getOMClass($row, 0);
                $cls = preg_replace('#\.#', '\\', $cls);
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                DiaporamaImageTableMap::addInstanceToPool($obj, $key);
            } // if key exists
        }

        return $results;
    }
    /**
     * Add all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be added to the select list and only loaded
     * on demand.
     *
     * @param Criteria $criteria object containing the columns to add.
     * @param string   $alias    optional table alias
     * @throws PropelException Any exceptions caught during processing will be
     *         rethrown wrapped into a PropelException.
     */
    public static function addSelectColumns(Criteria $criteria, $alias = null)
    {
        if (null === $alias) {
            $criteria->addSelectColumn(DiaporamaImageTableMap::ID);
            $criteria->addSelectColumn(DiaporamaImageTableMap::DIAPORAMA_ID);
            $criteria->addSelectColumn(DiaporamaImageTableMap::DIAPORAMA_TYPE_ID);
            $criteria->addSelectColumn(DiaporamaImageTableMap::ENTITY_ID);
            $criteria->addSelectColumn(DiaporamaImageTableMap::POSITION);
        } else {
            $criteria->addSelectColumn($alias . '.ID');
            $criteria->addSelectColumn($alias . '.DIAPORAMA_ID');
            $criteria->addSelectColumn($alias . '.DIAPORAMA_TYPE_ID');
            $criteria->addSelectColumn($alias . '.ENTITY_ID');
            $criteria->addSelectColumn($alias . '.POSITION');
        }
    }

    /**
     * Returns the TableMap related to this object.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws PropelException Any exceptions caught during processing will be
     *         rethrown wrapped into a PropelException.
     */
    public static function getTableMap()
    {
        return Propel::getServiceContainer()->getDatabaseMap(DiaporamaImageTableMap::DATABASE_NAME)->getTable(DiaporamaImageTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
      $dbMap = Propel::getServiceContainer()->getDatabaseMap(DiaporamaImageTableMap::DATABASE_NAME);
      if (!$dbMap->hasTable(DiaporamaImageTableMap::TABLE_NAME)) {
        $dbMap->addTableObject(new DiaporamaImageTableMap());
      }
    }

    /**
     * Performs a DELETE on the database, given a DiaporamaImage or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or DiaporamaImage object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *         rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, ConnectionInterface $con = null)
     {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(DiaporamaImageTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Diaporamas\Model\DiaporamaImage) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(DiaporamaImageTableMap::DATABASE_NAME);
            $criteria->add(DiaporamaImageTableMap::ID, (array) $values, Criteria::IN);
        }

        $query = DiaporamaImageQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) { DiaporamaImageTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) { DiaporamaImageTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the diaporama_image table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return DiaporamaImageQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a DiaporamaImage or Criteria object.
     *
     * @param mixed               $criteria Criteria or DiaporamaImage object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(DiaporamaImageTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from DiaporamaImage object
        }

        if ($criteria->containsKey(DiaporamaImageTableMap::ID) && $criteria->keyContainsValue(DiaporamaImageTableMap::ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.DiaporamaImageTableMap::ID.')');
        }


        // Set the correct dbName
        $query = DiaporamaImageQuery::create()->mergeWith($criteria);

        try {
            // use transaction because $criteria could contain info
            // for more than one table (I guess, conceivably)
            $con->beginTransaction();
            $pk = $query->doInsert($con);
            $con->commit();
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }

        return $pk;
    }

} // DiaporamaImageTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
DiaporamaImageTableMap::buildTableMap();
