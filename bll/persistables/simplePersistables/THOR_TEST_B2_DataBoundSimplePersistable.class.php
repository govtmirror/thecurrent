<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of THOR_TEST_B2_DataBoundSimplePersistable
 *
 * @author Dan Kottke
 */
class THOR_TEST_B2_DataBoundSimplePersistable extends THOR_DataBoundSimplePersistable{

    public function __construct($keyValue = null) {

        $sourceKeys = unserialize(TEST_B2_DBFIELDS);
        $database = DB_NAME;
        $table = TEST_B2;
        $keyName = GLOBAL_PRIMARY_KEY_NAME;
        $isDirty = true;

        parent::__construct($sourceKeys, $database, $table, $keyName, $keyValue, $isDirty);
    }

}

?>
