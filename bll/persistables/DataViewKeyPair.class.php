<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DataViewKeyPair
 *
 * @author KottkeDP
 */
class DataViewKeyPair {
    protected $keyOne;
    protected $memIDOne;
    protected $keyTwo;
    protected $memIDTwo;
    protected $isOnePrime;
    
    function __construct($keyOne, $memIDOne, $keyTwo, $memIDTwo, $isOnePrime) {
        $this->keyOne = $keyOne;
        $this->memIDOne = $memIDOne;
        $this->keyTwo = $keyTwo;
        $this->memIDTwo = $memIDTwo;
        $this->isOnePrime = $isOnePrime;
    }

    
    public function get_keyOne() {
        return $this->keyOne;
    }

    public function set_keyOne($keyOne) {
        $this->keyOne = $keyOne;
    }

    public function get_memIDOne() {
        return $this->memIDOne;
    }

    public function set_memIDOne($memIDOne) {
        $this->memIDOne = $memIDOne;
    }

    public function get_keyTwo() {
        return $this->keyTwo;
    }

    public function set_keyTwo($keyTwo) {
        $this->keyTwo = $keyTwo;
    }

    public function get_memIDTwo() {
        return $this->memIDTwo;
    }

    public function set_memIDTwo($memIDTwo) {
        $this->memIDTwo = $memIDTwo;
    }

    public function get_isOnePrime() {
        return $this->isOnePrime;
    }

    public function set_isOnePrime($isOnePrime) {
        $this->isOnePrime = $isOnePrime;
    }
    
    public function getParentMemID()
    {
        if($this->get_isOnePrime())
        {
            return $this->get_memIDTwo();
        }
        else
        {
            return $this->get_memIDOne();
        }
        
    }
    
    public function getChildMemID()
    {
        if(!$this->get_isOnePrime())
        {
            return $this->get_memIDTwo();
        }
        else
        {
            return $this->get_memIDOne();
        }
    }
    
    public function getPrimeKey()
    {
        if($this->get_isOnePrime())
        {
            return $this->get_keyOne();
        }
        else
        {
            return $this->get_keyTwo();
        }
    }
    
    public function getForeignKey()
    {
        if(!$this->get_isOnePrime())
        {
            return $this->get_keyOne();
        }
        else
        {
            return $this->get_keyTwo();
        }
    }
    
    

    
}

?>
