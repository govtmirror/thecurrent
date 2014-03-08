<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MySQLDataBoundValueModel
 *
 * @author KottkeDP
 */
abstract class MySQLDataBoundSimplePersistable extends SQLDataBoundSimplePersistable {

    public function __construct($sourceKeys,
                                $database = null,
                                $table = null,
                                $keyName = null,
                                $keyValue = null,
                                $isDirty = null,
                                $nonAIKey = false) {
        $connection = MySQLConfig::dsConnect();
        parent::__construct($sourceKeys, $database, $table, $keyName, $keyValue, $isDirty, $connection, $nonAIKey);
    }

    public function save()
    {
        if(!$this->get_isDirty())
        {
            $returnMe = 0;
            //nothing changed
        }
        elseif($this->get_keyValue())
        {
            //update

            $returnMe = $this->queryLogicForSet(ValidSaveActions::UPDATE);
            $this->set_isDirty(false);

        }
        else
        {
            //create
            $returnMe = $this->queryLogicForSet(ValidSaveActions::INSERT);
            $this->set_isDirty(false);
        }
        return $returnMe;

    }



    protected function queryLogicForSet($action)
    {
        $query = SQLGen::Query(ValidQueryDatabaseFormats::MYSQL, $this->get_database())->
                fromTable($this->get_table(), $this->get_table());

        switch($action)
        {
            case ValidSaveActions::INSERT :
                $query = $query->insertValues();
                break;
            case ValidSaveActions::UPDATE :
                $query = $query->update();
                break;
            default:
                throw new Exception("Improper save type for query");
                break;
        }

        foreach($this->get_sourceValues() as $key => $value)
        {
            if(($key != $this->get_keyName() || $this->get_nonAIKey()) && isset($value))
            {
                switch(gettype($value))
                {
                    case 'boolean':
                        // $query->
                        $query = $query->setNumConst($this->get_table(), $key, $value);
                        break;
                    case 'integer':
                        $query = $query->setNumConst($this->get_table(), $key, $value);
                        break;
                    case 'double':
                        $query = $query->setNumConst($this->get_table(), $key, $value);
                        break;
                    case 'string':
                        if($value === DB_NULL)
                        {
                            $query = $query->setNumConst($this->get_table(), $key, $value);
                        }
                        else
                        {
                            $query = $query->setStringConst($this->get_table(), $key, $value);
                        }

                        break;
                    case 'array':
                        throw new Exception("Invalid value passed to save() function");
                        break;
                    case 'object':
                        try
                        {
                            $query = $query->setStringConst($this->get_table(), $key, (string)$value);
                        }
                        catch(Exception $e)
                        {
                            throw new Exception("Invalid value passed to save() function");
                        }
                        break;
                    case 'resource':
                        throw new Exception("Invalid value passed to save() function");
                        break;
                    case 'NULL':
                        $query = $query->setNumConst($this->get_table(), $key, $value);
                        break;
                    default :
                        throw new Exception("Invalid value passed to save() function");
                        break;

                }

            }
            elseif(!isset($value) && $action == ValidSaveActions::INSERT)
            {
                $query = $query->setNumConst($this->get_table(), $key, DB_NULL);
            }
        }
        if($action != ValidSaveActions::INSERT)
        {
            $query = $query->where( SQLGen::referenceSourceSelection($query, $this->get_table(), $this->get_keyName()),
                    ValidSQLComparisonOperations::EQUALS,
                    $this->get_keyValue());

        }

        //echo $query;
        $ds = $this->get_connection();// MySQLConfig::dsConnect();
        $ds->query($query->toSQL());
        $ds->fetch();
        if($action == ValidSaveActions::INSERT)
        {
            $this->set_keyValue($ds->getInsertID());
        }
        return $this;
    }


    public function populateFromKey($keyValue)
    {

        $query = SQLGen::Query(ValidQueryDatabaseFormats::MYSQL, $this->get_database())->
                fromTable($this->get_table(), $this->get_table())->select()->selectStar();
        $query = $query->
                where(SQLGen::referenceSourceSelection($query, $this->get_table(), $this->get_keyName()),
                        ValidSQLComparisonOperations::EQUALS,
                        $keyValue
                        //$this->get_keyValue()
                        );


        $ds = $this->get_connection();//MySQLConfig::dsConnect();

        $ds->query($query->toSQL());

        while($row = $ds->fetch())
        {

            $this->setPersistablePropertiesFromRow($row);

        }

        return $this;
    }



