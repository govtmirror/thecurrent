<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DataView
 *
 * @author Optimus
 */
class DataView {

    //ordered flow, subsequent nodes can only connect to existing nodes.
    //connections only link primary key of one to FK of other
    //can have multiple connections between same two nodes (join on and)
    //connections also contain left, inner, or right stipulation, order important
    //persistable nodes must be retrievable once generated
    //must be able to figure out FK hierarchy for save (children upward)

    //TODO: add specific keyPair model

    //output
    protected $generatedSQL;
    protected $sqlResultSet;
    protected $resultSet; //index => array(memID => template)
    //protected $transformedResultsSet;
    //input
    //protected $persistableWeb;

    protected $friendlyNames; // uniqueString => memID;

    protected $persistableInputCollection; //$memID => template
    protected $graphLinks; // index => (memID1, memID2, array(key1, key2), joinType)
    protected $exclusions;
    protected $includeKeys;

    protected $keyPairs;

    protected $connection;

    public function __construct($connection = null) {
        $this->resultSet = array();
        $this->friendlyNames = array();
        $this->persistableInputCollection = array();
        $this->graphLinks = array();
        $this->exclusions = array();
        $this->includeKeys = array();
        $this->set_connection($connection);
    }

    public function encodeGUIDForSQL($guid)
    {
        return str_replace('-', '_', $guid);
    }

    public function decodeGUIDForSQL($encodedGuid)
    {
        return str_replace('_', '-', $encodedGuid);
    }

    public function encodeColumnForSQL(DataBoundSimplePersistable $persistable, $columnName)
    {
        return $persistable->get_table()."__X__". $this->encodeGUIDForSQL($persistable->getUniqueReferenceKey()) ."__X__".$columnName;
    }

    public function decodeColumnForSQL($column)
    {
        $tripletTemp = explode('__X__', $column);
        $returnMe = array(
                            'tableName' => $tripletTemp[0],
                            'memID' => $this->decodeGUIDForSQL($tripletTemp[1]),
                            'field' => $tripletTemp[2]
            );
        return $returnMe;
    }


    public function startWeb(IPersistable $persistable,
                                $friendlyName,
                                $exclusions = array(),
                                $includeKey = false)
    {
        $newMemID = $persistable->getUniqueReferenceKey();

        $friendlyNames = $this->get_friendlyNames();
        $friendlyNames[$friendlyName] = $newMemID;
        $this->set_friendlyNames($friendlyNames);

        $persistableInputCollection = $this->get_persistableInputCollection();
        $persistableInputCollection[$newMemID] = $persistable;
        $this->set_persistableInputCollection($persistableInputCollection);

        $ex = $this->get_exclusions();
        $ex[$newMemID] = $exclusions;
        $this->set_exclusions($ex);

        $ik = $this->get_includeKeys();
        $ik[$newMemID] = $includeKey;
        $this->set_includeKeys($ik);

        return $this;
    }

    public function addToWeb(IPersistable $persistable,
                                $friendlyName,
                                $keyPairs,
                                $joinType,
                                $exclusions = array(),
                                $includeKey = false)
    {

        $this->startWeb($persistable, $friendlyName, $exclusions, $includeKey);
        $newMemID = $persistable->getUniqueReferenceKey();
        //$friendlyNames = $this->get_friendlyNames();

        $graphLink = new DataViewGraphLink($newMemID, $keyPairs, $joinType);
        $graphLinks = $this->get_graphLinks();
        $graphLinks[] = $graphLink;
        $this->set_graphLinks($graphLinks);

    }

    public function generateSQL($excludedMemIDsFromSelect = array(), $orderBy = array(), $limit = null, $condition = null)
    {
        $this->set_generatedSQL($this->translatePropertiesIntoQuery($excludedMemIDsFromSelect, $orderBy, $limit, $condition));
    }


    public function execute()
    {
        return $this->get_connection()->query($this->get_generatedSQL()->toSQL());
    }

    public function read()
    {
        //$this->execute();
        return $this->get_connection()->fetch();
    }

