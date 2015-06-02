<?php

namespace Diaporamas\Model\Base;

use \Exception;
use \PDO;
use Diaporamas\Model\Diaporama as ChildDiaporama;
use Diaporamas\Model\DiaporamaI18nQuery as ChildDiaporamaI18nQuery;
use Diaporamas\Model\DiaporamaQuery as ChildDiaporamaQuery;
use Diaporamas\Model\Map\DiaporamaTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'diaporama' table.
 *
 *
 *
 * @method     ChildDiaporamaQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildDiaporamaQuery orderByShortcode($order = Criteria::ASC) Order by the shortcode column
 * @method     ChildDiaporamaQuery orderByDescendantClass($order = Criteria::ASC) Order by the descendant_class column
 *
 * @method     ChildDiaporamaQuery groupById() Group by the id column
 * @method     ChildDiaporamaQuery groupByShortcode() Group by the shortcode column
 * @method     ChildDiaporamaQuery groupByDescendantClass() Group by the descendant_class column
 *
 * @method     ChildDiaporamaQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildDiaporamaQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildDiaporamaQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildDiaporamaQuery leftJoinDiaporamaImage($relationAlias = null) Adds a LEFT JOIN clause to the query using the DiaporamaImage relation
 * @method     ChildDiaporamaQuery rightJoinDiaporamaImage($relationAlias = null) Adds a RIGHT JOIN clause to the query using the DiaporamaImage relation
 * @method     ChildDiaporamaQuery innerJoinDiaporamaImage($relationAlias = null) Adds a INNER JOIN clause to the query using the DiaporamaImage relation
 *
 * @method     ChildDiaporamaQuery leftJoinProductDiaporama($relationAlias = null) Adds a LEFT JOIN clause to the query using the ProductDiaporama relation
 * @method     ChildDiaporamaQuery rightJoinProductDiaporama($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ProductDiaporama relation
 * @method     ChildDiaporamaQuery innerJoinProductDiaporama($relationAlias = null) Adds a INNER JOIN clause to the query using the ProductDiaporama relation
 *
 * @method     ChildDiaporamaQuery leftJoinCategoryDiaporama($relationAlias = null) Adds a LEFT JOIN clause to the query using the CategoryDiaporama relation
 * @method     ChildDiaporamaQuery rightJoinCategoryDiaporama($relationAlias = null) Adds a RIGHT JOIN clause to the query using the CategoryDiaporama relation
 * @method     ChildDiaporamaQuery innerJoinCategoryDiaporama($relationAlias = null) Adds a INNER JOIN clause to the query using the CategoryDiaporama relation
 *
 * @method     ChildDiaporamaQuery leftJoinBrandDiaporama($relationAlias = null) Adds a LEFT JOIN clause to the query using the BrandDiaporama relation
 * @method     ChildDiaporamaQuery rightJoinBrandDiaporama($relationAlias = null) Adds a RIGHT JOIN clause to the query using the BrandDiaporama relation
 * @method     ChildDiaporamaQuery innerJoinBrandDiaporama($relationAlias = null) Adds a INNER JOIN clause to the query using the BrandDiaporama relation
 *
 * @method     ChildDiaporamaQuery leftJoinFolderDiaporama($relationAlias = null) Adds a LEFT JOIN clause to the query using the FolderDiaporama relation
 * @method     ChildDiaporamaQuery rightJoinFolderDiaporama($relationAlias = null) Adds a RIGHT JOIN clause to the query using the FolderDiaporama relation
 * @method     ChildDiaporamaQuery innerJoinFolderDiaporama($relationAlias = null) Adds a INNER JOIN clause to the query using the FolderDiaporama relation
 *
 * @method     ChildDiaporamaQuery leftJoinContentDiaporama($relationAlias = null) Adds a LEFT JOIN clause to the query using the ContentDiaporama relation
 * @method     ChildDiaporamaQuery rightJoinContentDiaporama($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ContentDiaporama relation
 * @method     ChildDiaporamaQuery innerJoinContentDiaporama($relationAlias = null) Adds a INNER JOIN clause to the query using the ContentDiaporama relation
 *
 * @method     ChildDiaporamaQuery leftJoinProductDiaporamaImage($relationAlias = null) Adds a LEFT JOIN clause to the query using the ProductDiaporamaImage relation
 * @method     ChildDiaporamaQuery rightJoinProductDiaporamaImage($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ProductDiaporamaImage relation
 * @method     ChildDiaporamaQuery innerJoinProductDiaporamaImage($relationAlias = null) Adds a INNER JOIN clause to the query using the ProductDiaporamaImage relation
 *
 * @method     ChildDiaporamaQuery leftJoinCategoryDiaporamaImage($relationAlias = null) Adds a LEFT JOIN clause to the query using the CategoryDiaporamaImage relation
 * @method     ChildDiaporamaQuery rightJoinCategoryDiaporamaImage($relationAlias = null) Adds a RIGHT JOIN clause to the query using the CategoryDiaporamaImage relation
 * @method     ChildDiaporamaQuery innerJoinCategoryDiaporamaImage($relationAlias = null) Adds a INNER JOIN clause to the query using the CategoryDiaporamaImage relation
 *
 * @method     ChildDiaporamaQuery leftJoinBrandDiaporamaImage($relationAlias = null) Adds a LEFT JOIN clause to the query using the BrandDiaporamaImage relation
 * @method     ChildDiaporamaQuery rightJoinBrandDiaporamaImage($relationAlias = null) Adds a RIGHT JOIN clause to the query using the BrandDiaporamaImage relation
 * @method     ChildDiaporamaQuery innerJoinBrandDiaporamaImage($relationAlias = null) Adds a INNER JOIN clause to the query using the BrandDiaporamaImage relation
 *
 * @method     ChildDiaporamaQuery leftJoinFolderDiaporamaImage($relationAlias = null) Adds a LEFT JOIN clause to the query using the FolderDiaporamaImage relation
 * @method     ChildDiaporamaQuery rightJoinFolderDiaporamaImage($relationAlias = null) Adds a RIGHT JOIN clause to the query using the FolderDiaporamaImage relation
 * @method     ChildDiaporamaQuery innerJoinFolderDiaporamaImage($relationAlias = null) Adds a INNER JOIN clause to the query using the FolderDiaporamaImage relation
 *
 * @method     ChildDiaporamaQuery leftJoinContentDiaporamaImage($relationAlias = null) Adds a LEFT JOIN clause to the query using the ContentDiaporamaImage relation
 * @method     ChildDiaporamaQuery rightJoinContentDiaporamaImage($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ContentDiaporamaImage relation
 * @method     ChildDiaporamaQuery innerJoinContentDiaporamaImage($relationAlias = null) Adds a INNER JOIN clause to the query using the ContentDiaporamaImage relation
 *
 * @method     ChildDiaporamaQuery leftJoinDiaporamaI18n($relationAlias = null) Adds a LEFT JOIN clause to the query using the DiaporamaI18n relation
 * @method     ChildDiaporamaQuery rightJoinDiaporamaI18n($relationAlias = null) Adds a RIGHT JOIN clause to the query using the DiaporamaI18n relation
 * @method     ChildDiaporamaQuery innerJoinDiaporamaI18n($relationAlias = null) Adds a INNER JOIN clause to the query using the DiaporamaI18n relation
 *
 * @method     ChildDiaporama findOne(ConnectionInterface $con = null) Return the first ChildDiaporama matching the query
 * @method     ChildDiaporama findOneOrCreate(ConnectionInterface $con = null) Return the first ChildDiaporama matching the query, or a new ChildDiaporama object populated from the query conditions when no match is found
 *
 * @method     ChildDiaporama findOneById(int $id) Return the first ChildDiaporama filtered by the id column
 * @method     ChildDiaporama findOneByShortcode(string $shortcode) Return the first ChildDiaporama filtered by the shortcode column
 * @method     ChildDiaporama findOneByDescendantClass(string $descendant_class) Return the first ChildDiaporama filtered by the descendant_class column
 *
 * @method     array findById(int $id) Return ChildDiaporama objects filtered by the id column
 * @method     array findByShortcode(string $shortcode) Return ChildDiaporama objects filtered by the shortcode column
 * @method     array findByDescendantClass(string $descendant_class) Return ChildDiaporama objects filtered by the descendant_class column
 *
 */
abstract class DiaporamaQuery extends ModelCriteria
{

    /**
     * Initializes internal state of \Diaporamas\Model\Base\DiaporamaQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'thelia', $modelName = '\\Diaporamas\\Model\\Diaporama', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildDiaporamaQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildDiaporamaQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof \Diaporamas\Model\DiaporamaQuery) {
            return $criteria;
        }
        $query = new \Diaporamas\Model\DiaporamaQuery();
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
     * @return ChildDiaporama|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = DiaporamaTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(DiaporamaTableMap::DATABASE_NAME);
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
     * @return   ChildDiaporama A model object, or null if the key is not found
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT ID, SHORTCODE, DESCENDANT_CLASS FROM diaporama WHERE ID = :p0';
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
            $obj = new ChildDiaporama();
            $obj->hydrate($row);
            DiaporamaTableMap::addInstanceToPool($obj, (string) $key);
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
     * @return ChildDiaporama|array|mixed the result, formatted by the current formatter
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
     * @return ChildDiaporamaQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(DiaporamaTableMap::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return ChildDiaporamaQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(DiaporamaTableMap::ID, $keys, Criteria::IN);
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
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildDiaporamaQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(DiaporamaTableMap::ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(DiaporamaTableMap::ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DiaporamaTableMap::ID, $id, $comparison);
    }

    /**
     * Filter the query on the shortcode column
     *
     * Example usage:
     * <code>
     * $query->filterByShortcode('fooValue');   // WHERE shortcode = 'fooValue'
     * $query->filterByShortcode('%fooValue%'); // WHERE shortcode LIKE '%fooValue%'
     * </code>
     *
     * @param     string $shortcode The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildDiaporamaQuery The current query, for fluid interface
     */
    public function filterByShortcode($shortcode = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($shortcode)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $shortcode)) {
                $shortcode = str_replace('*', '%', $shortcode);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(DiaporamaTableMap::SHORTCODE, $shortcode, $comparison);
    }

    /**
     * Filter the query on the descendant_class column
     *
     * Example usage:
     * <code>
     * $query->filterByDescendantClass('fooValue');   // WHERE descendant_class = 'fooValue'
     * $query->filterByDescendantClass('%fooValue%'); // WHERE descendant_class LIKE '%fooValue%'
     * </code>
     *
     * @param     string $descendantClass The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildDiaporamaQuery The current query, for fluid interface
     */
    public function filterByDescendantClass($descendantClass = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($descendantClass)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $descendantClass)) {
                $descendantClass = str_replace('*', '%', $descendantClass);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(DiaporamaTableMap::DESCENDANT_CLASS, $descendantClass, $comparison);
    }

    /**
     * Filter the query by a related \Diaporamas\Model\DiaporamaImage object
     *
     * @param \Diaporamas\Model\DiaporamaImage|ObjectCollection $diaporamaImage  the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildDiaporamaQuery The current query, for fluid interface
     */
    public function filterByDiaporamaImage($diaporamaImage, $comparison = null)
    {
        if ($diaporamaImage instanceof \Diaporamas\Model\DiaporamaImage) {
            return $this
                ->addUsingAlias(DiaporamaTableMap::ID, $diaporamaImage->getDiaporamaId(), $comparison);
        } elseif ($diaporamaImage instanceof ObjectCollection) {
            return $this
                ->useDiaporamaImageQuery()
                ->filterByPrimaryKeys($diaporamaImage->getPrimaryKeys())
                ->endUse();
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
     * @return ChildDiaporamaQuery The current query, for fluid interface
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
     * Filter the query by a related \Diaporamas\Model\ProductDiaporama object
     *
     * @param \Diaporamas\Model\ProductDiaporama|ObjectCollection $productDiaporama  the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildDiaporamaQuery The current query, for fluid interface
     */
    public function filterByProductDiaporama($productDiaporama, $comparison = null)
    {
        if ($productDiaporama instanceof \Diaporamas\Model\ProductDiaporama) {
            return $this
                ->addUsingAlias(DiaporamaTableMap::ID, $productDiaporama->getId(), $comparison);
        } elseif ($productDiaporama instanceof ObjectCollection) {
            return $this
                ->useProductDiaporamaQuery()
                ->filterByPrimaryKeys($productDiaporama->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByProductDiaporama() only accepts arguments of type \Diaporamas\Model\ProductDiaporama or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ProductDiaporama relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return ChildDiaporamaQuery The current query, for fluid interface
     */
    public function joinProductDiaporama($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ProductDiaporama');

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
            $this->addJoinObject($join, 'ProductDiaporama');
        }

        return $this;
    }

    /**
     * Use the ProductDiaporama relation ProductDiaporama object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Diaporamas\Model\ProductDiaporamaQuery A secondary query class using the current class as primary query
     */
    public function useProductDiaporamaQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinProductDiaporama($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ProductDiaporama', '\Diaporamas\Model\ProductDiaporamaQuery');
    }

    /**
     * Filter the query by a related \Diaporamas\Model\CategoryDiaporama object
     *
     * @param \Diaporamas\Model\CategoryDiaporama|ObjectCollection $categoryDiaporama  the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildDiaporamaQuery The current query, for fluid interface
     */
    public function filterByCategoryDiaporama($categoryDiaporama, $comparison = null)
    {
        if ($categoryDiaporama instanceof \Diaporamas\Model\CategoryDiaporama) {
            return $this
                ->addUsingAlias(DiaporamaTableMap::ID, $categoryDiaporama->getId(), $comparison);
        } elseif ($categoryDiaporama instanceof ObjectCollection) {
            return $this
                ->useCategoryDiaporamaQuery()
                ->filterByPrimaryKeys($categoryDiaporama->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByCategoryDiaporama() only accepts arguments of type \Diaporamas\Model\CategoryDiaporama or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the CategoryDiaporama relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return ChildDiaporamaQuery The current query, for fluid interface
     */
    public function joinCategoryDiaporama($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('CategoryDiaporama');

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
            $this->addJoinObject($join, 'CategoryDiaporama');
        }

        return $this;
    }

    /**
     * Use the CategoryDiaporama relation CategoryDiaporama object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Diaporamas\Model\CategoryDiaporamaQuery A secondary query class using the current class as primary query
     */
    public function useCategoryDiaporamaQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinCategoryDiaporama($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'CategoryDiaporama', '\Diaporamas\Model\CategoryDiaporamaQuery');
    }

    /**
     * Filter the query by a related \Diaporamas\Model\BrandDiaporama object
     *
     * @param \Diaporamas\Model\BrandDiaporama|ObjectCollection $brandDiaporama  the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildDiaporamaQuery The current query, for fluid interface
     */
    public function filterByBrandDiaporama($brandDiaporama, $comparison = null)
    {
        if ($brandDiaporama instanceof \Diaporamas\Model\BrandDiaporama) {
            return $this
                ->addUsingAlias(DiaporamaTableMap::ID, $brandDiaporama->getId(), $comparison);
        } elseif ($brandDiaporama instanceof ObjectCollection) {
            return $this
                ->useBrandDiaporamaQuery()
                ->filterByPrimaryKeys($brandDiaporama->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByBrandDiaporama() only accepts arguments of type \Diaporamas\Model\BrandDiaporama or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the BrandDiaporama relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return ChildDiaporamaQuery The current query, for fluid interface
     */
    public function joinBrandDiaporama($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('BrandDiaporama');

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
            $this->addJoinObject($join, 'BrandDiaporama');
        }

        return $this;
    }

    /**
     * Use the BrandDiaporama relation BrandDiaporama object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Diaporamas\Model\BrandDiaporamaQuery A secondary query class using the current class as primary query
     */
    public function useBrandDiaporamaQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinBrandDiaporama($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'BrandDiaporama', '\Diaporamas\Model\BrandDiaporamaQuery');
    }

    /**
     * Filter the query by a related \Diaporamas\Model\FolderDiaporama object
     *
     * @param \Diaporamas\Model\FolderDiaporama|ObjectCollection $folderDiaporama  the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildDiaporamaQuery The current query, for fluid interface
     */
    public function filterByFolderDiaporama($folderDiaporama, $comparison = null)
    {
        if ($folderDiaporama instanceof \Diaporamas\Model\FolderDiaporama) {
            return $this
                ->addUsingAlias(DiaporamaTableMap::ID, $folderDiaporama->getId(), $comparison);
        } elseif ($folderDiaporama instanceof ObjectCollection) {
            return $this
                ->useFolderDiaporamaQuery()
                ->filterByPrimaryKeys($folderDiaporama->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByFolderDiaporama() only accepts arguments of type \Diaporamas\Model\FolderDiaporama or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the FolderDiaporama relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return ChildDiaporamaQuery The current query, for fluid interface
     */
    public function joinFolderDiaporama($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('FolderDiaporama');

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
            $this->addJoinObject($join, 'FolderDiaporama');
        }

        return $this;
    }

    /**
     * Use the FolderDiaporama relation FolderDiaporama object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Diaporamas\Model\FolderDiaporamaQuery A secondary query class using the current class as primary query
     */
    public function useFolderDiaporamaQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinFolderDiaporama($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'FolderDiaporama', '\Diaporamas\Model\FolderDiaporamaQuery');
    }

    /**
     * Filter the query by a related \Diaporamas\Model\ContentDiaporama object
     *
     * @param \Diaporamas\Model\ContentDiaporama|ObjectCollection $contentDiaporama  the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildDiaporamaQuery The current query, for fluid interface
     */
    public function filterByContentDiaporama($contentDiaporama, $comparison = null)
    {
        if ($contentDiaporama instanceof \Diaporamas\Model\ContentDiaporama) {
            return $this
                ->addUsingAlias(DiaporamaTableMap::ID, $contentDiaporama->getId(), $comparison);
        } elseif ($contentDiaporama instanceof ObjectCollection) {
            return $this
                ->useContentDiaporamaQuery()
                ->filterByPrimaryKeys($contentDiaporama->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByContentDiaporama() only accepts arguments of type \Diaporamas\Model\ContentDiaporama or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ContentDiaporama relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return ChildDiaporamaQuery The current query, for fluid interface
     */
    public function joinContentDiaporama($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ContentDiaporama');

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
            $this->addJoinObject($join, 'ContentDiaporama');
        }

        return $this;
    }

    /**
     * Use the ContentDiaporama relation ContentDiaporama object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Diaporamas\Model\ContentDiaporamaQuery A secondary query class using the current class as primary query
     */
    public function useContentDiaporamaQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinContentDiaporama($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ContentDiaporama', '\Diaporamas\Model\ContentDiaporamaQuery');
    }

    /**
     * Filter the query by a related \Diaporamas\Model\ProductDiaporamaImage object
     *
     * @param \Diaporamas\Model\ProductDiaporamaImage|ObjectCollection $productDiaporamaImage  the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildDiaporamaQuery The current query, for fluid interface
     */
    public function filterByProductDiaporamaImage($productDiaporamaImage, $comparison = null)
    {
        if ($productDiaporamaImage instanceof \Diaporamas\Model\ProductDiaporamaImage) {
            return $this
                ->addUsingAlias(DiaporamaTableMap::ID, $productDiaporamaImage->getDiaporamaId(), $comparison);
        } elseif ($productDiaporamaImage instanceof ObjectCollection) {
            return $this
                ->useProductDiaporamaImageQuery()
                ->filterByPrimaryKeys($productDiaporamaImage->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByProductDiaporamaImage() only accepts arguments of type \Diaporamas\Model\ProductDiaporamaImage or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ProductDiaporamaImage relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return ChildDiaporamaQuery The current query, for fluid interface
     */
    public function joinProductDiaporamaImage($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ProductDiaporamaImage');

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
            $this->addJoinObject($join, 'ProductDiaporamaImage');
        }

        return $this;
    }

    /**
     * Use the ProductDiaporamaImage relation ProductDiaporamaImage object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Diaporamas\Model\ProductDiaporamaImageQuery A secondary query class using the current class as primary query
     */
    public function useProductDiaporamaImageQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinProductDiaporamaImage($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ProductDiaporamaImage', '\Diaporamas\Model\ProductDiaporamaImageQuery');
    }

    /**
     * Filter the query by a related \Diaporamas\Model\CategoryDiaporamaImage object
     *
     * @param \Diaporamas\Model\CategoryDiaporamaImage|ObjectCollection $categoryDiaporamaImage  the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildDiaporamaQuery The current query, for fluid interface
     */
    public function filterByCategoryDiaporamaImage($categoryDiaporamaImage, $comparison = null)
    {
        if ($categoryDiaporamaImage instanceof \Diaporamas\Model\CategoryDiaporamaImage) {
            return $this
                ->addUsingAlias(DiaporamaTableMap::ID, $categoryDiaporamaImage->getDiaporamaId(), $comparison);
        } elseif ($categoryDiaporamaImage instanceof ObjectCollection) {
            return $this
                ->useCategoryDiaporamaImageQuery()
                ->filterByPrimaryKeys($categoryDiaporamaImage->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByCategoryDiaporamaImage() only accepts arguments of type \Diaporamas\Model\CategoryDiaporamaImage or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the CategoryDiaporamaImage relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return ChildDiaporamaQuery The current query, for fluid interface
     */
    public function joinCategoryDiaporamaImage($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('CategoryDiaporamaImage');

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
            $this->addJoinObject($join, 'CategoryDiaporamaImage');
        }

        return $this;
    }

    /**
     * Use the CategoryDiaporamaImage relation CategoryDiaporamaImage object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Diaporamas\Model\CategoryDiaporamaImageQuery A secondary query class using the current class as primary query
     */
    public function useCategoryDiaporamaImageQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinCategoryDiaporamaImage($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'CategoryDiaporamaImage', '\Diaporamas\Model\CategoryDiaporamaImageQuery');
    }

    /**
     * Filter the query by a related \Diaporamas\Model\BrandDiaporamaImage object
     *
     * @param \Diaporamas\Model\BrandDiaporamaImage|ObjectCollection $brandDiaporamaImage  the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildDiaporamaQuery The current query, for fluid interface
     */
    public function filterByBrandDiaporamaImage($brandDiaporamaImage, $comparison = null)
    {
        if ($brandDiaporamaImage instanceof \Diaporamas\Model\BrandDiaporamaImage) {
            return $this
                ->addUsingAlias(DiaporamaTableMap::ID, $brandDiaporamaImage->getDiaporamaId(), $comparison);
        } elseif ($brandDiaporamaImage instanceof ObjectCollection) {
            return $this
                ->useBrandDiaporamaImageQuery()
                ->filterByPrimaryKeys($brandDiaporamaImage->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByBrandDiaporamaImage() only accepts arguments of type \Diaporamas\Model\BrandDiaporamaImage or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the BrandDiaporamaImage relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return ChildDiaporamaQuery The current query, for fluid interface
     */
    public function joinBrandDiaporamaImage($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('BrandDiaporamaImage');

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
            $this->addJoinObject($join, 'BrandDiaporamaImage');
        }

        return $this;
    }

    /**
     * Use the BrandDiaporamaImage relation BrandDiaporamaImage object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Diaporamas\Model\BrandDiaporamaImageQuery A secondary query class using the current class as primary query
     */
    public function useBrandDiaporamaImageQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinBrandDiaporamaImage($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'BrandDiaporamaImage', '\Diaporamas\Model\BrandDiaporamaImageQuery');
    }

    /**
     * Filter the query by a related \Diaporamas\Model\FolderDiaporamaImage object
     *
     * @param \Diaporamas\Model\FolderDiaporamaImage|ObjectCollection $folderDiaporamaImage  the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildDiaporamaQuery The current query, for fluid interface
     */
    public function filterByFolderDiaporamaImage($folderDiaporamaImage, $comparison = null)
    {
        if ($folderDiaporamaImage instanceof \Diaporamas\Model\FolderDiaporamaImage) {
            return $this
                ->addUsingAlias(DiaporamaTableMap::ID, $folderDiaporamaImage->getDiaporamaId(), $comparison);
        } elseif ($folderDiaporamaImage instanceof ObjectCollection) {
            return $this
                ->useFolderDiaporamaImageQuery()
                ->filterByPrimaryKeys($folderDiaporamaImage->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByFolderDiaporamaImage() only accepts arguments of type \Diaporamas\Model\FolderDiaporamaImage or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the FolderDiaporamaImage relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return ChildDiaporamaQuery The current query, for fluid interface
     */
    public function joinFolderDiaporamaImage($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('FolderDiaporamaImage');

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
            $this->addJoinObject($join, 'FolderDiaporamaImage');
        }

        return $this;
    }

    /**
     * Use the FolderDiaporamaImage relation FolderDiaporamaImage object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Diaporamas\Model\FolderDiaporamaImageQuery A secondary query class using the current class as primary query
     */
    public function useFolderDiaporamaImageQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinFolderDiaporamaImage($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'FolderDiaporamaImage', '\Diaporamas\Model\FolderDiaporamaImageQuery');
    }

    /**
     * Filter the query by a related \Diaporamas\Model\ContentDiaporamaImage object
     *
     * @param \Diaporamas\Model\ContentDiaporamaImage|ObjectCollection $contentDiaporamaImage  the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildDiaporamaQuery The current query, for fluid interface
     */
    public function filterByContentDiaporamaImage($contentDiaporamaImage, $comparison = null)
    {
        if ($contentDiaporamaImage instanceof \Diaporamas\Model\ContentDiaporamaImage) {
            return $this
                ->addUsingAlias(DiaporamaTableMap::ID, $contentDiaporamaImage->getDiaporamaId(), $comparison);
        } elseif ($contentDiaporamaImage instanceof ObjectCollection) {
            return $this
                ->useContentDiaporamaImageQuery()
                ->filterByPrimaryKeys($contentDiaporamaImage->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByContentDiaporamaImage() only accepts arguments of type \Diaporamas\Model\ContentDiaporamaImage or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ContentDiaporamaImage relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return ChildDiaporamaQuery The current query, for fluid interface
     */
    public function joinContentDiaporamaImage($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ContentDiaporamaImage');

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
            $this->addJoinObject($join, 'ContentDiaporamaImage');
        }

        return $this;
    }

    /**
     * Use the ContentDiaporamaImage relation ContentDiaporamaImage object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Diaporamas\Model\ContentDiaporamaImageQuery A secondary query class using the current class as primary query
     */
    public function useContentDiaporamaImageQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinContentDiaporamaImage($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ContentDiaporamaImage', '\Diaporamas\Model\ContentDiaporamaImageQuery');
    }

    /**
     * Filter the query by a related \Diaporamas\Model\DiaporamaI18n object
     *
     * @param \Diaporamas\Model\DiaporamaI18n|ObjectCollection $diaporamaI18n  the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildDiaporamaQuery The current query, for fluid interface
     */
    public function filterByDiaporamaI18n($diaporamaI18n, $comparison = null)
    {
        if ($diaporamaI18n instanceof \Diaporamas\Model\DiaporamaI18n) {
            return $this
                ->addUsingAlias(DiaporamaTableMap::ID, $diaporamaI18n->getId(), $comparison);
        } elseif ($diaporamaI18n instanceof ObjectCollection) {
            return $this
                ->useDiaporamaI18nQuery()
                ->filterByPrimaryKeys($diaporamaI18n->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByDiaporamaI18n() only accepts arguments of type \Diaporamas\Model\DiaporamaI18n or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the DiaporamaI18n relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return ChildDiaporamaQuery The current query, for fluid interface
     */
    public function joinDiaporamaI18n($relationAlias = null, $joinType = 'LEFT JOIN')
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('DiaporamaI18n');

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
            $this->addJoinObject($join, 'DiaporamaI18n');
        }

        return $this;
    }

    /**
     * Use the DiaporamaI18n relation DiaporamaI18n object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Diaporamas\Model\DiaporamaI18nQuery A secondary query class using the current class as primary query
     */
    public function useDiaporamaI18nQuery($relationAlias = null, $joinType = 'LEFT JOIN')
    {
        return $this
            ->joinDiaporamaI18n($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'DiaporamaI18n', '\Diaporamas\Model\DiaporamaI18nQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildDiaporama $diaporama Object to remove from the list of results
     *
     * @return ChildDiaporamaQuery The current query, for fluid interface
     */
    public function prune($diaporama = null)
    {
        if ($diaporama) {
            $this->addUsingAlias(DiaporamaTableMap::ID, $diaporama->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the diaporama table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(DiaporamaTableMap::DATABASE_NAME);
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
            DiaporamaTableMap::clearInstancePool();
            DiaporamaTableMap::clearRelatedInstancePool();

            $con->commit();
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }

        return $affectedRows;
    }

    /**
     * Performs a DELETE on the database, given a ChildDiaporama or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or ChildDiaporama object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(DiaporamaTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(DiaporamaTableMap::DATABASE_NAME);

        $affectedRows = 0; // initialize var to track total num of affected rows

        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();


        DiaporamaTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            DiaporamaTableMap::clearRelatedInstancePool();
            $con->commit();

            return $affectedRows;
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }
    }

    // i18n behavior

    /**
     * Adds a JOIN clause to the query using the i18n relation
     *
     * @param     string $locale Locale to use for the join condition, e.g. 'fr_FR'
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'. Defaults to left join.
     *
     * @return    ChildDiaporamaQuery The current query, for fluid interface
     */
    public function joinI18n($locale = 'en_US', $relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $relationName = $relationAlias ? $relationAlias : 'DiaporamaI18n';

        return $this
            ->joinDiaporamaI18n($relationAlias, $joinType)
            ->addJoinCondition($relationName, $relationName . '.Locale = ?', $locale);
    }

    /**
     * Adds a JOIN clause to the query and hydrates the related I18n object.
     * Shortcut for $c->joinI18n($locale)->with()
     *
     * @param     string $locale Locale to use for the join condition, e.g. 'fr_FR'
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'. Defaults to left join.
     *
     * @return    ChildDiaporamaQuery The current query, for fluid interface
     */
    public function joinWithI18n($locale = 'en_US', $joinType = Criteria::LEFT_JOIN)
    {
        $this
            ->joinI18n($locale, null, $joinType)
            ->with('DiaporamaI18n');
        $this->with['DiaporamaI18n']->setIsWithOneToMany(false);

        return $this;
    }

    /**
     * Use the I18n relation query object
     *
     * @see       useQuery()
     *
     * @param     string $locale Locale to use for the join condition, e.g. 'fr_FR'
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'. Defaults to left join.
     *
     * @return    ChildDiaporamaI18nQuery A secondary query class using the current class as primary query
     */
    public function useI18nQuery($locale = 'en_US', $relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinI18n($locale, $relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'DiaporamaI18n', '\Diaporamas\Model\DiaporamaI18nQuery');
    }

} // DiaporamaQuery
