<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SB_PressBriefingsWidget
 *
 * @author KottkeDP
 */
class TC_SB_PressBriefingsWidget  extends TC_SB_SidebarWidget{
    public function __construct() {
        
        parent::__construct('Press Briefings', '$iconURL', 'TC_GenericRSSSource', 2, array('link'=>'http://www.state.gov/rss/channels/brief.xml'),'JSGoogleRSS_Default' );
        
    }
}

?>
