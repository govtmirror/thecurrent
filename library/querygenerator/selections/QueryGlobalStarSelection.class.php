<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of QueryGlobalStarSelection
 *
 * @author Dan Kottke
 */
class QueryGlobalStarSelection extends QueryElementContainer implements ISelectable{
    
    
    public function __construct() {
        
        $value = new QueryGlobalStar();
        parent::__construct($value);
    }
    
    public function set_value(QueryGlobalStar $value = null) {
        
        
        
        if(isset($value) && !$value instanceof QueryGlobalStar)
        {
            throw new Exception('Value must be type '.get_class("QueryGlobalStar"));
        }
        parent::set_value($value);
    }
    
    public function getToSQLProfileFromContext($region) {
        
        $returnMe = new QueryToSQLProfile($region);
        $returnMe->set_format(ValidQueryToSQLFormats::STANDARD);
        $returnMe->set_hasParenthesis(false);
        $returnMe->set_fragment($this->get_value()->toSQL($region));
        return $returnMe;
    }

}

?>
