<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of THOR_TEST_SECRETBASEMENT2_DataBoundSimplePersistable
 *
 * @author severus
 */
class THOR_TEST_SECRETBASEMENT2_DataBoundSimplePersistable extends THOR_DataBoundSimplePersistable{
    
    public function __construct($keyValue = null) {
        
        $sourceKeys = unserialize(TEST_SECRETBASEMENT2_DBFIELDS);
        $database = DB_NAME;
        $table = TEST_SECRETBASEMENT2;
        $keyName = GLOBAL_PRIMARY_KEY_NAME;
        $isDirty = true;
        
        parent::__construct($sourceKeys, $database, $table, $keyName, $keyValue, $isDirty);
    }
    
}

?>
