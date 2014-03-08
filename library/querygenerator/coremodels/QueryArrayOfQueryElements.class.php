<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of QueryArrayOfQueryElements
 *
 * @author Dan Kottke
 */
class QueryArrayOfQueryElements extends ArrayOf  implements IVerifiable, IOutputsToSQL, ITreeElement{
    protected $isVerified = false;
    protected $verificationErrors;
    
    public function isValidElement($value, $offset = null)
    {
        
        return ($value instanceof QueryElement || $value instanceof self);
    }
    
    public function convertOffsetValue($offset, $value)
    {
        if (is_array($value)) 
        {
            $value = new self($value);
        }
        return array($offset, $value);
    }
    public function get_isVerified() {
        return $this->isVerified;
    }

    public function get_verificationErrors() {
        return $this->verificationErrors;
    }

    
    public function writeVerificationError($value, $message = null)
    {
        $writeMe = "Verification failed with message: ". $message;
        $writeMe .= "\r\n";
        $writeMe .= "On object: " . var_export($value, true);
        $writeMe .= "\r\n";
        $this->verificationErrors[] = $writeMe;
    }

    public function verify($param = null) {
        foreach($this as $key => $value)
        {
            if(!$value->verify($param))
            {
                $this->isVerified = false;
                return 0;
            }
        }
        $this->isVerified = true;
        
    }
    
    public function toSQL($region = null) {
        $returnArr = array();
        foreach($this as $key => $value)
        {
            $returnArr[] = $value->toSQL($region);
        }
        return implode(",", $returnArr);
    }

    public function get_children($params = null) {
        return $this;
    }

    public function isTerminal($params = null) {
        return false;
    }

}

?>
