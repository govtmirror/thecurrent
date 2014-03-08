<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author KottkeDP
 */
interface IPersistable {
    
    public function get_keyName();
    public function get_keyValue();
    public function get_source();
    public function getUniqueReferenceKey();
    
    //public function set_isDirty($bool);
    public function get_isDirty();
    
    //public function set_isActive($bool);
    //public function get_isActive();
    
    public function save();
    public function populateFromKey($key);
    public function isPersistableAlreadyRecorded();
    //public function produceSetFromPropertyMatches($selfModel);
    //public function isPersistableAlreadyRecorded();
}

?>
