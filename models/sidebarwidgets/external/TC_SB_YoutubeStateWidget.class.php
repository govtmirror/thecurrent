<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SB_YoutubeStateWidget
 *
 * @author KottkeDP
 */
class TC_SB_YoutubeStateWidget extends TC_SB_SidebarWidget  {
    public function __construct() {
        
        parent::__construct('State Youtube Channel', '$iconURL', 'TC_GenericRSSSource', 3, array('link'=>'https://gdata.youtube.com/feeds/api/users/statevideo/uploads?alt=rss'), 'JSGoogleRSS_Default');
    }
}

?>
