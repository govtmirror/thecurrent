<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TC_Model
 *
 * @author KottkeDP
 */
abstract class TC_THOR_HostModel extends THOR_HostModel{
    protected $validFields;
    protected $fieldValuePairs;
    
    public function __construct($validFields = array(), $title = null, $description = null, $fieldValuePairs = array()) {
        
        $this->set_validFields($validFields);// = $validFields;
        $this->set_fieldValuePairs($fieldValuePairs);// = $fieldValuePairs;
        
        parent::__construct($title, $description);
    }
    
    
    public function get_validFields() {
        return $this->validFields;
    }

    public function set_validFields($validFields) {
        $this->validFields = $validFields;
    }

    public function get_fieldValuePairs() {
        return $this->fieldValuePairs;
    }

    public function set_fieldValuePairs($fieldValuePairs) {
        $this->fieldValuePairs = $fieldValuePairs;
    }

      

}

?>
