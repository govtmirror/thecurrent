<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of QueryFreeFormConstant
 *
 * @author KottkeDP
 */
class QueryFreeFormConstant extends QueryConstant{
    
    public function __construct($value) {
        $meta = new QuerySelectionTreeLeafMeta(array('is_tableBound' => false, 'is_star' => false));
        parent::__construct($value, $meta);
    }
    public function getStandardToSQLOutput($region) {
        return  $this->get_value() ;
    }
}

?>
