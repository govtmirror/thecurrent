<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SB_FlickrStateWidget
 *
 * @author KottkeDP
 */
class TC_SB_FlickrStateWidget extends TC_SB_SidebarWidget  {
    public function __construct() {
        
        parent::__construct('Flickr - DoS Channel', '$iconURL', 'TC_GenericRSSSource', 4, array('link'=>'http://api.flickr.com/services/feeds/photos_public.gne?lang=en-us&format=rss2&id=9364837@N06'), 'JSGoogleRSS_Default');
    }
}

?>
