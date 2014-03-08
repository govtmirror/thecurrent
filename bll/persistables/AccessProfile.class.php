<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AccessProfile
 *
 * @author KottkeDP
 */
class AccessProfile {
    private $title;
    private $accessType;
    private $accessContext;
    private $accessLevel;
    
    function __construct($title, $accessType, $accessContext, $accessLevel /*= null*/) {
        
        $this->title = $title;
        $this->accessType = $accessType;
        $this->accessContext = $accessContext;
        //if(isset($accessLevel))
        //{
            $this->accessLevel = $accessLevel;
        //}
    }
    
    public function get_title() {
        return $this->title;
    }

    public function set_title($title) {
        $this->title = $title;
    }

    public function get_accessType() {
        return $this->accessType;
    }

    public function set_accessType($accessType) {
        $this->accessType = $accessType;
    }

    public function get_accessContext() {
        return $this->accessContext;
    }

    public function set_accessContext($accessContext) {
        $this->accessContext = $accessContext;
    }

    public function get_accessLevel() {
        return $this->accessLevel;
    }

    public function set_accessLevel($accessLevel) {
        $this->accessLevel = $accessLevel;
    }



}

?>