    public function readObjectRow($excludedMemIDsFromPopulate = array())
    {
        //$this->execute();
        if($row = $this->get_connection()->fetch())
        {
            //return $row;
            return $this->retrieveComponentsFromRow($row, $excludedMemIDsFromPopulate);
        }
        else
        {
            return false;
        }

    }



    public function generateSelectionCollection($columnName)
    {
        //$tempArr = $this->decodeColumnForSQL($columnName);
        //$tempArr['memID'];
        $returnMe = array();
        $this->execute();
        while($row = $this->read())
        {
            if(!in_array($row->$columnName, $returnMe))
            $returnMe[$row->$columnName] = $row->$columnName;
        }
        return $returnMe;

    }

    public function generateObjectCollection($memID)
    {
        $returnMe = array();
        $tempArr = array_keys($this->get_persistableInputCollection());
        $tempArr = array_combine($tempArr, $tempArr);
        unset($tempArr[$memID]);

        $this->execute();

        while($row = $this->readObjectRow($tempArr))
        {
            //var_dump($row);
            //echo $memID;
            if(!array_key_exists($row[$memID]->get_keyValue(), $returnMe))
            $returnMe[$row[$memID]->get_keyValue()] = $row[$memID];
        }
        return $returnMe;
    }

    public function generateDataRows()
    {
        $sqlResultSet = array();
        $this->execute();
        //$ds = $this->get_connection();// $firstPersistable->get_connection();//MySQLConfig::dsConnect();
        while($row = $this->read())
        {
            $sqlResultSet[] = $row;
        }
        $this->set_sqlResultSet($sqlResultSet);
        return $sqlResultSet;
        /*
        try
        {
            $ds->query($this->get_generatedSQL()->toSQL());

            while($row = $ds->fetch())
            {
                $sqlResultSet[] = $row;
                $resultSet[] = $this->retrieveComponentsFromRow($row);

            }
            $this->set_sqlResultSet($sqlResultSet);
            $this->set_resultSet($resultSet);
            //echo $query;
            return $resultSet;
        }
        catch(Exception $ex)
        {
            throw new Exception("Generate failed with query " . $this->get_generatedSQL());
        }
         *
         */
    }

    public function generateObjectRows($excludedMemIDsFromPopulate = array())
    {
        $resultSet = array();
        $this->execute();
        while($row = $this->readObjectRow($excludedMemIDsFromPopulate))
        {
            $resultSet[] = $row;
        }
        $this->set_resultSet($resultSet);
        return $resultSet;


    }
    /*
    public function generateSelectionCollectionAndDataRows($columnName)
    {

    }

    public function generateSelectionCollectionAndObjectRows($columnName, $excludedMemIDsFromPopulate = array())
    {

    }
    */
    public function generateDataAndObjectRows($excludedMemIDsFromPopulate = null)
    {
        $sqlResultSet = array();
        $resultSet = array();
        $this->execute();
        //$ds = $this->get_connection();// $firstPersistable->get_connection();//MySQLConfig::dsConnect();
        while($row = $this->read())
        {
            $sqlResultSet[] = $row;
            $resultSet[] = $this->retrieveComponentsFromRow($row);
        }
        $this->set_sqlResultSet($sqlResultSet);
        $this->set_resultSet($resultSet);
        //return $sqlResultSet;
    }
    /*
    public function generateSelectionCollectionAndDataAndObjectRows($columnName, $excludedMemIDsFromPopulate = array())
    {

    }
    */
    /*
    public function generateComplexObjectRows()
    {

    }
    */
    /*
    public function generate($excludedMemIDsFromSelect = array(), $orderBy = array(), $limit = null, $condition = null)
    {
        $this->translatePropertiesIntoQuery($excludedMemIDsFromSelect, $orderBy, $limit);
        return $this->generateResultSetFromAttachedQueryAndKeys();


    }
    */

