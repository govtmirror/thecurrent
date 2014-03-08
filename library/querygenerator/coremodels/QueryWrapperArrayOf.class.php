<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Adapter for ArrayOf objects
 *
 * @author Dan Kottke
 */
class QueryWrapperArrayOf extends QueryElementAdapter{
    
    public function __construct(ArrayOf $value) {
        parent::__construct($value);
    }
    public function getToSQLProfileFromContext($region) {
        if($this->get_value() instanceof IOutputsToSQL)
        {
            return $this->get_value()->toSQL($region);
        }
        return false;
    }

}

?>
