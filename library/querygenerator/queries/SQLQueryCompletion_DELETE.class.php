<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SQLQueryCompletion_DELETE
 *
 * @author KottkeDP
 */
class SQLQueryCompletion_DELETE extends SQLQueryCompletion {
    
    
    public function __construct( 
                                SQLQueryIgnition $queryIgnition,
                                QueryArrayOfSelections $selections = null,
                                QueryConditionComparison $condition = null,
                                QueryArrayOfQueryOrders $orderBy = null, 
                                $limit = null
            
            ) {
        
        $meta = new QueryElementMeta(array());
        
        $e_keys = array();
        
        $p_keys = array();
        
        parent::__construct($queryIgnition, $meta, $e_keys, $p_keys, $selections, $condition, $orderBy, $limit);
        
        
    }
    
    
    
    public function getStandardToSQLOutput($region) {
        
        //$childrenToSQLProfile = new QueryToSQLProfile(ValidQueryToSQLRegions::SOURCE);
        
        $returnMe = "DELETE FROM " ;
        
        $returnMe .= " ".$this->get_ignition()->toSQL(ValidQueryToSQLRegions::SOURCE)." ";
        
        /*
        $returnMe = "DELETE FROM " . $this->get_ignition()->get_source()->toSQL($childrenToSQLProfile) . " ";
        
        $childrenToSQLProfile->set_region(ValidQueryToSQLRegions::JOIN_ON);
        $joinArray = $this->get_ignition()->get_joinedSources();
        foreach($joinArray as $key => $value)
        {
            $returnMe .= $value->get_source()->toSQL($childrenToSQLProfile) . " "; 
            //$joinArray[$key] = $value->toSQL($childrenToSQLProfile);
        }
        */
        //$childrenToSQLProfile->set_region(ValidQueryToSQLRegions::CONDITION);
        $returnMe .= $this->get_condition() ? " WHERE " . $this->get_condition()->toSQL(ValidQueryToSQLRegions::CONDITION) : "";
        
        //$childrenToSQLProfile->set_region(ValidQueryToSQLRegions::ORDER_BY);
        
        $returnMe .= count($this->get_orderBy()) > 0 ? " ORDER BY " : "";
        $orderByArray = $this->get_orderBy();
        $temparr = array();
        foreach($orderByArray as $key => $value)
        {
            $temparr[$key] = $value->toSQL(ValidQueryToSQLRegions::ORDER_BY);
            //$orderByArray->offsetSet($key, $value->toSQL(ValidQueryToSQLRegions::ORDER_BY));
            //$orderByArray[$key] = $value->toSQL(ValidQueryToSQLRegions::ORDER_BY);
        }
        $returnMe .= implode(",", $temparr);
        
        
        $returnMe .= $this->get_limit() ? " LIMIT " . $this->get_limit() : "";
        
        return $returnMe;
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
