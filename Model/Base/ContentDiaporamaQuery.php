<?php

namespace Diaporamas\Model\Base;

use \Exception;
use \PDO;
use Diaporamas\Model\ContentDiaporama as ChildContentDiaporama;
use Diaporamas\Model\ContentDiaporamaI18nQuery as ChildContentDiaporamaI18nQuery;
use Diaporamas\Model\ContentDiaporamaQuery as ChildContentDiaporamaQuery;
use Diaporamas\Model\DiaporamaQuery as ChildDiaporamaQuery;
use Diaporamas\Model\Map\ContentDiaporamaTableMap;
use Diaporamas\Model\Thelia\Model\Content;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'content_diaporama' table.
 *
 *
 *
 * @method     ChildContentDiaporamaQuery orderByContentId($order = Criteria::ASC) Order by the content_id column
 * @method     ChildContentDiaporamaQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildContentDiaporamaQuery orderByShortcode($order = Criteria::ASC) Order by the shortcode column
 *
 * @method     ChildContentDiaporamaQuery groupByContentId() Group by the content_id column
 * @method     ChildContentDiaporamaQuery groupById() Group by the id column
 * @method     ChildContentDiaporamaQuery groupByShortcode() Group by the shortcode column
 *
 * @method     ChildContentDiaporamaQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildContentDiaporamaQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildContentDiaporamaQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildContentDiaporamaQuery leftJoinContent($relationAlias = null) Adds a LEFT JOIN clause to the query using the Content relation
 * @method     ChildContentDiaporamaQuery rightJoinContent($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Content relation
 * @method     ChildContentDiaporamaQuery innerJoinContent($relationAlias = null) Adds a INNER JOIN clause to the query using the Content relation
 *
 * @method     ChildContentDiaporamaQuery leftJoinDiaporama($relationAlias = null) Adds a LEFT JOIN clause to the query using the Diaporama relation
 * @method     ChildContentDiaporamaQuery rightJoinDiaporama($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Diaporama relation
 * @method     ChildContentDiaporamaQuery innerJoinDiaporama($relationAlias = null) Adds a INNER JOIN clause to the query using the Diaporama relation
 *
 * @method     ChildContentDiaporamaQuery leftJoinContentDiaporamaI18n($relationAlias = null) Adds a LEFT JOIN clause to the query using the ContentDiaporamaI18n relation
 * @method     ChildContentDiaporamaQuery rightJoinContentDiaporamaI18n($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ContentDiaporamaI18n relation
 * @method     ChildContentDiaporamaQuery innerJoinContentDiaporamaI18n($relationAlias = null) Adds a INNER JOIN clause to the query using the ContentDiaporamaI18n relation
 *
 * @method     ChildContentDiaporama findOne(ConnectionInterface $con = null) Return the first ChildContentDiaporama matching the query
 * @method     ChildContentDiaporama findOneOrCreate(ConnectionInterface $con = null) Return the first ChildContentDiaporama matching the query, or a new ChildContentDiaporama object populated from the query conditions when no match is found
 *
 * @method     ChildContentDiaporama findOneByContentId(int $content_id) Return the first ChildContentDiaporama filtered by the content_id column
 * @method     ChildContentDiaporama findOneById(int $id) Return the first ChildContentDiaporama filtered by the id column
 * @method     ChildContentDiaporama findOneByShortcode(string $shortcode) Return the first ChildContentDiaporama filtered by the shortcode column
 *
 * @method     array findByContentId(int $content_id) Return ChildContentDiaporama objects filtered by the content_id column
 * @method     array findById(int $id) Return ChildContentDiaporama objects filtered by the id column
 * @method     array findByShortcode(string $shortcode) Return ChildContentDiaporama objects filtered by the shortcode column
 *
 */
abstract class ContentDiaporamaQuery extends ChildDiaporamaQuery
{

    /**
     * Initializes internal state of \Diaporamas\Model\Base\ContentDiaporamaQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'thelia', $modelName = '\\Diaporamas\\Model\\ContentDiaporama', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildContentDiaporamaQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildContentDiaporamaQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof \Diaporamas\Model\ContentDiaporamaQuery) {
            return $criteria;
        }
        $query = new \Diaporamas\Model\ContentDiaporamaQuery();
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
     * @return ChildContentDiaporama|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = ContentDiaporamaTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ContentDiaporamaTableMap::DATABASE_NAME);
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
     * @return   ChildContentDiaporama A model object, or null if the key is not found
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT CONTENT_ID, ID, SHORTCODE FROM content_diaporama WHERE ID = :p0';
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
            $obj = new ChildContentDiaporama();
            $obj->hydrate($row);
            ContentDiaporamaTableMap::addInstanceToPool($obj, (string) $key);
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
     * @return ChildContentDiaporama|array|mixed the result, formatted by the current formatter
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
     * @return ChildContentDiaporamaQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(ContentDiaporamaTableMap::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return ChildContentDiaporamaQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(ContentDiaporamaTableMap::ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the content_id column
     *
     * Example usage:
     * <code>
     * $query->filterByContentId(1234); // WHERE content_id = 1234
     * $query->filterByContentId(array(12, 34)); // WHERE content_id IN (12, 34)
     * $query->filterByContentId(array('min' => 12)); // WHERE content_id > 12
     * </code>
     *
     * @see       filterByContent()
     *
     * @param     mixed $contentId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildContentDiaporamaQuery The current query, for fluid interface
     */
    public function filterByContentId($contentId = null, $comparison = null)
    {
        if (is_array($contentId)) {
            $useMinMax = false;
            if (isset($contentId['min'])) {
                $this->addUsingAlias(ContentDiaporamaTableMap::CONTENT_ID, $contentId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($contentId['max'])) {
                $this->addUsingAlias(ContentDiaporamaTableMap::CONTENT_ID, $contentId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ContentDiaporamaTableMap::CONTENT_ID, $contentId, $comparison);
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
     * @see       filterByDiaporama()
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildContentDiaporamaQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(ContentDiaporamaTableMap::ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(ContentDiaporamaTableMap::ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ContentDiaporamaTableMap::ID, $id, $comparison);
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
     * @return ChildContentDiaporamaQuery The current query, for fluid interface
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

        return $this->addUsingAlias(ContentDiaporamaTableMap::SHORTCODE, $shortcode, $comparison);
    }

    /**
     * Filter the query by a related \Diaporamas\Model\Thelia\Model\Content object
     *
     * @param \Diaporamas\Model\Thelia\Model\Content|ObjectCollection $content The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildContentDiaporamaQuery The current query, for fluid interface
     */
    public function filterByContent($content, $comparison = null)
    {
        if ($content instanceof \Diaporamas\Model\Thelia\Model\Content) {
            return $this
                ->addUsingAlias(ContentDiaporamaTableMap::CONTENT_ID, $content->getId(), $comparison);
        } elseif ($content instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ContentDiaporamaTableMap::CONTENT_ID, $content->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByContent() only accepts arguments of type \Diaporamas\Model\Thelia\Model\Content or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Content relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return ChildContentDiaporamaQuery The current query, for fluid interface
     */
    public function joinContent($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Content');

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
            $this->addJoinObject($join, 'Content');
        }

        return $this;
    }

    /**
     * Use the Content relation Content object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Diaporamas\Model\Thelia\Model\ContentQuery A secondary query class using the current class as primary query
     */
    public function useContentQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinContent($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Content', '\Diaporamas\Model\Thelia\Model\ContentQuery');
    }

    /**
     * Filter the query by a related \Diaporamas\Model\Diaporama object
     *
     * @param \Diaporamas\Model\Diaporama|ObjectCollection $diaporama The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildContentDiaporamaQuery The current query, for fluid interface
     */
    public function filterByDiaporama($diaporama, $comparison = null)
    {
        if ($diaporama instanceof \Diaporamas\Model\Diaporama) {
            return $this
                ->addUsingAlias(ContentDiaporamaTableMap::ID, $diaporama->getId(), $comparison);
        } elseif ($diaporama instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ContentDiaporamaTableMap::ID, $diaporama->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return ChildContentDiaporamaQuery The current query, for fluid interface
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
     * Filter the query by a related \Diaporamas\Model\ContentDiaporamaI18n object
     *
     * @param \Diaporamas\Model\ContentDiaporamaI18n|ObjectCollection $contentDiaporamaI18n  the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildContentDiaporamaQuery The current query, for fluid interface
     */
    public function filterByContentDiaporamaI18n($contentDiaporamaI18n, $comparison = null)
    {
        if ($contentDiaporamaI18n instanceof \Diaporamas\Model\ContentDiaporamaI18n) {
            return $this
                ->addUsingAlias(ContentDiaporamaTableMap::ID, $contentDiaporamaI18n->getId(), $comparison);
        } elseif ($contentDiaporamaI18n instanceof ObjectCollection) {
            return $this
                ->useContentDiaporamaI18nQuery()
                ->filterByPrimaryKeys($contentDiaporamaI18n->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByContentDiaporamaI18n() only accepts arguments of type \Diaporamas\Model\ContentDiaporamaI18n or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ContentDiaporamaI18n relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return ChildContentDiaporamaQuery The current query, for fluid interface
     */
    public function joinContentDiaporamaI18n($relationAlias = null, $joinType = 'LEFT JOIN')
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ContentDiaporamaI18n');

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
            $this->addJoinObject($join, 'ContentDiaporamaI18n');
        }

        return $this;
    }

    /**
     * Use the ContentDiaporamaI18n relation ContentDiaporamaI18n object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Diaporamas\Model\ContentDiaporamaI18nQuery A secondary query class using the current class as primary query
     */
    public function useContentDiaporamaI18nQuery($relationAlias = null, $joinType = 'LEFT JOIN')
    {
        return $this
            ->joinContentDiaporamaI18n($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ContentDiaporamaI18n', '\Diaporamas\Model\ContentDiaporamaI18nQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildContentDiaporama $contentDiaporama Object to remove from the list of results
     *
     * @return ChildContentDiaporamaQuery The current query, for fluid interface
     */
    public function prune($contentDiaporama = null)
    {
        if ($contentDiaporama) {
            $this->addUsingAlias(ContentDiaporamaTableMap::ID, $contentDiaporama->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the content_diaporama table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ContentDiaporamaTableMap::DATABASE_NAME);
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
            ContentDiaporamaTableMap::clearInstancePool();
            ContentDiaporamaTableMap::clearRelatedInstancePool();

            $con->commit();
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }

        return $affectedRows;
    }

    /**
     * Performs a DELETE on the database, given a ChildContentDiaporama or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or ChildContentDiaporama object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(ContentDiaporamaTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ContentDiaporamaTableMap::DATABASE_NAME);

        $affectedRows = 0; // initialize var to track total num of affected rows

        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();


        ContentDiaporamaTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ContentDiaporamaTableMap::clearRelatedInstancePool();
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
     * @return    ChildContentDiaporamaQuery The current query, for fluid interface
     */
    public function joinI18n($locale = 'en_US', $relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $relationName = $relationAlias ? $relationAlias : 'ContentDiaporamaI18n';

        return $this
            ->joinContentDiaporamaI18n($relationAlias, $joinType)
            ->addJoinCondition($relationName, $relationName . '.Locale = ?', $locale);
    }

    /**
     * Adds a JOIN clause to the query and hydrates the related I18n object.
     * Shortcut for $c->joinI18n($locale)->with()
     *
     * @param     string $locale Locale to use for the join condition, e.g. 'fr_FR'
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'. Defaults to left join.
     *
     * @return    ChildContentDiaporamaQuery The current query, for fluid interface
     */
    public function joinWithI18n($locale = 'en_US', $joinType = Criteria::LEFT_JOIN)
    {
        $this
            ->joinI18n($locale, null, $joinType)
            ->with('ContentDiaporamaI18n');
        $this->with['ContentDiaporamaI18n']->setIsWithOneToMany(false);

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
     * @return    ChildContentDiaporamaI18nQuery A secondary query class using the current class as primary query
     */
    public function useI18nQuery($locale = 'en_US', $relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinI18n($locale, $relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ContentDiaporamaI18n', '\Diaporamas\Model\ContentDiaporamaI18nQuery');
    }

} // ContentDiaporamaQuery
