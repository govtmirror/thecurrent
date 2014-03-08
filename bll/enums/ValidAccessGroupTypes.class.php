<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ValidAccessGroupTypes
 *
 * @author KottkeDP
 */
class ValidAccessGroupTypes {

    //no read groups

    const NOBODY = "nobody"; //unique
    const VERSIONED = 'versioned';
    const PERSONAL_PUBLISHED = 'personal_published'; // one per user

    //read groups
    const EVERYONE = "everyone"; //unique
    const MANAGED = "managed";
    const VERSIONED_VERSIONREAD = 'versioned_versionread'; //one per user //in versioned group

    //edit groups

    const PERSONAL = "personal"; // one per user
    const MANAGED_ADMIN = 'managed_admin';
    const GLOBAL_ADMIN = 'global_admin'; // unique
    const VERSIONED_PUBLISHER = 'versioned_publisher'; //one per admin user in versioned group, contains draft


    //catalog READ groups
    const VERSIONED_MOSTRECENT = 'versioned_mostrecent'; //unique


}

?>
