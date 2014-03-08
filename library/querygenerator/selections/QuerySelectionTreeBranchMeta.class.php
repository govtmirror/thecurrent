<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of QueryOperationMeta
 *
 * @author KottkeDP
 */
class QuerySelectionTreeBranchMeta extends QueryElementMeta{
    
    //protected $keys = array('is_aggregate');
    //protected $is_aggregate_key = 'is_aggregate';
    protected $allowed_keys = array('is_aggregate');
    
    public function __construct($params = null) {
        parent::__construct($params, $this->allowed_keys);
    }

    
}

?>
