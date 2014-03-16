<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TC_DefaultAccessProfile
 *
 * @author Dan Kottke
 */
class TC_DefaultAccessProfile extends AccessProfile{

    public function __construct() {

        parent::__construct(ValidAccessProfiles::DASHBOARD_READ, ValidAccessTypes::VIEW, ValidAccessContexts::DASHBOARD, ValidAccessLevels::BASIC_ACCESS);
    }


}

?>
