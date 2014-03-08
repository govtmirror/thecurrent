<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Entity_SimpleDataBoundValueModel
 *
 * @author severus
 */
class THOR_ENTITIES_DataBoundSimplePersistable extends THOR_DataBoundSimplePersistable{
    
    public function __construct($keyValue = null) {
        
        $sourceKeys = unserialize(ENTITIES_DBFIELDS);
        $database = DB_NAME;
        $table = ENTITIES;
        $keyName = GLOBAL_PRIMARY_KEY_NAME;
        $isDirty = true;
        
        parent::__construct($sourceKeys, $database, $table, $keyName, $keyValue, $isDirty);
    }
    
}

?>
