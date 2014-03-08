<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author KottkeDP
 */
interface IVerifiable {
    public function verify($param = null);
    public function get_isVerified();
    public function get_verificationErrors();
}

?>
