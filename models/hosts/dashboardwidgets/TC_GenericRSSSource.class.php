<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TC_GenericRSSWidget
 *
 * @author KottkeDP
 */
class TC_GenericRSSSource extends TC_Source{

    //protected $link;

    public function __construct($title = null, $description = null, $viewtype = null, $link = null )
    {
        $validFieldsToSubmit = array(
            'link'
        );
        parent::__construct($validFieldsToSubmit, $title, $description, $viewtype);
        if(isset($link) && is_string($link))
        {
            $this->set_link($link);// = $link;
        }
        elseif(isset($link))
        {
            throw new Exception("widget link must be a string");
        }

    }

    public function get_link()
    {
        $pairs = $this->get_fieldValuePairs();
        if(array_key_exists('link', $pairs))
        {
            return $pairs['link'];
        }
        else
        {
            return false;
        }
    }

    public function set_link($link)
    {
        if(is_string($link))
        {
            $pairs = $this->get_fieldValuePairs();
            $pairs['link'] = $link;
            $this->set_fieldValuePairs($pairs);
            //$this->link = $link;
            return true;
        }
        else
        {
            return false;
        }
    }

}

?>
