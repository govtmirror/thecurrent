<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of QuerySelectJoin
 *
 * @author KottkeDP
 */
class QueryJoin extends QueryElementValue{
    
    protected $e_keys = array(ValidQueryJoinExpressions::FOREIGN_SELECTION,
                                ValidQueryJoinExpressions::LOCAL_SELECTION,
                                ValidQueryJoinExpressions::SOURCE
                            );
    protected $p_keys = array(ValidQueryJoinParameters::JOIN_TYPE);
    
    function __construct(QuerySource $source, QuerySingleSelection $localSelection, QuerySingleSelection $foreignSelection, $joinType) {
        
        $meta = new QueryElementMeta();
        parent::__construct($meta, $this->e_keys, $this->p_keys );
        
        $this->set_source($source);
        $this->set_localSelection($localSelection);
        $this->set_foreignSelection($foreignSelection);
        $this->set_joinType($joinType);
    }
    
    public function get_source() {
        return $this->get_expression(ValidQueryJoinExpressions::SOURCE);
        
    }

    public function set_source(QuerySource $source ) {
        $this->set_expression(ValidQueryJoinExpressions::SOURCE, $source);
        
    }

    public function get_localSelection() {
        return $this->get_expression(ValidQueryJoinExpressions::LOCAL_SELECTION);
    }

    public function set_localSelection(QuerySingleSelection $localSelection ) {
        $this->set_expression(ValidQueryJoinExpressions::LOCAL_SELECTION, $localSelection);
    }

    public function get_foreignSelection() {
        return $this->get_expression(ValidQueryJoinExpressions::FOREIGN_SELECTION);
    }

    public function set_foreignSelection(QuerySingleSelection $foreignSelection ) {
        $this->set_expression(ValidQueryJoinExpressions::FOREIGN_SELECTION, $foreignSelection);
    }

    public function get_joinType() {
        return $this->get_parameter(ValidQueryJoinParameters::JOIN_TYPE);
    }

    public function set_joinType($joinType ) {
        $this->set_parameter(ValidQueryJoinParameters::JOIN_TYPE, $joinType);
    }


    public function isTerminal($params = null) {
        return false;
    }

    public function getStandardToSQLOutput($region) {
        //echo get_class($this->get_localSelection());
        //$sourceParams = new QueryToSQLProfile($region, false );
        $returnMe = " " . $this->get_joinType() . " " . $this->get_source()->toSQL($region);
        $returnMe .= $this->get_joinType() != ValidQueryJoinTypes::CROSS ? 
                " ON " . $this->get_localSelection()->toSQL($region) . " = " .$this->get_foreignSelection()->toSQL($region) 
                : 
                ""
            ;
        //echo get_class($this->get_localSelection()->get_value());
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
