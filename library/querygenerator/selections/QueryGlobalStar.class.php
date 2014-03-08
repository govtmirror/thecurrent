<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of QueryGlobalStar
 *
 * @author Dan Kottke
 */
class QueryGlobalStar extends QueryElementValue implements IMultiSelectValue{
    
    public function __construct() {
        
        $meta = new QuerySelectionTreeLeafMeta(array('is_tableBound' => false, 'is_star' => true ));
        //$name = "*";
        //parent::__construct($meta, $expressionKeys, $parameterKeys)
        parent::__construct($meta);
    }
    
    
    public function getToSQLProfileFromContext($region) {
        
        $returnMe = new QueryToSQLProfile($region);
        $returnMe->set_format(ValidQueryToSQLFormats::STANDARD);
        $returnMe->set_hasParenthesis(false);
        $returnMe->set_fragment($this->getStandardToSQLOutput($region));
        return $returnMe;
    }
    
    public function isTerminal($params = null) {
        return true;
    }

    public function getStandardToSQLOutput($region) {
        return "*";
    }

    
    
}

?>