    public function translatePropertiesIntoQuery($excludedMemIDsFromSelect = array(), $orderBy = array(), $limit = null, $condition = null)
    {
        $persistableCollection = $this->get_persistableInputCollection();
        $firstPersistable = array_shift(array_values($persistableCollection));
        $this->set_persistableInputCollection($persistableCollection);

        //$friendlyNames = clone $this->get_friendlyNames();

        //$graphLinks = clone $this->get_graphLinks();
        $exclusions = $this->get_exclusions();
        $includeKeys = $this->get_includeKeys();

        $firstMemID = $firstPersistable->getUniqueReferenceKey();

        $firstVal = $firstPersistable->get_keyValue();
        if($includeKeys[$firstMemID] && !isset($firstVal))
        {
            throw new Exception('Key is not set, cannot include key');
        }
        // TODO: allow a way to pass in source so IPersistable is proper here. This expects SQL simple persistable
        $query = SQLGen::Query(ValidQueryDatabaseFormats::MYSQL, $firstPersistable->get_database())->
                fromTable($firstPersistable->get_table(), $firstPersistable->get_table())->join();

        $arrayToWhereLater = array();


        foreach($this->get_graphLinks() as $link)
        {
            $link instanceof DataViewGraphLink;
            // var_dump($link);

            $keyPairs = $link->get_keyPairs();
            $pair = array_pop($keyPairs);
            $pair instanceof DataViewKeyPair;

            foreach($keyPairs as $wherePair)
            {
                $arrayToWhereLater[] = $wherePair;
            }
            //echo $persistableCollection[$link->get_memID1()]->get_table();
            //var_dump($persistableCollection);
            //echo $link->get_memID1();
            //$templates = $this->get_persistableInputCollection();
            //$query = $query->joinTable($joinType, $newSourceName, $newSourceAlias, $newSelectionName, $existingSourceAlias, $existingSelectionName, $newSourceDBName)
            if($pair->get_memIDOne() == $link->get_memID())
            {
                $oldMemID = $pair->get_memIDTwo();
                $newMemID = $pair->get_memIDOne();
                $oldKey = $pair->get_keyTwo();
                $newKey = $pair->get_keyOne();
            }
            else
            {
                $oldMemID = $pair->get_memIDOne();
                $newMemID = $pair->get_memIDTwo();
                $oldKey = $pair->get_keyOne();
                $newKey = $pair->get_keyTwo();
            }
            // echo $oldMemID; echo '-xxx';
            // echo $this->get_persistableInputCollection()[$oldMemID]->get_table(); echo '---';
            // echo $oldMemID; echo '-----';

            $query = $query->joinTable($link->get_joinType(),
                                        $persistableCollection[$newMemID]->get_table(),
                                        $persistableCollection[$newMemID]->get_table(),
                                        $newKey,
                                        $persistableCollection[$oldMemID]->get_table(),
                                        $oldKey,
                                        $persistableCollection[$newMemID]->get_database());
            //echo $query;
        }
        //echo $query;

        $query = $query->select();
        foreach($this->get_persistableInputCollection() as $persistable)
        {
            $persistable instanceof DataBoundSimplePersistable;
            if(!in_array($persistable->getUniqueReferenceKey(), $excludedMemIDsFromSelect))
            {
                $query = $query->select($persistable->get_keyName(), $persistable->get_table(), $this->encodeColumnForSQL($persistable, $persistable->get_keyName()));// $persistable->get_table()."__X__".  $this->encodeGUIDForSQL($persistable->getUniqueReferenceKey()) ."__X__".$persistable->get_keyName());
                foreach($persistable->get_sourceKeys() as $key)
                {
                    $query = $query->select($key, $persistable->get_table(), $this->encodeColumnForSQL($persistable, $key));// $persistable->get_table()."__X__". $this->encodeGUIDForSQL($persistable->getUniqueReferenceKey()) ."__X__".$key);
                }
            }
        }


        foreach($arrayToWhereLater as $wherePair)
        {

            $wherePair instanceof DataViewKeyPair;
            $firstConstant = new QueryFreeFormConstant($persistableCollection[$wherePair->get_memIDOne()]->get_source() .".". $wherePair->get_keyOne());
            $secondConstant = new QueryFreeFormConstant($persistableCollection[$wherePair->get_memIDTwo()]->get_source() .".". $wherePair->get_keyTwo());;
            $query = $query->where($firstConstant, ValidSQLComparisonOperations::EQUALS, $secondConstant);

        }
        foreach($this->get_persistableInputCollection() as $persistable)
        {
            foreach($persistable->get_sourceValues() as $key => $value)
            {
                if(isset($value) && !in_array($key, $exclusions[$persistable->getUniqueReferenceKey()]))
                {
                    if(/*($includeKey && isset($this->get_keyValue())) ||*/ $key != $persistable->get_keyName())
                    {
                        $query = $query->where(SQLGen::referenceSourceSelection($query, $persistable->get_table(), $key),
                            ValidSQLComparisonOperations::EQUALS,
                            $value);
                    }
                }
            }
            $thisVal = $persistable->get_keyValue();
            if(isset($thisVal))
            {
                $query = $query->where(SQLGen::referenceSourceSelection($query, $persistable->get_table(), $persistable->get_keyName()),
                            ValidSQLComparisonOperations::EQUALS,
                            $thisVal);
            }
        }
        if(isset($condition))
        {
            $query = $query->where_condition($condition, ValidSQLComparisonOperations::_AND);
        }
                //joinTable($joinType, $newSourceName, $newSourceAlias, $newSelectionName, $existingSourceAlias, $existingSelectionName, $newSourceDBName)
                //select()->selectStar();
        foreach($orderBy as $encodedColName => $secondaryParam)
        {

            if(array_key_exists('direction', $secondaryParam))
            {
                $direction = $secondaryParam['direction'];
            }
            else
            {
                $direction = null;
            }
            if(array_key_exists('cast_type', $secondaryParam))
            {
                $cast_type = $secondaryParam['cast_type'];
            }
            else
            {
                $cast_type = null;
            }
            $query = $query->orderBy($encodedColName, $direction, $cast_type);


            //$query = $query->orderBy($encodedColName, $direction);
        }
        if(isset($limit))
        {
            $query = $query->limit($limit);
        }


        $this->set_generatedSQL($query);
        $this->set_keyPairs($this->populatePairsFromLinks());
        return $query;
    }

