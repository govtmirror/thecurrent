<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TC_SB_RapidResponseWidget
 *
 * @author KottkeDP
 */
class TC_SB_RapidResponseWidget extends TC_SB_SidebarWidget {
    public function __construct() {
        
        parent::__construct('Rapid Response (InfoCentral)', '$iconURL', 'TC_RapidResponseRSSSource', 7, array('link'=>'https://infocentral.state.gov/home/content-type-rapid-response.rss'),'JSServerDiverted_Default');
    }
}

?>
