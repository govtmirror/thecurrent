<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SB_DepartmentNoticesWidget
 *
 * @author KottkeDP
 */
class TC_SB_DepartmentNoticesWidget extends TC_SB_SidebarWidget{
    public function __construct() {
        
        parent::__construct('Department Notices', '$iconURL', 'TC_GenericRSSSource', 2, array('link'=>'http://mmsweb.a.state.gov/GpsWeb/RSS/TodaysNotices.aspx'),'JSServerDiverted_Default');
    }
}

?>
