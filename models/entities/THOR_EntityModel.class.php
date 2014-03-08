<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Entity
 *
 * @author KottkeDP
 */
abstract class THOR_EntityModel {// implements IAuditable{

    protected $entity_id;

    //protected $is_dirty;
    protected $is_active;
    protected $created_date;
    protected $last_edited;
    protected $owner;

    protected $host_id;
    protected $host_type;
    protected $host;

    protected $validMetadataKeys;
    protected $metadata;

    // protected $accessgroups;

    protected $priorVersion;

    public function __construct(   $entity_id = null,
                            $host_id = null,
                            $host_type = null,
                            THOR_HostModel $host = null,
                            //$is_dirty = null,
                            $is_active = null,
                            $created_date = null,
                            $last_edited = null,
                            $owner = null,
                            $validMetadataKeys = array(),
                            $metadata = array(),
                            // $accessgroups = array(),
                            THOR_EntityModel $priorVersion = null)
    {

        $this->set_entity_id($entity_id);
        $this->set_host_id($host_id);
        $this->set_host_type($host_type);
        $this->set_host($host);
        $this->set_is_active($is_active);
        $this->set_created_date($created_date);
        $this->set_last_edited($last_edited);
        $this->set_owner($owner);
        $this->set_validMetadataKeys($validMetadataKeys);
        $this->set_metadata($metadata);
        // $this->set_accessgroups($accessgroups);
        $this->set_priorVersion($priorVersion);
        /*
        if(isset($entity_id) && is_numeric($entity_id))
        {
            $this->entity_id = $entity_id;
        }
        if(isset($is_active) && is_bool($is_active))
        {
            $this->is_active = $is_active;
        }
        else
        {
            $this->is_active = 1;
        }
        if(isset($created_date) && is_string($created_date))
        {
            $this->created_date = $created_date;
        }
        else
        {
            $this->created_date = date('Y-m-d H:i:s');
        }
        if(isset($last_edited) && is_string($last_edited))
        {
            $this->last_edited = $last_edited;
        }
        else
        {
            $this->last_edited = date('Y-m-d H:i:s');
        }
        if(isset($owner))
        {
            $this->owner = $owner;
        }
        if(isset($host_id) && is_numeric($host_id))
        {
            $this->host_id = $host_id;
        }
        if(isset($host_type) && is_string($host_type))
        {
            $this->host_type = $host_type;
        }
        if(isset($host))
        {
            $this->host = $host;
        }
        */


    }


    public function get_entity_id() {
        return $this->entity_id;
    }
    public function set_entity_id($entity_id) {

            $this->entity_id = $entity_id;

    }


    public function get_owner() {
        return $this->owner;
    }
    public function set_owner($owner) {
        $this->owner = $owner;
    }

    public function set_is_active($is_active) {
        $this->is_active = $is_active;
    }


    public function get_is_active() {
        return $this->is_active;
    }

    public function get_created_date() {
        return $this->created_date;
    }
    public function set_created_date($created_date) {
        if(is_string($created_date))
        {
            $this->created_date = $created_date;
        }
    }

    public function get_last_edited() {
        return $this->last_edited;
    }
    public function set_last_edited($last_edited) {
        if(is_string($last_edited))
        {
            $this->last_edited = $last_edited;
        }
    }


    public function get_host_id() {
        return $this->host_id;
    }
    public function set_host_id($host_id) {
            $this->host_id = $host_id;
    }

    public function get_host_type() {
        return $this->host_type;
    }
    public function set_host_type($host_type) {
        if(is_string($host_type))
        {
            $this->host_type = $host_type;
        }
    }

    public function get_host() {
        return $this->host;
    }
    public function set_host($host) {
        $this->host = $host;
    }

    public function get_validMetadataKeys() {
        return $this->validMetadataKeys;
    }

    public function set_validMetadataKeys($validMetadataKeys) {
        $this->validMetadataKeys = $validMetadataKeys;
    }

    public function get_metadata() {
        return $this->metadata;
    }
    public function set_metadata($metadata) {
        $this->metadata = $metadata;
    }

    // public function get_accessgroups() {
    //     return $this->accessgroups;
    // }

    // public function set_accessgroups($accessgroups) {
    //     $this->accessgroups = $accessgroups;
    // }

    public function get_priorVersion() {
        if(!isset($this->priorVersion))
        {
            $this->priorVersion = $this;
        }
        return $this->priorVersion;
    }

    public function set_priorVersion($priorVersion) {
        $this->priorVersion = $priorVersion;
    }



    public function get_metadata_at_key($key)
    {
        $metadata = $this->metadata;
        if(array_key_exists($key, $metadata))
        {
            return $metadata[$key];
        }
        else
        {
            return false;
        }
    }

    public function set_metadata_at_key($key, $data)
    {
        $metadata = $this->metadata;
        $metadata[$key] = $data;
    }
    public function __set($name, $value)
    {
        $this->metadata[$name] = $value;
    }

    public function __get($name)
    {

        if (array_key_exists($name, $this->metadata)) {
            return $this->metadata[$name];
        }
        else
        {
            return false;
        }
        /*
        $trace = debug_backtrace();
        trigger_error(
            'Undefined property via __get(): ' . $name .
            ' in ' . $trace[0]['file'] .
            ' on line ' . $trace[0]['line'],
            E_USER_NOTICE);
        return null;
         *
         */
    }

    public function __isset($name)
    {
        return isset($this->metadata[$name]);
    }

    /**  As of PHP 5.1.0  */
    public function __unset($name)
    {
        unset($this->metadata[$name]);
    }






    /*
    public function returnPropertiesForAudit($prefix = null) {
        $returnMe = array();
        foreach($this as $key => $value)
        {
            //if($key != 'title' && $key != 'description')
            if(isset($prefix))
            {
                $returnMe[$prefix.'___'.$key] = $value;
            }
            else
            {
                $returnMe[$key] = $value;
            }

        }
        return $returnMe;
    }
    */





}

?>
