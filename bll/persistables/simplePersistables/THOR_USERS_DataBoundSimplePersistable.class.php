<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of THOR_USERS_DataBoundSimplePersistable
 *
 * @author KottkeDP
 */
class THOR_USERS_DataBoundSimplePersistable extends MySQLDataBoundSimplePersistable{

    public function __construct($keyValue = null) {

        $sourceKeys = unserialize(USERS_DBFIELDS);
        $database = DB_NAME;
        $table = USERS;
        $keyName = GLOBAL_PRIMARY_KEY_NAME;
        $isDirty = true;

        parent::__construct($sourceKeys, $database, $table, $keyName, $keyValue, $isDirty, true);
    }

}


?>
