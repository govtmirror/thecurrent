<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SQLQueryCompletion
 *
 * @author KottkeDP
 */
abstract class SQLQueryCompletion extends SQLQuery {
    
    public function __construct(
                                SQLQueryIgnition $queryIgnition,
                                QueryElementMeta $meta = null,
                                array $expressionKeys = array(), 
                                array $parameterKeys = array(),
                                QueryArrayOfSelections $selections = null,
                                QueryConditionComparison $condition = null,
                                QueryArrayOfQueryOrders $orderBy = null, 
                                $limit = null
                                ) {
        
        
        $e_keys = array(ValidQueryExpressions::CONDITION,
                        ValidQueryExpressions::SELECTIONS,
                        ValidQueryExpressions::ORDER_BY,
                        ValidQueryExpressions::IGNITION
            );
        
        $p_keys = array(ValidQueryParameters::LIMIT);
        
        if(!isset($meta))
        {
            $meta = new QueryElementMeta();
        }
        if(!isset($expressionKeys))
        {
            $expressionKeys = array();
        }
        if(!isset($parameterKeys))
        {
            $parameterKeys = array();
        }
        parent::__construct($meta, array_merge($expressionKeys, $e_keys), array_merge($parameterKeys, $p_keys) );
        
        $this->set_limit($limit); 
        $this->set_ignition($queryIgnition);
        
        if(!isset($selections))
        {
            $selections = new QueryArrayOfSelections(array());
        }
        $this->set_selections($selections);
        
        if(isset($condition))
        $this->set_condition($condition);
        
        if(!isset($orderBy))
        {
            $orderBy = new QueryArrayOfQueryOrders(array());
        }
        $this->set_orderBy($orderBy);
        
        
    }
    
    public function get_ignition() {
        return $this->get_expression(ValidQueryExpressions::IGNITION);
    }

    protected function set_ignition(SQLQueryIgnition $ignition) {
        $this->set_expression(ValidQueryExpressions::IGNITION, $ignition);
    }

    public function get_selections() {
        
        $list = $this->get_expression(ValidQueryExpressions::SELECTIONS);
        
        if(!isset($list))
        {
            throw new Exception("selections should never be null");
            //$this->set_sourceList(new QueryArrayOfSources(array()));
        }
        //var_dump($list->get_value());
        
        $list = new QueryArrayOfSelections( $this->get_expression(ValidQueryExpressions::SELECTIONS)->get_value() );
        
        return $list;
        
        
        
        //return new QueryArrayOfSelections($this->get_expression(ValidQueryExpressions::SELECTIONS)) ;
    }
    
    

    protected function set_selections(QueryArrayOfSelections $selections) {
        
        $wrapper = new QueryWrapperArrayOf($selections);
        $this->set_expression(ValidQueryExpressions::SELECTIONS, $wrapper);
        
        /*
        if(!isset($selections))
        {
            $selections = new QueryArrayOfSelections();
        }
        $wrapper = new QueryWrapperArrayOf($selections);
        //$this->set_expression(ValidQueryExpressions::SOURCELIST, $wrapper);
        $this->set_expression(ValidQueryExpressions::SELECTIONS, $wrapper);
         * 
         */
    }
    
    public function get_condition() {
        return $this->get_expression(ValidQueryExpressions::CONDITION);
    }

    protected function set_condition(QueryConditionComparison $condition ) {
        $this->set_expression(ValidQueryExpressions::CONDITION, $condition);
    }
    
    public function get_orderBy() {
        
        $list = $this->get_expression(ValidQueryExpressions::ORDER_BY);
        
        if(!isset($list))
        {
            throw new Exception("order by should never be null");
        }
        
        
        $list = new QueryArrayOfQueryOrders( $this->get_expression(ValidQueryExpressions::ORDER_BY)->get_value() );
        
        return $list;
        
    }

    protected function set_orderBy(QueryArrayOfQueryOrders $orderBy ) {
        
        $wrapper = new QueryWrapperArrayOf($orderBy);
        $this->set_expression(ValidQueryExpressions::ORDER_BY, $wrapper);
        
        
        //$wrapper = new QueryWrapperArrayOf($orderBy);
        //$this->set_expression(ValidQueryExpressions::ORDER_BY, $wrapper);
    }

    public function get_limit() {
        return $this->get_parameter(ValidQueryParameters::LIMIT);
    }

    protected function set_limit($limit = null) {
        
            $this->set_parameter(ValidQueryParameters::LIMIT, $limit);
        
            
        
    }
    
    
    
