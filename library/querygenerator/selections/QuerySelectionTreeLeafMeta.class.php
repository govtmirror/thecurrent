<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of QueryTreeLeafMeta
 *
 * @author KottkeDP
 */
class QuerySelectionTreeLeafMeta extends QueryElementMeta {
    
    
    protected $allowed_keys = array('is_tableBound','is_star');
    
    public function __construct($params = null) {
        parent::__construct($params, $this->allowed_keys);
    }
    
    
}

?>
