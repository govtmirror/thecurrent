<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SQLQueryCompletion_SELECTUNION
 *
 * @author KottkeDP
 */
class SQLQueryCompletion_SELECTSETOPERATION extends SQLQueryCompletion_SELECT{
    
    public function __construct(SQLQueryIgnition $queryIgnition, 
                                SQLQueryCompletion_SELECT $attachedQuery = null,
                                $setOperation = null,
                                QueryArrayOfSelections $selections = null, 
                                QueryConditionComparison $condition = null, 
                                QueryArrayOfQueryOrders $orderBy = null, 
                                $limit = null, 
                                $isDistinct = null, 
                                QueryArrayOfSelections $groupBy = null, 
                                QueryConditionComparison $having = null, 
                                $into = null) {
        $meta = new QueryElementMeta();
        $e_keys = array(ValidQueryExpressions::QUERY);
        $p_keys = array();
        
        parent::__construct($queryIgnition, $meta, $p_keys, $e_keys, $selections, $condition, $orderBy, $limit, $isDistinct);
        
        if(isset($attachedQuery))
            $this->set_attachedQuery ($attachedQuery);
        
        $this->set_setOperation($setOperation);
    }
    
    public function get_attachedQuery()
    {
        return $this->get_expression(ValidQueryExpressions::QUERY);
    }
    
    protected function set_attachedQuery(SQLQueryCompletion_SELECT $attachedQuery)
    {
        $this->set_expression(ValidQueryExpressions::QUERY, $attachedQuery);
    }
    
    public function get_setOperation() {
        return $this->get_parameter(ValidQueryParameters::SET_OPERATION);
    }

    protected function set_setOperation($setOperation = null) {
        $this->set_parameter(ValidQueryParameters::SET_OPERATION, $setOperation);
    }
    
    
    public function verify($param = null) {
        
        parent::verify($param);
        //logic here later
        
    }
    
    
    public function getStandardToSQLOutput($region) {
        
        $returnMe = "( ";
        $returnMe .= $this->get_attachedQuery()->toSQL(ValidQueryToSQLRegions::FULL)." ";
        $returnMe .= ") ";
        
        switch($this->get_setOperation())
        {
            case ValidQuerySetOperations::UNION :
                $returnMe .= " UNION ";
                break;
            case ValidQuerySetOperations::UNION_ALL :
                $returnMe .= " UNION ALL ";
                break;
            case ValidQuerySetOperations::INTERSECT :
                $returnMe .= " INTERSECT ";
                break;
            case ValidQuerySetOperations::MINUS :
                $returnMe .= " MINUS ";
                break;
            case ValidQuerySetOperations::EXCEPT :
                $returnMe .= " EXCEPT ";
                break;
            default:
                $returnMe .= " UNION ";
                break;
        }
        
        
        $returnMe .= "( SELECT ";
        $returnMe .= $this->get_isDistinct() ? " DISTINCT " : "";
        
        //$childrenToSQLProfile = new QueryToSQLProfile(ValidQueryToSQLRegions::SELECTION);
        $selectionArray = $this->get_selections();
        $temparr = array();
        foreach($selectionArray as $key => $value)
        {
            $temparr[$key] = $value->toSQL(ValidQueryToSQLRegions::SELECTION);
            //$selectionArray->offsetSet($key, $value->toSQL(ValidQueryToSQLRegions::SELECTION));
            //$selectionArray[$key] = $value->toSQL(ValidQueryToSQLRegions::SELECTION);
        }
        $returnMe .= implode(",", $temparr) . " ";
        
        //$childrenToSQLProfile->set_region(ValidQueryToSQLRegions::SOURCE);
        $returnMe .= " FROM ".$this->get_ignition()->toSQL(ValidQueryToSQLRegions::SOURCE)." ";
        
        /*
        $returnMe .= " FROM " . $this->get_ignition()->get_source()->toSQL($childrenToSQLProfile) . " ";
        
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
        
        //$childrenToSQLProfile->set_region(ValidQueryToSQLRegions::GROUP_BY);
        $returnMe .= count($this->get_groupBy()) > 0 ? " GROUP BY " : "";
        //echo count($this->get_groupBy());
        $groupByArray = $this->get_groupBy();
        $temparr = array();
        foreach($groupByArray as $key => $value)
        {
            $temparr[$key] = $value->toSQL(ValidQueryToSQLRegions::GROUP_BY);
            //$groupByArray->offsetSet($key, $value->toSQL(ValidQueryToSQLRegions::GROUP_BY));
            //$groupByArray[$key] = $value->toSQL(ValidQueryToSQLRegions::GROUP_BY);
        }
        $returnMe .= implode(",", $temparr);
        
        //$childrenToSQLProfile->set_region(ValidQueryToSQLRegions::HAVING);
        $returnMe .= $this->get_having() ? " HAVING " . $this->get_having()->toSQL(ValidQueryToSQLRegions::HAVING) : "";
        
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
        
        $returnMe .= $this->get_into() ? " INTO " . $this->get_into() : "";
        
        $returnMe .= " ) ";
        
        
        return $returnMe;
    }
    
    
    
    
}

?>
