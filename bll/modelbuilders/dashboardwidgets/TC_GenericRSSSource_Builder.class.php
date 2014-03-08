<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of GenericRSS_News
 *
 * @author kottkedp
 */
class TC_GenericRSSSource_Builder extends TC_DashboardSourceBuilder {
    
    public function __construct($id, $repo = null, $args = null) {
        parent::__construct('TC_GenericRSSSource', $id, $repo, $args);
    }
    
   
    /*
    public function generateFeed($args = null)
    {        
        
        $url = $this->getModel()->get_link(); 
        $feed = new SimplePie();  
	  $feed->set_feed_url($url);
	  $feed->enable_cache(false);
        $feed->init();
        unset($url);
        //$rss = fetch_rss($url);
        return $feed;        
    }   
     * 
     */
    
}

?>
