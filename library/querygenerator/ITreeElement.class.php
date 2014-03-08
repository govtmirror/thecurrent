<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author Dan Kottke
 */
interface ITreeElement {
    public function isTerminal($params = null);
    public function get_children($params = null);
    
}

?>
