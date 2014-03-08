<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SB_DepartmentAnnouncementsWidget
 *
 * @author KottkeDP
 */
class TC_SB_DepartmentAnnouncementsWidget extends TC_SB_SidebarWidget {
    public function __construct() {
        
        parent::__construct('Department Announcements', '$iconURL', 'TC_GenericRSSSource', 3, array('link'=>'http://mmsweb.a.state.gov/GpsWeb/RSS/TodaysAnnouncements.aspx'),'JSServerDiverted_Default');
    }
}

?>
