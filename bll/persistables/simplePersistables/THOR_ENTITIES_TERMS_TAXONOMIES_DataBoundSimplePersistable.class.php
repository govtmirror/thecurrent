<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of THOR_ENTITIES_TAXONOMIES_DataBoundSimplePersistable
 *
 * @author Optimus
 */
class THOR_ENTITIES_TERMS_TAXONOMIES_DataBoundSimplePersistable extends THOR_DataBoundSimplePersistable{

    public function __construct($keyValue = null) {

        $sourceKeys = unserialize(ENTITIES_TERMS_TAXONOMIES_DBFIELDS);
        $database = DB_NAME;
        $table = ENTITIES_TERMS_TAXONOMIES;
        $keyName = GLOBAL_PRIMARY_KEY_NAME;
        $isDirty = true;

        parent::__construct($sourceKeys, $database, $table, $keyName, $keyValue, $isDirty);
    }

}

?>
