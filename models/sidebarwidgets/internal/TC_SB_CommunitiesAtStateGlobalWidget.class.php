<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SB_CommunitiesAtStateGlobalWidget
 *
 * @author KottkeDP
 */
class TC_SB_CommunitiesAtStateGlobalWidget extends TC_SB_SidebarWidget {
    public function __construct() {
        
        parent::__construct('Communities @ State OpenNet', '$iconURL', 'TC_GenericRSSSource', 4, array('link'=>'http://cas.state.gov/?wpmu-feed=posts'),'JSServerDiverted_CAS');
    }
}

?>
