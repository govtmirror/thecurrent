<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SimplePieStrategy
 *
 * @author KottkeDP
 */
class SimplePieStrategy extends FeedStrategy{
   
   public function __construct(TC_GenericRSSSource $model) {
       parent::__construct($model);
   }
   
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
}

?>