    /*
    public function generateResultSetFromAttachedQueryAndKeys()
    {
        $resultSet = array();
        $sqlResultSet = array();
        $ds = $this->get_connection();// $firstPersistable->get_connection();//MySQLConfig::dsConnect();
        try
        {
            $ds->query($this->get_generatedSQL()->toSQL());

            while($row = $ds->fetch())
            {
                $sqlResultSet[] = $row;
                $resultSet[] = $this->retrieveComponentsFromRow($row);

            }
            $this->set_sqlResultSet($sqlResultSet);
            $this->set_resultSet($resultSet);
            //echo $query;
            return $resultSet;
        }
        catch(Exception $ex)
        {
            throw new Exception("Generate failed with query " . $this->get_generatedSQL());
        }
    }
    */
    protected function retrieveComponentsFromRow($row, $excludedMemIDsFromPopulate = array())
    {
        $persistables = $this->get_persistableInputCollection();

        $includedPersistables = array();

        foreach($row as $key => $value)
        {
            if(ctype_digit($value))
            {
                $value = (int)$value;
            }
            // else if(is_string($value))
            // {
            //     $value = addslashes($value);
            // }
            //$triplet = array();
            //$tripletTemp = explode('__X__', $key);
            $colParts = $this->decodeColumnForSQL($key);
            $tableName = $colParts['tableName'];//$tripletTemp[0];
            $memID = $colParts['memID'];//$this->decodeGUIDForSQL($tripletTemp[1]);
            $field = $colParts['field'];//$tripletTemp[2];

            if(array_key_exists($memID, $persistables) && !in_array($memID, $excludedMemIDsFromPopulate))
            {
                if(!array_key_exists($memID, $includedPersistables))
                {

                    $persistable = clone $persistables[$memID];
                    //$persistable->$field = $value;
                    if($field != $persistable->get_keyName())
                    {
                        if(!isset($value) || $value === DB_NULL)
                        {
                            $persistable->$field = DB_NULL;
                        }
                        else
                        {
                            $persistable->$field = $value;
                        }
                    }
                    else
                    {
                        $persistable->set_keyValue($value);

                    }
                    $persistable->set_isDirty(false);
                    $includedPersistables[$memID] = $persistable;

                }
                else
                {

                    $persistable = $includedPersistables[$memID];

                    if($field != $persistable->get_keyName())
                    {
                        if(!isset($value) || $value === DB_NULL)
                        {
                            $persistable->$field = DB_NULL;
                        }
                        else
                        {
                            $persistable->$field = $value;
                        }

                    }
                    else
                    {
                        $persistable->set_keyValue($value);

                    }
                    $persistable->set_isDirty(false);
                    $includedPersistables[$memID] = $persistable;

                }
            }

            //echo $persistable->get_keyValue();


        }
        return $includedPersistables;
    }

