<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FeedBuilder
 *
 * @author Dan Kottke
 */
class FeedBuilder {
    protected $strategy;
    protected $feed;

    public function __construct(FeedStrategy $strategy) {


            $this->strategy = $strategy;

    }




    public function getFeed($args = null)
    {
        if(!(isset($this->feed)))
        {
            $this->feed = $this->strategy->generateFeed($args);
        }
        return $this->feed;

    }



    public function getFeedStrategy()
    {

            return $this->feedStrategy;

    }

}

?>
