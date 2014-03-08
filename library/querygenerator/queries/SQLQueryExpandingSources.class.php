<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SQLQueryExpandingSources
 *
 * @author KottkeDP
 */
class SQLQueryExpandingSources extends SQLQueryIgnition{
    
    public function __construct(
                                $databaseType, 
                                QuerySource $source = null, 
                                $defaultDB = null,
                                QueryArrayOfQueryJoins $joinedSources = null
                                ) {
        
        $meta = new QueryElementMeta();
        
        $e_keys = array(ValidQueryExpressions::JOINED_SOURCES);
        $p_keys = array();
        
        parent::__construct($databaseType, $meta, $e_keys, $p_keys, $source, $defaultDB);
        
        if(!isset($joinedSources))
        {
            $joinedSources = new QueryArrayOfQueryJoins(array());
        }
        foreach($joinedSources as $key => $value)
        {
            $this->addSourceToList($value->get_source());
        }
        $wrapper = new QueryWrapperArrayOf($joinedSources);
        $this->set_expression(ValidQueryExpressions::JOINED_SOURCES, $wrapper);
        
        /*
        echo '<pre>';
        
        var_dump($joinedSources);
        echo '</pre>';
        */
    }
    
    
    
    public function get_joinedSources() {
        //return $this->get_expression(ValidQueryExpressions::JOINED_SOURCES)->get_value();
        
        $list = $this->get_expression(ValidQueryExpressions::JOINED_SOURCES);
        
        if(!isset($list))
        {
            throw new Exception("join list should never be null");
            //$this->set_sourceList(new QueryArrayOfSources(array()));
        }
        //var_dump($list->get_value());
        
        $list = new QueryArrayOfQueryJoins( $this->get_expression(ValidQueryExpressions::JOINED_SOURCES)->get_value() );
        
        return $list;
        
        
        /*
        if(isset($list))
        {
            //$this->set_joinedSources(new QueryArrayOfQueryJoins(array()));
            return clone $list->get_value();
        }
        else
        {
            $this->set_joinedSources(new QueryArrayOfQueryJoins(array()));
            return $this->get_expression(ValidQueryExpressions::JOINED_SOURCES)->get_value();
        }
        */
    }

    public function clear_joinedSources()
    {
        $oldJoinSourcesWrapped = $this->get_expression(ValidQueryExpressions::JOINED_SOURCES);
        if(isset($oldJoinSourcesWrapped))
        {
            $oldJoinSources = clone $oldJoinSourcesWrapped->get_value();
            foreach($oldJoinSources as $key => $value)
            {
                $this->removeSourceFromList($key);
            }
        }
        $wrapper = new QueryWrapperArrayOf(new QueryArrayOfQueryJoins(array()));
        $this->set_expression(ValidQueryExpressions::JOINED_SOURCES, $wrapper);
        
    }
    
    protected function set_joinedSources(QueryArrayOfQueryJoins $joinedSources ) {
        
        $this->clear_joinedSources();
        /*
        echo '<pre>';
        var_dump($joinedSources);
        echo '</pre>';
         * 
         */
        
        foreach($joinedSources as $key => $value)
        {
            //echo 'this is where it"s broken';
            $this->addSourceToList($value->get_source());
            
        }
        
        //$this->set_sourceList($sources);
        $wrapper = new QueryWrapperArrayOf($joinedSources);
        $this->set_expression(ValidQueryExpressions::JOINED_SOURCES, $wrapper);
    }
    
    protected function addJoinedSource(QueryJoin $join)
    {
        
        $joins = clone $this->get_joinedSources();
        /*
        echo '<pre>';
        var_dump($this->get_sourceList());
        echo '</pre>';
        */
        
        $joins->offsetSet($join->get_source()->get_alias(), $join);
        //$joins[$join->get_source()->get_alias()] = $join;
        
        
        
        $this->set_joinedSources($joins);
        
        
    }
    
    protected function _join(
                            $joinType,
                            
                            QuerySource $newSource,
                            $newSelectionName,
            
                            $existingSourceAlias, 
                            $existingSelectionName)
    {
       
        $newCol = new QuerySourceBoundSingle($newSource, $newSelectionName);
        $newSelection = new QuerySingleSelection($newCol);
        
        
        
        $sourceList = $this->get_sourceList();
        
        $oldSource = $sourceList->offsetGet($existingSourceAlias);// $sourceList[$existingSourceAlias];
        
        $oldCol = new QuerySourceBoundSingle($oldSource, $existingSelectionName);
        
        $oldSelection = new QuerySingleSelection($oldCol);
        
        $join = new QueryJoin($newSource, $oldSelection, $newSelection, $joinType);
        
        
        
        $this->addJoinedSource($join);
        return $this;
    }
    
    public function joinTable(
                            $joinType,
                            
                            $newSourceName,
                            $newSourceAlias,
                            $newSelectionName,
            
                            $existingSourceAlias, 
                            $existingSelectionName,
                            
                            $newSourceDBName = null 
                            
                            )
    {
        if(!isset($newSourceDBName))
        {
            $newSourceDBName = $this->get_defaultDB();
        }
        if(!isset($newSourceDBName))
        {
            throw new Exception("Database not specified");
        }
        
        $tableType = "QueryTable_" . $this->get_databaseType();
       
        $table = new $tableType($newSourceName, $newSourceDBName);
        
        //$table = new QueryTable_MySQL($newSourceName, $newSourceDBName);
        $newSource = new QuerySource($table, $newSourceAlias);
        
        return $this->_join($joinType, $newSource, $newSelectionName, $existingSourceAlias, $existingSelectionName);
        
    }
    
    public function joinQuery($joinType,
                            
                            QuerySelect $newSourceQuery,
                            $newSourceAlias,
                            $newSelectionName,
            
                            $existingSourceAlias, 
                            $existingSelectionName
                            
                            )
    {
        
        $newSource = new QuerySource($newSourceQuery, $newSourceAlias);
        
        return $this->_join($joinType, $newSource, $newSelectionName, $existingSourceAlias, $existingSelectionName);
        
    }
    
    public function join()
    {
        throw new Exception('Cannot call "join" function more than once');
    }
    
    public function insertSelect()
    {
        throw new Exception("Insert queries cannot contain join statements");
    }
    public function insertValues()
    {
        throw new Exception("Insert queries cannot contain join statements");
    }
    
    
    
    
    public function getStandardToSQLOutput($region) {
        
        //$parentToSQLProfile = new QueryToSQLProfile(ValidQueryToSQLRegions::SOURCE);
        $frag = parent::getStandardToSQLOutput(ValidQueryToSQLRegions::SOURCE);
        
        //$childrenToSQLProfile = new QueryToSQLProfile(ValidQueryToSQLRegions::JOIN_ON);
        $joinArray = $this->get_joinedSources();
        $returnMe = $frag . " ";
        /*
        echo '<pre>';
        var_dump($this->get_sourceList());
        echo '</pre>';
        */
        foreach($joinArray as $key => $value)
        {
           
            $returnMe .= $value->toSQL(ValidQueryToSQLRegions::JOIN_ON); 
            //$joinArray[$key] = $value->toSQL($childrenToSQLProfile);
        }
        return $returnMe;
    }
    
}

?>
