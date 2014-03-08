<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SB_AllNewsWidget
 *
 * @author optimus
 */
class TC_SB_AllNewsWidget extends TC_SB_SidebarWidget {
    
    public function __construct() {
        
        parent::__construct('All News', '$iconURL', 'TC_GoogleRSSSource', 5, array(),'JSGoogleNews_Default');
    }
}

?>
