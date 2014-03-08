<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AnonymousValueModel
 *
 * @author KottkeDP
 */
class AnonymousValueModel implements IValueModel{
    protected $sourceKeys;
    protected $sourceValues;           
    
    public function __construct($sourceKeys) {
        
        $values = array();
        foreach($sourceKeys as $key)
        {
            $values[$key] = null;
        }
        
        $this->set_sourceKeys($sourceKeys);
        $this->set_sourceValues($values);
        
    }
    
    public function __get($name) 
    {
        if(array_key_exists($name, $this->sourceKeys))
        {
            return $this->sourceValues[$name];
        }
        else
        {
            throw new Exception('Accessed non-existent property');
        }        
    }
    
    public function __set($name, $value) 
    {
        if(array_key_exists($name, $this->sourceKeys))
        {
            $this->sourceValues[$name] = $value;
        }
        else
        {
            echo $name;
            throw new Exception('Accessed non-existent property');
        }        
    }
    
    public function get_sourceKeys() {
        return $this->sourceKeys;
    }

    public function set_sourceKeys($sourceKeys) {
        $this->sourceKeys = $sourceKeys;
    }

    public function get_sourceValues() {
        return $this->sourceValues;
    }

    public function set_sourceValues($sourceValues) {
        $this->sourceValues = $sourceValues;
    }


    
}

?>