    public function produceSetFromPropertyMatches($includeKey = false, array $exclusions = array(), $orderBy = array(), $limit = null)
    {
        $returnMe = array();
        $thisVal = $this->get_keyValue();
        if($includeKey && !isset($thisVal))
        {
            throw new Exception('Key is not set, cannot include key');
        }

        $query = SQLGen::Query(ValidQueryDatabaseFormats::MYSQL, $this->get_database())->
                fromTable($this->get_table(), $this->get_table())->select()->
                selectStar();
                //select($this->get_keyName(), $this->get_table());

        //$query = $query->select($this->get_keyName(), $this->get_table());

        foreach($this->get_sourceValues() as $key => $value)
        {
            if(isset($value) && !in_array($key, $exclusions))
            {
                if(/*($includeKey && isset($this->get_keyValue())) ||*/ $key != $this->get_keyName())
                {
                    $query = $query->where(SQLGen::referenceSourceSelection($query, $this->get_table(), $key),
                        ValidSQLComparisonOperations::EQUALS,
                        $value);
                }
            }
        }
        if($includeKey && isset($thisVal))
        {
            $query = $query->where(SQLGen::referenceSourceSelection($query, $this->get_table(), $this->get_keyName()),
                        ValidSQLComparisonOperations::EQUALS,
                        $this->get_keyValue());
        }

        foreach($orderBy as $colName => $secondaryParam)//$direction)
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

            $query = $query->orderBy($colName, $direction, $cast_type);
        }
        if(isset($limit))
        {
            $query = $query->limit($limit);
        }

        //echo $query;
        $ds = $this->get_connection();//MySQLConfig::dsConnect();
        $ds->query($query->toSQL());

        while($row = $ds->fetch())
        {
            $class = get_class($this);
            $addMe = new $class();
            $addMe->setPersistablePropertiesFromRow($row);

            $returnMe[] = $addMe;
        }


        return $returnMe;
    }

    protected function setPersistablePropertiesFromRow($row)
    {
        foreach($row as $key => $value)
        {
            if(ctype_digit($value))
            {
                $value = (int)$value;
            }
            if($key != $this->get_keyName())
            {
                if(!isset($value) || $value === DB_NULL)
                {
                    $this->$key = DB_NULL;
                }
                else
                {
                    $this->$key = $value;
                }
            }
            else
            {
                $this->set_keyValue($value);
            }
        }
        $this->set_isDirty(false);
        return $this;
    }

    public function isPersistableAlreadyRecorded($includeKey = false, $convertWorkingCopyToPersisted = false, array $exclusions = array())
    {

        //must enforce EXACT MATCH, not just non-null properties
        //if match, set ID afterwards. Effectively a populate, but a reverse populateByKey
        if(!$this->get_isDirty())
        {
            return $this;
        }

        foreach($this->get_sourceValues() as $key => $value)
        {
            if(!isset($value) && !in_array($key, $exclusions))
            {
                $this->$key = DB_NULL;
                //return false;
            }
        }

        $set = $this->produceSetFromPropertyMatches($includeKey, $exclusions);
        if(empty($set))
        {
            return false;
        }
        else
        {
            $match = array_pop($set);

            if($convertWorkingCopyToPersisted)
            {
                foreach($match->get_sourceKeys() as $keyName)
                {
                    $this->$keyName = $match->$keyName;
                }
                // if($includeKey)
                // {
                    $this->set_keyValue($match->get_keyValue());
                // }
                $this->set_isDirty(false);
            }


            // if($convertWorkingCopyToPersisted && !$includeKey)// && empty($exclusions))
            // {
            //     //$match = $set[0];//array_pop($set);
            //     $this->set_keyValue($match->get_keyValue());
            //     $this->set_isDirty(false);
            //     //return true;
            // }
            // elseif($convertWorkingCopyToPersisted && $includeKey)// && empty($exclusions))
            // {
            //     $this->set_isDirty(false);
            //     //return true;
            // }
            // elseif($convertWorkingCopyToPersisted)
            // {

            //     //throw new Exception('Cannot convert working copy to persisted when exclusions are passed.');
            // }
            /*
            $match = $set[0];
            if($includeKey && $match->get_keyValue() == $this->get_keyValue())
            {
                $isDirty = false;
                foreach($match as $key => $value)
                {
                    if($value != $this->$key)
                    {
                        $isDirty = true;
                    }
                }
                $this->set_isDirty($isDirty);
            }
            */

            return $match;

        }
    }

}

?>
