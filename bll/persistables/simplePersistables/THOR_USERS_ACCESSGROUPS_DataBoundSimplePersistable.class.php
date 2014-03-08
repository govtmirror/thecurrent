<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of THOR_USERS_ACCESSGROUPS_DataBoundSimplePersistable
 *
 * @author KottkeDP
 */
class THOR_USERS_ACCESSGROUPS_DataBoundSimplePersistable extends THOR_DataBoundSimplePersistable{
    
    public function __construct($keyValue = null) {
        
        $sourceKeys = unserialize(USERS_ACCESSGROUPS_DBFIELDS);
        $database = DB_NAME;
        $table = USERS_ACCESSGROUPS;
        $keyName = GLOBAL_PRIMARY_KEY_NAME;
        $isDirty = true;
        
        parent::__construct($sourceKeys, $database, $table, $keyName, $keyValue, $isDirty);
    }
    
}

?>
