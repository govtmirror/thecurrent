<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TC_THOR_WIDGETPARAMFIELDS_DataBoundSimplePersistable
 *
 * @author KottkeDP
 */
class TC_THOR_WIDGETPARAMFIELDS_DataBoundSimplePersistable  extends THOR_DataBoundSimplePersistable{
    public function __construct($keyValue = null) {
        
        $sourceKeys = unserialize(WIDGETPARAMFIELDS_DBFIELDS);
        $database = DB_NAME;
        $table = WIDGETPARAMFIELDS;
        $keyName = GLOBAL_PRIMARY_KEY_NAME;
        $isDirty = true;
        
        parent::__construct($sourceKeys, $database, $table, $keyName, $keyValue, $isDirty);
    }
}

?>
