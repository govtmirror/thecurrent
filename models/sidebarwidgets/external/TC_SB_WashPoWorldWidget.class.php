<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SB_WashPoWorldWidget
 *
 * @author optimus
 */
class TC_SB_WashPoWorldWidget extends TC_SB_SidebarWidget{
    public function __construct() {
        
        parent::__construct('Washington Post - World News', '$iconURL', 'TC_GenericRSSSource', 8, array('link'=>'http://feeds.washingtonpost.com/rss/world'),'JSGoogleRSS_Default' );
        
    }
}


?>
