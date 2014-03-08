<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * This class hosts a list of expected metadata properties and their values. QueryValueElements contain this object.
 * This data is not for use in a normal functional capacity, but is used when tree traversing looking for specific
 * meta attributes.
 *
 * @author KottkeDP
 */
class QueryElementMeta {
    protected $properties;
    protected $keys;

    public function __construct(array $properties = array(), array $keys = array()) {
        $this->keys = $keys;
        $this->set_properties($properties);


    }

    public function get_keys() {
        return $this->keys;
    }


    public function get_properties() {
        return $this->properties;
    }

    public function set_properties(array $properties = array()) {
        foreach($properties as $key => $value)
        {

            if(!in_array($key, $this->get_keys()))
            {
                throw new Exception('Invalid property');

            }
        }
        $this->properties = $properties;
    }

    public function __get($name) {

        if(array_key_exists($name, $this->properties))
        {
            return $this->properties[$name];
        }
        else
        {
            return null;
        }

    }

    public function __set($name, $value) {
        if(in_array($name, $this->get_keys()))
        {
            $this->properties[$name] = $value;
        }
        else
        {
            throw new Exception('Invalid property');
        }
    }








}

?>
