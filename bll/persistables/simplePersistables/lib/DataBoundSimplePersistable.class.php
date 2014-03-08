<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ValueModel
 *
 * @author optimus
 */
abstract class DataBoundSimplePersistable extends AnonymousValueModel implements IPersistable {

    protected $isDirty;
    //protected $isActive;
    protected $keyValue;
    protected $keyName;
    protected $inMemoryID;
    protected $nonAIKey;
    //protected $source;

    public function __construct($sourceKeys, /*$isActive = null,*/
                                $keyName = null,
                                $keyValue = null,
                                $isDirty = false,
                                $nonAIKey = false) {

        $this->set_keyName($keyName);
        $this->set_keyValue($keyValue);
        $this->set_isDirty($isDirty);
        $this->get_inMemoryID();
        $this->set_nonAIKey($nonAIKey);
        //$this->set_isActive($isActive);
        parent::__construct($sourceKeys);
    }



    public function __set($name, $value) {
        if($this->$name != $value)
        {
            $this->set_isDirty(true);
        }
        parent::__set($name, $value);
    }

    public function get_keyName() {
        return $this->keyName;
    }

    private function set_keyName($keyName) {
        $this->keyName = $keyName;
    }

    public function get_keyValue() {
        return $this->keyValue;
    }

    public function set_keyValue($keyValue) {
        if($this->get_keyValue() != $keyValue)
        {
            $this->set_isDirty(true);
        }
        $this->set_isDirty(true);
        $this->keyValue = $keyValue;
    }

    public function get_nonAIKey()
    {
        return $this->nonAIKey;
    }

    public function set_nonAIKey($nonAIKey)
    {
        $this->nonAIKey = $nonAIKey;
    }

    public function get_isDirty() {
        return $this->isDirty;
    }

    public function set_isDirty($isDirty) {
        $this->isDirty = $isDirty;
    }

    public function getUniqueReferenceKey() {
        return $this->get_inMemoryID();
    }

    public function get_inMemoryID() {
        if(!isset($this->inMemoryID))
        {
            if(function_exists('com_create_guid') === true)
            {
                $this->inMemoryID = trim(com_create_guid(), '{}');
            }
            else
            {
                $this->inMemoryID = sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));

            }

        }

        return $this->inMemoryID;
    }



            /*
    public function get_isActive() {
        return $this->isActive;
    }

    public function set_isActive($isActive) {
        $this->isActive = $isActive;
    }
    */
    //abstract public function save();

        // implementation of persistence



}

?>
