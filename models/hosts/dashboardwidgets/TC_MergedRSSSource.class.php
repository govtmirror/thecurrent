<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TC_MergedRSSWidget
 *
 * @author KottkeDP
 */
class TC_MergedRSSSource extends TC_Source{
    //protected $links;
    public function __construct($title = null, $description = null, $viewtype = null, $links = null) {

        $validFieldsToSubmit = array(
            'links'
        );
        parent::__construct($validFieldsToSubmit, $title, $description, $viewtype);

        if(isset($links) && is_string($links))
        {
            $this->set_links($links);// = $links;
        }
        elseif(isset($links))
        {
            throw new Exception("widget link must be an array of strings");
        }
    }

    public function get_links()
    {
        $pairs = $this->get_fieldValuePairs();
        if(array_key_exists('links', $pairs))
        {
            return $pairs['links'];
        }
        else
        {
            return false;
        }
        //return $this->links;
    }

    public function set_links($links)
    {
        if(is_string($links))
        {
            $pairs = $this->get_fieldValuePairs();
            $pairs['links'] = $links;
            $this->set_fieldValuePairs($pairs);
            return true;

        }
        else
        {
            return false;
        }
    }
}

?>
