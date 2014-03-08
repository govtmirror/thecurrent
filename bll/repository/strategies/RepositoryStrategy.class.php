<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RepositoryStrategy
 *
 * @author KottkeDP
 */
class RepositoryStrategy implements IRepositoryStrategy {
    
    //protected $dataSource;
    protected $getStrategy;
    protected $setStrategy;
    
    
    
    public function __construct(IGetStrategy $getStrategy = null, ISetStrategy $setStrategy = null) {
        
        
        if(isset($getStrategy))
        {
            $this->getStrategy = $getStrategy;
        }
        if(isset($setStrategy))
        {
            $this->setStrategy = $setStrategy;
        }
        
    }
    
        
    
    // <editor-fold desc="getters/setters">
    
    public function get_getStrategy() {
        return $this->getStrategy;
    }

    public function set_getStrategy(IGetStrategy $getStrategy) {
        $this->getStrategy = $getStrategy;
    }

    public function get_setStrategy() {
        return $this->setStrategy;
    }

    public function set_setStrategy(ISetStrategy $setStrategy) {
        $this->setStrategy = $setStrategy;
    }

    // </editor-fold>
    
   
    
    // <editor-fold desc="abstracts">
    public  function get(IGetParameterModel $param)
    {
        return $this->get_getStrategy()->get($param);
        //$this->set_filter(null);// = null;
        //$this->set_order(null);// = null;
        
    }
    //$caller = null, AccessProfile $accessProfile = null, $id = null, $args = null
    public  function getOne(IGetParameterModel $param)
    {
        return $this->get_getStrategy()->getOne( $param);
    }
    /*
    public  function getProperty($caller = null, AccessProfile $accessProfile = null, $id = null, $property = null, $args = null)
    {
        
        
        
    }
     
     */
    public  function getIDs(IGetParameterModel $param)
    {
        return $this->get_getStrategy()->getIDs($param);
        //$this->set_filter(null);
        //$this->set_order(null);
        
        
    }
    //$caller = null, $accessGroup_id = null, $args = null
    public function save(ISetParameterModel $param )
    {
        return $this->get_setStrategy()->save($param);

    }
    
    //public abstract function save(Entity $entity,$args = null);
    
    
     // </editor-fold>
    
    
    
    
    
    
    
}

?>
