<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of QueryElementAdapter
 *
 * @author Dan Kottke
 * 
 * 
 * This class serves as both an parent class to an adapter for non-query elements and also helps define containers for "top level" query elements.  
 * 
 */
abstract class QueryElementAdapter extends QueryElement{
    
    protected $value;
    
    public function __construct($value) {
        
        $this->set_value($value);
        
        parent::__construct();
    }
    
    public function get_value() {
        return $this->value;
    }
    
    public function set_value($value = null) {
        if(!($value instanceof IVerifiable)
            || !($value instanceof IOutputsToSQL)
            || !($value instanceof ITreeElement)
                )
        {
            throw new Exception("Object cannot be adapted into QueryElement");
        }
        $this->value = $value;
    }
    
    public function verify($param = null) {
        if($this->get_value() instanceof IVerifiable)
        {
            return $this->get_value()->verify($param);            
        }
        return false;
    }
    
    public function get_isVerified() {
        if($this->get_value() instanceof IVerifiable)
        {
            return $this->get_value()->get_isVerified();        
        }
        return false;
    }
    
    public function get_verificationErrors() {
        if($this->get_value() instanceof IVerifiable)
        {
            return $this->get_value()->get_verificationErrors();            
        }
        return false;
    }


    public function get_children($params = null) 
    {
        if($this->get_value() instanceof ITreeElement)
        {
            return $this->get_value()->get_children($params);            
        }
        return false;
    }
    
    public function isTerminal($params = null) 
    {
        if($this->get_value() instanceof ITreeElement)
        {
            return $this->get_value()->isTerminal($params);            
        }
        return false;
    }
    
    
    
    
    
}

?>
