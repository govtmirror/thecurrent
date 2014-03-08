<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of QueryMultiSelection
 *
 * @author Dan Kottke
 */
class QueryMultiSelection extends QueryElementContainer implements ISelectable{
    
    public function __construct(QuerySource $source) {
        
        $value = new QuerySourceBoundAll($source);
        parent::__construct($value);
    }
    
    public function set_value(IMultiSelectValue $value = null) {
        
        
        
        if(isset($value) && !$value instanceof IMultiSelectValue)
        {
            throw new Exception('Value must be type '.get_class("IMultiSelectValue"));
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
