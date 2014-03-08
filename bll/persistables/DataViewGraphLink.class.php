<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DataViewGraphLink
 *
 * @author Optimus
 */
class DataViewGraphLink {
    //protected $memID1;
    protected $memID;
    protected $keyPairs;
    protected $joinType;
    
    public function __construct($memID, array $keyPairs, $joinType) {
       // $this->memID1 = $memID1;
        $this->memID = $memID;
        $this->keyPairs = $keyPairs;
        $this->joinType = $joinType;
    }

    
    

    public function get_memID() {
        return $this->memID;
    }

    public function set_memID($memID) {
        $this->memID = $memID;
    }

    public function get_keyPairs() {
        return $this->keyPairs;
    }

    public function set_keyPairs(array $keyPairs) {
        $this->keyPairs = $keyPairs;
    }

    public function get_joinType() {
        return $this->joinType;
    }

    public function set_joinType($joinType) {
        $this->joinType = $joinType;
    }


}

?>
