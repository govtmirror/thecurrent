<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TC_SB_SMARTWidget
 *
 * @author KottkeDP
 */
class TC_SMARTSource extends TC_Source {

    //protected $tags;
    //protected $terms;
    //protected $addressee;

    public function __construct($title = null, $description = null, $viewtype = null, $terms = null) {
        //$this->tags = $tags;
        $validFieldsToSubmit = array(
            'terms'
        );
        parent::__construct($validFieldsToSubmit,$title, $description, $viewtype);

        $this->set_terms($terms);// = $terms;
        //$this->addressee = $addressee;
    }




    public function get_terms() {
        $pairs = $this->get_fieldValuePairs();
        if(array_key_exists('terms', $pairs))
        {
            if($pairs['terms'] == '' or !isset($pairs['terms']))
                return ' * ';
            else
            {
                return $pairs['terms'];
            }
        }
        else
        {
            return ' * ';
        }


    }

    public function set_terms( $terms) {
        $pairs = $this->get_fieldValuePairs();
        $pairs['terms'] = $terms;
        $this->set_fieldValuePairs($pairs);
        //$this->terms = $terms;
    }







}

?>
