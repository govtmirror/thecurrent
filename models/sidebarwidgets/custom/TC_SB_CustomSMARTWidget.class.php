<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TC_SB_CustomSMARTWidget
 *
 * @author KottkeDP
 */
class TC_SB_CustomSMARTWidget  extends TC_SB_SidebarWidget  {
    public function __construct($title, $iconURL, $dashboardModel, $priority = null, $properties = null) {
        
        parent::__construct($title, $iconURL, $dashboardModel, $priority, $properties, '');
    }
}

?>
