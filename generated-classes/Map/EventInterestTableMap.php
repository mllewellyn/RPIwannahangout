<?php

namespace Map;

use \EventInterest;
use \EventInterestQuery;
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
 * This class defines the structure of the 'event_interest' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class EventInterestTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.EventInterestTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'RPIWannaHangOut';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'event_interest';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\EventInterest';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'EventInterest';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 3;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 3;

    /**
     * the column name for the event_interest_id field
     */
    const COL_EVENT_INTEREST_ID = 'event_interest.event_interest_id';

    /**
     * the column name for the interested_user_id field
     */
    const COL_INTERESTED_USER_ID = 'event_interest.interested_user_id';

    /**
     * the column name for the target_event_id field
     */
    const COL_TARGET_EVENT_ID = 'event_interest.target_event_id';

    /**
     * The default string format for model objects of the related table
     */
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        self::TYPE_PHPNAME       => array('EventInterestId', 'InterestedUserId', 'TargetEventId', ),
        self::TYPE_CAMELNAME     => array('eventInterestId', 'interestedUserId', 'targetEventId', ),
        self::TYPE_COLNAME       => array(EventInterestTableMap::COL_EVENT_INTEREST_ID, EventInterestTableMap::COL_INTERESTED_USER_ID, EventInterestTableMap::COL_TARGET_EVENT_ID, ),
        self::TYPE_FIELDNAME     => array('event_interest_id', 'interested_user_id', 'target_event_id', ),
        self::TYPE_NUM           => array(0, 1, 2, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('EventInterestId' => 0, 'InterestedUserId' => 1, 'TargetEventId' => 2, ),
        self::TYPE_CAMELNAME     => array('eventInterestId' => 0, 'interestedUserId' => 1, 'targetEventId' => 2, ),
        self::TYPE_COLNAME       => array(EventInterestTableMap::COL_EVENT_INTEREST_ID => 0, EventInterestTableMap::COL_INTERESTED_USER_ID => 1, EventInterestTableMap::COL_TARGET_EVENT_ID => 2, ),
        self::TYPE_FIELDNAME     => array('event_interest_id' => 0, 'interested_user_id' => 1, 'target_event_id' => 2, ),
        self::TYPE_NUM           => array(0, 1, 2, )
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
        $this->setName('event_interest');
        $this->setPhpName('EventInterest');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\EventInterest');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('event_interest_id', 'EventInterestId', 'INTEGER', true, null, null);
        $this->addForeignKey('interested_user_id', 'InterestedUserId', 'INTEGER', 'user', 'user_id', true, null, null);
        $this->addForeignKey('target_event_id', 'TargetEventId', 'INTEGER', 'event', 'event_id', true, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Interested', '\\User', RelationMap::MANY_TO_ONE, array('interested_user_id' => 'user_id', ), null, null);
        $this->addRelation('Target_Event', '\\Event', RelationMap::MANY_TO_ONE, array('target_event_id' => 'event_id', ), null, null);
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
            'validate' => array('interested_user_id_exists' => array ('column' => 'interested_user_id','validator' => 'NotNull',), 'target_event_id_exists' => array ('column' => 'target_event_id','validator' => 'NotNull',), ),
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
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return string The primary key hash of the row
     */
    public static function getPrimaryKeyHashFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        // If the PK cannot be derived from the row, return NULL.
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('EventInterestId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('EventInterestId', TableMap::TYPE_PHPNAME, $indexType)];
    }

    /**
     * Retrieves the primary key from the DB resultset row
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, an array of the primary key columns will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        return (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('EventInterestId', TableMap::TYPE_PHPNAME, $indexType)
        ];
    }

    /**
     * The class that the tableMap will make instances of.
     *
     * If $withPrefix is true, the returned path
     * uses a dot-path notation which is translated into a path
     * relative to a location on the PHP include_path.
     * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
     *
     * @param boolean $withPrefix Whether or not to return the path with the class name
     * @return string path.to.ClassName
     */
    public static function getOMClass($withPrefix = true)
    {
        return $withPrefix ? EventInterestTableMap::CLASS_DEFAULT : EventInterestTableMap::OM_CLASS;
    }

    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param array  $row       row returned by DataFetcher->fetch().
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                 One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return array           (EventInterest object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = EventInterestTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = EventInterestTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + EventInterestTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = EventInterestTableMap::OM_CLASS;
            /** @var EventInterest $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            EventInterestTableMap::addInstanceToPool($obj, $key);
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
     *                         rethrown wrapped into a PropelException.
     */
    public static function populateObjects(DataFetcherInterface $dataFetcher)
    {
        $results = array();

        // set the class once to avoid overhead in the loop
        $cls = static::getOMClass(false);
        // populate the object(s)
        while ($row = $dataFetcher->fetch()) {
            $key = EventInterestTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = EventInterestTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var EventInterest $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                EventInterestTableMap::addInstanceToPool($obj, $key);
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
     *                         rethrown wrapped into a PropelException.
     */
    public static function addSelectColumns(Criteria $criteria, $alias = null)
    {
        if (null === $alias) {
            $criteria->addSelectColumn(EventInterestTableMap::COL_EVENT_INTEREST_ID);
            $criteria->addSelectColumn(EventInterestTableMap::COL_INTERESTED_USER_ID);
            $criteria->addSelectColumn(EventInterestTableMap::COL_TARGET_EVENT_ID);
        } else {
            $criteria->addSelectColumn($alias . '.event_interest_id');
            $criteria->addSelectColumn($alias . '.interested_user_id');
            $criteria->addSelectColumn($alias . '.target_event_id');
        }
    }

    /**
     * Returns the TableMap related to this object.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function getTableMap()
    {
        return Propel::getServiceContainer()->getDatabaseMap(EventInterestTableMap::DATABASE_NAME)->getTable(EventInterestTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(EventInterestTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(EventInterestTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new EventInterestTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a EventInterest or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or EventInterest object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param  ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, ConnectionInterface $con = null)
     {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(EventInterestTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \EventInterest) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(EventInterestTableMap::DATABASE_NAME);
            $criteria->add(EventInterestTableMap::COL_EVENT_INTEREST_ID, (array) $values, Criteria::IN);
        }

        $query = EventInterestQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            EventInterestTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                EventInterestTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the event_interest table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return EventInterestQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a EventInterest or Criteria object.
     *
     * @param mixed               $criteria Criteria or EventInterest object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(EventInterestTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from EventInterest object
        }

        if ($criteria->containsKey(EventInterestTableMap::COL_EVENT_INTEREST_ID) && $criteria->keyContainsValue(EventInterestTableMap::COL_EVENT_INTEREST_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.EventInterestTableMap::COL_EVENT_INTEREST_ID.')');
        }


        // Set the correct dbName
        $query = EventInterestQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // EventInterestTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
EventInterestTableMap::buildTableMap();
