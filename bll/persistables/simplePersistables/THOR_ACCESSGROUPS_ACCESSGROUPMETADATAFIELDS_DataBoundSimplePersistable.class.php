<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of THOR_ACCESSGROUPS_ACCESSGROUPMETADATAFIELDS_DataBoundSimplePersistable
 *
 * @author KottkeDP
 */
class THOR_ACCESSGROUPS_ACCESSGROUPMETADATAFIELDS_DataBoundSimplePersistable extends THOR_DataBoundSimplePersistable{
    
    public function __construct($keyValue = null) {
        
        $sourceKeys = unserialize(ACCESSGROUPS_ACCESSGROUPMETADATAFIELDS_DBFIELDS);
        $database = DB_NAME;
        $table = ACCESSGROUPS_ACCESSGROUPMETADATAFIELDS;
        $keyName = GLOBAL_PRIMARY_KEY_NAME;
        $isDirty = true;
        
        parent::__construct($sourceKeys, $database, $table, $keyName, $keyValue, $isDirty);
    }
    
}

?>
