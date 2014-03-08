<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class TC_GoogleRSSSource_Builder extends TC_DashboardSourceBuilder {
        
    public function __construct($id, $repo = null, $args = null) {
        
        parent::__construct('TC_GoogleRSSSource', $id, $repo, $args);
    }
    
    
    /*
    public function generateFeed($args = null)
    {
        //$url = $this->getModel()
        //fetch_rss($url)
        
    } 
    */
    
    
}


?>
