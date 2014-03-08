<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SQLQueryCompletionSelect
 *
 * @author KottkeDP
 */
class SQLQueryCompletion_SELECT extends SQLQueryCompletion implements ISingleSourceValue, ISelectionInventory{
    public function __construct( 
                                SQLQueryIgnition $queryIgnition,
                                QueryElementMeta $meta = null,
                                array $expressionKeys = array(), 
                                array $parameterKeys = array(),
                                QueryArrayOfSelections $selections = null,
                                QueryConditionComparison $condition = null,
                                QueryArrayOfQueryOrders $orderBy = null, 
                                $limit = null,
                                $isDistinct = null, 
                                QueryArrayOfSelections $groupBy = null,
                                QueryConditionComparison $having = null,
                                $into = null
            ) 
        {
            
        if(!isset($meta))
        $meta = new QueryElementMeta();

        $e_keys = array(ValidQueryExpressions::GROUP_BY,
                    ValidQueryExpressions::HAVING
        );
        
        $p_keys = array(ValidQueryParameters::INTO,
                        ValidQueryParameters::IS_DISTINCT);
        
        parent::__construct($queryIgnition, $meta, array_merge($expressionKeys, $e_keys), array_merge($parameterKeys, $p_keys), $selections, $condition, $orderBy, $limit);
        
        $this->set_isDistinct($isDistinct);
        $this->set_into($into);
        
        if(!isset($groupBy))
        {
            $groupBy = new QueryArrayOfSelections(array());
        }
        $this->set_groupBy($groupBy);
        
        if(isset($having))
        $this->set_having($having);
        
    }
    
    public function get_isDistinct() {
        return $this->get_parameter(ValidQueryParameters::IS_DISTINCT);
    }

    protected function set_isDistinct($isDistinct = false) {
        $this->set_parameter(ValidQueryParameters::IS_DISTINCT, $isDistinct);
    }
    
    
    
    public function get_groupBy() {
        
        $list = $this->get_expression(ValidQueryExpressions::GROUP_BY);
        
        if(!isset($list))
        {
            throw new Exception("group by should never be null");
        }
        $list = new QueryArrayOfSelections( $this->get_expression(ValidQueryExpressions::GROUP_BY)->get_value() );
        
        return $list;
        
    }

    protected function set_groupBy(QueryArrayOfSelections $groupBy ) {
        $wrapper = new QueryWrapperArrayOf($groupBy);
        $this->set_expression(ValidQueryExpressions::GROUP_BY, $wrapper); 
        
        //$this->set_expression(ValidQueryExpressions::GROUP_BY, $groupBy);
    }

    public function get_having() {
        return $this->get_expression(ValidQueryExpressions::HAVING);
    }

    protected function set_having(QueryConditionComparison $having ) {
        $this->set_expression(ValidQueryExpressions::HAVING, $having);
    }

    public function get_into() {
        return $this->get_parameter(ValidQueryParameters::INTO);
    }

    protected function set_into($into = null) {
        $this->set_parameter(ValidQueryParameters::INTO, $into);
    }
    
    public function clearHaving()
    {
        $this->set_having(null);
        return $this;
    }
    
    public function clearIsDistinct()
    {
        $this->set_isDistinct();
        return $this;
    }
    
    public function clearGroupBy()
    {
        $this->set_groupBy(new QueryArrayOfSelections(array()));
        return $this;
    }
    
    public function clearInto()
    {
        $this->set_into(null);
        return $this;
    }
    
    public function clearAll() {
        
        return parent::clearAll()->clearIsDistinct()->clearHaving()->clearGroupBy()->clearInto();
    }
    
    
    
    public function get_inventory($param = null) {
        return $this->get_selections();
    }
    
    public function batchSelect(QueryArrayOfSelections $selections)
    {
        foreach ($selections as $key => $value) 
        {
            if($value instanceof QuerySingleSelection)
            {
                $this->addSelection($value);
            }
            else if($value instanceof QueryMultiSelection)
            {
                $this->addStarSelection($value);
            }
            else if($value instanceof QueryGlobalStarSelection)
            {
                $this->addGlobalStarSelection($value);
            }
            else
            {
                throw new Exception("batch select failed");
            }
            
        }
        return $this;
    }
    
    protected function addStarSelection(QueryMultiSelection $selection)
    {
        
        
        $sel = clone $this->get_selections();
        $sel[] = $selection;
        $this->set_selections($sel);
    }
    
    protected function addGlobalStarSelection(QueryGlobalStarSelection $selection)
    {
        $sel = clone $this->get_selections();
        $sel[] = $selection;
        $this->set_selections($sel);
    }
    
    public function selectStar()
    {
        $selection = new QueryGlobalStarSelection();
        $this->addGlobalStarSelection($selection);
        return $this;
    }
    
