<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * This is the parent class of all things involved in queries.
 *
 * @author KottkeDP
 */
abstract class QueryElement implements  IVerifiable, IOutputsToSQL, ITreeElement{
    
    //protected $SQLProfile;
    
    public function __construct() {
        
    }
    
    //returns a SQL string representation of the element. This class will execute last in the call and render optional enclosing parenthesis.
    public function toSQL($region = null) 
    {
        
        
        if(!isset($region))
        {
            $region = ValidQueryToSQLRegions::FULL;
        }
        
        $profile = $this->get_SQLProfile($region);
        if( $profile->get_hasParenthesis() )
        {
            return '(' . $profile->get_fragment() . ')';
        }
        else
        {
            return $profile->get_fragment();
        }
        
    }
    
    //convenient way of calling toSQL. May restrict toSQL visibility later and rely solely on this.
    public function __toString() 
    {
        return $this->toSQL();
    }
    
    public function get_SQLProfile($region) {
        //if(!isset($this->SQLProfile))
        //{
        return    $this->getToSQLProfileFromContext($region);
        //}
        //echo " $$ " . get_class($this) . "/" . $region . "/" . $this->SQLProfile->get_format() ." %% ";
        
        //return $this->SQLProfile;
    }
    
    //given a specific context within a SQL query, returns a SQL Profile with properties defining options for how the element should be rendered.    
    public abstract function getToSQLProfileFromContext($region);
    
    
}

?>
