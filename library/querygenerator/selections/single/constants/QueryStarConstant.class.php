<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of QueryStarConstant
 *
 * @author Dan Kottke
 */
class QueryStarConstant extends QueryConstant{
    public function __construct() {
        $meta = new QuerySelectionTreeLeafMeta(array('is_tableBound' => false, 'is_star' => true));
        $value = "*";
        parent::__construct($value, $meta);
    }
    public function getStandardToSQLOutput($region) {
        return  $this->get_value() ;
    }
}

?>
