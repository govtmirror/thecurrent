<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SimplePieMergedStrategy
 *
 * @author optimus
 */
class SimplePieMergedStrategy extends FeedStrategy{
    
    public function __construct(TC_MergedRSSSource $model) {
        parent::__construct($model);
    }
    
    public function generateFeed($args = null)
    {        
        //expects values in the form created by http_build_query() with & => ~~~, = => $$$
	  //return $this->getModel()->get_links();

        $urls = array();
	  $mergeArr = array();
	  parse_str($this->getModel()->get_links(), $urls);

	  //$urls = str_replace('~~~','&',$urls);
	  //$urls = str_replace('$$$','=',$urls);
        //return $urls;
        //$urls = parse_str(str_replace('$$$','=',str_replace('~~~','&',$this->getModel()->get_links()))); 
        
          
       foreach($urls as $key => $value)
        {
            $value = str_replace('~~~','&',$value);
            $value = str_replace('$$$','=',$value);
            $mergeArr[] = $value;
        }   
          
          
          
          
          
          
          
        //foreach($urls as $key => $value)
        //{

	//	$value = str_replace('~~~','&',$value);
        //        $value = str_replace('$$$','=',$value);
		$pie = new SimplePie();     
		$pie->set_feed_url($mergeArr);
	  	$pie->enable_cache(false);
                //$pie->handle_content_type();
        	$pie->init();
            //$mergeArr[] = $pie;

        //}        
        //$feed = SimplePie::merge_items($mergeArr);
                
        //return $feed;        
                return $pie;
    }
    
}

?>