    public function selectSourceStar($sourceAlias)
    {
        
        $sourceList = clone $this->get_ignition()->get_sourceList();
        
        if(!$sourceList->offsetExists($sourceAlias))
        {
            Throw new Exception("source key is unrecognized in star selection ".$sourceAlias);
        }
        
        $source = $sourceList->offsetGet($sourceAlias);;
        //$col = new QuerySourceBoundAll($source);
        
        
        $selection = new QueryMultiSelection($source);
        
        
        $this->addStarSelection($selection);
        
        return $this;
        
    }
    
    public function selectFreeForm($value, $alias = null)
    {
        $col = new QueryFreeFormConstant($value);
        $selection = new QuerySingleSelection($col, $alias);
        
        $this->addSelection($selection);
        return $this;
    }
    
    protected function selectOperation(QueryOperation $operation, $alias)
    {
        
        $selection = new QuerySingleSelection($operation, $alias);
        $this->addSelection($selection);
        return $this;
    }
    
    public function selectCountStar($alias, $isDistinct = false)
    {
        $star = new QueryStarConstant();
        //$select = new QueryMultiSelection($star);
        $op = new QueryAggregateCount($star, $isDistinct);
        return $this->selectOperation($op, $alias);
    }
    
    protected function selectCountOperation(ISelectValue $select, $alias, $isDistinct = false)
    {
        $op = new QueryAggregateCount($select, $isDistinct);
        return $this->selectOperation($op, $alias);
    }
    
    public function selectCount($columnName, $sourceAlias, $alias, $isDistinct = false)
    {
        $sourceList = $this->get_ignition()->get_sourceList();
        
        if(!$sourceList->offsetExists($sourceAlias))
        {
            Throw new Exception("source key is unrecognized in count selection ".$sourceAlias);
        }
        
        $source = $sourceList->offsetGet($sourceAlias);
        
        $col = new QuerySourceBoundSingle($source, $columnName);
        //$selection = new QuerySingleSelection($col, $alias);
        
        $op = new QueryAggregateCount($col, $isDistinct);
        return $this->selectOperation($op, $alias);
    }
    
    
    
    
    protected function mergeNewHaving($aggregateSelectionKey, $operation, $secondary, $mergeOperation)
    {
        //$primary = $this->sanitizeConditionParam($primary);
        //$secondary = $this->sanitizeConditionParam($secondary);
        
        if(is_numeric($aggregateSelectionKey))
        {
            Throw new Exception("selection key is invalid");
        }
        $selections = clone $this->get_selections();
        if(!$selections->offsetExists($aggregateSelectionKey))
        {
            Throw new Exception("selection key is unrecognized in order by");
        }
        $primarySel = $selections->offsetGet($aggregateSelectionKey);//[$selectionKey];
        $primary = $primarySel->get_value();
        
        return $this->mergeNewHavingComplex($primary, $operation, $secondary, $mergeOperation);
        /*
        $cond = new QueryConditionComparison($operation, $primary, $secondary);
        $oldCond = $this->get_having();
        if(isset($oldCond))
        {
            $cond = new QueryConditionComparison($mergeOperation, $cond, $oldCond);
            
        }
        $this->set_having($cond);
        return $this;
        */
        
    }
    
    protected function mergeNewHavingComplex( $primary, $operation,  $secondary, $mergeOperation)
    {
        $primary = $this->sanitizeConditionParam($primary);
        $secondary = $this->sanitizeConditionParam($secondary);
        
        $cond = new QueryConditionComparison($operation, $primary, $secondary);
        $oldCond = $this->get_having();
        if(isset($oldCond))
        {
            $cond = new QueryConditionComparison($mergeOperation, $cond, $oldCond);
            
        }
        $this->set_having($cond);
        return $this;
        
        
    }
    
    
    public function having( $aggregateSelectionKey, $operation,  $secondary)
    {
        return $this->having_and($aggregateSelectionKey, $operation, $secondary);
        //return $this->mergeNewHaving($primary, $operation, $secondary, ValidSQLComparisonOperations::_AND);
    }
    public function having_and( $aggregateSelectionKey, $operation,  $secondary)
    {
        //return $this->having($primary, $operation, $secondary);
        return $this->mergeNewHaving($aggregateSelectionKey, $operation, $secondary, ValidSQLComparisonOperations::_AND);
    }
    
    public function having_or( $aggregateSelectionKey, $operation,  $secondary)
    {
        return $this->mergeNewHaving($aggregateSelectionKey, $operation, $secondary, ValidSQLComparisonOperations::_OR);
        
    }
    
    
    
    
    public function having_complex( $primary, $operation,  $secondary)
    {
        return $this->having_complex_and($primary, $operation, $secondary);
        //return $this->mergeNewHaving($primary, $operation, $secondary, ValidSQLComparisonOperations::_AND);
    }
    
    public function having_complex_and( $primary, $operation,  $secondary)
    {
        //return $this->having($primary, $operation, $secondary);
        return $this->mergeNewHavingComplex($primary, $operation, $secondary, ValidSQLComparisonOperations::_AND);
    }
    
