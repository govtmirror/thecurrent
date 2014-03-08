<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SB_APWorldNewsWidget
 *
 * @author optimus
 */
class TC_SB_APWorldNewsWidget extends TC_SB_SidebarWidget{
    public function __construct() {
        
        parent::__construct('AP - World News', '$iconURL', 'TC_GenericRSSSource', 7, array('link'=>'http://hosted.ap.org/lineups/WORLDHEADS-rss_2.0.xml?SITE=WVEC&SECTION=HOME'),'JSGoogleRSS_Default' );
        
    }
}

?>
