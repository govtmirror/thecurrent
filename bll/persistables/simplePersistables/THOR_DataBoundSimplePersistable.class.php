<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of THOR_DataBoundSimplePersistable
 *
 * @author severus
 */
abstract class THOR_DataBoundSimplePersistable extends MySQLDataBoundSimplePersistable{

    public function __construct($sourceKeys, $database, $table, $keyName, $keyValue = null, $isDirty = null, $nonAIKey = false) {
        //takes primary keys out of ordinary settable keys
        foreach($sourceKeys as $key => $value)
        {
            if($key == $keyName)
            {
                unset($sourceKeys[$key]);
            }
        }
        // echo $table;
        // echo '---';
        // echo $this->getUniqueReferenceKey();
        // echo "\r\n";
        parent::__construct($sourceKeys, $database, $table, $keyName, $keyValue, $isDirty, $nonAIKey);
    }
    /*
    public function __construct($keyValue = null) {

        $sourceKeys = unserialize(ENTITIES_DBFIELDS);
        $database = DB_NAME;
        $table = ENTITIES;
        $keyName = GLOBAL_PRIMARY_KEY_NAME;

        //handle isDirty

        parent::__construct($sourceKeys, $database, $table, $keyName, $keyValue, $isDirty);
    }*/
}

?>