    //recursive params : result array, link pairs
    //step 1, ma

    //initializeFunction
    //-focal memID
    //
    //creates array of result arrays (eventually populated) with row for every unique focal entity
    // each row of these is passed into recursive function
    //
    //recursive function
    // -result array
    // -remaining link pairs
    public function recursiveExperiment($focalMemID, $linkPairsLeft = array(), $transformedResultSet = array())
    {
        // TODO: add recursive calls once output can be made into tree rather than flat-ish array
        $resultSet = $this->get_resultSet();
        if(!isset($resultSet))
        {
            return false;
        }

        $childMemIDs = array();
        $parentsMemIDs = array();

        foreach($linkPairsLeft as $pairKey => $pair)
        {
            $pair instanceof DataViewKeyPair;

            if($pair->getParentMemID() == $focalMemID)
            {
                $childMemIDs[$pair->getChildMemID()] = $pair->getChildMemID();
                unset($linkPairsLeft[$pairKey]);
            }
            if($pair->getChildMemID() == $focalMemID)
            {
                $parentsMemIDs[$pair->getParentMemID()] = $pair->getParentMemID();
                unset($linkPairsLeft[$pairKey]);
            }


        }

        // 1 row per focal, index is array( keyVal => array ( memID => array(keyVal => object), memID => array(keyVal => object), memID => array(keyVal => object) ) )

        $accountedForKeys = array(); //$memID => array( keyValue )

        foreach($resultSet as $arrayRow)
        {
            //reference to row of current focal object in return array
            $transformedRowKey = null;
            //find focal object (must do this first to determine row)
            foreach($arrayRow as $memID => $object)
            {
                if(!array_key_exists($memID, $accountedForKeys))
                {
                    $accountedForKeys[$memID] = array();
                }
                $object instanceof IPersistable;
                if($memID == $focalMemID  )
                {
                    $transformedRowKey = $object->get_keyValue();


                    if(!(in_array($transformedRowKey, $accountedForKeys[$memID])))
                    {
                        $transformedResultSet[$transformedRowKey] = array();
                        $transformedResultSet[$transformedRowKey][$memID] = array();
                        $transformedResultSet[$transformedRowKey][$memID][$object->get_keyValue()] = $object;
                        $accountedForKeys[$memID][] = $object->get_keyValue();
                    }

                    //see if focal object row already exists in transformedResultSet
                    //if so get that row

                }
            }
            foreach($arrayRow as $memID => $object)
            {
                $object instanceof IPersistable;

                if(in_array ($memID, $childMemIDs))
                {
                    if(!(in_array($object->get_keyValue(), $accountedForKeys[$memID])))
                    {
                        if(!array_key_exists($memID, $transformedResultSet[$transformedRowKey]))
                        {
                            $transformedResultSet[$transformedRowKey][$memID] = array();
                        }
                        $transformedResultSet[$transformedRowKey][$memID][$object->get_keyValue()] = $object; //later object here is recursive call
                        $accountedForKeys[$memID][] =  $object->get_keyValue();
                    }
                }
                elseif(in_array ($memID, $parentsMemIDs))
                {
                    if(!(in_array($object->get_keyValue(), $accountedForKeys[$memID])))
                    {
                        if(!array_key_exists($memID, $transformedResultSet[$transformedRowKey]))
                        {
                            $transformedResultSet[$transformedRowKey][$memID] = array();
                        }
                        $transformedResultSet[$transformedRowKey][$memID][$object->get_keyValue()] = $object; //later object here is recursive call
                        $accountedForKeys[$memID][] =  $object->get_keyValue();
                    }
                }

            }

        }

        return $transformedResultSet;

    }

