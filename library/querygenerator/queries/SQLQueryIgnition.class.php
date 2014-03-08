<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SQLQueryIgnition
 *
 * @author KottkeDP
 */
class SQLQueryIgnition  extends SQLQuery{
    
    public function __construct( 
                        $databaseType,
                        QueryElementMeta $meta = null,
                        $expressionKeys = null, 
                        $parameterKeys = null,
                        QuerySource $source = null,
                        $defaultDB = null) 
    {
        
        $e_keys = array(ValidQueryExpressions::SOURCE, ValidQueryExpressions::SOURCELIST);
        $p_keys = array(ValidQueryParameters::DEFAULT_DB, ValidQueryParameters::DATABASE_TYPE);
        
        if(!isset($meta))
        {
            $meta = new QueryElementMeta();
        }
        if(!isset($expressionKeys))
        {
            $expressionKeys = array();
        }
        if(!isset($parameterKeys))
        {
            $parameterKeys = array();
        }
        
        parent::__construct($meta, array_merge($expressionKeys, $e_keys), array_merge($parameterKeys, $p_keys) );
        
        $sourceList = new QueryArrayOfSources(array());
        $this->set_sourceList($sourceList);
        
        $this->set_defaultDB($defaultDB);
        $this->set_databaseType($databaseType);
        
        if(isset($source))
        $this->set_source($source);
        
        
    }
    
        //get/set
    //<editor-fold>
    
    public function get_defaultDB() {
        return $this->get_parameter(ValidQueryParameters::DEFAULT_DB);
    }

    protected function set_defaultDB($defaultDB = null) {
        $this->set_parameter(ValidQueryParameters::DEFAULT_DB, $defaultDB);
    }
    
    public function get_databaseType() {
        return $this->get_parameter(ValidQueryParameters::DATABASE_TYPE);
    }

    protected function set_databaseType($databaseType) {
        $this->set_parameter(ValidQueryParameters::DATABASE_TYPE, $databaseType);
    }

    public function get_source() {
        return $this->get_expression(ValidQueryExpressions::SOURCE);
    }

    protected function set_source(QuerySource $source) 
    {
        
        $oldSource = $this->get_source();
        
        if(isset($oldSource))
        {
            
            $oldSource = clone $oldSource;
            $oldAlias = $oldSource->get_alias();
            
            
             
            $this->removeSourceFromList($oldAlias);
            
            
             
        }
        
        $this->set_expression(ValidQueryExpressions::SOURCE, $source);
        $this->addSourceToList($source);
        
    }
    
    public function get_sourceList()
    {
        $list = $this->get_expression(ValidQueryExpressions::SOURCELIST);
        if(!isset($list))
        {
            throw new Exception("source list should never be null");
            //$this->set_sourceList(new QueryArrayOfSources(array()));
        }
        //var_dump($list->get_value());
        $list = new QueryArrayOfSources( $this->get_expression(ValidQueryExpressions::SOURCELIST)->get_value() );
        
        return $list;
    }

    protected function set_sourceList(QueryArrayOfSources $sourceList)
    {
        //var_dump($sourceList);
        //echo "<br/>";
        $wrapper = new QueryWrapperArrayOf($sourceList);
        
        $this->set_expression(ValidQueryExpressions::SOURCELIST, $wrapper);
        
        //$exp = $this->get_expressions();
        //foreach($exp as $key => $value)
        //var_dump($exp);
    }
    //</editor-fold>
    public function isTerminal($params = null) {
        return false;
    }
    
    protected function addSourceToList(QuerySource $source)
    {
        
        //$list = new QueryArrayOfSources($this->get_sourceList());
        $list = clone $this->get_sourceList();
        
        $list->offsetSet($source->get_alias(),$source);
        //$list[$source->get_alias()] = $source;
        $this->set_sourceList($list);
        
    }
    
    protected function removeSourceFromList($key)
    {
        //$list = new QueryArrayOfSources($this->get_sourceList());
        $list = clone $this->get_sourceList();
        
            
        if($list->offsetExists($key))
        {
            $list->offsetUnset($key);
            //unset($list[$key]);
        }
        $this->set_sourceList($list);
        
    }
    
    //analogous to FROM or INTO, etc.
    public function fromTable($tableName, $alias, $dbName = null)
    {
        if(!isset($dbName))
        {
            $dbName = $this->get_defaultDB();
        }
        if(!isset($dbName))
        {
            throw new Exception("Database not specified");
        }
        
        $tableType = "QueryTable_" . $this->get_databaseType();
        
        $table = new $tableType($tableName, $dbName);
        
        $source = new QuerySource($table, $alias);
        
        
        $this->set_source($source);
        return $this;
        
    }
    
    public function fromSelect(QuerySelect $query, $alias)
    {
        if(!isset($dbName))
        {
            $dbName = $this->get_defaultDB();
        }
        if(!isset($dbName))
        {
            throw new Exception("Database not specified");
        }
        
        $source = new QuerySource($query, $alias);
        
        
        $this->set_source($source);
        return $this;
    }
    
    public function insertSelect()
    {
        return new SQLQueryCompletion_INSERTSELECT($this);//$this->query(ValidQueryTypes::INSERT_SELECT);
    }
    public function insertValues()
    {
        return new SQLQueryCompletion_INSERTVALUE($this);//$this->query(ValidQueryTypes::INSERT_VALUE);
    }
    public function select()
    {
        
        return new SQLQueryCompletion_SELECT($this);// $this->query(ValidQueryTypes::SELECT);
    }
    public function delete()
    {
        return new SQLQueryCompletion_DELETE($this);//$this->query(ValidQueryTypes::DELETE);
    }
    public function update()
    {
        return new SQLQueryCompletion_UPDATE($this);//$this->query(ValidQueryTypes::UPDATE);
    }
    
    protected function query($queryType)
    {
        $classToMake = "SQLQueryCompletion_".$queryType;
        return new $classToMake($this);
    }
    
    public function join()
    {
        return new SQLQueryExpandingSources($this->get_databaseType(), $this->get_source(), $this->get_defaultDB());
    }
    
    public function getStandardToSQLOutput($region = ValidQueryToSQLRegions::SOURCE) {
        //$childrenToSQLProfile = new QueryToSQLProfile(ValidQueryToSQLRegions::SOURCE);
        $returnMe =  $this->get_source()->toSQL($region);
        return $returnMe;
    }

    public function getToSQLProfileFromContext($region) {
        $returnMe = new QueryToSQLProfile($region);
        
        $returnMe->set_format(ValidQueryToSQLFormats::STANDARD);
        $returnMe->set_hasParenthesis(false);
        $returnMe->set_fragment($this->getStandardToSQLOutput($region));
               
        return $returnMe;
    }

    
    
    
    
    
}

?>
