<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SB_PressReleasesWidget
 *
 * @author KottkeDP
 */
class TC_SB_PressReleasesWidget  extends TC_SB_SidebarWidget{
    public function __construct() {
        
        parent::__construct('Press Releases', '$iconURL', 'TC_GenericRSSSource', 1, array('link'=>'http://www.state.gov/rss/channels/press.xml'),'JSGoogleRSS_Default' );
        
    }
}

?>
