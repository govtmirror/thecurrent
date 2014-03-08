<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of QueryConditionEquals
 *
 * @author Dan Kottke
 */
class QueryConditionComparison extends QueryNonAggregate{
    
    protected $e_keys = array(ValidQueryConditionExpressions::PRIMARY, ValidQueryConditionExpressions::SECONDARY);
    protected $p_keys = array(ValidQueryConditionParameters::OPERATION);
    
    
    
    
    public function __construct($operation, $primary, $secondary) {
        
        parent::__construct($this->e_keys, $this->p_keys);
        
        $this->set_operation($operation);
        $this->set_primary($primary);
        $this->set_secondary($secondary);
    }
    
    public function get_operation() {
        return $this->get_parameter(ValidQueryConditionParameters::OPERATION);
        //return $this->value;
    }

    public function set_operation($operation = NULL) {
        
        
        $this->set_parameter(ValidQueryConditionParameters::OPERATION, $operation);
        
    }
    
    public function get_primary() {
        return $this->get_expression(ValidQueryConditionExpressions::PRIMARY);
        //return $this->value;
    }

    public function set_primary( $primary = null) {
        if(isset($primary) && !($primary instanceof ISingleSelectValue))
        {
            if(is_string($primary))
            {
                $primary = new QueryStringConstant($primary);
            }
            elseif(is_numeric($primary))
            {
                $primary = new QueryNumericConstant($primary);
            }
            else
            {
                $primary = new QueryFreeFormConstant($primary);
            }
            
        }
        $this->set_expression(ValidQueryConditionExpressions::PRIMARY, $primary);
        
    }
    
    public function get_secondary() {
        return $this->get_expression(ValidQueryConditionExpressions::SECONDARY);
        //return $this->value;
    }

    public function set_secondary( $secondary = null) {
        if(isset($secondary) && !($secondary instanceof ISingleSelectValue))
        {
            if(is_string($secondary))
            {
                $secondary = new QueryStringConstant($secondary);
            }
            elseif(is_numeric($secondary))
            {
                $secondary = new QueryNumericConstant($secondary);
            }
            else
            {
                $secondary = new QueryFreeFormConstant($secondary);
            }
            
        }
        $this->set_expression(ValidQueryConditionExpressions::SECONDARY, $secondary);
    }
    
    
    /*
    public function toSQL(QueryToSQLProfile $params ) {
        
        $primary = get_expression(ValidQueryConditionExpressions::PRIMARY);
        $returnMe = ''; 
        if($primary instanceof QueryElementValueAlias)
        {
            
        }
        $secondary = get_expression(ValidQueryConditionExpressions::SECONDARY);
        
        
        $childParams = new QueryToSQLProfile($params->get_region(), false, '', ValidQueryToSQLFormats::ALIAS );
        $returnMe = $this->get_expression(ValidQueryConditionExpressions::PRIMARY)->toSQL() . ' ' . 
                    $this->get_parameter(ValidQueryConditionParameters::OPERATOR) .  ' ' .
                    $this->get_expression(ValidQueryConditionExpressions::SECONDARY)->toSQL();
        
        $parentParams = new QueryToSQLProfile($params->get_region(), true, $returnMe);
        
        return parent::toSQL($parentParams);
        
        
    }
    */
    public function getStandardToSQLOutput($region) {
        //$sourceParams = new QueryToSQLProfile($params->get_region(), true );
        return $this->get_primary()->toSQL($region) . " " . $this->get_operation() . " " . $this->get_secondary()->toSQL($region);
    }

    public function getToSQLProfileFromContext($region) {
        $returnMe = new QueryToSQLProfile($region);
        $returnMe->set_format(ValidQueryToSQLFormats::STANDARD);
        $returnMe->set_hasParenthesis(true);
        $returnMe->set_fragment($this->getStandardToSQLOutput($region));
        return $returnMe;
        
    }


}

?>
