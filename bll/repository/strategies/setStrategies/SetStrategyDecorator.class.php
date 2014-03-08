<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PersistenceDecorator
 *
 * @author KottkeDP
 */
abstract class SetStrategyDecorator extends SetStrategy {
    protected $setStrategy;

    public function __construct($dataSource = null, SetStrategy $setStrategy = null) {
        
        if(isset($setStrategy))
        {
            $this->set_setStrategy($setStrategy); 
        }
        parent::__construct($dataSource);
    }
    
    
    public function get_setStrategy() {
        return $this->setStrategy;
    }

    public function set_setStrategy(SetStrategy $strategy) {
        $this->setStrategy = $strategy;
    }
    
    //$entity, $caller = null, $accessGroup_id = null, $args = null
    public function save(ISetParameterModel $param) {
        if($this->get_setStrategy())
        {
            $newParam = $this->get_setStrategy()->save($param);
        }
        parent::save($newParam);
    }

    
    
    
    
}

?>
