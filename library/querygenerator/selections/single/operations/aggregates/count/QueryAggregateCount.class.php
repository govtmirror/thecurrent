<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of QueryAggregateCount
 *
 * @author KottkeDP
 */
class QueryAggregateCount extends QueryAggregate{
    
    //protected $column;
    //protected $isDistinct;
    protected $e_keys = array(ValidQueryAggregateCountExpressions::EXP1);
    protected $p_keys = array(ValidQueryAggregateCountParameters::DISTINCT);
    
    public function __construct(ISelectValue $selection, $isDistinct = false) {
        
        parent::__construct($this->e_keys, $this->p_keys);
        $this->set_selection($selection);
        $this->set_isDistinct($isDistinct);
    }
    
    
    
    public function get_selection() {
        return $this->get_expression(ValidQueryAggregateCountExpressions::EXP1);
        //return $this->column;
    }

    public function set_selection(ISelectValue $selection = null) {
        
        $this->set_expression(ValidQueryAggregateCountExpressions::EXP1, $selection);
    }

    public function get_isDistinct() {
        return $this->get_parameter(ValidQueryAggregateCountParameters::DISTINCT);
    }

    public function set_isDistinct($isDistinct = FALSE) {
        if(is_bool($isDistinct))
        {
            $this->set_parameter(ValidQueryAggregateCountParameters::DISTINCT, $isDistinct);
        }
        else
        {
            $this->set_parameter(ValidQueryAggregateCountParameters::DISTINCT, false);
        }
    }
    /*
    public function toSQL(QueryToSQLProfile $params) {
        
        $sourceParams = new QueryToSQLProfile($params->get_region(), false, '', ValidQueryToSQLFormats::STANDARD );
        
        $returnMe = " COUNT(".($this->get_isDistinct() ? "DISTINCT" : "" . " ").$this->get_selection()->toSQL($sourceParams).") ";
        
        $parentParams = new QueryToSQLProfile($params->get_region(), false, $returnMe);
        
        return parent::toSQL($parentParams);
        
        
        
    }
    */
    
    public function getStandardToSQLOutput($region) {
        
        //$sourceParams = new QueryToSQLProfile($params->get_region(), false );
        
        return " COUNT(".($this->get_isDistinct() ? "DISTINCT" : "") . " ".$this->get_selection()->toSQL($region).") ";
    }

    public function getToSQLProfileFromContext($region) {
        $returnMe = new QueryToSQLProfile($region);
        switch ($region)
        {
            case ValidQueryToSQLRegions::SELECTION :
                $returnMe->set_format(ValidQueryToSQLFormats::DEFINITION);
                $returnMe->set_hasParenthesis(false);
                break;
            
            case ValidQueryToSQLRegions::HAVING :
                $returnMe->set_format(ValidQueryToSQLFormats::STANDARD);
                $returnMe->set_hasParenthesis(false);
                break;
            case ValidQueryToSQLRegions::ORDER_BY :
                $returnMe->set_format(ValidQueryToSQLFormats::STANDARD);
                $returnMe->set_hasParenthesis(false);
                break;
            case ValidQueryToSQLRegions::GROUP_BY :
                $returnMe->set_format(ValidQueryToSQLFormats::STANDARD);
                $returnMe->set_hasParenthesis(false);
                break;
            case ValidQueryToSQLRegions::SET_OPERATION_EXP :
                $returnMe->set_format(ValidQueryToSQLFormats::STANDARD);
                $returnMe->set_hasParenthesis(false);
                break;
            case ValidQueryToSQLRegions::INSERTSELECT :
                $returnMe->set_format(ValidQueryToSQLFormats::ALIAS);
                $returnMe->set_hasParenthesis(false);
                break;
            
            default :
                $returnMe->set_format(ValidQueryToSQLFormats::STANDARD);
                $returnMe->set_hasParenthesis(false);
                break;
                
        }
        $returnMe->set_fragment($this->getStandardToSQLOutput($region));
        return $returnMe;
    }

    

    

    
}

?>
