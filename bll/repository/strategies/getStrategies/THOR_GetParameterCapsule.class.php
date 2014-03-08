<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of GetParameterObject
 *
 * @author KottkeDP
 */
class THOR_GetParameterCapsule implements IGetParameterModel {
    
    protected $inputReferenceIDs;
    protected $outputReferenceIDs;
    //link to simple persistable?
    protected $inputCollection;
    protected $outputCollection;
    
    //protected $parameterModel;
    
    protected $parameters;
    
    protected $options;
    //protected $extras;
    
    public function __construct(array $inputCollection = array(), 
                                array $parameters = array(), 
                                array $options = array(), 
                                array $inputReferenceIDs = array()//,
                                //$user_id = null,
                                //array $accessGroupIDs = array(),
                                //$accessProfile_id = null
                                ) {
        $this->set_inputCollection($inputCollection);
        $this->set_inputReferenceIDs($inputReferenceIDs);
        $this->set_parameters($parameters);
        $this->set_options($options);
        //$this->set_accessGroupIDs($accessGroupIDs);
        //$this->set_user_id($user_id);
        //$this->set_accessProfile_id($accessProfile_id);
    }

    
    public function get_inputCollection() {
        return $this->inputCollection;
    }

    public function set_inputCollection($inputCollection) {
        $this->inputCollection = $inputCollection;
    }

    public function get_outputCollection() {
        return $this->outputCollection;
    }

    public function set_outputCollection($outputCollection) {
        $this->outputCollection = $outputCollection;
    }

   

        
    public function get_parameters() {
        return $this->parameters;
    }

    public function set_parameters( $parameters) {
        $this->parameters = $parameters;
    }

    public function get_options() {
        return $this->options;
    }

    public function set_options( $options) {
        $this->options = $options;
    }

   
    public function get_inputReferenceIDs() {
        return $this->inputReferenceIDs;
    }

    public function set_inputReferenceIDs($inputReferenceIDs) {
        $this->inputReferenceIDs = $inputReferenceIDs;
    }

    public function get_outputReferenceIDs() {
        return $this->outputReferenceIDs;
    }

    public function set_outputReferenceIDs($outputReferenceIDs) {
        $this->outputReferenceIDs = $outputReferenceIDs;
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
    
    public function get_accessProfile_id()
    {
        $params = $this->get_parameters();
        if(array_key_exists('accessProfile_id', $params))
        {
            return $params['accessProfile_id'];
        }
        else 
        {
            return false;
        }
    }
    
    public function set_accessProfile_id($accessProfile_id)
    {
        $params = $this->get_parameters();
        $params['accessProfile_id'] = $accessProfile_id;
        $this->set_parameters($params);
    }

    */
}

?>
