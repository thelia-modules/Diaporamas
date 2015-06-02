<?php

namespace Diaporamas\Model\Base;

use \Exception;
use \PDO;
use Diaporamas\Model\BrandDiaporamaImage as ChildBrandDiaporamaImage;
use Diaporamas\Model\BrandDiaporamaImageQuery as ChildBrandDiaporamaImageQuery;
use Diaporamas\Model\DiaporamaImageQuery as ChildDiaporamaImageQuery;
use Diaporamas\Model\Map\BrandDiaporamaImageTableMap;
use Diaporamas\Model\Thelia\Model\BrandImage;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'brand_diaporama_image' table.
 *
 *
 *
 * @method     ChildBrandDiaporamaImageQuery orderByBrandImageId($order = Criteria::ASC) Order by the brand_image_id column
 * @method     ChildBrandDiaporamaImageQuery orderByPosition($order = Criteria::ASC) Order by the position column
 * @method     ChildBrandDiaporamaImageQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildBrandDiaporamaImageQuery orderByDiaporamaId($order = Criteria::ASC) Order by the diaporama_id column
 *
 * @method     ChildBrandDiaporamaImageQuery groupByBrandImageId() Group by the brand_image_id column
 * @method     ChildBrandDiaporamaImageQuery groupByPosition() Group by the position column
 * @method     ChildBrandDiaporamaImageQuery groupById() Group by the id column
 * @method     ChildBrandDiaporamaImageQuery groupByDiaporamaId() Group by the diaporama_id column
 *
 * @method     ChildBrandDiaporamaImageQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildBrandDiaporamaImageQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildBrandDiaporamaImageQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildBrandDiaporamaImageQuery leftJoinBrandImage($relationAlias = null) Adds a LEFT JOIN clause to the query using the BrandImage relation
 * @method     ChildBrandDiaporamaImageQuery rightJoinBrandImage($relationAlias = null) Adds a RIGHT JOIN clause to the query using the BrandImage relation
 * @method     ChildBrandDiaporamaImageQuery innerJoinBrandImage($relationAlias = null) Adds a INNER JOIN clause to the query using the BrandImage relation
 *
 * @method     ChildBrandDiaporamaImageQuery leftJoinDiaporamaImage($relationAlias = null) Adds a LEFT JOIN clause to the query using the DiaporamaImage relation
 * @method     ChildBrandDiaporamaImageQuery rightJoinDiaporamaImage($relationAlias = null) Adds a RIGHT JOIN clause to the query using the DiaporamaImage relation
 * @method     ChildBrandDiaporamaImageQuery innerJoinDiaporamaImage($relationAlias = null) Adds a INNER JOIN clause to the query using the DiaporamaImage relation
 *
 * @method     ChildBrandDiaporamaImageQuery leftJoinDiaporama($relationAlias = null) Adds a LEFT JOIN clause to the query using the Diaporama relation
 * @method     ChildBrandDiaporamaImageQuery rightJoinDiaporama($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Diaporama relation
 * @method     ChildBrandDiaporamaImageQuery innerJoinDiaporama($relationAlias = null) Adds a INNER JOIN clause to the query using the Diaporama relation
 *
 * @method     ChildBrandDiaporamaImage findOne(ConnectionInterface $con = null) Return the first ChildBrandDiaporamaImage matching the query
 * @method     ChildBrandDiaporamaImage findOneOrCreate(ConnectionInterface $con = null) Return the first ChildBrandDiaporamaImage matching the query, or a new ChildBrandDiaporamaImage object populated from the query conditions when no match is found
 *
 * @method     ChildBrandDiaporamaImage findOneByBrandImageId(int $brand_image_id) Return the first ChildBrandDiaporamaImage filtered by the brand_image_id column
 * @method     ChildBrandDiaporamaImage findOneByPosition(int $position) Return the first ChildBrandDiaporamaImage filtered by the position column
 * @method     ChildBrandDiaporamaImage findOneById(int $id) Return the first ChildBrandDiaporamaImage filtered by the id column
 * @method     ChildBrandDiaporamaImage findOneByDiaporamaId(int $diaporama_id) Return the first ChildBrandDiaporamaImage filtered by the diaporama_id column
 *
 * @method     array findByBrandImageId(int $brand_image_id) Return ChildBrandDiaporamaImage objects filtered by the brand_image_id column
 * @method     array findByPosition(int $position) Return ChildBrandDiaporamaImage objects filtered by the position column
 * @method     array findById(int $id) Return ChildBrandDiaporamaImage objects filtered by the id column
 * @method     array findByDiaporamaId(int $diaporama_id) Return ChildBrandDiaporamaImage objects filtered by the diaporama_id column
 *
 */
abstract class BrandDiaporamaImageQuery extends ChildDiaporamaImageQuery
{

    /**
     * Initializes internal state of \Diaporamas\Model\Base\BrandDiaporamaImageQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'thelia', $modelName = '\\Diaporamas\\Model\\BrandDiaporamaImage', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildBrandDiaporamaImageQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildBrandDiaporamaImageQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof \Diaporamas\Model\BrandDiaporamaImageQuery) {
            return $criteria;
        }
        $query = new \Diaporamas\Model\BrandDiaporamaImageQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildBrandDiaporamaImage|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = BrandDiaporamaImageTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(BrandDiaporamaImageTableMap::DATABASE_NAME);
        }
        $this->basePreSelect($con);
        if ($this->formatter || $this->modelAlias || $this->with || $this->select
         || $this->selectColumns || $this->asColumns || $this->selectModifiers
         || $this->map || $this->having || $this->joins) {
            return $this->findPkComplex($key, $con);
        } else {
            return $this->findPkSimple($key, $con);
        }
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @return   ChildBrandDiaporamaImage A model object, or null if the key is not found
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT BRAND_IMAGE_ID, POSITION, ID, DIAPORAMA_ID FROM brand_diaporama_image WHERE ID = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            $obj = new ChildBrandDiaporamaImage();
            $obj->hydrate($row);
            BrandDiaporamaImageTableMap::addInstanceToPool($obj, (string) $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @return ChildBrandDiaporamaImage|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($dataFetcher);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return ObjectCollection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($dataFetcher);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return ChildBrandDiaporamaImageQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(BrandDiaporamaImageTableMap::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return ChildBrandDiaporamaImageQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(BrandDiaporamaImageTableMap::ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the brand_image_id column
     *
     * Example usage:
     * <code>
     * $query->filterByBrandImageId(1234); // WHERE brand_image_id = 1234
     * $query->filterByBrandImageId(array(12, 34)); // WHERE brand_image_id IN (12, 34)
     * $query->filterByBrandImageId(array('min' => 12)); // WHERE brand_image_id > 12
     * </code>
     *
     * @see       filterByBrandImage()
     *
     * @param     mixed $brandImageId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildBrandDiaporamaImageQuery The current query, for fluid interface
     */
    public function filterByBrandImageId($brandImageId = null, $comparison = null)
    {
        if (is_array($brandImageId)) {
            $useMinMax = false;
            if (isset($brandImageId['min'])) {
                $this->addUsingAlias(BrandDiaporamaImageTableMap::BRAND_IMAGE_ID, $brandImageId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($brandImageId['max'])) {
                $this->addUsingAlias(BrandDiaporamaImageTableMap::BRAND_IMAGE_ID, $brandImageId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BrandDiaporamaImageTableMap::BRAND_IMAGE_ID, $brandImageId, $comparison);
    }

    /**
     * Filter the query on the position column
     *
     * Example usage:
     * <code>
     * $query->filterByPosition(1234); // WHERE position = 1234
     * $query->filterByPosition(array(12, 34)); // WHERE position IN (12, 34)
     * $query->filterByPosition(array('min' => 12)); // WHERE position > 12
     * </code>
     *
     * @param     mixed $position The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildBrandDiaporamaImageQuery The current query, for fluid interface
     */
    public function filterByPosition($position = null, $comparison = null)
    {
        if (is_array($position)) {
            $useMinMax = false;
            if (isset($position['min'])) {
                $this->addUsingAlias(BrandDiaporamaImageTableMap::POSITION, $position['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($position['max'])) {
                $this->addUsingAlias(BrandDiaporamaImageTableMap::POSITION, $position['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BrandDiaporamaImageTableMap::POSITION, $position, $comparison);
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE id = 1234
     * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE id > 12
     * </code>
     *
     * @see       filterByDiaporamaImage()
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildBrandDiaporamaImageQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(BrandDiaporamaImageTableMap::ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(BrandDiaporamaImageTableMap::ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BrandDiaporamaImageTableMap::ID, $id, $comparison);
    }

    /**
     * Filter the query on the diaporama_id column
     *
     * Example usage:
     * <code>
     * $query->filterByDiaporamaId(1234); // WHERE diaporama_id = 1234
     * $query->filterByDiaporamaId(array(12, 34)); // WHERE diaporama_id IN (12, 34)
     * $query->filterByDiaporamaId(array('min' => 12)); // WHERE diaporama_id > 12
     * </code>
     *
     * @see       filterByDiaporama()
     *
     * @param     mixed $diaporamaId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildBrandDiaporamaImageQuery The current query, for fluid interface
     */
    public function filterByDiaporamaId($diaporamaId = null, $comparison = null)
    {
        if (is_array($diaporamaId)) {
            $useMinMax = false;
            if (isset($diaporamaId['min'])) {
                $this->addUsingAlias(BrandDiaporamaImageTableMap::DIAPORAMA_ID, $diaporamaId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($diaporamaId['max'])) {
                $this->addUsingAlias(BrandDiaporamaImageTableMap::DIAPORAMA_ID, $diaporamaId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BrandDiaporamaImageTableMap::DIAPORAMA_ID, $diaporamaId, $comparison);
    }

    /**
     * Filter the query by a related \Diaporamas\Model\Thelia\Model\BrandImage object
     *
     * @param \Diaporamas\Model\Thelia\Model\BrandImage|ObjectCollection $brandImage The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildBrandDiaporamaImageQuery The current query, for fluid interface
     */
    public function filterByBrandImage($brandImage, $comparison = null)
    {
        if ($brandImage instanceof \Diaporamas\Model\Thelia\Model\BrandImage) {
            return $this
                ->addUsingAlias(BrandDiaporamaImageTableMap::BRAND_IMAGE_ID, $brandImage->getId(), $comparison);
        } elseif ($brandImage instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(BrandDiaporamaImageTableMap::BRAND_IMAGE_ID, $brandImage->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByBrandImage() only accepts arguments of type \Diaporamas\Model\Thelia\Model\BrandImage or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the BrandImage relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return ChildBrandDiaporamaImageQuery The current query, for fluid interface
     */
    public function joinBrandImage($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('BrandImage');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'BrandImage');
        }

        return $this;
    }

    /**
     * Use the BrandImage relation BrandImage object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Diaporamas\Model\Thelia\Model\BrandImageQuery A secondary query class using the current class as primary query
     */
    public function useBrandImageQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinBrandImage($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'BrandImage', '\Diaporamas\Model\Thelia\Model\BrandImageQuery');
    }

    /**
     * Filter the query by a related \Diaporamas\Model\DiaporamaImage object
     *
     * @param \Diaporamas\Model\DiaporamaImage|ObjectCollection $diaporamaImage The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildBrandDiaporamaImageQuery The current query, for fluid interface
     */
    public function filterByDiaporamaImage($diaporamaImage, $comparison = null)
    {
        if ($diaporamaImage instanceof \Diaporamas\Model\DiaporamaImage) {
            return $this
                ->addUsingAlias(BrandDiaporamaImageTableMap::ID, $diaporamaImage->getId(), $comparison);
        } elseif ($diaporamaImage instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(BrandDiaporamaImageTableMap::ID, $diaporamaImage->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByDiaporamaImage() only accepts arguments of type \Diaporamas\Model\DiaporamaImage or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the DiaporamaImage relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return ChildBrandDiaporamaImageQuery The current query, for fluid interface
     */
    public function joinDiaporamaImage($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('DiaporamaImage');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'DiaporamaImage');
        }

        return $this;
    }

    /**
     * Use the DiaporamaImage relation DiaporamaImage object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Diaporamas\Model\DiaporamaImageQuery A secondary query class using the current class as primary query
     */
    public function useDiaporamaImageQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinDiaporamaImage($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'DiaporamaImage', '\Diaporamas\Model\DiaporamaImageQuery');
    }

    /**
     * Filter the query by a related \Diaporamas\Model\Diaporama object
     *
     * @param \Diaporamas\Model\Diaporama|ObjectCollection $diaporama The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildBrandDiaporamaImageQuery The current query, for fluid interface
     */
    public function filterByDiaporama($diaporama, $comparison = null)
    {
        if ($diaporama instanceof \Diaporamas\Model\Diaporama) {
            return $this
                ->addUsingAlias(BrandDiaporamaImageTableMap::DIAPORAMA_ID, $diaporama->getId(), $comparison);
        } elseif ($diaporama instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(BrandDiaporamaImageTableMap::DIAPORAMA_ID, $diaporama->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByDiaporama() only accepts arguments of type \Diaporamas\Model\Diaporama or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Diaporama relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return ChildBrandDiaporamaImageQuery The current query, for fluid interface
     */
    public function joinDiaporama($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Diaporama');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Diaporama');
        }

        return $this;
    }

    /**
     * Use the Diaporama relation Diaporama object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Diaporamas\Model\DiaporamaQuery A secondary query class using the current class as primary query
     */
    public function useDiaporamaQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinDiaporama($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Diaporama', '\Diaporamas\Model\DiaporamaQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildBrandDiaporamaImage $brandDiaporamaImage Object to remove from the list of results
     *
     * @return ChildBrandDiaporamaImageQuery The current query, for fluid interface
     */
    public function prune($brandDiaporamaImage = null)
    {
        if ($brandDiaporamaImage) {
            $this->addUsingAlias(BrandDiaporamaImageTableMap::ID, $brandDiaporamaImage->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the brand_diaporama_image table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(BrandDiaporamaImageTableMap::DATABASE_NAME);
        }
        $affectedRows = 0; // initialize var to track total num of affected rows
        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            BrandDiaporamaImageTableMap::clearInstancePool();
            BrandDiaporamaImageTableMap::clearRelatedInstancePool();

            $con->commit();
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }

        return $affectedRows;
    }

    /**
     * Performs a DELETE on the database, given a ChildBrandDiaporamaImage or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or ChildBrandDiaporamaImage object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *         rethrown wrapped into a PropelException.
     */
     public function delete(ConnectionInterface $con = null)
     {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(BrandDiaporamaImageTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(BrandDiaporamaImageTableMap::DATABASE_NAME);

        $affectedRows = 0; // initialize var to track total num of affected rows

        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();


        BrandDiaporamaImageTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            BrandDiaporamaImageTableMap::clearRelatedInstancePool();
            $con->commit();

            return $affectedRows;
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }
    }

} // BrandDiaporamaImageQuery
