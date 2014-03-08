<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of THOR_AccessGroupModel
 *
 * @author KottkeDP
 */
class THOR_AccessGroupModel {
    
    protected $accessGroup_ID;
    protected $accessGroup_Type;
    protected $accessGroup_TypeID;
    
    public function __construct($accessGroup_ID, $accessGroup_Type, $accessGroup_TypeID) {
        $this->set_accessGroup_ID($accessGroup_ID);// = $accessGroup_ID;
        $this->set_accessGroup_Type($accessGroup_Type);// = $accessGroup_Type;
        $this->set_accessGroup_TypeID($accessGroup_TypeID);// = $accessGroup_TypeID;
    }
    
    public function get_accessGroup_ID() {
        return $this->accessGroup_ID;
    }

    public function set_accessGroup_ID($accessGroup_ID) {
        $this->accessGroup_ID = $accessGroup_ID;
    }

    public function get_accessGroup_Type() {
        return $this->accessGroup_Type;
    }

    public function set_accessGroup_Type($accessGroup_Type) {
        $this->accessGroup_Type = $accessGroup_Type;
    }

    public function get_accessGroup_TypeID() {
        return $this->accessGroup_TypeID;
    }

    public function set_accessGroup_TypeID($accessGroup_TypeID) {
        $this->accessGroup_TypeID = $accessGroup_TypeID;
    }



    
}

?>
