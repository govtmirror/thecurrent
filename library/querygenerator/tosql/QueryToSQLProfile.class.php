<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of QueryToStringProfile
 *
 * @author Dan Kottke
 */
class QueryToSQLProfile {
    
     protected $hasParenthesis;
     protected $format;
     protected $fragment;
     protected $region;
     
     public function __construct($region, $hasParenthesis = null, $fragment = '', $format = null)
     {
         $this->set_format($format);
         $this->set_fragment($fragment);
         $this->set_hasParenthesis($hasParenthesis);
         $this->set_region($region);
     }
     
     public function get_hasParenthesis() {
         return $this->hasParenthesis;
     }

     public function set_hasParenthesis($hasParenthesis) {
         $this->hasParenthesis = $hasParenthesis;
     }

     public function get_format() {
         return $this->format;
     }

     public function set_format($format) {
         $this->format = $format;
     }

     public function get_fragment() {
         return $this->fragment;
     }

     public function set_fragment($fragment) {
         $this->fragment = $fragment;
     }

     public function get_region() {
         return $this->region;
     }

     public function set_region($region) {
         $this->region = $region;
     }




     
     
}

?>
