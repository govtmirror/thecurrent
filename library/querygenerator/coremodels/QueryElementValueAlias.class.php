<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * This class contains QueryElementValues and augments them with an alias. It is useful mostly for top-level query elements.
 *
 * @author Dan Kottke
 */
abstract class QueryElementValueAlias extends QueryElementContainer{
    
    
    protected $alias;
    
    
    public function __construct(QueryElement $value, $alias = null) {
        
        $this->set_alias($alias);
        
        //$meta = $value->get_meta();
        parent::__construct($value);
    }
    
    
    
    public function get_alias() {
        return $this->alias;
    }

    public function set_alias($alias = null) {
        if(is_numeric($alias))
        {
            throw new Exception("alias cannot be numeric");
        }
        $this->alias = $alias;
    }
    
    
    public function getToSQLProfileFromContext($region)
    {
        $valueProfile = $this->get_value()->get_SQLProfile($region);
        $fragment = $valueProfile->get_fragment();//$this->get_value()->toSQL($region);
        
        $newFragment = "";
        if($this->get_alias())
        {
            switch ($valueProfile->get_format())
            {
                case ValidQueryToSQLFormats::ALIAS :
                    $newFragment = $this->get_alias();
                    break;
                case ValidQueryToSQLFormats::DEFINITION :
                    if($this->get_value() instanceof IOutputsToSQL)
                    {
                        $newFragment = $fragment." AS ".$this->get_alias();
                    }
                    break;
                case ValidQueryToSQLFormats::STANDARD :
                    if($this->get_value() instanceof IOutputsToSQL)
                    {
                        $newFragment = $fragment;
                    }
                default :
                    $newFragment = $fragment;
                    break;
            }
        }
        else 
        {
            $newFragment = $fragment;
        }
        
        return new QueryToSQLProfile($region, false, $newFragment);
        //$returnMe = new QueryToSQLProfile($region, $hasParenthesis, $fragment);
        
        /*
        if($this->get_value() instanceof QueryElement)
        {
            return $this->get_value()->getToSQLProfileFromContext($region, $params);
        }
         * 
         */
    }
    
    
    /*
    
    public function toSQL(QueryToSQLProfile $params) {
        
        $valueparams = $this->get_SQLProfile($params->get_region(), $params);
        
        //$returnMe = $params->get_fragment();
        if($this->get_alias())
        {
            switch ($valueparams->get_format())
            {
                case ValidQueryToSQLFormats::ALIAS :
                    $returnMe = $this->get_alias();
                    break;
                case ValidQueryToSQLFormats::DEFINITION :
                    if($this->get_value() instanceof IOutputsToSQL)
                    {
                        $returnMe = $valueparams->get_fragment()." AS ".$this->get_alias();
                    }
                    break;
                case ValidQueryToSQLFormats::STANDARD :
                    if($this->get_value() instanceof IOutputsToSQL)
                    {
                        $returnMe = $valueparams->get_fragment();
                    }
                default :
                    //$returnMe = $valueparams->get_fragment();
                    break;
            }
        }
        else 
        {
            $returnMe = $valueparams->get_fragment();
        }
        
        $params->set_fragment($returnMe);
        //$parentParams->set_hasParenthesis($params->get_hasParenthesis());
        return parent::toSQL($params);
        
    }
     * 
     */
    

}

?>