    public function transformResultSetFriendly($friendlyName)
    {
        $friendlies = $this->get_friendlyNames();
        return $this->transformResultSet($friendlies[$friendlyName]);
    }

    public function transformResultSet($focalMemID)
    {
        /*
        $pairs = array();
        foreach($this->get_graphLinks() as $link)
        {
            foreach($link->get_keyPairs() as $pair)
            {

            }
            $pairs[] = $pair;
        }
         */
        return $this->recursiveExperiment($focalMemID, $this->get_keyPairs());


    }
    /*
    protected function getChildrenMemIDNodes($pairs)
    {
        $returnMe = array('links' => null, 'children' => null);

        foreach($pairs as $pair)
        {
            $pair instanceof DataViewKeyPair;

        }

    }

    protected function getParentMemIDNodes($pairs)
    {
        $returnMe = array('links' => null, 'parents' => null);
        foreach($pairs as $pair)
        {

        }

    }
    */


    public function populatePairsFromLinks()
    {
        $pairs = array();
        foreach($this->get_graphLinks() as $link)
        {
            foreach($link->get_keyPairs() as $pair)
            {

            }
            $pairs[] = $pair;
        }
        return $pairs;
    }

    public function get_keyPairs() {
        return $this->keyPairs;
    }

    public function set_keyPairs($keyPairs) {
        $this->keyPairs = $keyPairs;
    }

    public function getFromResult($memID, array $resultRow)
    {
        return $resultRow[$memID];
    }
    public function getFromResultFriendly($friendlyName, array $resultRow)
    {
        //$friendlies = $this->get_friendlyNames();
        return $this->getFromResult($this->getMemIDFromFriendly($friendlyName), $resultRow);
    }


    public function get_resultSet() {
        return $this->resultSet;
    }

    public function set_resultSet($resultSet) {
        $this->resultSet = $resultSet;
    }


    public function get_sqlResultSet() {
        return $this->sqlResultSet;
    }

    public function set_sqlResultSet($sqlResultSet) {
        $this->sqlResultSet = $sqlResultSet;
    }

    public function get_exclusions() {
        return $this->exclusions;
    }

    public function set_exclusions($exclusions) {
        $this->exclusions = $exclusions;
    }

    public function get_includeKeys() {
        return $this->includeKeys;
    }

    public function set_includeKeys($includeKeys) {
        $this->includeKeys = $includeKeys;
    }

    public function get_friendlyNames() {
        return $this->friendlyNames;
    }

    public function set_friendlyNames($friendlyNames) {
        $this->friendlyNames = $friendlyNames;
    }

    public function getMemIDFromFriendly($friendlyName)
    {
        $friendlies = $this->get_friendlyNames();
        return $friendlies[$friendlyName];
    }

    public function getFromPersistableInputCollection($memID)
    {
        $persistables = $this->get_persistableInputCollection();
        return $persistables[$memID];
    }
    public function getFromPersistableInputCollectionFriendly($friendlyName)
    {
        //$friendlies = $this->get_friendlyNames();
        return $this->getFromPersistableInputCollection($this->getMemIDFromFriendly($friendlyName));
    }

    public function get_persistableInputCollection() {
        return $this->persistableInputCollection;
    }

    public function set_persistableInputCollection($persistableInputCollection) {
        $this->persistableInputCollection = $persistableInputCollection;
    }

    public function get_graphLinks() {
        return $this->graphLinks;
    }

    public function set_graphLinks($graphLinks) {
        $this->graphLinks = $graphLinks;
    }

    public function get_generatedSQL() {
        return $this->generatedSQL;
    }

    public function set_generatedSQL($generatedSQL) {
        $this->generatedSQL = $generatedSQL;
    }

    public function get_connection() {
        return $this->connection;
    }

    public function set_connection($connection) {
        $this->connection = $connection;
    }



        /*
    public function save()
    {

    }
     *
     */

}

?>
