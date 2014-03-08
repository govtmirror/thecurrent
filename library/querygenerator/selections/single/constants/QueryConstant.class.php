<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of QueryConstant
 *
 * @author Dan Kottke
 */
abstract class QueryConstant extends QueryElementValue implements ISingleSelectValue  {
    //protected $value;
    //protected $isVerified;
    
    protected $e_keys = array();
    protected $p_keys = array(ValidQueryConstantParameters::VALUE);
    
    function __construct($value, $meta) {
        //$meta = new QuerySelectionTreeLeafMeta(array('is_tableBound' => false, 'is_star' => false));
        parent::__construct($meta, $this->e_keys, $this->p_keys);
        
        $this->set_value($value);
        
    }
    
    public function get_value() {
        return $this->get_parameter(ValidQueryConstantParameters::VALUE);
        //return $this->value;
    }

    public function set_value($value = null) {
        
        
        $this->set_parameter(ValidQueryConstantParameters::VALUE, $value);
        
    }


    public function isTerminal($params = null) {
        return true;
    }

    
    
    
    public function getReferenceKey() {
        throw new Exception("constant selections require an alias");
    }

    

    
    

    public function getToSQLProfileFromContext($region) {
        $returnMe = new QueryToSQLProfile($region);
        switch ($region)
        {
            case ValidQueryToSQLRegions::SELECTION :
                $returnMe->set_format(ValidQueryToSQLFormats::DEFINITION);
                $returnMe->set_hasParenthesis(false);
                break;
            case ValidQueryToSQLRegions::CONDITION :
                $returnMe->set_format(ValidQueryToSQLFormats::STANDARD);
                $returnMe->set_hasParenthesis(false);
                break;
            case ValidQueryToSQLRegions::HAVING :
                $returnMe->set_format(ValidQueryToSQLFormats::ALIAS);
                $returnMe->set_hasParenthesis(false);
                break;
            case ValidQueryToSQLRegions::ORDER_BY :
                $returnMe->set_format(ValidQueryToSQLFormats::ALIAS);
                $returnMe->set_hasParenthesis(false);
                break;
            case ValidQueryToSQLRegions::GROUP_BY :
                $returnMe->set_format(ValidQueryToSQLFormats::ALIAS);
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
