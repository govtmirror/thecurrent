<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author KottkeDP
 */
interface ISetParameterModel extends IParameterModel {
    public function get_Item();
    public function set_Item($item);
    public function get_parameters();
    public function set_parameters($parameters);
    public function get_options();
    public function set_options($options);
    //public function get_inputID();
    //public function set_inputID($inputID);
    
    
}

?>
