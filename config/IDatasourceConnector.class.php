<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of IDatasourceConnector
 *
 * @author kottkedp
 */
interface IDatasourceConnector {
    
public static function dsConnect();
public static function getTables();
public static function getFields($table);

}

?>
