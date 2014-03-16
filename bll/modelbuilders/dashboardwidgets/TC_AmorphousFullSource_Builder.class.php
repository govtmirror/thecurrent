<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DB_AmorphousWidget_NewsBuilder
 *
 * @author Dan Kottke
 */
class TC_AmorphousFullSource_Builder extends TC_DashboardSourceBuilder {

    public function __construct($id, $repo = null, $args = null) {
        parent::__construct('TC_AmorphousFullSource', $id, $repo, $args);
    }

}

?>
