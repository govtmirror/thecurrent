<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author KottkeDP
 */

interface IGetParameterModel extends IParameterModel{
    
    public function set_outputCollection($outputCollection);
    public function get_outputCollection();
    public function get_outputReferenceIDs();
    public function set_outputReferenceIDs($outputReferenceIDs);
    public function get_inputCollection();
    
    public function get_inputReferenceIDs();
    public function set_inputReferenceIDs($inputReferenceIDs);
    public function get_parameters();
    public function set_parameters($parameters);
    public function get_options();
    public function set_options($options);
    
    
    
}

?>
