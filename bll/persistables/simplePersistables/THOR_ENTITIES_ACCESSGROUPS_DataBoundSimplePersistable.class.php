<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of THOR_Entities_AccessGroups_DataBoundSimplePersistable
 *
 * @author KottkeDP
 */
class THOR_ENTITIES_ACCESSGROUPS_DataBoundSimplePersistable extends THOR_DataBoundSimplePersistable{
    
    public function __construct($keyValue = null) {
        
        $sourceKeys = unserialize(ENTITIES_ACCESSGROUPS_DBFIELDS);
        $database = DB_NAME;
        $table = ENTITIES_ACCESSGROUPS;
        $keyName = GLOBAL_PRIMARY_KEY_NAME;
        $isDirty = true;
        
        parent::__construct($sourceKeys, $database, $table, $keyName, $keyValue, $isDirty);
    }
    
}

?>
