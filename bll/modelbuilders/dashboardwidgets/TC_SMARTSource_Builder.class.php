<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TC_SMARTSource_Builder
 *
 * @author KottkeDP
 */
class TC_SMARTSource_Builder  extends TC_DashboardSourceBuilder{
    public function __construct($id, $repo = null, $args = null) {
        
        parent::__construct('TC_SMARTSource', $id, $repo, $args);
    }
}

?>
