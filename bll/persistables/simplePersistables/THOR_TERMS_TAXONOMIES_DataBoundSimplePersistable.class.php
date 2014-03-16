<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of THOR_TAXONOMIES_TAXONOMYGROUPS_DataBoundSimplePersistable
 *
 * @author Dan Kottke
 */
class THOR_TERMS_TAXONOMIES_DataBoundSimplePersistable extends THOR_DataBoundSimplePersistable{

    public function __construct($keyValue = null) {

        $sourceKeys = unserialize(TERMS_TAXONOMIES_DBFIELDS);
        $database = DB_NAME;
        $table = TERMS_TAXONOMIES;
        $keyName = GLOBAL_PRIMARY_KEY_NAME;
        $isDirty = true;

        parent::__construct($sourceKeys, $database, $table, $keyName, $keyValue, $isDirty);
    }

}

?>
