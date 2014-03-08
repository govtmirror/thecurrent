<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * The meat-and-potatoes class for all meaningful query content. 
 * Expressions represent Query Element children that may be verified and rendered recursively.
 * Parameters represent non-Query Element options that affect the output of the object
 * Meta represents a composed collection of metadata for the class to provide a common interface for flagging elements while traversing the tree
 * 
 *
 * @author Dan Kottke
 */
 abstract class QueryElementValue  extends QueryElement{
    protected $meta;
    protected $isVerified;
    protected $verificationErrors;
    
    protected $expressions;
    protected $parameters;
    
    protected $expressionKeys;
    protected $parameterKeys;


    public function __construct(QueryElementMeta $meta = null,  $expressionKeys = array(),  $parameterKeys = array()) {
        
        
        $this->set_meta($meta);
        
        $this->expressionKeys = $expressionKeys;
        $this->parameterKeys = $parameterKeys;
        
        
        
        
        $this->isVerified = false;
        $this->verificationErrors = array();
        
        parent::__construct();
    }
    public function get_isVerified() {
        return $this->isVerified;
    }
    
    
    public function get_expressionKeys() {
        return $this->expressionKeys;
    }

    

    public function get_parameterKeys() {
        return $this->parameterKeys;
    }

    

        
    public function get_meta() {
        return $this->meta;
    }

    public function set_meta(QueryElementMeta $meta = null) {
        if(!isset($meta))
        {
            $meta = new QueryElementMeta();
        }
        $this->meta = $meta;
        $this->isVerified = false;
    }
    
    public function get_expressions() {
        return $this->expressions;
    }

    public function set_expressions(QueryArrayOfQueryElements $expressions = null) {
        foreach($expressions as $key => $value)
        {
            if(!in_array($key, $this->get_expressionKeys()))
            {
                throw new Exception('Invalid expression');
                
            }
        }
        $this->expressions = $expressions;
        $this->isVerified = false;
    }

    public function get_parameters() {
        return $this->parameters;
    }

    public function set_parameters(array $parameters = array()) {
        foreach($parameters as $key => $value)
        {
            if(!in_array($key, $this->get_parameterKeys()))
            {
                throw new Exception('Invalid parameter');
                
            }
        }
        $this->parameters = $parameters;
        $this->isVerified = false;
    }
    
    public function set_expression($key, QueryElement $param = NULL)
    {
        
        
        if(!in_array($key, $this->get_expressionKeys()))
            {
                throw new Exception('Invalid expression');
                
            }
        $this->expressions[$key] = $param;
        $this->isVerified = false;
    }

    public function set_parameter($key, $param = null)
    {
         
        if(!in_array($key, $this->get_parameterKeys()))
            {
                throw new Exception('Invalid parameter');
                
            }
        $this->parameters[$key] = $param;
        $this->isVerified = false;
    }
    
    public function get_expression($key) {
        if(array_key_exists($key, $this->expressions))
        {
            return $this->expressions[$key];
        }
        else
        {
            return null;
        }
        
    }

    

    public function get_parameter($key) {
        if(array_key_exists($key, $this->parameters))
        {
            return $this->parameters[$key];
        }
        else
        {
            return null;
        }
        
    }
    
    
    
    public function removeExpression($key)
    {
        if(array_key_exists($key, $this->expressions))
        {
            unset($this->expressions[$key]);
            $this->isVerified = false;
        }
        else
        {
            return null;
        }
        
    }

    public function removeParameter($key)
    {
        if(array_key_exists($key, $this->parameters))
        {
            unset($this->parameters[$key]);
            $this->isVerified = false;
        }
        else
        {
            return null;
        }
        
    }
    
    
    public function clearExpressions()
    {
        $this->expressions = new QueryArrayOfQueryElements();
        $this->isVerified = false;
    }

    public function clearParameters()
    {
        $this->parameters = array();
        $this->isVerified = false;
    }

    public function get_verificationErrors() {
        return $this->verificationErrors;
    }

    
    public function writeVerificationError($value, $message = null)
    {
        $writeMe = "Verification failed with message: ". $message;
        $writeMe .= "\r\n";
        $writeMe .= "On object: " . var_export($value, true);
        $writeMe .= "\r\n";
        $this->verificationErrors[] = $writeMe;
    }
    
    public function verify($param = null) {
        foreach($this->get_children($param) as $key => $value)
        {
            if(!$value->verify($param))
            {
                $this->isVerified = false;
                //$this->writeVerificationError($value);
                return 0;
            }
        }
        $this->isVerified =  true;
        //return $this->isVerified;
    }
    
    

    public function get_children($params = null) {
        $children = array();
        foreach($this->get_expressions() as $key => $value)
        {
            $children[$key] = $value;
        }
        
        return $children;
        
        
    }

    
    public function __get($name) {
        if(array_key_exists($name, $this->meta))
        {
            return $this->meta[$name];
        }
        else
        {
            return null;
        }
        
    }
    
    public function __set($name, $value) {
        
        $this->meta->$name = $value;
        $this->isVerified = false;
        
    }
    

    /*
    public function toSQL($region) {
        
        $parentParams = new QueryToSQLProfile($params->get_region(), $params->get_hasParenthesis(), $this->getStandardToSQLOutput($params));
        
        return parent::toSQL($parentParams);
    }
    */
    
    public abstract function getStandardToSQLOutput($region);
    
    //public abstract function getToSQLProfileFromContext($region, QueryToSQLProfile $params = null);
    
    

    //public abstract function getQueryToSQLProfile(QueryToSQLProfile $referenceProfile);
    
    
    
    
}

?>
