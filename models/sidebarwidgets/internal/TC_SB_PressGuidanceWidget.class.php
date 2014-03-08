<?php

class TC_SB_PressGuidanceWidget extends TC_SB_SidebarWidget {
    public function __construct() {
        
        parent::__construct('Press Guidance (InfoCentral)', '$iconURL', 'TC_PressGuidanceRSSSource', 6, array('link'=>'https://infocentral.state.gov/home/content-type-guidance.rss'),'JSServerDiverted_Default');
    }
}
?>
