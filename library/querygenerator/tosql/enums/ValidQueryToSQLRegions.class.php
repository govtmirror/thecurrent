<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ValidQueryRegions
 *
 * @author Dan Kottke
 */
class ValidQueryToSQLRegions {
    
    const SELECTION = 0;
    const SOURCE = 1;
    const JOIN_ON = 2;
    const CONDITION = 3;
    const HAVING = 4;
    const GROUP_BY = 5;
    const ORDER_BY = 6;
    
    
    const FULL = 7;
    const SET_OPERATION_EXP = 8;
    
    const INSERTSELECT = 9;

}

?>
