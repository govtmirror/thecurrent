<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SB_CustomExternalSearchRSSWidget
 *
 * @author KottkeDP
 */
class TC_SB_CustomExternalSearchRSSWidget extends TC_SB_SidebarWidget {
    
    public function __construct($title, $iconURL, $dashboardModel, $priority = null, $properties = null) {
        parent::__construct($title, $iconURL, $dashboardModel, $priority, $properties,'');
    }
    
}

?>
