<?php

namespace Diaporamas\Model\Base;

use \Exception;
use \PDO;
use Diaporamas\Model\CategoryDiaporamaImage as ChildCategoryDiaporamaImage;
use Diaporamas\Model\CategoryDiaporamaImageQuery as ChildCategoryDiaporamaImageQuery;
use Diaporamas\Model\DiaporamaImageQuery as ChildDiaporamaImageQuery;
use Diaporamas\Model\Map\CategoryDiaporamaImageTableMap;
use Diaporamas\Model\Thelia\Model\CategoryImage;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'category_diaporama_image' table.
 *
 *
 *
 * @method     ChildCategoryDiaporamaImageQuery orderByCategoryImageId($order = Criteria::ASC) Order by the category_image_id column
 * @method     ChildCategoryDiaporamaImageQuery orderByPosition($order = Criteria::ASC) Order by the position column
 * @method     ChildCategoryDiaporamaImageQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildCategoryDiaporamaImageQuery orderByDiaporamaId($order = Criteria::ASC) Order by the diaporama_id column
 *
 * @method     ChildCategoryDiaporamaImageQuery groupByCategoryImageId() Group by the category_image_id column
 * @method     ChildCategoryDiaporamaImageQuery groupByPosition() Group by the position column
 * @method     ChildCategoryDiaporamaImageQuery groupById() Group by the id column
 * @method     ChildCategoryDiaporamaImageQuery groupByDiaporamaId() Group by the diaporama_id column
 *
 * @method     ChildCategoryDiaporamaImageQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildCategoryDiaporamaImageQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildCategoryDiaporamaImageQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildCategoryDiaporamaImageQuery leftJoinCategoryImage($relationAlias = null) Adds a LEFT JOIN clause to the query using the CategoryImage relation
 * @method     ChildCategoryDiaporamaImageQuery rightJoinCategoryImage($relationAlias = null) Adds a RIGHT JOIN clause to the query using the CategoryImage relation
 * @method     ChildCategoryDiaporamaImageQuery innerJoinCategoryImage($relationAlias = null) Adds a INNER JOIN clause to the query using the CategoryImage relation
 *
 * @method     ChildCategoryDiaporamaImageQuery leftJoinDiaporamaImage($relationAlias = null) Adds a LEFT JOIN clause to the query using the DiaporamaImage relation
 * @method     ChildCategoryDiaporamaImageQuery rightJoinDiaporamaImage($relationAlias = null) Adds a RIGHT JOIN clause to the query using the DiaporamaImage relation
 * @method     ChildCategoryDiaporamaImageQuery innerJoinDiaporamaImage($relationAlias = null) Adds a INNER JOIN clause to the query using the DiaporamaImage relation
 *
 * @method     ChildCategoryDiaporamaImageQuery leftJoinDiaporama($relationAlias = null) Adds a LEFT JOIN clause to the query using the Diaporama relation
 * @method     ChildCategoryDiaporamaImageQuery rightJoinDiaporama($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Diaporama relation
 * @method     ChildCategoryDiaporamaImageQuery innerJoinDiaporama($relationAlias = null) Adds a INNER JOIN clause to the query using the Diaporama relation
 *
 * @method     ChildCategoryDiaporamaImage findOne(ConnectionInterface $con = null) Return the first ChildCategoryDiaporamaImage matching the query
 * @method     ChildCategoryDiaporamaImage findOneOrCreate(ConnectionInterface $con = null) Return the first ChildCategoryDiaporamaImage matching the query, or a new ChildCategoryDiaporamaImage object populated from the query conditions when no match is found
 *
 * @method     ChildCategoryDiaporamaImage findOneByCategoryImageId(int $category_image_id) Return the first ChildCategoryDiaporamaImage filtered by the category_image_id column
 * @method     ChildCategoryDiaporamaImage findOneByPosition(int $position) Return the first ChildCategoryDiaporamaImage filtered by the position column
 * @method     ChildCategoryDiaporamaImage findOneById(int $id) Return the first ChildCategoryDiaporamaImage filtered by the id column
 * @method     ChildCategoryDiaporamaImage findOneByDiaporamaId(int $diaporama_id) Return the first ChildCategoryDiaporamaImage filtered by the diaporama_id column
 *
 * @method     array findByCategoryImageId(int $category_image_id) Return ChildCategoryDiaporamaImage objects filtered by the category_image_id column
 * @method     array findByPosition(int $position) Return ChildCategoryDiaporamaImage objects filtered by the position column
 * @method     array findById(int $id) Return ChildCategoryDiaporamaImage objects filtered by the id column
 * @method     array findByDiaporamaId(int $diaporama_id) Return ChildCategoryDiaporamaImage objects filtered by the diaporama_id column
 *
 */
abstract class CategoryDiaporamaImageQuery extends ChildDiaporamaImageQuery
{

    /**
     * Initializes internal state of \Diaporamas\Model\Base\CategoryDiaporamaImageQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'thelia', $modelName = '\\Diaporamas\\Model\\CategoryDiaporamaImage', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildCategoryDiaporamaImageQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildCategoryDiaporamaImageQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof \Diaporamas\Model\CategoryDiaporamaImageQuery) {
            return $criteria;
        }
        $query = new \Diaporamas\Model\CategoryDiaporamaImageQuery();
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
     * @return ChildCategoryDiaporamaImage|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = CategoryDiaporamaImageTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(CategoryDiaporamaImageTableMap::DATABASE_NAME);
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
     * @return   ChildCategoryDiaporamaImage A model object, or null if the key is not found
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT CATEGORY_IMAGE_ID, POSITION, ID, DIAPORAMA_ID FROM category_diaporama_image WHERE ID = :p0';
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
            $obj = new ChildCategoryDiaporamaImage();
            $obj->hydrate($row);
            CategoryDiaporamaImageTableMap::addInstanceToPool($obj, (string) $key);
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
     * @return ChildCategoryDiaporamaImage|array|mixed the result, formatted by the current formatter
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
     * @return ChildCategoryDiaporamaImageQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(CategoryDiaporamaImageTableMap::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return ChildCategoryDiaporamaImageQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(CategoryDiaporamaImageTableMap::ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the category_image_id column
     *
     * Example usage:
     * <code>
     * $query->filterByCategoryImageId(1234); // WHERE category_image_id = 1234
     * $query->filterByCategoryImageId(array(12, 34)); // WHERE category_image_id IN (12, 34)
     * $query->filterByCategoryImageId(array('min' => 12)); // WHERE category_image_id > 12
     * </code>
     *
     * @see       filterByCategoryImage()
     *
     * @param     mixed $categoryImageId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildCategoryDiaporamaImageQuery The current query, for fluid interface
     */
    public function filterByCategoryImageId($categoryImageId = null, $comparison = null)
    {
        if (is_array($categoryImageId)) {
            $useMinMax = false;
            if (isset($categoryImageId['min'])) {
                $this->addUsingAlias(CategoryDiaporamaImageTableMap::CATEGORY_IMAGE_ID, $categoryImageId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($categoryImageId['max'])) {
                $this->addUsingAlias(CategoryDiaporamaImageTableMap::CATEGORY_IMAGE_ID, $categoryImageId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CategoryDiaporamaImageTableMap::CATEGORY_IMAGE_ID, $categoryImageId, $comparison);
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
     * @return ChildCategoryDiaporamaImageQuery The current query, for fluid interface
     */
    public function filterByPosition($position = null, $comparison = null)
    {
        if (is_array($position)) {
            $useMinMax = false;
            if (isset($position['min'])) {
                $this->addUsingAlias(CategoryDiaporamaImageTableMap::POSITION, $position['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($position['max'])) {
                $this->addUsingAlias(CategoryDiaporamaImageTableMap::POSITION, $position['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CategoryDiaporamaImageTableMap::POSITION, $position, $comparison);
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
     * @return ChildCategoryDiaporamaImageQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(CategoryDiaporamaImageTableMap::ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(CategoryDiaporamaImageTableMap::ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CategoryDiaporamaImageTableMap::ID, $id, $comparison);
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
     * @return ChildCategoryDiaporamaImageQuery The current query, for fluid interface
     */
    public function filterByDiaporamaId($diaporamaId = null, $comparison = null)
    {
        if (is_array($diaporamaId)) {
            $useMinMax = false;
            if (isset($diaporamaId['min'])) {
                $this->addUsingAlias(CategoryDiaporamaImageTableMap::DIAPORAMA_ID, $diaporamaId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($diaporamaId['max'])) {
                $this->addUsingAlias(CategoryDiaporamaImageTableMap::DIAPORAMA_ID, $diaporamaId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CategoryDiaporamaImageTableMap::DIAPORAMA_ID, $diaporamaId, $comparison);
    }

    /**
     * Filter the query by a related \Diaporamas\Model\Thelia\Model\CategoryImage object
     *
     * @param \Diaporamas\Model\Thelia\Model\CategoryImage|ObjectCollection $categoryImage The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildCategoryDiaporamaImageQuery The current query, for fluid interface
     */
    public function filterByCategoryImage($categoryImage, $comparison = null)
    {
        if ($categoryImage instanceof \Diaporamas\Model\Thelia\Model\CategoryImage) {
            return $this
                ->addUsingAlias(CategoryDiaporamaImageTableMap::CATEGORY_IMAGE_ID, $categoryImage->getId(), $comparison);
        } elseif ($categoryImage instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(CategoryDiaporamaImageTableMap::CATEGORY_IMAGE_ID, $categoryImage->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByCategoryImage() only accepts arguments of type \Diaporamas\Model\Thelia\Model\CategoryImage or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the CategoryImage relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return ChildCategoryDiaporamaImageQuery The current query, for fluid interface
     */
    public function joinCategoryImage($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('CategoryImage');

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
            $this->addJoinObject($join, 'CategoryImage');
        }

        return $this;
    }

    /**
     * Use the CategoryImage relation CategoryImage object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Diaporamas\Model\Thelia\Model\CategoryImageQuery A secondary query class using the current class as primary query
     */
    public function useCategoryImageQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinCategoryImage($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'CategoryImage', '\Diaporamas\Model\Thelia\Model\CategoryImageQuery');
    }

    /**
     * Filter the query by a related \Diaporamas\Model\DiaporamaImage object
     *
     * @param \Diaporamas\Model\DiaporamaImage|ObjectCollection $diaporamaImage The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildCategoryDiaporamaImageQuery The current query, for fluid interface
     */
    public function filterByDiaporamaImage($diaporamaImage, $comparison = null)
    {
        if ($diaporamaImage instanceof \Diaporamas\Model\DiaporamaImage) {
            return $this
                ->addUsingAlias(CategoryDiaporamaImageTableMap::ID, $diaporamaImage->getId(), $comparison);
        } elseif ($diaporamaImage instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(CategoryDiaporamaImageTableMap::ID, $diaporamaImage->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return ChildCategoryDiaporamaImageQuery The current query, for fluid interface
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
     * @return ChildCategoryDiaporamaImageQuery The current query, for fluid interface
     */
    public function filterByDiaporama($diaporama, $comparison = null)
    {
        if ($diaporama instanceof \Diaporamas\Model\Diaporama) {
            return $this
                ->addUsingAlias(CategoryDiaporamaImageTableMap::DIAPORAMA_ID, $diaporama->getId(), $comparison);
        } elseif ($diaporama instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(CategoryDiaporamaImageTableMap::DIAPORAMA_ID, $diaporama->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return ChildCategoryDiaporamaImageQuery The current query, for fluid interface
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
     * @param   ChildCategoryDiaporamaImage $categoryDiaporamaImage Object to remove from the list of results
     *
     * @return ChildCategoryDiaporamaImageQuery The current query, for fluid interface
     */
    public function prune($categoryDiaporamaImage = null)
    {
        if ($categoryDiaporamaImage) {
            $this->addUsingAlias(CategoryDiaporamaImageTableMap::ID, $categoryDiaporamaImage->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the category_diaporama_image table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CategoryDiaporamaImageTableMap::DATABASE_NAME);
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
            CategoryDiaporamaImageTableMap::clearInstancePool();
            CategoryDiaporamaImageTableMap::clearRelatedInstancePool();

            $con->commit();
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }

        return $affectedRows;
    }

    /**
     * Performs a DELETE on the database, given a ChildCategoryDiaporamaImage or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or ChildCategoryDiaporamaImage object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(CategoryDiaporamaImageTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(CategoryDiaporamaImageTableMap::DATABASE_NAME);

        $affectedRows = 0; // initialize var to track total num of affected rows

        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();


        CategoryDiaporamaImageTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            CategoryDiaporamaImageTableMap::clearRelatedInstancePool();
            $con->commit();

            return $affectedRows;
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }
    }

} // CategoryDiaporamaImageQuery
