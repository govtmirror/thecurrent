<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of User
 *
 * @author KottkeDP
 */
class User extends THOR_HostModel{
    protected $user_id;
    protected $email;
    protected $user_login;
    protected $name;
    
    public function __construct($user_id, $email = null, $user_login = null, $name = null, $title = null, $description = null) {
        $this->user_id = $user_id;
        $this->email = $email;
        $this->user_login = $user_login;
        $this->name = $name;
        parent::__construct($title, $description);
    }
    
    public function get_user_id() {
        return $this->user_id;
    }

    public function set_user_id($user_id) {
        $this->user_id = $user_id;
    }

    public function get_email() {
        return $this->email;
    }

    public function set_email($email) {
        $this->email = $email;
    }

    public function get_user_login() {
        return $this->user_login;
    }

    public function set_user_login($user_login) {
        $this->user_login = $user_login;
    }

    public function get_name() {
        return $this->name;
    }

    public function set_name($name) {
        $this->name = $name;
    }

        
    public function returnProperties() {
        $returnMe = array();
        foreach($this as $key => $value)
        {
            //if($key != 'title' && $key != 'description')
                $returnMe[$key] = $value;
        }
        return $returnMe;
    }

    
    

}

?>
