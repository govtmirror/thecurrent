<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * This class represents a generic container for a QueryElementValue.
 *
 * @author Dan Kottke
 * 
 * 
 */
abstract class QueryElementContainer extends QueryElementAdapter{
    
    //restricts value to QueryElements
    public function __construct(QueryElement $value) {
        
        parent::__construct($value);
        
    }
    
    //restricts value to QueryElements
    public function set_value(QueryElement $value) {
        parent::set_value($value);
   }
   

    
    
    
    
    
}

?>
