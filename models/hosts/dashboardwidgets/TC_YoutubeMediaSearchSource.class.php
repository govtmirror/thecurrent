<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TC_YoutubeMediaSearchWidget
 *
 * @author KottkeDP
 */
class TC_YoutubeMediaSearchSource extends TC_Source{

    public function __construct( $title = null, $description = null, $viewtype = null, $q = null, $time = null, $alt = null) {

        $validFieldsToSubmit = array(
            'q',
            'time',
            'alt'
        );
        parent::__construct($validFieldsToSubmit, $title, $description, $viewtype);

        if(isset($q) && is_string($q))
        {
            $this->set_q($q);
        }
        elseif(isset($q))
        {
            throw new Exception("widget q must be a string");
        }

        if(isset($time) && is_string($time))
        {
            $this->set_time($time);// = $time;
        }
        elseif(isset($time))
        {
            throw new Exception("widget time must be a string");
        }
        else
        {
            $this->set_time('this_week');// = 'this_week';
        }

        if(isset($alt) && is_string($alt))
        {
            $this->set_alt($alt);// = $alt;
        }
        elseif(isset($alt))
        {
            throw new Exception("widget alt must be a string");
        }
        else
        {
            $this->set_alt('rss');// = 'rss';
        }

    }

    public function get_q()
    {
        $pairs = $this->get_fieldValuePairs();
        if(array_key_exists('q', $pairs))
        {
            return stripSlashesDeep($pairs['q']);
        }
        else
        {
            return false;
        }

        //return stripSlashesDeep($this->q);

    }
    public function set_q($q)
    {
        if(is_string($q))
        {
            $pairs = $this->get_fieldValuePairs();
            $pairs['q'] = addslashes($q);
            $this->set_fieldValuePairs($pairs);
            return true;
            //$this->q = addslashes($q);
            //return true;
        }
        else
        {
            return false;
        }

    }

    public function get_time()
    {
        $pairs = $this->get_fieldValuePairs();
        if(array_key_exists('time', $pairs))
        {
            return $pairs['time'];
        }
        else
        {
            return false;
        }


    }
    public function set_time($time)
    {
        if(is_string($time))
        {
            $pairs = $this->get_fieldValuePairs();
            $pairs['time'] = $time;
            $this->set_fieldValuePairs($pairs);

            return true;
        }
        else
        {
            return false;
        }

    }
    public function get_alt()
    {
        $pairs = $this->get_fieldValuePairs();
        if(array_key_exists('alt', $pairs))
        {
            return $pairs['alt'];
        }
        else
        {
            return false;
        }


    }
    public function set_alt($alt)
    {
        if(is_string($alt))
        {
            $pairs = $this->get_fieldValuePairs();
            $pairs['alt'] = $alt;
            $this->set_fieldValuePairs($pairs);
            //$this->alt = $alt;
            return true;
        }
        else
        {
            return false;
        }

    }

}

?>
