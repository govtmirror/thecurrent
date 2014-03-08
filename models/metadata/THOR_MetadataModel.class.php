<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Metadata
 *
 * @author KottkeDP
 */
class THOR_MetadataModel /*implements IAuditable*/{
    
    
    protected $metadata_id;
    
    protected $metadata_type;
    //protected $is_dirty;
    protected $is_active;
    protected $created_date;
    protected $last_edited;
    protected $owner;
    
    protected $entity_id;
    //protected $entity;    
    
    protected $title;
    protected $description;
    protected $data;
    
    protected $validMetadataKeys;
    protected $metadata;
    
    
    
    public function __construct(   
                            $metadata_id = null,
                            $metadata_type = null,
                            $title = null,
                            $description = null,
                            $data = null,
                            $entity_id = null, 
                            $is_active = null, 
                            $created_date = null, 
                            $last_edited = null,
                            $owner = null,
                            $validMetadataKeys = array(),
                            $metadata = array()) 
    {
        
        $this->set_metadata_id($metadata_id);
        $this->set_metadata_type($metadata_type);
        $this->set_title($title);
        $this->set_description($description);
        $this->set_data($data);
        
        $this->set_entity_id($entity_id);
        
        $this->set_is_active($is_active);
        $this->set_created_date($created_date);
        $this->set_last_edited($last_edited);
        $this->set_owner($owner);
        $this->set_validMetadataKeys($validMetadataKeys);
        $this->set_metadata($metadata);
    }
    
    
    
    public function get_metadata_id() {
        return $this->metadata_id;
    }

    public function set_metadata_id($metadata_id) {
        $this->metadata_id = $metadata_id;
    }

    public function get_metadata_type() {
        return $this->metadata_type;
    }

    public function set_metadata_type($metadata_type) {
        $this->metadata_type = $metadata_type;
    }

    public function get_is_active() {
        return $this->is_active;
    }

    public function set_is_active($is_active) {
        $this->is_active = $is_active;
    }

    public function get_created_date() {
        return $this->created_date;
    }

    public function set_created_date($created_date) {
        $this->created_date = $created_date;
    }

    public function get_last_edited() {
        return $this->last_edited;
    }

    public function set_last_edited($last_edited) {
        $this->last_edited = $last_edited;
    }

    public function get_owner() {
        return $this->owner;
    }

    public function set_owner($owner) {
        $this->owner = $owner;
    }

    public function get_entity_id() {
        return $this->entity_id;
    }

    public function set_entity_id($entity_id) {
        $this->entity_id = $entity_id;
    }

    public function get_title() {
        return $this->title;
    }

    public function set_title($title) {
        $this->title = $title;
    }

    public function get_description() {
        return $this->description;
    }

    public function set_description($description) {
        $this->description = $description;
    }

    public function get_data() {
        return $this->data;
    }

    public function set_data($data) {
        $this->data = $data;
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

        
            
      
    /*
    public function __set($name, $value)
    {        
        $this->properties[$name] = $value;
    }

    public function __get($name)
    {
                
        if (array_key_exists($name, $this->properties)) {
            return $this->properties[$name];
        }
        else
        {
            return false;
        }
        
    }

    public function __isset($name)
    {
        return isset($this->properties[$name]);
    }

    public function __unset($name)
    {
        unset($this->properties[$name]);
    }
    */
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
