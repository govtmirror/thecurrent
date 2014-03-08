<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of QuerySourceBound
 *
 * @author Dan Kottke
 */
abstract class QuerySourceBound extends QueryElementValue  {
    
    //protected $source;
    
    protected $e_keys = array(ValidQuerySourceBoundExpressions::SOURCE);
    protected $p_keys = array(ValidQuerySourceBoundParameters::NAME);
    
    
    public function __construct(QueryElementMeta $meta, QuerySource $source, $name) {
        //$meta = new QuerySelectionTreeLeafMeta(array('is_tableBound' => true ));
        parent::__construct($meta, $this->e_keys, $this->p_keys );
        
        $this->set_source($source);
        $this->set_name($name);
        
    }
    
    public function get_source() {
        return $this->get_expression(ValidQuerySourceBoundExpressions::SOURCE);
        //return $this->source;
    }

    public function set_source(QuerySource $source = null) {
        $this->set_expression(ValidQuerySourceBoundExpressions::SOURCE, $source);
        //$this->source = $source;
        //$this->isVerified = false;
            
    }
    
    public function get_name() {
        return $this->get_parameter(ValidQuerySourceBoundParameters::NAME);
    }

    public function set_name($name = NULL) {
        $this->set_parameter(ValidQuerySourceBoundParameters::NAME, $name);
        
    }
    
    public function getReferenceKey() {
        return $this->get_name();
    }

    public function isTerminal($params = null) {
        return false;
    }
    
    public function getStandardToSQLOutput($region) {
        /*
         $sourceParams = new QueryToSQLProfile($params->get_region(), false, '', ValidQueryToSQLFormats::ALIAS );
        
        $returnMe = $this->get_source()->toSQL($sourceParams).".".$this->get_name();
         */
        //echo $this->get_source()->get_value()->toSQL(ValidQueryToSQLRegions::JOIN_ON);
        //echo get_class($this->get_source()->get_value());
        //$sourceParams = new QueryToSQLProfile(ValidQueryToSQLRegions::SELECTION, false );
        //echo get_class($this->get_source()->get_value());
        
        return $this->get_source()->toSQL(ValidQueryToSQLRegions::SELECTION).".".$this->get_name();
        
        
        
        //return $this->get_source()->get_alias().".".$this->get_name();
    }

    

    
    /*
    public function toSQL(QueryToSQLProfile $params) {
        
        $sourceParams = new QueryToSQLProfile($params->get_region(), false, '', ValidQueryToSQLFormats::ALIAS );
        
        $returnMe = $this->get_source()->toSQL($sourceParams).".".$this->get_name();
        
        $parentParams = new QueryToSQLProfile($params->get_region(), false, $returnMe);
        
        return parent::toSQL($parentParams);
        
    }
    */
    
    


}

?>