    public function having_complex_or( $primary, $operation,  $secondary)
    {
        return $this->mergeNewHavingComplex($primary, $operation, $secondary, ValidSQLComparisonOperations::_OR);
        
    }
    
    
    

    protected function addGroupBy(QuerySingleSelection $selection)
    {
        $groupBy = clone $this->get_groupBy();
        $groupBy->offsetSet($selection->getReferenceKey(), $selection);
        //$groupBy[$selection->getReferenceKey()] = $selection;
        $this->set_groupBy($groupBy);
    }
    
    
    
    public function groupBy($selectionKey)
    {
        if(is_numeric($selectionKey))
        {
            Throw new Exception("selection key is invalid");
        }
        
        $selections = $this->get_selections();
        
        if(!$selections->offsetExists($selectionKey))
        {
            Throw new Exception("selection key is unrecognized in group by");
        }
        $selection = $selections->offsetGet($selectionKey);
        
        $this->addGroupBy($selection);
        return $this;
    }
    
    public function into($file)
    {
        $this->set_into($file);
        return $this;
    }
    
    
    
    public function distinct($isDistinct = false)
    {
        $this->set_isDistinct($isDistinct);
        return $this;
    }
    
    public function performSetOperation(SQLQueryCompletion_SELECT $query, $setOperation)
    {
        return new SQLQueryCompletion_SELECTSETOPERATION($query->get_ignition(), 
                                                        $this, 
                                                        $setOperation, 
                                                        $query->get_selections(), 
                                                        $query->get_condition(), 
                                                        $query->get_orderBy(), 
                                                        $query->get_limit(), 
                                                        $query->get_isDistinct(), 
                                                        $query->get_groupBy());
    }


    
    public function getRequiredGroupBySelections()
    {
        $params = array('is_aggregate' => true);
        $starSelections = array();
        $nonAggregateSelections = array();
        $hasAggregate = false;
        foreach($this->get_selections() as $key => $value)
        {
            if(!$value->is_star)
            {
                $aggs = QueryUtility::findAllNodes($value, $params, false, false, false);
                if(count($aggs) != 0)
                {
                    $hasAggregate = true;
                }
                else 
                {
                    $nonAggregateSelections[$key] = $value;
                }
            }
            else
            {
                $starSelections[$key] = $value;
            }
        }
        
        if($hasAggregate)
        {
            if(count($starSelections) > 0)
            {
                throw new Exception("Cannot select * with an aggregate selection");
            }
            return $nonAggregateSelections;
        }
        else
        {
            return array();
        }
        
    }
    
    public function verify($param = null) {
        
        parent::verify($param);
        if(count($req = $this->getRequiredGroupBySelections()) > 0)
        {
            if(count(array_diff_assoc($this->get_groupBy(), $req)) > 0)
            {
                $this->isVerified = false;
                $this->writeVerificationError($this);
            }
        }
        return 0;
        
    }
    
    
    
    
    
    
    public function getStandardToSQLOutput($region) {
        $returnMe = "SELECT ";
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
        
        return $returnMe;
    }

    public function getToSQLProfileFromContext($region) {
        $returnMe = new QueryToSQLProfile($region);
        switch ($region)
        {
            case ValidQueryToSQLRegions::JOIN_ON :
                $returnMe->set_format(ValidQueryToSQLFormats::DEFINITION);
                $returnMe->set_hasParenthesis(false);
                $returnMe->set_fragment("(".$this->getStandardToSQLOutput($region).")");
                break;
            case ValidQueryToSQLRegions::SOURCE :
                $returnMe->set_format(ValidQueryToSQLFormats::DEFINITION);
                $returnMe->set_hasParenthesis(false);
                $returnMe->set_fragment("(".$this->getStandardToSQLOutput($region).")");
                break;
            case ValidQueryToSQLRegions::FULL :
                $returnMe->set_format(ValidQueryToSQLFormats::STANDARD);
                $returnMe->set_hasParenthesis(false);
                $returnMe->set_fragment($this->getStandardToSQLOutput($region));
                break;
            /*
            case ValidQueryToSQLRegions::SET_OPERATION_EXP :
                $returnMe->set_format(ValidQueryToSQLFormats::DEFINITION);
                $returnMe->set_hasParenthesis(true);
                $returnMe->set_fragment($this->getStandardToSQLOutput($region));
                break;
             * why did I do this?
             */
            case ValidQueryToSQLRegions::INSERTSELECT :
                $returnMe->set_format(ValidQueryToSQLFormats::STANDARD);
                $returnMe->set_hasParenthesis(false);
                $returnMe->set_fragment($this->getStandardToSQLOutput($region));
                break;
            
            default :
                $returnMe->set_format(ValidQueryToSQLFormats::ALIAS);
                $returnMe->set_hasParenthesis(false);
                $returnMe->set_fragment($this->getStandardToSQLOutput($region));
                break;
                
        }
        
        return $returnMe;
    }
    
    

}

?>
