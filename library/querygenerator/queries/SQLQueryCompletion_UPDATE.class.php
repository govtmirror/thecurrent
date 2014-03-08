<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SQLQueryCompletion_UPDATE
 *
 * @author KottkeDP
 */
class SQLQueryCompletion_UPDATE  extends SQLQueryCompletion {
    
    
    public function __construct( 
                                SQLQueryIgnition $queryIgnition,
                                QueryArrayOfSelections $selections = null,
                                QueryArrayOfSelections $values = null,
                                QueryConditionComparison $condition = null,
                                QueryArrayOfQueryOrders $orderBy = null, 
                                $limit = null
            
            ) {
        
        $meta = new QueryElementMeta(array());
        
        $e_keys = array(ValidQueryExpressions::VALUES);
        
        $p_keys = array();
        
        parent::__construct($queryIgnition, $meta, $e_keys, $p_keys, $selections, $condition, $orderBy, $limit);
        
        if(!isset($values))
        {
            $values = new QueryArrayOfSelections(array());
        }
        $this->set_values($values);
        
    }
    
    public function get_values() {
        
        $list = $this->get_expression(ValidQueryExpressions::VALUES);
        
        if(!isset($list))
        {
            throw new Exception("values should never be null");
        }
        $list = new QueryArrayOfSelections( $this->get_expression(ValidQueryExpressions::VALUES)->get_value() );
        
        return $list;
        
        
        //return $this->get_expression(ValidQueryExpressions::VALUES);
    }

    protected function set_values(QueryArrayOfSelections $values = null) {
        $wrapper = new QueryWrapperArrayOf($values);
        $this->set_expression(ValidQueryExpressions::VALUES, $wrapper);
        
        //$this->set_expression(ValidQueryExpressions::VALUES, $values);
    }
    
    public function clearValues()
    {
        $this->set_values(new QueryArrayOfSelections(array()));
        return $this;
    }
    
    public function clearAll() {
        return parent::clearAll()->clearValues();
    }
    
    protected function addValue(QuerySingleSelection $value)
    {
        $sel = clone $this->get_values();
        $sel->offsetSet($value->getReferenceKey(), $value);
        $this->set_values($sel);
    }
    
    public function setNumConst($sourceAlias, $selectionName, $value)
    {
        return $this->_setConst($sourceAlias, $selectionName, $value, ValidQueryLiteralTypes::NUM);
        
    }
    
    public function setStringConst($sourceAlias, $selectionName, $value)
    {
        return $this->_setConst($sourceAlias, $selectionName, $value, ValidQueryLiteralTypes::STRING);
    }
    
    public function setToSelection($sourceAlias, $selectionName, $valueSourceAlias, $valueSelectionName)
    {
        $sourceList = $this->get_ignition()->get_sourceList();
        if(!$sourceList->offsetExists($valueSourceAlias))
        {
            throw new Exception("Must select from a loaded source");
        }
        $source = $sourceList->offsetGet($valueSourceAlias);
        $selection = new QuerySourceBoundSingle($source, $valueSelectionName);
        //$selection = new QuerySingleSelection($selectionVal);
        
        return $this->_setBySelectionName($sourceAlias, $selectionName, $selection);
    }
    
    protected function _setBySelectionName($sourceAlias, $selectionName, ISingleSelectValue $value)
    {
        $sourceList = $this->get_ignition()->get_sourceList();
        if(!$sourceList->offsetExists($sourceAlias))
        {
            throw new Exception("Must select from a loaded source");
        }
        $source = $sourceList->offsetGet($sourceAlias);
        
        $selectionVal = new QuerySourceBoundSingle($source, $selectionName);
        $selection = new QuerySingleSelection($selectionVal);
        
        return $this->_set( $selection , $value);
    }
    
    protected function _set(QuerySingleSelection $selection, ISingleSelectValue $value)
    {
        $this->addSelection($selection);
        $valueSel = new QuerySingleSelection($value, $selection->getReferenceKey());
        $this->addValue($valueSel);
        return $this;
    }
    
    protected function _setConst($sourceAlias, $selectionName, $value, $dataType)
    {
        
        switch($dataType)
        {
            case ValidQueryLiteralTypes::STRING :
                $constVal = new QueryStringConstant($value);
                break;
            case ValidQueryLiteralTypes::NUM :
                $constVal = new QueryNumericConstant($value);
                break;
            default:
                $constVal = new QueryFreeFormConstant($value);
                break;
        }
        
        //$const = new QuerySingleSelection($constVal);
        
        return $this->_setBySelectionName($sourceAlias, $selectionName, $constVal);
        //return $this->_set( $selection , $const);
    }
    
    public function getStandardToSQLOutput($region) {
        //$childrenToSQLProfile = new QueryToSQLProfile(ValidQueryToSQLRegions::SOURCE);
        $returnMe = "UPDATE ";
        $returnMe .= " ".$this->get_ignition()->toSQL(ValidQueryToSQLRegions::SOURCE)." ";
        /*
        $returnMe = "UPDATE " . $this->get_source()->toSQL($childrenToSQLProfile) . " ";
        
        $childrenToSQLProfile->set_region(ValidQueryToSQLRegions::JOIN_ON);
        $joinArray = $this->get_joinedSources();
        foreach($joinArray as $key => $value)
        {
            $returnMe .= $value->get_source()->toSQL($childrenToSQLProfile) . " "; 
            //$joinArray[$key] = $value->toSQL($childrenToSQLProfile);
        }
        */
        
        $returnMe .= $this->get_selections() ? " SET " : "";
        
        $selectionArray = $this->get_selections();
        $valuesArray = $this->get_values();
        //$childrenToSQLProfile->set_region(ValidQueryToSQLRegions::COLUMN_SETTING);
        
        $temparr = array();
        foreach($selectionArray as $key => $value)
        {
            $temparr[$key] = $value->toSQL(ValidQueryToSQLRegions::SET_OPERATION_EXP). 
                                    " = " . 
                                    $valuesArray[$key]->toSQL(ValidQueryToSQLRegions::SET_OPERATION_EXP);
        }
        $returnMe .= implode(",", $temparr) . " ";
        
        
        
        //$childrenToSQLProfile->set_region(ValidQueryToSQLRegions::CONDITION);
        $returnMe .= $this->get_condition() ? " WHERE " . $this->get_condition()->toSQL(ValidQueryToSQLRegions::CONDITION) : "";
        
        //$childrenToSQLProfile->set_region(ValidQueryToSQLRegions::ORDER_BY);
        $returnMe .= count($this->get_orderBy()) > 0 ? " ORDER BY " : "";
        $orderByArray = $this->get_orderBy();
        $temparr = array();
        foreach($orderByArray as $key => $value)
        {
            $temparr[$key] = $value->toSQL(ValidQueryToSQLRegions::ORDER_BY);
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
