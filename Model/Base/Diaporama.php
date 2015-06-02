<?php

namespace Diaporamas\Model\Base;

use \Exception;
use \PDO;
use Diaporamas\Model\BrandDiaporama as ChildBrandDiaporama;
use Diaporamas\Model\BrandDiaporamaImage as ChildBrandDiaporamaImage;
use Diaporamas\Model\BrandDiaporamaImageQuery as ChildBrandDiaporamaImageQuery;
use Diaporamas\Model\BrandDiaporamaQuery as ChildBrandDiaporamaQuery;
use Diaporamas\Model\CategoryDiaporama as ChildCategoryDiaporama;
use Diaporamas\Model\CategoryDiaporamaImage as ChildCategoryDiaporamaImage;
use Diaporamas\Model\CategoryDiaporamaImageQuery as ChildCategoryDiaporamaImageQuery;
use Diaporamas\Model\CategoryDiaporamaQuery as ChildCategoryDiaporamaQuery;
use Diaporamas\Model\ContentDiaporama as ChildContentDiaporama;
use Diaporamas\Model\ContentDiaporamaImage as ChildContentDiaporamaImage;
use Diaporamas\Model\ContentDiaporamaImageQuery as ChildContentDiaporamaImageQuery;
use Diaporamas\Model\ContentDiaporamaQuery as ChildContentDiaporamaQuery;
use Diaporamas\Model\Diaporama as ChildDiaporama;
use Diaporamas\Model\DiaporamaI18n as ChildDiaporamaI18n;
use Diaporamas\Model\DiaporamaI18nQuery as ChildDiaporamaI18nQuery;
use Diaporamas\Model\DiaporamaImage as ChildDiaporamaImage;
use Diaporamas\Model\DiaporamaImageQuery as ChildDiaporamaImageQuery;
use Diaporamas\Model\DiaporamaQuery as ChildDiaporamaQuery;
use Diaporamas\Model\FolderDiaporama as ChildFolderDiaporama;
use Diaporamas\Model\FolderDiaporamaImage as ChildFolderDiaporamaImage;
use Diaporamas\Model\FolderDiaporamaImageQuery as ChildFolderDiaporamaImageQuery;
use Diaporamas\Model\FolderDiaporamaQuery as ChildFolderDiaporamaQuery;
use Diaporamas\Model\ProductDiaporama as ChildProductDiaporama;
use Diaporamas\Model\ProductDiaporamaImage as ChildProductDiaporamaImage;
use Diaporamas\Model\ProductDiaporamaImageQuery as ChildProductDiaporamaImageQuery;
use Diaporamas\Model\ProductDiaporamaQuery as ChildProductDiaporamaQuery;
use Diaporamas\Model\Map\DiaporamaTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\PropelQuery;
use Propel\Runtime\ActiveRecord\ActiveRecordInterface;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\BadMethodCallException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Parser\AbstractParser;

