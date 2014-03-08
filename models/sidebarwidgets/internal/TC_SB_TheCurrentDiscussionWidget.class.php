<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SB_TheCurrentDiscussionWidget
 *
 * @author optimus
 */
class TC_SB_TheCurrentDiscussionWidget extends TC_SB_SidebarWidget{
    public function __construct() {
        
        parent::__construct('The Current Discussion', '$iconURL', 'TC_GenericRSSSource', 5, array('link'=>SITE_DOMAIN .'/'. DISCUSSION_PAGE_FOLDER. '/' . '?feed=rss2'),'JSServerDiverted_CAS');
    }
}

?>