    public function select($columnName, $sourceAlias, $alias = null)
    {
        
        
        $sourceList = $this->get_ignition()->get_sourceList();
        if(!$sourceList->offsetExists($sourceAlias))
        {
            throw new Exception("Must select from a loaded source");
        }
        
        //$source = $sourceList[$sourceAlias];
        
        $source = $sourceList->offsetGet($sourceAlias);
        
        $col = new QuerySourceBoundSingle($source, $columnName);
        $selection = new QuerySingleSelection($col, $alias);
        
        $this->addSelection($selection);
        
        return $this;
    }
    
    public function selectNumConst($value, $alias)
    {
        $col = new QueryNumericConstant($value);
        $selection = new QuerySingleSelection($col, $alias);
        
        $this->addSelection($selection);
        return $this;
    }
    
    public function selectStringConst($value, $alias)
    {
        
        $col = new QueryStringConstant($value);
        $selection = new QuerySingleSelection($col, $alias);
        
        $this->addSelection($selection);
        return $this;
    }
    
    protected function addSelection(QuerySingleSelection $selection)
    {
        
        $sel = clone $this->get_selections();
        //if($sel->offsetExists($selection->getReferenceKey()))
        $sel->offsetSet($selection->getReferenceKey(), $selection);
        //$sel[$selection->getReferenceKey()] = $selection;
        
        $this->set_selections($sel);
    }
    
    public function clearSelections()
    {
        $this->set_selections(new QueryArrayOfSelections(array()));
        return $this;
    }
    
    public function clearCondition()
    {
        $this->set_condition(null);
        return $this;
    }
    
    public function clearLimit()
    {
        $this->set_limit(null);
        return $this;
    }
    
    public function clearAll()
    {
        return $this->clearSelections()->clearCondition()->clearOrderBy()->clearLimit();
    }
    
    public function clearOrderBy()
    {
        $this->set_orderBy(new QueryArrayOfQueryOrders(array()));
        return $this;
    }
    
    protected function sanitizeConditionParam($value)
    {
        
        if(is_numeric($value))
        {
            return new QueryNumericConstant($value);
        }
        else if(is_string($value))
        {
            return new QueryStringConstant($value);
        }
        else if($value instanceof ISingleSelectValue)
        {
             return $value;
        }
        else
        {
            //echo get_class($value);
            throw new Exception("Condition parameter is not of valid type.");
        }
        
    }


    public function where( $primary, $operation,  $secondary)
    {
        return $this->where_and($primary, $operation, $secondary);
    }
    
    public function where_and( $primary, $operation,  $secondary)
    {
        return $this->mergeNewCondition($primary, $operation, $secondary, ValidSQLComparisonOperations::_AND);
        
    }
    
    public function where_or( $primary, $operation,  $secondary)
    {
        return $this->mergeNewCondition($primary, $operation, $secondary, ValidSQLComparisonOperations::_OR);
        
    }
    
    public function where_condition(QueryConditionComparison $condition, $mergeOperation)
    {
        $oldCond = $this->get_condition();
        if(isset($oldCond))
        {
            $condition = new QueryConditionComparison($mergeOperation, $condition, $oldCond);
            
        }
        $this->set_condition($condition);
        return $this;
    }
    
    protected function mergeNewCondition( $primary, $operation,  $secondary, $mergeOperation)
    {
        $primary = $this->sanitizeConditionParam($primary);
        $secondary = $this->sanitizeConditionParam($secondary);
        $cond = new QueryConditionComparison($operation, $primary, $secondary);
        
        return $this->where_condition($cond, $mergeOperation);
        /*
        $oldCond = $this->get_condition();
        if(isset($oldCond))
        {
            $cond = new QueryConditionComparison($mergeOperation, $cond, $oldCond);
            
        }
        $this->set_condition($cond);
        return $this;
         * 
         */
    }
    
    protected function addOrderBy(QueryOrder $order)
    {
        $currentOrdering = clone $this->get_orderBy();
        $currentOrdering[] = $order;
        $this->set_orderBy($currentOrdering);
    }
    
    public function orderBy($selectionKey, $direction, $cast_type = null)
    {
        if(is_numeric($selectionKey))
        {
            Throw new Exception("selection key is invalid");
        }
        $selections = clone $this->get_selections();
        if(!$selections->offsetExists($selectionKey))
        {
            Throw new Exception("selection key is unrecognized in order by");
        }
        $selection = $selections->offsetGet($selectionKey);//[$selectionKey];
        $ordering = new QueryOrder($selection, $direction, $cast_type);
        $this->addOrderBy($ordering);
        return $this;
    }
    
    
    
    public function limit($limit)
    {
        $this->set_limit($limit);
        return $this;
    }
    
    
    public function isTerminal($params = null) {
        return false;
    }
}

?>
