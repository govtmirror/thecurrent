<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FeedStrategy
 *
 * @author KottkeDP
 */
abstract class FeedStrategy {
    //protected $modelType;
    protected $model;
    
    public function __construct(TC_Source $model)//, $modelType) 
    {
        $this->model = $model;
        
    } 
   
    
    public function getModel()
    {
        
        if(isset($this->model) && $this->model instanceof TC_Source)
        {
            return $this->model;
        }
        else 
        {
            return false;
        }
    }
    
    
    public abstract function generateFeed($args = null);
    
}

?>
