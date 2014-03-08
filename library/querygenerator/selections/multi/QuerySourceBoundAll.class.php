<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of QueryStarColumn
 *
 * @author KottkeDP
 */
class QuerySourceBoundAll extends QuerySourceBound implements IMultiSelectValue{
    
    public function __construct(QuerySource $source) {
        
        $meta = new QuerySelectionTreeLeafMeta(array('is_tableBound' => true, 'is_star' => true ));
        $name = "*";
        parent::__construct($meta, $source, $name);
    }
    
    
    public function getToSQLProfileFromContext($region) {
        
        $returnMe = new QueryToSQLProfile($region);
        $returnMe->set_format(ValidQueryToSQLFormats::STANDARD);
        $returnMe->set_hasParenthesis(false);
        $returnMe->set_fragment($this->getStandardToSQLOutput($region));
        return $returnMe;
    }
    
    
}

?>
