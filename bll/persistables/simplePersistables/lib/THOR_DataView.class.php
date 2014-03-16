<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of THOR_DataView
 *
 * @author Dan Kottke
 */
class THOR_DataView extends DataView{

    public function __construct() {
        $ds = MySQLAdapter::getInstance();
        parent::__construct($ds);
    }
    //put your code here
}

?>