abstract class Diaporama implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\Diaporamas\\Model\\Map\\DiaporamaTableMap';


    /**
     * attribute to determine if this object has previously been saved.
     * @var boolean
     */
    protected $new = true;

    /**
     * attribute to determine whether this object has been deleted.
     * @var boolean
     */
    protected $deleted = false;

    /**
     * The columns that have been modified in current object.
     * Tracking modified columns allows us to only update modified columns.
     * @var array
     */
    protected $modifiedColumns = array();

    /**
     * The (virtual) columns that are added at runtime
     * The formatters can add supplementary columns based on a resultset
     * @var array
     */
    protected $virtualColumns = array();

    /**
     * The value for the id field.
     * @var        int
     */
    protected $id;

    /**
     * The value for the shortcode field.
     * @var        string
     */
    protected $shortcode;

    /**
     * The value for the descendant_class field.
     * @var        string
     */
    protected $descendant_class;

    /**
     * @var        ObjectCollection|ChildDiaporamaImage[] Collection to store aggregation of ChildDiaporamaImage objects.
     */
    protected $collDiaporamaImages;
    protected $collDiaporamaImagesPartial;

    /**
     * @var        ChildProductDiaporama one-to-one related ChildProductDiaporama object
     */
    protected $singleProductDiaporama;

    /**
     * @var        ChildCategoryDiaporama one-to-one related ChildCategoryDiaporama object
     */
    protected $singleCategoryDiaporama;

    /**
     * @var        ChildBrandDiaporama one-to-one related ChildBrandDiaporama object
     */
    protected $singleBrandDiaporama;

    /**
     * @var        ChildFolderDiaporama one-to-one related ChildFolderDiaporama object
     */
    protected $singleFolderDiaporama;

    /**
     * @var        ChildContentDiaporama one-to-one related ChildContentDiaporama object
     */
    protected $singleContentDiaporama;

    /**
     * @var        ObjectCollection|ChildProductDiaporamaImage[] Collection to store aggregation of ChildProductDiaporamaImage objects.
     */
    protected $collProductDiaporamaImages;
    protected $collProductDiaporamaImagesPartial;

    /**
     * @var        ObjectCollection|ChildCategoryDiaporamaImage[] Collection to store aggregation of ChildCategoryDiaporamaImage objects.
     */
    protected $collCategoryDiaporamaImages;
    protected $collCategoryDiaporamaImagesPartial;

    /**
     * @var        ObjectCollection|ChildBrandDiaporamaImage[] Collection to store aggregation of ChildBrandDiaporamaImage objects.
     */
    protected $collBrandDiaporamaImages;
    protected $collBrandDiaporamaImagesPartial;

    /**
     * @var        ObjectCollection|ChildFolderDiaporamaImage[] Collection to store aggregation of ChildFolderDiaporamaImage objects.
     */
    protected $collFolderDiaporamaImages;
    protected $collFolderDiaporamaImagesPartial;

    /**
     * @var        ObjectCollection|ChildContentDiaporamaImage[] Collection to store aggregation of ChildContentDiaporamaImage objects.
     */
    protected $collContentDiaporamaImages;
    protected $collContentDiaporamaImagesPartial;

    /**
     * @var        ObjectCollection|ChildDiaporamaI18n[] Collection to store aggregation of ChildDiaporamaI18n objects.
     */
    protected $collDiaporamaI18ns;
    protected $collDiaporamaI18nsPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    // i18n behavior

    /**
     * Current locale
     * @var        string
     */
    protected $currentLocale = 'en_US';

    /**
     * Current translation objects
     * @var        array[ChildDiaporamaI18n]
     */
    protected $currentTranslations;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection
     */
    protected $diaporamaImagesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection
     */
    protected $productDiaporamaImagesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection
     */
    protected $categoryDiaporamaImagesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection
     */
    protected $brandDiaporamaImagesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection
     */
    protected $folderDiaporamaImagesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection
     */
    protected $contentDiaporamaImagesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection
     */
    protected $diaporamaI18nsScheduledForDeletion = null;

    /**
     * Initializes internal state of Diaporamas\Model\Base\Diaporama object.
     */
    public function __construct()
    {
    }

    /**
     * Returns whether the object has been modified.
     *
     * @return boolean True if the object has been modified.
     */
    public function isModified()
    {
        return !!$this->modifiedColumns;
    }

    /**
     * Has specified column been modified?
     *
     * @param  string  $col column fully qualified name (TableMap::TYPE_COLNAME), e.g. Book::AUTHOR_ID
     * @return boolean True if $col has been modified.
     */
    public function isColumnModified($col)
    {
        return $this->modifiedColumns && isset($this->modifiedColumns[$col]);
    }

    /**
     * Get the columns that have been modified in this object.
     * @return array A unique list of the modified column names for this object.
     */
    public function getModifiedColumns()
    {
        return $this->modifiedColumns ? array_keys($this->modifiedColumns) : [];
    }

    /**
     * Returns whether the object has ever been saved.  This will
     * be false, if the object was retrieved from storage or was created
     * and then saved.
     *
     * @return boolean true, if the object has never been persisted.
     */
    public function isNew()
    {
        return $this->new;
    }

    /**
     * Setter for the isNew attribute.  This method will be called
     * by Propel-generated children and objects.
     *
     * @param boolean $b the state of the object.
     */
    public function setNew($b)
    {
        $this->new = (Boolean) $b;
    }

    /**
     * Whether this object has been deleted.
     * @return boolean The deleted state of this object.
     */
    public function isDeleted()
    {
        return $this->deleted;
    }

    /**
     * Specify whether this object has been deleted.
     * @param  boolean $b The deleted state of this object.
     * @return void
     */
    public function setDeleted($b)
    {
        $this->deleted = (Boolean) $b;
    }

    /**
     * Sets the modified state for the object to be false.
     * @param  string $col If supplied, only the specified column is reset.
     * @return void
     */
    public function resetModified($col = null)
    {
        if (null !== $col) {
            if (isset($this->modifiedColumns[$col])) {
                unset($this->modifiedColumns[$col]);
            }
        } else {
            $this->modifiedColumns = array();
        }
    }

    /**
     * Compares this with another <code>Diaporama</code> instance.  If
     * <code>obj</code> is an instance of <code>Diaporama</code>, delegates to
     * <code>equals(Diaporama)</code>.  Otherwise, returns <code>false</code>.
     *
     * @param  mixed   $obj The object to compare to.
     * @return boolean Whether equal to the object specified.
     */
    public function equals($obj)
    {
        $thisclazz = get_class($this);
        if (!is_object($obj) || !($obj instanceof $thisclazz)) {
            return false;
        }

        if ($this === $obj) {
            return true;
        }

        if (null === $this->getPrimaryKey()
            || null === $obj->getPrimaryKey())  {
            return false;
        }

        return $this->getPrimaryKey() === $obj->getPrimaryKey();
    }

    /**
     * If the primary key is not null, return the hashcode of the
     * primary key. Otherwise, return the hash code of the object.
     *
     * @return int Hashcode
     */
    public function hashCode()
    {
        if (null !== $this->getPrimaryKey()) {
            return crc32(serialize($this->getPrimaryKey()));
        }

        return crc32(serialize(clone $this));
    }

    /**
     * Get the associative array of the virtual columns in this object
     *
     * @return array
     */
    public function getVirtualColumns()
    {
        return $this->virtualColumns;
    }

    /**
     * Checks the existence of a virtual column in this object
     *
     * @param  string  $name The virtual column name
     * @return boolean
     */
    public function hasVirtualColumn($name)
    {
        return array_key_exists($name, $this->virtualColumns);
    }

    /**
     * Get the value of a virtual column in this object
     *
     * @param  string $name The virtual column name
     * @return mixed
     *
     * @throws PropelException
     */
    public function getVirtualColumn($name)
    {
        if (!$this->hasVirtualColumn($name)) {
            throw new PropelException(sprintf('Cannot get value of inexistent virtual column %s.', $name));
        }

        return $this->virtualColumns[$name];
    }

    /**
     * Set the value of a virtual column in this object
     *
     * @param string $name  The virtual column name
     * @param mixed  $value The value to give to the virtual column
     *
     * @return Diaporama The current object, for fluid interface
     */
    public function setVirtualColumn($name, $value)
    {
        $this->virtualColumns[$name] = $value;

        return $this;
    }

    /**
     * Logs a message using Propel::log().
     *
     * @param  string  $msg
     * @param  int     $priority One of the Propel::LOG_* logging levels
     * @return boolean
     */
    protected function log($msg, $priority = Propel::LOG_INFO)
    {
        return Propel::log(get_class($this) . ': ' . $msg, $priority);
    }

    /**
     * Populate the current object from a string, using a given parser format
     * <code>
     * $book = new Book();
     * $book->importFrom('JSON', '{"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * @param mixed $parser A AbstractParser instance,
     *                       or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param string $data The source data to import from
     *
     * @return Diaporama The current object, for fluid interface
     */
    public function importFrom($parser, $data)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        $this->fromArray($parser->toArray($data), TableMap::TYPE_PHPNAME);

        return $this;
    }

    /**
     * Export the current object properties to a string, using a given parser format
     * <code>
     * $book = BookQuery::create()->findPk(9012);
     * echo $book->exportTo('JSON');
     *  => {"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * @param  mixed   $parser                 A AbstractParser instance, or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param  boolean $includeLazyLoadColumns (optional) Whether to include lazy load(ed) columns. Defaults to TRUE.
     * @return string  The exported data
     */
    public function exportTo($parser, $includeLazyLoadColumns = true)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        return $parser->fromArray($this->toArray(TableMap::TYPE_PHPNAME, $includeLazyLoadColumns, array(), true));
    }

    /**
     * Clean up internal collections prior to serializing
     * Avoids recursive loops that turn into segmentation faults when serializing
     */
    public function __sleep()
    {
        $this->clearAllReferences();

        return array_keys(get_object_vars($this));
    }

    /**
     * Get the [id] column value.
     *
     * @return   int
     */
    public function getId()
    {

        return $this->id;
    }

    /**
     * Get the [shortcode] column value.
     *
     * @return   string
     */
    public function getShortcode()
    {

        return $this->shortcode;
    }

    /**
     * Get the [descendant_class] column value.
     *
     * @return   string
     */
    public function getDescendantClass()
    {

        return $this->descendant_class;
    }

    /**
     * Set the value of [id] column.
     *
     * @param      int $v new value
     * @return   \Diaporamas\Model\Diaporama The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[DiaporamaTableMap::ID] = true;
        }


        return $this;
    } // setId()

    /**
     * Set the value of [shortcode] column.
     *
     * @param      string $v new value
     * @return   \Diaporamas\Model\Diaporama The current object (for fluent API support)
     */
    public function setShortcode($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->shortcode !== $v) {
            $this->shortcode = $v;
            $this->modifiedColumns[DiaporamaTableMap::SHORTCODE] = true;
        }


        return $this;
    } // setShortcode()

    /**
     * Set the value of [descendant_class] column.
     *
     * @param      string $v new value
     * @return   \Diaporamas\Model\Diaporama The current object (for fluent API support)
     */
    public function setDescendantClass($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->descendant_class !== $v) {
            $this->descendant_class = $v;
            $this->modifiedColumns[DiaporamaTableMap::DESCENDANT_CLASS] = true;
        }


        return $this;
    } // setDescendantClass()

    /**
     * Indicates whether the columns in this object are only set to default values.
     *
     * This method can be used in conjunction with isModified() to indicate whether an object is both
     * modified _and_ has some values set which are non-default.
     *
     * @return boolean Whether the columns in this object are only been set with default values.
     */
    public function hasOnlyDefaultValues()
    {
        // otherwise, everything was equal, so return TRUE
        return true;
    } // hasOnlyDefaultValues()

    /**
     * Hydrates (populates) the object variables with values from the database resultset.
     *
     * An offset (0-based "start column") is specified so that objects can be hydrated
     * with a subset of the columns in the resultset rows.  This is needed, for example,
     * for results of JOIN queries where the resultset row includes columns from two or
     * more tables.
     *
     * @param array   $row       The row returned by DataFetcher->fetch().
     * @param int     $startcol  0-based offset column which indicates which restultset column to start with.
     * @param boolean $rehydrate Whether this object is being re-hydrated from the database.
     * @param string  $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                  One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_STUDLYPHPNAME
     *                            TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @return int             next starting column
     * @throws PropelException - Any caught Exception will be rewrapped as a PropelException.
     */
    public function hydrate($row, $startcol = 0, $rehydrate = false, $indexType = TableMap::TYPE_NUM)
    {
        try {


            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : DiaporamaTableMap::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : DiaporamaTableMap::translateFieldName('Shortcode', TableMap::TYPE_PHPNAME, $indexType)];
            $this->shortcode = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : DiaporamaTableMap::translateFieldName('DescendantClass', TableMap::TYPE_PHPNAME, $indexType)];
            $this->descendant_class = (null !== $col) ? (string) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 3; // 3 = DiaporamaTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating \Diaporamas\Model\Diaporama object", 0, $e);
        }
    }

    /**
     * Checks and repairs the internal consistency of the object.
     *
     * This method is executed after an already-instantiated object is re-hydrated
     * from the database.  It exists to check any foreign keys to make sure that
     * the objects related to the current object are correct based on foreign key.
     *
     * You can override this method in the stub class, but you should always invoke
     * the base method from the overridden method (i.e. parent::ensureConsistency()),
     * in case your model changes.
     *
     * @throws PropelException
     */
    public function ensureConsistency()
    {
    } // ensureConsistency

    /**
     * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
     *
     * This will only work if the object has been saved and has a valid primary key set.
     *
     * @param      boolean $deep (optional) Whether to also de-associated any related objects.
     * @param      ConnectionInterface $con (optional) The ConnectionInterface connection to use.
     * @return void
     * @throws PropelException - if this object is deleted, unsaved or doesn't have pk match in db
     */
    public function reload($deep = false, ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("Cannot reload a deleted object.");
        }

        if ($this->isNew()) {
            throw new PropelException("Cannot reload an unsaved object.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(DiaporamaTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildDiaporamaQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collDiaporamaImages = null;

            $this->singleProductDiaporama = null;

            $this->singleCategoryDiaporama = null;

            $this->singleBrandDiaporama = null;

            $this->singleFolderDiaporama = null;

            $this->singleContentDiaporama = null;

            $this->collProductDiaporamaImages = null;

            $this->collCategoryDiaporamaImages = null;

            $this->collBrandDiaporamaImages = null;

            $this->collFolderDiaporamaImages = null;

            $this->collContentDiaporamaImages = null;

            $this->collDiaporamaI18ns = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see Diaporama::setDeleted()
     * @see Diaporama::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(DiaporamaTableMap::DATABASE_NAME);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = ChildDiaporamaQuery::create()
                ->filterByPrimaryKey($this->getPrimaryKey());
            $ret = $this->preDelete($con);
            if ($ret) {
                $deleteQuery->delete($con);
                $this->postDelete($con);
                $con->commit();
                $this->setDeleted(true);
            } else {
                $con->commit();
            }
        } catch (Exception $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Persists this object to the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All modified related objects will also be persisted in the doSave()
     * method.  This method wraps all precipitate database operations in a
     * single transaction.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see doSave()
     */
    public function save(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("You cannot save an object that has been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(DiaporamaTableMap::DATABASE_NAME);
        }

        $con->beginTransaction();
        $isInsert = $this->isNew();
        try {
            $ret = $this->preSave($con);
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
            } else {
                $ret = $ret && $this->preUpdate($con);
            }
            if ($ret) {
                $affectedRows = $this->doSave($con);
                if ($isInsert) {
                    $this->postInsert($con);
                } else {
                    $this->postUpdate($con);
                }
                $this->postSave($con);
                DiaporamaTableMap::addInstanceToPool($this);
            } else {
                $affectedRows = 0;
            }
            $con->commit();

            return $affectedRows;
        } catch (Exception $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Performs the work of inserting or updating the row in the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All related objects are also updated in this method.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see save()
     */
    protected function doSave(ConnectionInterface $con)
    {
        $affectedRows = 0; // initialize var to track total num of affected rows
        if (!$this->alreadyInSave) {
            $this->alreadyInSave = true;

            if ($this->isNew() || $this->isModified()) {
                // persist changes
                if ($this->isNew()) {
                    $this->doInsert($con);
                } else {
                    $this->doUpdate($con);
                }
                $affectedRows += 1;
                $this->resetModified();
            }

            if ($this->diaporamaImagesScheduledForDeletion !== null) {
                if (!$this->diaporamaImagesScheduledForDeletion->isEmpty()) {
                    \Diaporamas\Model\DiaporamaImageQuery::create()
                        ->filterByPrimaryKeys($this->diaporamaImagesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->diaporamaImagesScheduledForDeletion = null;
                }
            }

                if ($this->collDiaporamaImages !== null) {
            foreach ($this->collDiaporamaImages as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->singleProductDiaporama !== null) {
                if (!$this->singleProductDiaporama->isDeleted() && ($this->singleProductDiaporama->isNew() || $this->singleProductDiaporama->isModified())) {
                    $affectedRows += $this->singleProductDiaporama->save($con);
                }
            }

            if ($this->singleCategoryDiaporama !== null) {
                if (!$this->singleCategoryDiaporama->isDeleted() && ($this->singleCategoryDiaporama->isNew() || $this->singleCategoryDiaporama->isModified())) {
                    $affectedRows += $this->singleCategoryDiaporama->save($con);
                }
            }

            if ($this->singleBrandDiaporama !== null) {
                if (!$this->singleBrandDiaporama->isDeleted() && ($this->singleBrandDiaporama->isNew() || $this->singleBrandDiaporama->isModified())) {
                    $affectedRows += $this->singleBrandDiaporama->save($con);
                }
            }

            if ($this->singleFolderDiaporama !== null) {
                if (!$this->singleFolderDiaporama->isDeleted() && ($this->singleFolderDiaporama->isNew() || $this->singleFolderDiaporama->isModified())) {
                    $affectedRows += $this->singleFolderDiaporama->save($con);
                }
            }

            if ($this->singleContentDiaporama !== null) {
                if (!$this->singleContentDiaporama->isDeleted() && ($this->singleContentDiaporama->isNew() || $this->singleContentDiaporama->isModified())) {
                    $affectedRows += $this->singleContentDiaporama->save($con);
                }
            }

            if ($this->productDiaporamaImagesScheduledForDeletion !== null) {
                if (!$this->productDiaporamaImagesScheduledForDeletion->isEmpty()) {
                    \Diaporamas\Model\ProductDiaporamaImageQuery::create()
                        ->filterByPrimaryKeys($this->productDiaporamaImagesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->productDiaporamaImagesScheduledForDeletion = null;
                }
            }

                if ($this->collProductDiaporamaImages !== null) {
            foreach ($this->collProductDiaporamaImages as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->categoryDiaporamaImagesScheduledForDeletion !== null) {
                if (!$this->categoryDiaporamaImagesScheduledForDeletion->isEmpty()) {
                    \Diaporamas\Model\CategoryDiaporamaImageQuery::create()
                        ->filterByPrimaryKeys($this->categoryDiaporamaImagesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->categoryDiaporamaImagesScheduledForDeletion = null;
                }
            }

                if ($this->collCategoryDiaporamaImages !== null) {
            foreach ($this->collCategoryDiaporamaImages as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->brandDiaporamaImagesScheduledForDeletion !== null) {
                if (!$this->brandDiaporamaImagesScheduledForDeletion->isEmpty()) {
                    \Diaporamas\Model\BrandDiaporamaImageQuery::create()
                        ->filterByPrimaryKeys($this->brandDiaporamaImagesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->brandDiaporamaImagesScheduledForDeletion = null;
                }
            }

                if ($this->collBrandDiaporamaImages !== null) {
            foreach ($this->collBrandDiaporamaImages as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->folderDiaporamaImagesScheduledForDeletion !== null) {
                if (!$this->folderDiaporamaImagesScheduledForDeletion->isEmpty()) {
                    \Diaporamas\Model\FolderDiaporamaImageQuery::create()
                        ->filterByPrimaryKeys($this->folderDiaporamaImagesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->folderDiaporamaImagesScheduledForDeletion = null;
                }
            }

                if ($this->collFolderDiaporamaImages !== null) {
            foreach ($this->collFolderDiaporamaImages as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->contentDiaporamaImagesScheduledForDeletion !== null) {
                if (!$this->contentDiaporamaImagesScheduledForDeletion->isEmpty()) {
                    \Diaporamas\Model\ContentDiaporamaImageQuery::create()
                        ->filterByPrimaryKeys($this->contentDiaporamaImagesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->contentDiaporamaImagesScheduledForDeletion = null;
                }
            }

                if ($this->collContentDiaporamaImages !== null) {
            foreach ($this->collContentDiaporamaImages as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->diaporamaI18nsScheduledForDeletion !== null) {
                if (!$this->diaporamaI18nsScheduledForDeletion->isEmpty()) {
                    \Diaporamas\Model\DiaporamaI18nQuery::create()
                        ->filterByPrimaryKeys($this->diaporamaI18nsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->diaporamaI18nsScheduledForDeletion = null;
                }
            }

                if ($this->collDiaporamaI18ns !== null) {
            foreach ($this->collDiaporamaI18ns as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            $this->alreadyInSave = false;

        }

        return $affectedRows;
    } // doSave()

    /**
     * Insert the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @throws PropelException
     * @see doSave()
     */
    protected function doInsert(ConnectionInterface $con)
    {
        $modifiedColumns = array();
        $index = 0;

        $this->modifiedColumns[DiaporamaTableMap::ID] = true;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . DiaporamaTableMap::ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(DiaporamaTableMap::ID)) {
            $modifiedColumns[':p' . $index++]  = 'ID';
        }
        if ($this->isColumnModified(DiaporamaTableMap::SHORTCODE)) {
            $modifiedColumns[':p' . $index++]  = 'SHORTCODE';
        }
        if ($this->isColumnModified(DiaporamaTableMap::DESCENDANT_CLASS)) {
            $modifiedColumns[':p' . $index++]  = 'DESCENDANT_CLASS';
        }

        $sql = sprintf(
            'INSERT INTO diaporama (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'ID':
                        $stmt->bindValue($identifier, $this->id, PDO::PARAM_INT);
                        break;
                    case 'SHORTCODE':
                        $stmt->bindValue($identifier, $this->shortcode, PDO::PARAM_STR);
                        break;
                    case 'DESCENDANT_CLASS':
                        $stmt->bindValue($identifier, $this->descendant_class, PDO::PARAM_STR);
                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), 0, $e);
        }

        try {
            $pk = $con->lastInsertId();
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', 0, $e);
        }
        $this->setId($pk);

        $this->setNew(false);
    }

    /**
     * Update the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @return Integer Number of updated rows
     * @see doSave()
     */
    protected function doUpdate(ConnectionInterface $con)
    {
        $selectCriteria = $this->buildPkeyCriteria();
        $valuesCriteria = $this->buildCriteria();

        return $selectCriteria->doUpdate($valuesCriteria, $con);
    }

    /**
     * Retrieves a field from the object by name passed in as a string.
     *
     * @param      string $name name
     * @param      string $type The type of fieldname the $name is of:
     *                     one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_STUDLYPHPNAME
     *                     TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                     Defaults to TableMap::TYPE_PHPNAME.
     * @return mixed Value of field.
     */
    public function getByName($name, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = DiaporamaTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
        $field = $this->getByPosition($pos);

        return $field;
    }

    /**
     * Retrieves a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param      int $pos position in xml schema
     * @return mixed Value of field at $pos
     */
    public function getByPosition($pos)
    {
        switch ($pos) {
            case 0:
                return $this->getId();
                break;
            case 1:
                return $this->getShortcode();
                break;
            case 2:
                return $this->getDescendantClass();
                break;
            default:
                return null;
                break;
        } // switch()
    }

    /**
     * Exports the object as an array.
     *
     * You can specify the key type of the array by passing one of the class
     * type constants.
     *
     * @param     string  $keyType (optional) One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_STUDLYPHPNAME,
     *                    TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                    Defaults to TableMap::TYPE_PHPNAME.
     * @param     boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to TRUE.
     * @param     array $alreadyDumpedObjects List of objects to skip to avoid recursion
     * @param     boolean $includeForeignObjects (optional) Whether to include hydrated related objects. Default to FALSE.
     *
     * @return array an associative array containing the field names (as keys) and field values
     */
    public function toArray($keyType = TableMap::TYPE_PHPNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array(), $includeForeignObjects = false)
    {
        if (isset($alreadyDumpedObjects['Diaporama'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Diaporama'][$this->getPrimaryKey()] = true;
        $keys = DiaporamaTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getShortcode(),
            $keys[2] => $this->getDescendantClass(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->collDiaporamaImages) {
                $result['DiaporamaImages'] = $this->collDiaporamaImages->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->singleProductDiaporama) {
                $result['ProductDiaporama'] = $this->singleProductDiaporama->toArray($keyType, $includeLazyLoadColumns, $alreadyDumpedObjects, true);
            }
            if (null !== $this->singleCategoryDiaporama) {
                $result['CategoryDiaporama'] = $this->singleCategoryDiaporama->toArray($keyType, $includeLazyLoadColumns, $alreadyDumpedObjects, true);
            }
            if (null !== $this->singleBrandDiaporama) {
                $result['BrandDiaporama'] = $this->singleBrandDiaporama->toArray($keyType, $includeLazyLoadColumns, $alreadyDumpedObjects, true);
            }
            if (null !== $this->singleFolderDiaporama) {
                $result['FolderDiaporama'] = $this->singleFolderDiaporama->toArray($keyType, $includeLazyLoadColumns, $alreadyDumpedObjects, true);
            }
            if (null !== $this->singleContentDiaporama) {
                $result['ContentDiaporama'] = $this->singleContentDiaporama->toArray($keyType, $includeLazyLoadColumns, $alreadyDumpedObjects, true);
            }
            if (null !== $this->collProductDiaporamaImages) {
                $result['ProductDiaporamaImages'] = $this->collProductDiaporamaImages->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collCategoryDiaporamaImages) {
                $result['CategoryDiaporamaImages'] = $this->collCategoryDiaporamaImages->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collBrandDiaporamaImages) {
                $result['BrandDiaporamaImages'] = $this->collBrandDiaporamaImages->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collFolderDiaporamaImages) {
                $result['FolderDiaporamaImages'] = $this->collFolderDiaporamaImages->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collContentDiaporamaImages) {
                $result['ContentDiaporamaImages'] = $this->collContentDiaporamaImages->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collDiaporamaI18ns) {
                $result['DiaporamaI18ns'] = $this->collDiaporamaI18ns->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
        }

        return $result;
    }

    /**
     * Sets a field from the object by name passed in as a string.
     *
     * @param      string $name
     * @param      mixed  $value field value
     * @param      string $type The type of fieldname the $name is of:
     *                     one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_STUDLYPHPNAME
     *                     TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                     Defaults to TableMap::TYPE_PHPNAME.
     * @return void
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = DiaporamaTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param      int $pos position in xml schema
     * @param      mixed $value field value
     * @return void
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setId($value);
                break;
            case 1:
                $this->setShortcode($value);
                break;
            case 2:
                $this->setDescendantClass($value);
                break;
        } // switch()
    }

    /**
     * Populates the object using an array.
     *
     * This is particularly useful when populating an object from one of the
     * request arrays (e.g. $_POST).  This method goes through the column
     * names, checking to see whether a matching key exists in populated
     * array. If so the setByName() method is called for that column.
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_STUDLYPHPNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param      array  $arr     An array to populate the object from.
     * @param      string $keyType The type of keys the array uses.
     * @return void
     */
    public function fromArray($arr, $keyType = TableMap::TYPE_PHPNAME)
    {
        $keys = DiaporamaTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setShortcode($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setDescendantClass($arr[$keys[2]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(DiaporamaTableMap::DATABASE_NAME);

        if ($this->isColumnModified(DiaporamaTableMap::ID)) $criteria->add(DiaporamaTableMap::ID, $this->id);
        if ($this->isColumnModified(DiaporamaTableMap::SHORTCODE)) $criteria->add(DiaporamaTableMap::SHORTCODE, $this->shortcode);
        if ($this->isColumnModified(DiaporamaTableMap::DESCENDANT_CLASS)) $criteria->add(DiaporamaTableMap::DESCENDANT_CLASS, $this->descendant_class);

        return $criteria;
    }

    /**
     * Builds a Criteria object containing the primary key for this object.
     *
     * Unlike buildCriteria() this method includes the primary key values regardless
     * of whether or not they have been modified.
     *
     * @return Criteria The Criteria object containing value(s) for primary key(s).
     */
    public function buildPkeyCriteria()
    {
        $criteria = new Criteria(DiaporamaTableMap::DATABASE_NAME);
        $criteria->add(DiaporamaTableMap::ID, $this->id);

        return $criteria;
    }

    /**
     * Returns the primary key for this object (row).
     * @return   int
     */
    public function getPrimaryKey()
    {
        return $this->getId();
    }

    /**
     * Generic method to set the primary key (id column).
     *
     * @param       int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {

        return null === $this->getId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \Diaporamas\Model\Diaporama (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setShortcode($this->getShortcode());
        $copyObj->setDescendantClass($this->getDescendantClass());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getDiaporamaImages() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addDiaporamaImage($relObj->copy($deepCopy));
                }
            }

            $relObj = $this->getProductDiaporama();
            if ($relObj) {
                $copyObj->setProductDiaporama($relObj->copy($deepCopy));
            }

            $relObj = $this->getCategoryDiaporama();
            if ($relObj) {
                $copyObj->setCategoryDiaporama($relObj->copy($deepCopy));
            }

            $relObj = $this->getBrandDiaporama();
            if ($relObj) {
                $copyObj->setBrandDiaporama($relObj->copy($deepCopy));
            }

            $relObj = $this->getFolderDiaporama();
            if ($relObj) {
                $copyObj->setFolderDiaporama($relObj->copy($deepCopy));
            }

            $relObj = $this->getContentDiaporama();
            if ($relObj) {
                $copyObj->setContentDiaporama($relObj->copy($deepCopy));
            }

            foreach ($this->getProductDiaporamaImages() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addProductDiaporamaImage($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getCategoryDiaporamaImages() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addCategoryDiaporamaImage($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getBrandDiaporamaImages() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addBrandDiaporamaImage($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getFolderDiaporamaImages() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addFolderDiaporamaImage($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getContentDiaporamaImages() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addContentDiaporamaImage($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getDiaporamaI18ns() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addDiaporamaI18n($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setId(NULL); // this is a auto-increment column, so set to default value
        }
    }

    /**
     * Makes a copy of this object that will be inserted as a new row in table when saved.
     * It creates a new object filling in the simple attributes, but skipping any primary
     * keys that are defined for the table.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @return                 \Diaporamas\Model\Diaporama Clone of current object.
     * @throws PropelException
     */
    public function copy($deepCopy = false)
    {
        // we use get_class(), because this might be a subclass
        $clazz = get_class($this);
        $copyObj = new $clazz();
        $this->copyInto($copyObj, $deepCopy);

        return $copyObj;
    }


    /**
     * Initializes a collection based on the name of a relation.
     * Avoids crafting an 'init[$relationName]s' method name
     * that wouldn't work when StandardEnglishPluralizer is used.
     *
     * @param      string $relationName The name of the relation to initialize
     * @return void
     */
    public function initRelation($relationName)
    {
        if ('DiaporamaImage' == $relationName) {
            return $this->initDiaporamaImages();
        }
        if ('ProductDiaporamaImage' == $relationName) {
            return $this->initProductDiaporamaImages();
        }
        if ('CategoryDiaporamaImage' == $relationName) {
            return $this->initCategoryDiaporamaImages();
        }
        if ('BrandDiaporamaImage' == $relationName) {
            return $this->initBrandDiaporamaImages();
        }
        if ('FolderDiaporamaImage' == $relationName) {
            return $this->initFolderDiaporamaImages();
        }
        if ('ContentDiaporamaImage' == $relationName) {
            return $this->initContentDiaporamaImages();
        }
        if ('DiaporamaI18n' == $relationName) {
            return $this->initDiaporamaI18ns();
        }
    }

    /**
     * Clears out the collDiaporamaImages collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addDiaporamaImages()
     */
    public function clearDiaporamaImages()
    {
        $this->collDiaporamaImages = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collDiaporamaImages collection loaded partially.
     */
    public function resetPartialDiaporamaImages($v = true)
    {
        $this->collDiaporamaImagesPartial = $v;
    }

    /**
     * Initializes the collDiaporamaImages collection.
     *
     * By default this just sets the collDiaporamaImages collection to an empty array (like clearcollDiaporamaImages());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initDiaporamaImages($overrideExisting = true)
    {
        if (null !== $this->collDiaporamaImages && !$overrideExisting) {
            return;
        }
        $this->collDiaporamaImages = new ObjectCollection();
        $this->collDiaporamaImages->setModel('\Diaporamas\Model\DiaporamaImage');
    }

    /**
     * Gets an array of ChildDiaporamaImage objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildDiaporama is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return Collection|ChildDiaporamaImage[] List of ChildDiaporamaImage objects
     * @throws PropelException
     */
    public function getDiaporamaImages($criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collDiaporamaImagesPartial && !$this->isNew();
        if (null === $this->collDiaporamaImages || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collDiaporamaImages) {
                // return empty collection
                $this->initDiaporamaImages();
            } else {
                $collDiaporamaImages = ChildDiaporamaImageQuery::create(null, $criteria)
                    ->filterByDiaporama($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collDiaporamaImagesPartial && count($collDiaporamaImages)) {
                        $this->initDiaporamaImages(false);

                        foreach ($collDiaporamaImages as $obj) {
                            if (false == $this->collDiaporamaImages->contains($obj)) {
                                $this->collDiaporamaImages->append($obj);
                            }
                        }

                        $this->collDiaporamaImagesPartial = true;
                    }

                    reset($collDiaporamaImages);

                    return $collDiaporamaImages;
                }

                if ($partial && $this->collDiaporamaImages) {
                    foreach ($this->collDiaporamaImages as $obj) {
                        if ($obj->isNew()) {
                            $collDiaporamaImages[] = $obj;
                        }
                    }
                }

                $this->collDiaporamaImages = $collDiaporamaImages;
                $this->collDiaporamaImagesPartial = false;
            }
        }

        return $this->collDiaporamaImages;
    }

    /**
     * Sets a collection of DiaporamaImage objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $diaporamaImages A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return   ChildDiaporama The current object (for fluent API support)
     */
    public function setDiaporamaImages(Collection $diaporamaImages, ConnectionInterface $con = null)
    {
        $diaporamaImagesToDelete = $this->getDiaporamaImages(new Criteria(), $con)->diff($diaporamaImages);


        $this->diaporamaImagesScheduledForDeletion = $diaporamaImagesToDelete;

        foreach ($diaporamaImagesToDelete as $diaporamaImageRemoved) {
            $diaporamaImageRemoved->setDiaporama(null);
        }

        $this->collDiaporamaImages = null;
        foreach ($diaporamaImages as $diaporamaImage) {
            $this->addDiaporamaImage($diaporamaImage);
        }

        $this->collDiaporamaImages = $diaporamaImages;
        $this->collDiaporamaImagesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related DiaporamaImage objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related DiaporamaImage objects.
     * @throws PropelException
     */
    public function countDiaporamaImages(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collDiaporamaImagesPartial && !$this->isNew();
        if (null === $this->collDiaporamaImages || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collDiaporamaImages) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getDiaporamaImages());
            }

            $query = ChildDiaporamaImageQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByDiaporama($this)
                ->count($con);
        }

        return count($this->collDiaporamaImages);
    }

    /**
     * Method called to associate a ChildDiaporamaImage object to this object
     * through the ChildDiaporamaImage foreign key attribute.
     *
     * @param    ChildDiaporamaImage $l ChildDiaporamaImage
     * @return   \Diaporamas\Model\Diaporama The current object (for fluent API support)
     */
    public function addDiaporamaImage(ChildDiaporamaImage $l)
    {
        if ($this->collDiaporamaImages === null) {
            $this->initDiaporamaImages();
            $this->collDiaporamaImagesPartial = true;
        }

        if (!in_array($l, $this->collDiaporamaImages->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddDiaporamaImage($l);
        }

        return $this;
    }

    /**
     * @param DiaporamaImage $diaporamaImage The diaporamaImage object to add.
     */
    protected function doAddDiaporamaImage($diaporamaImage)
    {
        $this->collDiaporamaImages[]= $diaporamaImage;
        $diaporamaImage->setDiaporama($this);
    }

    /**
     * @param  DiaporamaImage $diaporamaImage The diaporamaImage object to remove.
     * @return ChildDiaporama The current object (for fluent API support)
     */
    public function removeDiaporamaImage($diaporamaImage)
    {
        if ($this->getDiaporamaImages()->contains($diaporamaImage)) {
            $this->collDiaporamaImages->remove($this->collDiaporamaImages->search($diaporamaImage));
            if (null === $this->diaporamaImagesScheduledForDeletion) {
                $this->diaporamaImagesScheduledForDeletion = clone $this->collDiaporamaImages;
                $this->diaporamaImagesScheduledForDeletion->clear();
            }
            $this->diaporamaImagesScheduledForDeletion[]= clone $diaporamaImage;
            $diaporamaImage->setDiaporama(null);
        }

        return $this;
    }

    /**
     * Gets a single ChildProductDiaporama object, which is related to this object by a one-to-one relationship.
     *
     * @param      ConnectionInterface $con optional connection object
     * @return                 ChildProductDiaporama
     * @throws PropelException
     */
    public function getProductDiaporama(ConnectionInterface $con = null)
    {

        if ($this->singleProductDiaporama === null && !$this->isNew()) {
            $this->singleProductDiaporama = ChildProductDiaporamaQuery::create()->findPk($this->getPrimaryKey(), $con);
        }

        return $this->singleProductDiaporama;
    }

    /**
     * Sets a single ChildProductDiaporama object as related to this object by a one-to-one relationship.
     *
     * @param                  ChildProductDiaporama $v ChildProductDiaporama
     * @return                 \Diaporamas\Model\Diaporama The current object (for fluent API support)
     * @throws PropelException
     */
    public function setProductDiaporama(ChildProductDiaporama $v = null)
    {
        $this->singleProductDiaporama = $v;

        // Make sure that that the passed-in ChildProductDiaporama isn't already associated with this object
        if ($v !== null && $v->getDiaporama(null, false) === null) {
            $v->setDiaporama($this);
        }

        return $this;
    }

    /**
     * Gets a single ChildCategoryDiaporama object, which is related to this object by a one-to-one relationship.
     *
     * @param      ConnectionInterface $con optional connection object
     * @return                 ChildCategoryDiaporama
     * @throws PropelException
     */
    public function getCategoryDiaporama(ConnectionInterface $con = null)
    {

        if ($this->singleCategoryDiaporama === null && !$this->isNew()) {
            $this->singleCategoryDiaporama = ChildCategoryDiaporamaQuery::create()->findPk($this->getPrimaryKey(), $con);
        }

        return $this->singleCategoryDiaporama;
    }

    /**
     * Sets a single ChildCategoryDiaporama object as related to this object by a one-to-one relationship.
     *
     * @param                  ChildCategoryDiaporama $v ChildCategoryDiaporama
     * @return                 \Diaporamas\Model\Diaporama The current object (for fluent API support)
     * @throws PropelException
     */
    public function setCategoryDiaporama(ChildCategoryDiaporama $v = null)
    {
        $this->singleCategoryDiaporama = $v;

        // Make sure that that the passed-in ChildCategoryDiaporama isn't already associated with this object
        if ($v !== null && $v->getDiaporama(null, false) === null) {
            $v->setDiaporama($this);
        }

        return $this;
    }

    /**
     * Gets a single ChildBrandDiaporama object, which is related to this object by a one-to-one relationship.
     *
     * @param      ConnectionInterface $con optional connection object
     * @return                 ChildBrandDiaporama
     * @throws PropelException
     */
    public function getBrandDiaporama(ConnectionInterface $con = null)
    {

        if ($this->singleBrandDiaporama === null && !$this->isNew()) {
            $this->singleBrandDiaporama = ChildBrandDiaporamaQuery::create()->findPk($this->getPrimaryKey(), $con);
        }

        return $this->singleBrandDiaporama;
    }

    /**
     * Sets a single ChildBrandDiaporama object as related to this object by a one-to-one relationship.
     *
     * @param                  ChildBrandDiaporama $v ChildBrandDiaporama
     * @return                 \Diaporamas\Model\Diaporama The current object (for fluent API support)
     * @throws PropelException
     */
    public function setBrandDiaporama(ChildBrandDiaporama $v = null)
    {
        $this->singleBrandDiaporama = $v;

        // Make sure that that the passed-in ChildBrandDiaporama isn't already associated with this object
        if ($v !== null && $v->getDiaporama(null, false) === null) {
            $v->setDiaporama($this);
        }

        return $this;
    }

    /**
     * Gets a single ChildFolderDiaporama object, which is related to this object by a one-to-one relationship.
     *
     * @param      ConnectionInterface $con optional connection object
     * @return                 ChildFolderDiaporama
     * @throws PropelException
     */
    public function getFolderDiaporama(ConnectionInterface $con = null)
    {

        if ($this->singleFolderDiaporama === null && !$this->isNew()) {
            $this->singleFolderDiaporama = ChildFolderDiaporamaQuery::create()->findPk($this->getPrimaryKey(), $con);
        }

        return $this->singleFolderDiaporama;
    }

    /**
     * Sets a single ChildFolderDiaporama object as related to this object by a one-to-one relationship.
     *
     * @param                  ChildFolderDiaporama $v ChildFolderDiaporama
     * @return                 \Diaporamas\Model\Diaporama The current object (for fluent API support)
     * @throws PropelException
     */
    public function setFolderDiaporama(ChildFolderDiaporama $v = null)
    {
        $this->singleFolderDiaporama = $v;

        // Make sure that that the passed-in ChildFolderDiaporama isn't already associated with this object
        if ($v !== null && $v->getDiaporama(null, false) === null) {
            $v->setDiaporama($this);
        }

        return $this;
    }

    /**
     * Gets a single ChildContentDiaporama object, which is related to this object by a one-to-one relationship.
     *
     * @param      ConnectionInterface $con optional connection object
     * @return                 ChildContentDiaporama
     * @throws PropelException
     */
    public function getContentDiaporama(ConnectionInterface $con = null)
    {

        if ($this->singleContentDiaporama === null && !$this->isNew()) {
            $this->singleContentDiaporama = ChildContentDiaporamaQuery::create()->findPk($this->getPrimaryKey(), $con);
        }

        return $this->singleContentDiaporama;
    }

    /**
     * Sets a single ChildContentDiaporama object as related to this object by a one-to-one relationship.
     *
     * @param                  ChildContentDiaporama $v ChildContentDiaporama
     * @return                 \Diaporamas\Model\Diaporama The current object (for fluent API support)
     * @throws PropelException
     */
    public function setContentDiaporama(ChildContentDiaporama $v = null)
    {
        $this->singleContentDiaporama = $v;

        // Make sure that that the passed-in ChildContentDiaporama isn't already associated with this object
        if ($v !== null && $v->getDiaporama(null, false) === null) {
            $v->setDiaporama($this);
        }

        return $this;
    }

    /**
     * Clears out the collProductDiaporamaImages collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addProductDiaporamaImages()
     */
    public function clearProductDiaporamaImages()
    {
        $this->collProductDiaporamaImages = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collProductDiaporamaImages collection loaded partially.
     */
    public function resetPartialProductDiaporamaImages($v = true)
    {
        $this->collProductDiaporamaImagesPartial = $v;
    }

    /**
     * Initializes the collProductDiaporamaImages collection.
     *
     * By default this just sets the collProductDiaporamaImages collection to an empty array (like clearcollProductDiaporamaImages());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initProductDiaporamaImages($overrideExisting = true)
    {
        if (null !== $this->collProductDiaporamaImages && !$overrideExisting) {
            return;
        }
        $this->collProductDiaporamaImages = new ObjectCollection();
        $this->collProductDiaporamaImages->setModel('\Diaporamas\Model\ProductDiaporamaImage');
    }

    /**
     * Gets an array of ChildProductDiaporamaImage objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildDiaporama is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return Collection|ChildProductDiaporamaImage[] List of ChildProductDiaporamaImage objects
     * @throws PropelException
     */
    public function getProductDiaporamaImages($criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collProductDiaporamaImagesPartial && !$this->isNew();
        if (null === $this->collProductDiaporamaImages || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collProductDiaporamaImages) {
                // return empty collection
                $this->initProductDiaporamaImages();
            } else {
                $collProductDiaporamaImages = ChildProductDiaporamaImageQuery::create(null, $criteria)
                    ->filterByDiaporama($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collProductDiaporamaImagesPartial && count($collProductDiaporamaImages)) {
                        $this->initProductDiaporamaImages(false);

                        foreach ($collProductDiaporamaImages as $obj) {
                            if (false == $this->collProductDiaporamaImages->contains($obj)) {
                                $this->collProductDiaporamaImages->append($obj);
                            }
                        }

                        $this->collProductDiaporamaImagesPartial = true;
                    }

                    reset($collProductDiaporamaImages);

                    return $collProductDiaporamaImages;
                }

                if ($partial && $this->collProductDiaporamaImages) {
                    foreach ($this->collProductDiaporamaImages as $obj) {
                        if ($obj->isNew()) {
                            $collProductDiaporamaImages[] = $obj;
                        }
                    }
                }

                $this->collProductDiaporamaImages = $collProductDiaporamaImages;
                $this->collProductDiaporamaImagesPartial = false;
            }
        }

        return $this->collProductDiaporamaImages;
    }

    /**
     * Sets a collection of ProductDiaporamaImage objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $productDiaporamaImages A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return   ChildDiaporama The current object (for fluent API support)
     */
    public function setProductDiaporamaImages(Collection $productDiaporamaImages, ConnectionInterface $con = null)
    {
        $productDiaporamaImagesToDelete = $this->getProductDiaporamaImages(new Criteria(), $con)->diff($productDiaporamaImages);


        $this->productDiaporamaImagesScheduledForDeletion = $productDiaporamaImagesToDelete;

        foreach ($productDiaporamaImagesToDelete as $productDiaporamaImageRemoved) {
            $productDiaporamaImageRemoved->setDiaporama(null);
        }

        $this->collProductDiaporamaImages = null;
        foreach ($productDiaporamaImages as $productDiaporamaImage) {
            $this->addProductDiaporamaImage($productDiaporamaImage);
        }

        $this->collProductDiaporamaImages = $productDiaporamaImages;
        $this->collProductDiaporamaImagesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related ProductDiaporamaImage objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related ProductDiaporamaImage objects.
     * @throws PropelException
     */
    public function countProductDiaporamaImages(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collProductDiaporamaImagesPartial && !$this->isNew();
        if (null === $this->collProductDiaporamaImages || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collProductDiaporamaImages) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getProductDiaporamaImages());
            }

            $query = ChildProductDiaporamaImageQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByDiaporama($this)
                ->count($con);
        }

        return count($this->collProductDiaporamaImages);
    }

    /**
     * Method called to associate a ChildProductDiaporamaImage object to this object
     * through the ChildProductDiaporamaImage foreign key attribute.
     *
     * @param    ChildProductDiaporamaImage $l ChildProductDiaporamaImage
     * @return   \Diaporamas\Model\Diaporama The current object (for fluent API support)
     */
    public function addProductDiaporamaImage(ChildProductDiaporamaImage $l)
    {
        if ($this->collProductDiaporamaImages === null) {
            $this->initProductDiaporamaImages();
            $this->collProductDiaporamaImagesPartial = true;
        }

        if (!in_array($l, $this->collProductDiaporamaImages->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddProductDiaporamaImage($l);
        }

        return $this;
    }

    /**
     * @param ProductDiaporamaImage $productDiaporamaImage The productDiaporamaImage object to add.
     */
    protected function doAddProductDiaporamaImage($productDiaporamaImage)
    {
        $this->collProductDiaporamaImages[]= $productDiaporamaImage;
        $productDiaporamaImage->setDiaporama($this);
    }

    /**
     * @param  ProductDiaporamaImage $productDiaporamaImage The productDiaporamaImage object to remove.
     * @return ChildDiaporama The current object (for fluent API support)
     */
    public function removeProductDiaporamaImage($productDiaporamaImage)
    {
        if ($this->getProductDiaporamaImages()->contains($productDiaporamaImage)) {
            $this->collProductDiaporamaImages->remove($this->collProductDiaporamaImages->search($productDiaporamaImage));
            if (null === $this->productDiaporamaImagesScheduledForDeletion) {
                $this->productDiaporamaImagesScheduledForDeletion = clone $this->collProductDiaporamaImages;
                $this->productDiaporamaImagesScheduledForDeletion->clear();
            }
            $this->productDiaporamaImagesScheduledForDeletion[]= clone $productDiaporamaImage;
            $productDiaporamaImage->setDiaporama(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Diaporama is new, it will return
     * an empty collection; or if this Diaporama has previously
     * been saved, it will retrieve related ProductDiaporamaImages from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Diaporama.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return Collection|ChildProductDiaporamaImage[] List of ChildProductDiaporamaImage objects
     */
    public function getProductDiaporamaImagesJoinProductImage($criteria = null, $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildProductDiaporamaImageQuery::create(null, $criteria);
        $query->joinWith('ProductImage', $joinBehavior);

        return $this->getProductDiaporamaImages($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Diaporama is new, it will return
     * an empty collection; or if this Diaporama has previously
     * been saved, it will retrieve related ProductDiaporamaImages from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Diaporama.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return Collection|ChildProductDiaporamaImage[] List of ChildProductDiaporamaImage objects
     */
    public function getProductDiaporamaImagesJoinDiaporamaImage($criteria = null, $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildProductDiaporamaImageQuery::create(null, $criteria);
        $query->joinWith('DiaporamaImage', $joinBehavior);

        return $this->getProductDiaporamaImages($query, $con);
    }

    /**
     * Clears out the collCategoryDiaporamaImages collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addCategoryDiaporamaImages()
     */
    public function clearCategoryDiaporamaImages()
    {
        $this->collCategoryDiaporamaImages = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collCategoryDiaporamaImages collection loaded partially.
     */
    public function resetPartialCategoryDiaporamaImages($v = true)
    {
        $this->collCategoryDiaporamaImagesPartial = $v;
    }

    /**
     * Initializes the collCategoryDiaporamaImages collection.
     *
     * By default this just sets the collCategoryDiaporamaImages collection to an empty array (like clearcollCategoryDiaporamaImages());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initCategoryDiaporamaImages($overrideExisting = true)
    {
        if (null !== $this->collCategoryDiaporamaImages && !$overrideExisting) {
            return;
        }
        $this->collCategoryDiaporamaImages = new ObjectCollection();
        $this->collCategoryDiaporamaImages->setModel('\Diaporamas\Model\CategoryDiaporamaImage');
    }

    /**
     * Gets an array of ChildCategoryDiaporamaImage objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildDiaporama is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return Collection|ChildCategoryDiaporamaImage[] List of ChildCategoryDiaporamaImage objects
     * @throws PropelException
     */
    public function getCategoryDiaporamaImages($criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collCategoryDiaporamaImagesPartial && !$this->isNew();
        if (null === $this->collCategoryDiaporamaImages || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collCategoryDiaporamaImages) {
                // return empty collection
                $this->initCategoryDiaporamaImages();
            } else {
                $collCategoryDiaporamaImages = ChildCategoryDiaporamaImageQuery::create(null, $criteria)
                    ->filterByDiaporama($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collCategoryDiaporamaImagesPartial && count($collCategoryDiaporamaImages)) {
                        $this->initCategoryDiaporamaImages(false);

                        foreach ($collCategoryDiaporamaImages as $obj) {
                            if (false == $this->collCategoryDiaporamaImages->contains($obj)) {
                                $this->collCategoryDiaporamaImages->append($obj);
                            }
                        }

                        $this->collCategoryDiaporamaImagesPartial = true;
                    }

                    reset($collCategoryDiaporamaImages);

                    return $collCategoryDiaporamaImages;
                }

                if ($partial && $this->collCategoryDiaporamaImages) {
                    foreach ($this->collCategoryDiaporamaImages as $obj) {
                        if ($obj->isNew()) {
                            $collCategoryDiaporamaImages[] = $obj;
                        }
                    }
                }

                $this->collCategoryDiaporamaImages = $collCategoryDiaporamaImages;
                $this->collCategoryDiaporamaImagesPartial = false;
            }
        }

        return $this->collCategoryDiaporamaImages;
    }

    /**
     * Sets a collection of CategoryDiaporamaImage objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $categoryDiaporamaImages A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return   ChildDiaporama The current object (for fluent API support)
     */
    public function setCategoryDiaporamaImages(Collection $categoryDiaporamaImages, ConnectionInterface $con = null)
    {
        $categoryDiaporamaImagesToDelete = $this->getCategoryDiaporamaImages(new Criteria(), $con)->diff($categoryDiaporamaImages);


        $this->categoryDiaporamaImagesScheduledForDeletion = $categoryDiaporamaImagesToDelete;

        foreach ($categoryDiaporamaImagesToDelete as $categoryDiaporamaImageRemoved) {
            $categoryDiaporamaImageRemoved->setDiaporama(null);
        }

        $this->collCategoryDiaporamaImages = null;
        foreach ($categoryDiaporamaImages as $categoryDiaporamaImage) {
            $this->addCategoryDiaporamaImage($categoryDiaporamaImage);
        }

        $this->collCategoryDiaporamaImages = $categoryDiaporamaImages;
        $this->collCategoryDiaporamaImagesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related CategoryDiaporamaImage objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related CategoryDiaporamaImage objects.
     * @throws PropelException
     */
    public function countCategoryDiaporamaImages(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collCategoryDiaporamaImagesPartial && !$this->isNew();
        if (null === $this->collCategoryDiaporamaImages || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collCategoryDiaporamaImages) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getCategoryDiaporamaImages());
            }

            $query = ChildCategoryDiaporamaImageQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByDiaporama($this)
                ->count($con);
        }

        return count($this->collCategoryDiaporamaImages);
    }

    /**
     * Method called to associate a ChildCategoryDiaporamaImage object to this object
     * through the ChildCategoryDiaporamaImage foreign key attribute.
     *
     * @param    ChildCategoryDiaporamaImage $l ChildCategoryDiaporamaImage
     * @return   \Diaporamas\Model\Diaporama The current object (for fluent API support)
     */
    public function addCategoryDiaporamaImage(ChildCategoryDiaporamaImage $l)
    {
        if ($this->collCategoryDiaporamaImages === null) {
            $this->initCategoryDiaporamaImages();
            $this->collCategoryDiaporamaImagesPartial = true;
        }

        if (!in_array($l, $this->collCategoryDiaporamaImages->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddCategoryDiaporamaImage($l);
        }

        return $this;
    }

    /**
     * @param CategoryDiaporamaImage $categoryDiaporamaImage The categoryDiaporamaImage object to add.
     */
    protected function doAddCategoryDiaporamaImage($categoryDiaporamaImage)
    {
        $this->collCategoryDiaporamaImages[]= $categoryDiaporamaImage;
        $categoryDiaporamaImage->setDiaporama($this);
    }

    /**
     * @param  CategoryDiaporamaImage $categoryDiaporamaImage The categoryDiaporamaImage object to remove.
     * @return ChildDiaporama The current object (for fluent API support)
     */
    public function removeCategoryDiaporamaImage($categoryDiaporamaImage)
    {
        if ($this->getCategoryDiaporamaImages()->contains($categoryDiaporamaImage)) {
            $this->collCategoryDiaporamaImages->remove($this->collCategoryDiaporamaImages->search($categoryDiaporamaImage));
            if (null === $this->categoryDiaporamaImagesScheduledForDeletion) {
                $this->categoryDiaporamaImagesScheduledForDeletion = clone $this->collCategoryDiaporamaImages;
                $this->categoryDiaporamaImagesScheduledForDeletion->clear();
            }
            $this->categoryDiaporamaImagesScheduledForDeletion[]= clone $categoryDiaporamaImage;
            $categoryDiaporamaImage->setDiaporama(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Diaporama is new, it will return
     * an empty collection; or if this Diaporama has previously
     * been saved, it will retrieve related CategoryDiaporamaImages from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Diaporama.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return Collection|ChildCategoryDiaporamaImage[] List of ChildCategoryDiaporamaImage objects
     */
    public function getCategoryDiaporamaImagesJoinCategoryImage($criteria = null, $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildCategoryDiaporamaImageQuery::create(null, $criteria);
        $query->joinWith('CategoryImage', $joinBehavior);

        return $this->getCategoryDiaporamaImages($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Diaporama is new, it will return
     * an empty collection; or if this Diaporama has previously
     * been saved, it will retrieve related CategoryDiaporamaImages from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Diaporama.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return Collection|ChildCategoryDiaporamaImage[] List of ChildCategoryDiaporamaImage objects
     */
    public function getCategoryDiaporamaImagesJoinDiaporamaImage($criteria = null, $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildCategoryDiaporamaImageQuery::create(null, $criteria);
        $query->joinWith('DiaporamaImage', $joinBehavior);

        return $this->getCategoryDiaporamaImages($query, $con);
    }

    /**
     * Clears out the collBrandDiaporamaImages collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addBrandDiaporamaImages()
     */
    public function clearBrandDiaporamaImages()
    {
        $this->collBrandDiaporamaImages = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collBrandDiaporamaImages collection loaded partially.
     */
    public function resetPartialBrandDiaporamaImages($v = true)
    {
        $this->collBrandDiaporamaImagesPartial = $v;
    }

    /**
     * Initializes the collBrandDiaporamaImages collection.
     *
     * By default this just sets the collBrandDiaporamaImages collection to an empty array (like clearcollBrandDiaporamaImages());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initBrandDiaporamaImages($overrideExisting = true)
    {
        if (null !== $this->collBrandDiaporamaImages && !$overrideExisting) {
            return;
        }
        $this->collBrandDiaporamaImages = new ObjectCollection();
        $this->collBrandDiaporamaImages->setModel('\Diaporamas\Model\BrandDiaporamaImage');
    }

    /**
     * Gets an array of ChildBrandDiaporamaImage objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildDiaporama is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return Collection|ChildBrandDiaporamaImage[] List of ChildBrandDiaporamaImage objects
     * @throws PropelException
     */
    public function getBrandDiaporamaImages($criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collBrandDiaporamaImagesPartial && !$this->isNew();
        if (null === $this->collBrandDiaporamaImages || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collBrandDiaporamaImages) {
                // return empty collection
                $this->initBrandDiaporamaImages();
            } else {
                $collBrandDiaporamaImages = ChildBrandDiaporamaImageQuery::create(null, $criteria)
                    ->filterByDiaporama($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collBrandDiaporamaImagesPartial && count($collBrandDiaporamaImages)) {
                        $this->initBrandDiaporamaImages(false);

                        foreach ($collBrandDiaporamaImages as $obj) {
                            if (false == $this->collBrandDiaporamaImages->contains($obj)) {
                                $this->collBrandDiaporamaImages->append($obj);
                            }
                        }

                        $this->collBrandDiaporamaImagesPartial = true;
                    }

                    reset($collBrandDiaporamaImages);

                    return $collBrandDiaporamaImages;
                }

                if ($partial && $this->collBrandDiaporamaImages) {
                    foreach ($this->collBrandDiaporamaImages as $obj) {
                        if ($obj->isNew()) {
                            $collBrandDiaporamaImages[] = $obj;
                        }
                    }
                }

                $this->collBrandDiaporamaImages = $collBrandDiaporamaImages;
                $this->collBrandDiaporamaImagesPartial = false;
            }
        }

        return $this->collBrandDiaporamaImages;
    }

    /**
     * Sets a collection of BrandDiaporamaImage objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $brandDiaporamaImages A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return   ChildDiaporama The current object (for fluent API support)
     */
    public function setBrandDiaporamaImages(Collection $brandDiaporamaImages, ConnectionInterface $con = null)
    {
        $brandDiaporamaImagesToDelete = $this->getBrandDiaporamaImages(new Criteria(), $con)->diff($brandDiaporamaImages);


        $this->brandDiaporamaImagesScheduledForDeletion = $brandDiaporamaImagesToDelete;

        foreach ($brandDiaporamaImagesToDelete as $brandDiaporamaImageRemoved) {
            $brandDiaporamaImageRemoved->setDiaporama(null);
        }

        $this->collBrandDiaporamaImages = null;
        foreach ($brandDiaporamaImages as $brandDiaporamaImage) {
            $this->addBrandDiaporamaImage($brandDiaporamaImage);
        }

        $this->collBrandDiaporamaImages = $brandDiaporamaImages;
        $this->collBrandDiaporamaImagesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BrandDiaporamaImage objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related BrandDiaporamaImage objects.
     * @throws PropelException
     */
    public function countBrandDiaporamaImages(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collBrandDiaporamaImagesPartial && !$this->isNew();
        if (null === $this->collBrandDiaporamaImages || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collBrandDiaporamaImages) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getBrandDiaporamaImages());
            }

            $query = ChildBrandDiaporamaImageQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByDiaporama($this)
                ->count($con);
        }

        return count($this->collBrandDiaporamaImages);
    }

    /**
     * Method called to associate a ChildBrandDiaporamaImage object to this object
     * through the ChildBrandDiaporamaImage foreign key attribute.
     *
     * @param    ChildBrandDiaporamaImage $l ChildBrandDiaporamaImage
     * @return   \Diaporamas\Model\Diaporama The current object (for fluent API support)
     */
    public function addBrandDiaporamaImage(ChildBrandDiaporamaImage $l)
    {
        if ($this->collBrandDiaporamaImages === null) {
            $this->initBrandDiaporamaImages();
            $this->collBrandDiaporamaImagesPartial = true;
        }

        if (!in_array($l, $this->collBrandDiaporamaImages->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddBrandDiaporamaImage($l);
        }

        return $this;
    }

    /**
     * @param BrandDiaporamaImage $brandDiaporamaImage The brandDiaporamaImage object to add.
     */
    protected function doAddBrandDiaporamaImage($brandDiaporamaImage)
    {
        $this->collBrandDiaporamaImages[]= $brandDiaporamaImage;
        $brandDiaporamaImage->setDiaporama($this);
    }

    /**
     * @param  BrandDiaporamaImage $brandDiaporamaImage The brandDiaporamaImage object to remove.
     * @return ChildDiaporama The current object (for fluent API support)
     */
    public function removeBrandDiaporamaImage($brandDiaporamaImage)
    {
        if ($this->getBrandDiaporamaImages()->contains($brandDiaporamaImage)) {
            $this->collBrandDiaporamaImages->remove($this->collBrandDiaporamaImages->search($brandDiaporamaImage));
            if (null === $this->brandDiaporamaImagesScheduledForDeletion) {
                $this->brandDiaporamaImagesScheduledForDeletion = clone $this->collBrandDiaporamaImages;
                $this->brandDiaporamaImagesScheduledForDeletion->clear();
            }
            $this->brandDiaporamaImagesScheduledForDeletion[]= clone $brandDiaporamaImage;
            $brandDiaporamaImage->setDiaporama(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Diaporama is new, it will return
     * an empty collection; or if this Diaporama has previously
     * been saved, it will retrieve related BrandDiaporamaImages from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Diaporama.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return Collection|ChildBrandDiaporamaImage[] List of ChildBrandDiaporamaImage objects
     */
    public function getBrandDiaporamaImagesJoinBrandImage($criteria = null, $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBrandDiaporamaImageQuery::create(null, $criteria);
        $query->joinWith('BrandImage', $joinBehavior);

        return $this->getBrandDiaporamaImages($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Diaporama is new, it will return
     * an empty collection; or if this Diaporama has previously
     * been saved, it will retrieve related BrandDiaporamaImages from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Diaporama.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return Collection|ChildBrandDiaporamaImage[] List of ChildBrandDiaporamaImage objects
     */
    public function getBrandDiaporamaImagesJoinDiaporamaImage($criteria = null, $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBrandDiaporamaImageQuery::create(null, $criteria);
        $query->joinWith('DiaporamaImage', $joinBehavior);

        return $this->getBrandDiaporamaImages($query, $con);
    }

    /**
     * Clears out the collFolderDiaporamaImages collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addFolderDiaporamaImages()
     */
    public function clearFolderDiaporamaImages()
    {
        $this->collFolderDiaporamaImages = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collFolderDiaporamaImages collection loaded partially.
     */
    public function resetPartialFolderDiaporamaImages($v = true)
    {
        $this->collFolderDiaporamaImagesPartial = $v;
    }

    /**
     * Initializes the collFolderDiaporamaImages collection.
     *
     * By default this just sets the collFolderDiaporamaImages collection to an empty array (like clearcollFolderDiaporamaImages());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initFolderDiaporamaImages($overrideExisting = true)
    {
        if (null !== $this->collFolderDiaporamaImages && !$overrideExisting) {
            return;
        }
        $this->collFolderDiaporamaImages = new ObjectCollection();
        $this->collFolderDiaporamaImages->setModel('\Diaporamas\Model\FolderDiaporamaImage');
    }

    /**
     * Gets an array of ChildFolderDiaporamaImage objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildDiaporama is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return Collection|ChildFolderDiaporamaImage[] List of ChildFolderDiaporamaImage objects
     * @throws PropelException
     */
    public function getFolderDiaporamaImages($criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collFolderDiaporamaImagesPartial && !$this->isNew();
        if (null === $this->collFolderDiaporamaImages || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collFolderDiaporamaImages) {
                // return empty collection
                $this->initFolderDiaporamaImages();
            } else {
                $collFolderDiaporamaImages = ChildFolderDiaporamaImageQuery::create(null, $criteria)
                    ->filterByDiaporama($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collFolderDiaporamaImagesPartial && count($collFolderDiaporamaImages)) {
                        $this->initFolderDiaporamaImages(false);

                        foreach ($collFolderDiaporamaImages as $obj) {
                            if (false == $this->collFolderDiaporamaImages->contains($obj)) {
                                $this->collFolderDiaporamaImages->append($obj);
                            }
                        }

                        $this->collFolderDiaporamaImagesPartial = true;
                    }

                    reset($collFolderDiaporamaImages);

                    return $collFolderDiaporamaImages;
                }

                if ($partial && $this->collFolderDiaporamaImages) {
                    foreach ($this->collFolderDiaporamaImages as $obj) {
                        if ($obj->isNew()) {
                            $collFolderDiaporamaImages[] = $obj;
                        }
                    }
                }

                $this->collFolderDiaporamaImages = $collFolderDiaporamaImages;
                $this->collFolderDiaporamaImagesPartial = false;
            }
        }

        return $this->collFolderDiaporamaImages;
    }

    /**
     * Sets a collection of FolderDiaporamaImage objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $folderDiaporamaImages A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return   ChildDiaporama The current object (for fluent API support)
     */
    public function setFolderDiaporamaImages(Collection $folderDiaporamaImages, ConnectionInterface $con = null)
    {
        $folderDiaporamaImagesToDelete = $this->getFolderDiaporamaImages(new Criteria(), $con)->diff($folderDiaporamaImages);


        $this->folderDiaporamaImagesScheduledForDeletion = $folderDiaporamaImagesToDelete;

        foreach ($folderDiaporamaImagesToDelete as $folderDiaporamaImageRemoved) {
            $folderDiaporamaImageRemoved->setDiaporama(null);
        }

        $this->collFolderDiaporamaImages = null;
        foreach ($folderDiaporamaImages as $folderDiaporamaImage) {
            $this->addFolderDiaporamaImage($folderDiaporamaImage);
        }

        $this->collFolderDiaporamaImages = $folderDiaporamaImages;
        $this->collFolderDiaporamaImagesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related FolderDiaporamaImage objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related FolderDiaporamaImage objects.
     * @throws PropelException
     */
    public function countFolderDiaporamaImages(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collFolderDiaporamaImagesPartial && !$this->isNew();
        if (null === $this->collFolderDiaporamaImages || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collFolderDiaporamaImages) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getFolderDiaporamaImages());
            }

            $query = ChildFolderDiaporamaImageQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByDiaporama($this)
                ->count($con);
        }

        return count($this->collFolderDiaporamaImages);
    }

    /**
     * Method called to associate a ChildFolderDiaporamaImage object to this object
     * through the ChildFolderDiaporamaImage foreign key attribute.
     *
     * @param    ChildFolderDiaporamaImage $l ChildFolderDiaporamaImage
     * @return   \Diaporamas\Model\Diaporama The current object (for fluent API support)
     */
    public function addFolderDiaporamaImage(ChildFolderDiaporamaImage $l)
    {
        if ($this->collFolderDiaporamaImages === null) {
            $this->initFolderDiaporamaImages();
            $this->collFolderDiaporamaImagesPartial = true;
        }

        if (!in_array($l, $this->collFolderDiaporamaImages->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddFolderDiaporamaImage($l);
        }

        return $this;
    }

    /**
     * @param FolderDiaporamaImage $folderDiaporamaImage The folderDiaporamaImage object to add.
     */
    protected function doAddFolderDiaporamaImage($folderDiaporamaImage)
    {
        $this->collFolderDiaporamaImages[]= $folderDiaporamaImage;
        $folderDiaporamaImage->setDiaporama($this);
    }

    /**
     * @param  FolderDiaporamaImage $folderDiaporamaImage The folderDiaporamaImage object to remove.
     * @return ChildDiaporama The current object (for fluent API support)
     */
    public function removeFolderDiaporamaImage($folderDiaporamaImage)
    {
        if ($this->getFolderDiaporamaImages()->contains($folderDiaporamaImage)) {
            $this->collFolderDiaporamaImages->remove($this->collFolderDiaporamaImages->search($folderDiaporamaImage));
            if (null === $this->folderDiaporamaImagesScheduledForDeletion) {
                $this->folderDiaporamaImagesScheduledForDeletion = clone $this->collFolderDiaporamaImages;
                $this->folderDiaporamaImagesScheduledForDeletion->clear();
            }
            $this->folderDiaporamaImagesScheduledForDeletion[]= clone $folderDiaporamaImage;
            $folderDiaporamaImage->setDiaporama(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Diaporama is new, it will return
     * an empty collection; or if this Diaporama has previously
     * been saved, it will retrieve related FolderDiaporamaImages from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Diaporama.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return Collection|ChildFolderDiaporamaImage[] List of ChildFolderDiaporamaImage objects
     */
    public function getFolderDiaporamaImagesJoinFolderImage($criteria = null, $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildFolderDiaporamaImageQuery::create(null, $criteria);
        $query->joinWith('FolderImage', $joinBehavior);

        return $this->getFolderDiaporamaImages($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Diaporama is new, it will return
     * an empty collection; or if this Diaporama has previously
     * been saved, it will retrieve related FolderDiaporamaImages from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Diaporama.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return Collection|ChildFolderDiaporamaImage[] List of ChildFolderDiaporamaImage objects
     */
    public function getFolderDiaporamaImagesJoinDiaporamaImage($criteria = null, $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildFolderDiaporamaImageQuery::create(null, $criteria);
        $query->joinWith('DiaporamaImage', $joinBehavior);

        return $this->getFolderDiaporamaImages($query, $con);
    }

    /**
     * Clears out the collContentDiaporamaImages collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addContentDiaporamaImages()
     */
    public function clearContentDiaporamaImages()
    {
        $this->collContentDiaporamaImages = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collContentDiaporamaImages collection loaded partially.
     */
    public function resetPartialContentDiaporamaImages($v = true)
    {
        $this->collContentDiaporamaImagesPartial = $v;
    }

    /**
     * Initializes the collContentDiaporamaImages collection.
     *
     * By default this just sets the collContentDiaporamaImages collection to an empty array (like clearcollContentDiaporamaImages());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initContentDiaporamaImages($overrideExisting = true)
    {
        if (null !== $this->collContentDiaporamaImages && !$overrideExisting) {
            return;
        }
        $this->collContentDiaporamaImages = new ObjectCollection();
        $this->collContentDiaporamaImages->setModel('\Diaporamas\Model\ContentDiaporamaImage');
    }

    /**
     * Gets an array of ChildContentDiaporamaImage objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildDiaporama is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return Collection|ChildContentDiaporamaImage[] List of ChildContentDiaporamaImage objects
     * @throws PropelException
     */
    public function getContentDiaporamaImages($criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collContentDiaporamaImagesPartial && !$this->isNew();
        if (null === $this->collContentDiaporamaImages || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collContentDiaporamaImages) {
                // return empty collection
                $this->initContentDiaporamaImages();
            } else {
                $collContentDiaporamaImages = ChildContentDiaporamaImageQuery::create(null, $criteria)
                    ->filterByDiaporama($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collContentDiaporamaImagesPartial && count($collContentDiaporamaImages)) {
                        $this->initContentDiaporamaImages(false);

                        foreach ($collContentDiaporamaImages as $obj) {
                            if (false == $this->collContentDiaporamaImages->contains($obj)) {
                                $this->collContentDiaporamaImages->append($obj);
                            }
                        }

                        $this->collContentDiaporamaImagesPartial = true;
                    }

                    reset($collContentDiaporamaImages);

                    return $collContentDiaporamaImages;
                }

                if ($partial && $this->collContentDiaporamaImages) {
                    foreach ($this->collContentDiaporamaImages as $obj) {
                        if ($obj->isNew()) {
                            $collContentDiaporamaImages[] = $obj;
                        }
                    }
                }

                $this->collContentDiaporamaImages = $collContentDiaporamaImages;
                $this->collContentDiaporamaImagesPartial = false;
            }
        }

        return $this->collContentDiaporamaImages;
    }

    /**
     * Sets a collection of ContentDiaporamaImage objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $contentDiaporamaImages A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return   ChildDiaporama The current object (for fluent API support)
     */
    public function setContentDiaporamaImages(Collection $contentDiaporamaImages, ConnectionInterface $con = null)
    {
        $contentDiaporamaImagesToDelete = $this->getContentDiaporamaImages(new Criteria(), $con)->diff($contentDiaporamaImages);


        $this->contentDiaporamaImagesScheduledForDeletion = $contentDiaporamaImagesToDelete;

        foreach ($contentDiaporamaImagesToDelete as $contentDiaporamaImageRemoved) {
            $contentDiaporamaImageRemoved->setDiaporama(null);
        }

        $this->collContentDiaporamaImages = null;
        foreach ($contentDiaporamaImages as $contentDiaporamaImage) {
            $this->addContentDiaporamaImage($contentDiaporamaImage);
        }

        $this->collContentDiaporamaImages = $contentDiaporamaImages;
        $this->collContentDiaporamaImagesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related ContentDiaporamaImage objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related ContentDiaporamaImage objects.
     * @throws PropelException
     */
    public function countContentDiaporamaImages(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collContentDiaporamaImagesPartial && !$this->isNew();
        if (null === $this->collContentDiaporamaImages || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collContentDiaporamaImages) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getContentDiaporamaImages());
            }

            $query = ChildContentDiaporamaImageQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByDiaporama($this)
                ->count($con);
        }

        return count($this->collContentDiaporamaImages);
    }

    /**
     * Method called to associate a ChildContentDiaporamaImage object to this object
     * through the ChildContentDiaporamaImage foreign key attribute.
     *
     * @param    ChildContentDiaporamaImage $l ChildContentDiaporamaImage
     * @return   \Diaporamas\Model\Diaporama The current object (for fluent API support)
     */
    public function addContentDiaporamaImage(ChildContentDiaporamaImage $l)
    {
        if ($this->collContentDiaporamaImages === null) {
            $this->initContentDiaporamaImages();
            $this->collContentDiaporamaImagesPartial = true;
        }

        if (!in_array($l, $this->collContentDiaporamaImages->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddContentDiaporamaImage($l);
        }

        return $this;
    }

    /**
     * @param ContentDiaporamaImage $contentDiaporamaImage The contentDiaporamaImage object to add.
     */
    protected function doAddContentDiaporamaImage($contentDiaporamaImage)
    {
        $this->collContentDiaporamaImages[]= $contentDiaporamaImage;
        $contentDiaporamaImage->setDiaporama($this);
    }

    /**
     * @param  ContentDiaporamaImage $contentDiaporamaImage The contentDiaporamaImage object to remove.
     * @return ChildDiaporama The current object (for fluent API support)
     */
    public function removeContentDiaporamaImage($contentDiaporamaImage)
    {
        if ($this->getContentDiaporamaImages()->contains($contentDiaporamaImage)) {
            $this->collContentDiaporamaImages->remove($this->collContentDiaporamaImages->search($contentDiaporamaImage));
            if (null === $this->contentDiaporamaImagesScheduledForDeletion) {
                $this->contentDiaporamaImagesScheduledForDeletion = clone $this->collContentDiaporamaImages;
                $this->contentDiaporamaImagesScheduledForDeletion->clear();
            }
            $this->contentDiaporamaImagesScheduledForDeletion[]= clone $contentDiaporamaImage;
            $contentDiaporamaImage->setDiaporama(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Diaporama is new, it will return
     * an empty collection; or if this Diaporama has previously
     * been saved, it will retrieve related ContentDiaporamaImages from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Diaporama.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return Collection|ChildContentDiaporamaImage[] List of ChildContentDiaporamaImage objects
     */
    public function getContentDiaporamaImagesJoinContentImage($criteria = null, $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildContentDiaporamaImageQuery::create(null, $criteria);
        $query->joinWith('ContentImage', $joinBehavior);

        return $this->getContentDiaporamaImages($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Diaporama is new, it will return
     * an empty collection; or if this Diaporama has previously
     * been saved, it will retrieve related ContentDiaporamaImages from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Diaporama.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return Collection|ChildContentDiaporamaImage[] List of ChildContentDiaporamaImage objects
     */
    public function getContentDiaporamaImagesJoinDiaporamaImage($criteria = null, $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildContentDiaporamaImageQuery::create(null, $criteria);
        $query->joinWith('DiaporamaImage', $joinBehavior);

        return $this->getContentDiaporamaImages($query, $con);
    }

    /**
     * Clears out the collDiaporamaI18ns collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addDiaporamaI18ns()
     */
    public function clearDiaporamaI18ns()
    {
        $this->collDiaporamaI18ns = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collDiaporamaI18ns collection loaded partially.
     */
    public function resetPartialDiaporamaI18ns($v = true)
    {
        $this->collDiaporamaI18nsPartial = $v;
    }

    /**
     * Initializes the collDiaporamaI18ns collection.
     *
     * By default this just sets the collDiaporamaI18ns collection to an empty array (like clearcollDiaporamaI18ns());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initDiaporamaI18ns($overrideExisting = true)
    {
        if (null !== $this->collDiaporamaI18ns && !$overrideExisting) {
            return;
        }
        $this->collDiaporamaI18ns = new ObjectCollection();
        $this->collDiaporamaI18ns->setModel('\Diaporamas\Model\DiaporamaI18n');
    }

    /**
     * Gets an array of ChildDiaporamaI18n objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildDiaporama is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return Collection|ChildDiaporamaI18n[] List of ChildDiaporamaI18n objects
     * @throws PropelException
     */
    public function getDiaporamaI18ns($criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collDiaporamaI18nsPartial && !$this->isNew();
        if (null === $this->collDiaporamaI18ns || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collDiaporamaI18ns) {
                // return empty collection
                $this->initDiaporamaI18ns();
            } else {
                $collDiaporamaI18ns = ChildDiaporamaI18nQuery::create(null, $criteria)
                    ->filterByDiaporama($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collDiaporamaI18nsPartial && count($collDiaporamaI18ns)) {
                        $this->initDiaporamaI18ns(false);

                        foreach ($collDiaporamaI18ns as $obj) {
                            if (false == $this->collDiaporamaI18ns->contains($obj)) {
                                $this->collDiaporamaI18ns->append($obj);
                            }
                        }

                        $this->collDiaporamaI18nsPartial = true;
                    }

                    reset($collDiaporamaI18ns);

                    return $collDiaporamaI18ns;
                }

                if ($partial && $this->collDiaporamaI18ns) {
                    foreach ($this->collDiaporamaI18ns as $obj) {
                        if ($obj->isNew()) {
                            $collDiaporamaI18ns[] = $obj;
                        }
                    }
                }

                $this->collDiaporamaI18ns = $collDiaporamaI18ns;
                $this->collDiaporamaI18nsPartial = false;
            }
        }

        return $this->collDiaporamaI18ns;
    }

    /**
     * Sets a collection of DiaporamaI18n objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $diaporamaI18ns A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return   ChildDiaporama The current object (for fluent API support)
     */
    public function setDiaporamaI18ns(Collection $diaporamaI18ns, ConnectionInterface $con = null)
    {
        $diaporamaI18nsToDelete = $this->getDiaporamaI18ns(new Criteria(), $con)->diff($diaporamaI18ns);


        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->diaporamaI18nsScheduledForDeletion = clone $diaporamaI18nsToDelete;

        foreach ($diaporamaI18nsToDelete as $diaporamaI18nRemoved) {
            $diaporamaI18nRemoved->setDiaporama(null);
        }

        $this->collDiaporamaI18ns = null;
        foreach ($diaporamaI18ns as $diaporamaI18n) {
            $this->addDiaporamaI18n($diaporamaI18n);
        }

        $this->collDiaporamaI18ns = $diaporamaI18ns;
        $this->collDiaporamaI18nsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related DiaporamaI18n objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related DiaporamaI18n objects.
     * @throws PropelException
     */
    public function countDiaporamaI18ns(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collDiaporamaI18nsPartial && !$this->isNew();
        if (null === $this->collDiaporamaI18ns || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collDiaporamaI18ns) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getDiaporamaI18ns());
            }

            $query = ChildDiaporamaI18nQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByDiaporama($this)
                ->count($con);
        }

        return count($this->collDiaporamaI18ns);
    }

    /**
     * Method called to associate a ChildDiaporamaI18n object to this object
     * through the ChildDiaporamaI18n foreign key attribute.
     *
     * @param    ChildDiaporamaI18n $l ChildDiaporamaI18n
     * @return   \Diaporamas\Model\Diaporama The current object (for fluent API support)
     */
    public function addDiaporamaI18n(ChildDiaporamaI18n $l)
    {
        if ($l && $locale = $l->getLocale()) {
            $this->setLocale($locale);
            $this->currentTranslations[$locale] = $l;
        }
        if ($this->collDiaporamaI18ns === null) {
            $this->initDiaporamaI18ns();
            $this->collDiaporamaI18nsPartial = true;
        }

        if (!in_array($l, $this->collDiaporamaI18ns->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddDiaporamaI18n($l);
        }

        return $this;
    }

    /**
     * @param DiaporamaI18n $diaporamaI18n The diaporamaI18n object to add.
     */
    protected function doAddDiaporamaI18n($diaporamaI18n)
    {
        $this->collDiaporamaI18ns[]= $diaporamaI18n;
        $diaporamaI18n->setDiaporama($this);
    }

    /**
     * @param  DiaporamaI18n $diaporamaI18n The diaporamaI18n object to remove.
     * @return ChildDiaporama The current object (for fluent API support)
     */
    public function removeDiaporamaI18n($diaporamaI18n)
    {
        if ($this->getDiaporamaI18ns()->contains($diaporamaI18n)) {
            $this->collDiaporamaI18ns->remove($this->collDiaporamaI18ns->search($diaporamaI18n));
            if (null === $this->diaporamaI18nsScheduledForDeletion) {
                $this->diaporamaI18nsScheduledForDeletion = clone $this->collDiaporamaI18ns;
                $this->diaporamaI18nsScheduledForDeletion->clear();
            }
            $this->diaporamaI18nsScheduledForDeletion[]= clone $diaporamaI18n;
            $diaporamaI18n->setDiaporama(null);
        }

        return $this;
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->id = null;
        $this->shortcode = null;
        $this->descendant_class = null;
        $this->alreadyInSave = false;
        $this->clearAllReferences();
        $this->resetModified();
        $this->setNew(true);
        $this->setDeleted(false);
    }

    /**
     * Resets all references to other model objects or collections of model objects.
     *
     * This method is a user-space workaround for PHP's inability to garbage collect
     * objects with circular references (even in PHP 5.3). This is currently necessary
     * when using Propel in certain daemon or large-volume/high-memory operations.
     *
     * @param      boolean $deep Whether to also clear the references on all referrer objects.
     */
    public function clearAllReferences($deep = false)
    {
        if ($deep) {
            if ($this->collDiaporamaImages) {
                foreach ($this->collDiaporamaImages as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->singleProductDiaporama) {
                $this->singleProductDiaporama->clearAllReferences($deep);
            }
            if ($this->singleCategoryDiaporama) {
                $this->singleCategoryDiaporama->clearAllReferences($deep);
            }
            if ($this->singleBrandDiaporama) {
                $this->singleBrandDiaporama->clearAllReferences($deep);
            }
            if ($this->singleFolderDiaporama) {
                $this->singleFolderDiaporama->clearAllReferences($deep);
            }
            if ($this->singleContentDiaporama) {
                $this->singleContentDiaporama->clearAllReferences($deep);
            }
            if ($this->collProductDiaporamaImages) {
                foreach ($this->collProductDiaporamaImages as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collCategoryDiaporamaImages) {
                foreach ($this->collCategoryDiaporamaImages as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collBrandDiaporamaImages) {
                foreach ($this->collBrandDiaporamaImages as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collFolderDiaporamaImages) {
                foreach ($this->collFolderDiaporamaImages as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collContentDiaporamaImages) {
                foreach ($this->collContentDiaporamaImages as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collDiaporamaI18ns) {
                foreach ($this->collDiaporamaI18ns as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        // i18n behavior
        $this->currentLocale = 'en_US';
        $this->currentTranslations = null;

        $this->collDiaporamaImages = null;
        $this->singleProductDiaporama = null;
        $this->singleCategoryDiaporama = null;
        $this->singleBrandDiaporama = null;
        $this->singleFolderDiaporama = null;
        $this->singleContentDiaporama = null;
        $this->collProductDiaporamaImages = null;
        $this->collCategoryDiaporamaImages = null;
        $this->collBrandDiaporamaImages = null;
        $this->collFolderDiaporamaImages = null;
        $this->collContentDiaporamaImages = null;
        $this->collDiaporamaI18ns = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(DiaporamaTableMap::DEFAULT_STRING_FORMAT);
    }

    // i18n behavior

    /**
     * Sets the locale for translations
     *
     * @param     string $locale Locale to use for the translation, e.g. 'fr_FR'
     *
     * @return    ChildDiaporama The current object (for fluent API support)
     */
    public function setLocale($locale = 'en_US')
    {
        $this->currentLocale = $locale;

        return $this;
    }

    /**
     * Gets the locale for translations
     *
     * @return    string $locale Locale to use for the translation, e.g. 'fr_FR'
     */
    public function getLocale()
    {
        return $this->currentLocale;
    }

    /**
     * Returns the current translation for a given locale
     *
     * @param     string $locale Locale to use for the translation, e.g. 'fr_FR'
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return ChildDiaporamaI18n */
    public function getTranslation($locale = 'en_US', ConnectionInterface $con = null)
    {
        if (!isset($this->currentTranslations[$locale])) {
            if (null !== $this->collDiaporamaI18ns) {
                foreach ($this->collDiaporamaI18ns as $translation) {
                    if ($translation->getLocale() == $locale) {
                        $this->currentTranslations[$locale] = $translation;

                        return $translation;
                    }
                }
            }
            if ($this->isNew()) {
                $translation = new ChildDiaporamaI18n();
                $translation->setLocale($locale);
            } else {
                $translation = ChildDiaporamaI18nQuery::create()
                    ->filterByPrimaryKey(array($this->getPrimaryKey(), $locale))
                    ->findOneOrCreate($con);
                $this->currentTranslations[$locale] = $translation;
            }
            $this->addDiaporamaI18n($translation);
        }

        return $this->currentTranslations[$locale];
    }

    /**
     * Remove the translation for a given locale
     *
     * @param     string $locale Locale to use for the translation, e.g. 'fr_FR'
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return    ChildDiaporama The current object (for fluent API support)
     */
    public function removeTranslation($locale = 'en_US', ConnectionInterface $con = null)
    {
        if (!$this->isNew()) {
            ChildDiaporamaI18nQuery::create()
                ->filterByPrimaryKey(array($this->getPrimaryKey(), $locale))
                ->delete($con);
        }
        if (isset($this->currentTranslations[$locale])) {
            unset($this->currentTranslations[$locale]);
        }
        foreach ($this->collDiaporamaI18ns as $key => $translation) {
            if ($translation->getLocale() == $locale) {
                unset($this->collDiaporamaI18ns[$key]);
                break;
            }
        }

        return $this;
    }

    /**
     * Returns the current translation
     *
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return ChildDiaporamaI18n */
    public function getCurrentTranslation(ConnectionInterface $con = null)
    {
        return $this->getTranslation($this->getLocale(), $con);
    }


        /**
         * Get the [title] column value.
         *
         * @return   string
         */
        public function getTitle()
        {
        return $this->getCurrentTranslation()->getTitle();
    }


        /**
         * Set the value of [title] column.
         *
         * @param      string $v new value
         * @return   \Diaporamas\Model\DiaporamaI18n The current object (for fluent API support)
         */
        public function setTitle($v)
        {    $this->getCurrentTranslation()->setTitle($v);

        return $this;
    }

    // concrete_inheritance_parent behavior

    /**
     * Whether or not this object is the parent of a child object
     *
     * @return    bool
     */
    public function hasChildObject()
    {
        return $this->getDescendantClass() !== null;
    }

    /**
     * Get the child object of this object
     *
     * @return    mixed
     */
    public function getChildObject()
    {
        if (!$this->hasChildObject()) {
            return null;
        }
        $childObjectClass = $this->getDescendantClass();
        $childObject = PropelQuery::from($childObjectClass)->findPk($this->getPrimaryKey());

        return $childObject->hasChildObject() ? $childObject->getChildObject() : $childObject;
    }

    /**
     * Code to be run before persisting the object
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preSave(ConnectionInterface $con = null)
    {
        return true;
    }

    /**
     * Code to be run after persisting the object
     * @param ConnectionInterface $con
     */
    public function postSave(ConnectionInterface $con = null)
    {

    }

    /**
     * Code to be run before inserting to database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preInsert(ConnectionInterface $con = null)
    {
        return true;
    }

    /**
     * Code to be run after inserting to database
     * @param ConnectionInterface $con
     */
    public function postInsert(ConnectionInterface $con = null)
    {

    }

    /**
     * Code to be run before updating the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preUpdate(ConnectionInterface $con = null)
    {
        return true;
    }

    /**
     * Code to be run after updating the object in database
     * @param ConnectionInterface $con
     */
    public function postUpdate(ConnectionInterface $con = null)
    {

    }

    /**
     * Code to be run before deleting the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preDelete(ConnectionInterface $con = null)
    {
        return true;
    }

    /**
     * Code to be run after deleting the object in database
     * @param ConnectionInterface $con
     */
    public function postDelete(ConnectionInterface $con = null)
    {

    }


    /**
     * Derived method to catches calls to undefined methods.
     *
     * Provides magic import/export method support (fromXML()/toXML(), fromYAML()/toYAML(), etc.).
     * Allows to define default __call() behavior if you overwrite __call()
     *
     * @param string $name
     * @param mixed  $params
     *
     * @return array|string
     */
    public function __call($name, $params)
    {
        if (0 === strpos($name, 'get')) {
            $virtualColumn = substr($name, 3);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }

            $virtualColumn = lcfirst($virtualColumn);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }
        }

        if (0 === strpos($name, 'from')) {
            $format = substr($name, 4);

            return $this->importFrom($format, reset($params));
        }

        if (0 === strpos($name, 'to')) {
            $format = substr($name, 2);
            $includeLazyLoadColumns = isset($params[0]) ? $params[0] : true;

            return $this->exportTo($format, $includeLazyLoadColumns);
        }

        throw new BadMethodCallException(sprintf('Call to undefined method: %s.', $name));
    }

}
