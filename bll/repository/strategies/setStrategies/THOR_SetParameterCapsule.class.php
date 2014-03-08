<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SetParameterObject
 *
 * @author KottkeDP
 */
class THOR_SetParameterCapsule implements ISetParameterModel {
    
    //protected $inputID;
    protected $item;
    
    protected $parameters;
    protected $options;
    
    //protected $parameterModel;
    //link to simple persistable?
    //protected $extras;
    
    
    
    public function __construct($item = null, 
                                array $parameters = null, 
                                array $options = null
                                //$user_id = null,
                                //array $accessGroupIDs = array()
            ) {
        $this->set_item($item);
        $this->set_parameters($parameters);
        $this->set_options($options);
        //$this->set_accessGroupIDs($accessGroupIDs);
        //$this->set_user_id($user_id);
    }

        
    public function get_item() {
        return $this->item;
    }

    public function set_item($item) {
        $this->item = $item;
    }
    
    public function get_parameters() {
        return $this->parameters;
    }

    public function set_parameters($parameters) {
        $this->parameters = $parameters;
    }
    
    

    public function get_options() {
        return $this->options;
    }

    public function set_options($options) {
        $this->options = $options;
    }


    /*
    public function get_accessGroupIDs() {
        $params = $this->get_parameters();
        if(array_key_exists('accessGroupIDs', $params))
        {
            return $params['accessGroupIDs'];
        }
        else 
        {
            return false;
        }
        
    }

    public function set_accessGroupIDs($accessGroupIDs) {
        $params = $this->get_parameters();
        $params['accessGroupIDs'] = $accessGroupIDs;
        $this->set_parameters($params);
    }

    public function get_user_id()
    {
        $params = $this->get_parameters();
        if(array_key_exists('user_id', $params))
        {
            return $params['user_id'];
        }
        else 
        {
            return false;
        }
    }
    
    public function set_user_id($user_id)
    {
        $params = $this->get_parameters();
        $params['user_id'] = $user_id;
        $this->set_parameters($params);
    }
    */


    
}

?>
