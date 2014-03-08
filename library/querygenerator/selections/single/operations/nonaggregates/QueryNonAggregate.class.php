<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of QueryNonAggregate
 *
 * @author Dan Kottke
 */
abstract class QueryNonAggregate extends QueryOperation{
    
    public function __construct(array $expressionKeys, array $parameterKeys) {
        $meta = new QuerySelectionTreeBranchMeta(array('is_aggregate' => false));
        parent::__construct($meta, $expressionKeys, $parameterKeys);
    }
    
    
}

?>
