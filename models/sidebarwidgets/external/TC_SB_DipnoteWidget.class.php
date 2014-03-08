<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SB_DipnoteWidget
 *
 * @author kottkedp
 */
class TC_SB_DipnoteWidget extends TC_SB_SidebarWidget {
    
    public function __construct() {
        
        parent::__construct('Dipnote', '$iconURL', 'TC_GenericRSSSource', 6, array('link'=>'http://feeds.feedburner.com/dipnote'),'JSGoogleRSS_Default');
    }
}

?>
