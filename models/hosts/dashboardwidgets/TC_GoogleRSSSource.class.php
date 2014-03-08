<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TC_GoogleRSSWidget
 *
 * @author KottkeDP
 */
class TC_GoogleRSSSource extends TC_Source{
    //protected $domain;
    //protected $search_term;

    public function __construct($title = null, $description = null, $viewtype = null, $domain = null, $search_term = null)
    {
        $validFieldsToSubmit = array(
            'domain',
            'search_term'
        );
        parent::__construct($validFieldsToSubmit, $title, $description, $viewtype);

        if(isset($domain) && is_string($domain))
        {
            $this->set_domain($domain);// = $domain;
        }
        elseif(isset($domain))
        {
            throw new Exception("widget domain must be a string");
        }

        if(isset($search_term) && is_string($search_term))
        {
            $this->set_search_term(addslashes($search_term));// = addslashes($search_term);
        }
        elseif(isset($search_term))
        {
            throw new Exception("widget search_term must be a string");
        }

    }

    public function get_domain()
    {
        $pairs = $this->get_fieldValuePairs();
        if(array_key_exists('domain', $pairs))
        {
            return $pairs['domain'];
        }
        else
        {
            return false;
        }

    }
    public function set_domain($domain)
    {
        if(is_string($domain))
        {
            $pairs = $this->get_fieldValuePairs();
            $pairs['domain'] = $domain;
            $this->set_fieldValuePairs($pairs);
            //$this->domain = $domain;
            return true;
        }
        else
        {
            return false;
        }

    }

    public function get_search_term()
    {
        $pairs = $this->get_fieldValuePairs();
        if(array_key_exists('search_term', $pairs))
        {
            return stripSlashesDeep($pairs['search_term']);
        }
        else
        {
            return false;
        }

    }
    public function set_search_term($search_term)
    {
        if(is_string($search_term))
        {
            $pairs = $this->get_fieldValuePairs();
            $pairs['search_term'] = addslashes($search_term);
            $this->set_fieldValuePairs($pairs);
            //$this->search_term = addslashes($search_term);
            return true;
        }
        else
        {
            return false;
        }

    }
}

?>
