<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of QueryMulticolumnSelection
 *
 * @author Dan Kottke
 */

abstract class QueryOperation extends QueryElementValue implements ISingleSelectValue {
    
    //protected $expressions;
    //protected $parameters;
    
    //protected $operation;
    
    
    
    
    public function isTerminal($params = null) {
        return false;
    }

    public function getReferenceKey() {
        throw new Exception("operation selections require an alias");
    }
    
    

    
}

/*
abstract class QueryOperation_old implements IVerifiable, IQuerySelectable, IOutputsToSQL, ITyped{
    
    
    protected $operation;
    
    //not selections
    protected $parameters;

    protected $expressions;
    
    public function __construct($operation){// , array $parameters = null) {
        $this->set_operation($operation);
        //if(!isset($parameters))
        //{
            $this->parameters = array();
        //}
        
        //$this->set_parameters($parameters);
    }

    
    
    
    public function get_operation() {
        return $this->operation;
    }

    public function set_operation($operation) {
        $this->operation = $operation;
    }

    public function get_parameters() {
        return $this->parameters;
    }

    public function get_expressions() {
        return $this->expressions;
    }

    public function set_expressions(array $expressions) {
        if($this->validateSelectionsArray($expressions))
        {
            $this->expressions = $expressions;
        }
        else
        {
            throw new Exception('Invalid expressions');
        }
    }
    
    //public function set_parameters(array $parameters) {
    //    $this->parameters = $parameters;
    //}

    public function __get($name) {
        if( array_key_exists($name, $this->get_parameters()))
        {
            return $this->parameters[$name];
            //$arr = $this->get_parameters();
            //return $arr[$name];
        }
        return false;
    }
    
    public function __set($name, $value) {
        if($this->validateSelectionsOrDeepArraysOfSelections($value))
        {
            $this->parameters[$name] = $value;
        }
        else
        {
            throw new Exception('Invalid parameter passed to query operation');
        }
        
    }
    
    protected function validateSelectionsArray(array $expressions)
    {
        foreach($expressions as $key => $value)
        {
            if(!$value instanceof IQuerySelectable)
            {
                return false;
            }
        }
        return true;
    }

    protected function validateSelectionsOrDeepArraysOfSelections($param)
    {
        if($param instanceof IQuerySelectable)
        {
            return true;
        }
        elseif(is_array($param))
        {
            
            return $this->validateSelectionsArray($param);
            
            /*
             * No need for the full recursive
             * 
            foreach($param as $key => $value)
            {
                $litmus = $this->validateSelectionsOrDeepArraysOfSelections($value);
                if(!$litmus)
                {
                    return false;
                }
            }
             * 
             */
/*
        }
        else
        {
            return false;
        }
    }
    
    
    
    
}
*/
?>
