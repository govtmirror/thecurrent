<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SB_ALDACSWidget
 *
 * @author KottkeDP
 */
class TC_SB_ALDACSWidget extends TC_SB_SidebarWidget {
    public function __construct() {
        
        parent::__construct('ALDACS', '$iconURL', 'TC_SMARTSource', 1, array('terms'=>'ADDRESSEE:ALL DIPLOMATIC AND CONSULAR POSTS'),'JSCORS_Default');
    }
}

?>
