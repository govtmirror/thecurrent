<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MySQLConfig
 *
 * @author kottkedp
 */

//require_once 'MySQLAdapter.class.php';

class MySQLConfig implements IDatasourceConnector{
    
    //private $connection;
    
    //private $host;
    //private $username;
    //private $password;
    //private $database;
    
    public static function dsConnect()
    {
        $db = MySQLAdapter::getInstance(array(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME));
        return $db;
    }
            
    
    public static function getTables()
    {   
        $returnMe = array();
        $db = self::dsConnect();
        $db->query('SHOW TABLES FROM '.DB_NAME);
        while($row = $db->fetch())
        {
            $toLowerFName = 'Tables_in_' . strtolower(DB_NAME);
            array_push($returnMe, $row->$toLowerFName);
        }
        return $returnMe;        
    }
      
    public static function getFields($table)
    {   
        $returnMe = array();
        $db = self::dsConnect();
        $db->query('SHOW COLUMNS FROM '.DB_NAME.'.'.$table);
        while($row = $db->fetch())
        {
            $returnMe[$row->Field] = $table.'.'.$row->Field;
        }
        return $returnMe;        
    }
    
    public static function getFieldsNoTableName($table)
    {   
        $returnMe = array();
        $db = self::dsConnect();
        $db->query('SHOW COLUMNS FROM '.DB_NAME.'.'.$table);
        while($row = $db->fetch())
        {
            $returnMe[$row->Field] = $row->Field;
        }
        return $returnMe;        
    }
    
    public static function globalResetAll()
    {
        //THIS FUNCTION IS DANGEROUS, NEVER EVER EVER EVER CALL IT!        
        $db = self::dsConnect();
        $db->query('SHOW TABLES');
        while($row = $db->fetch())
        {
            $toLowerFName = 'Tables_in_' . DB_NAME;
            mysql_query("TRUNCATE " . $row->$toLowerFName);
            //$returnMe[$row->Field] = $table.'.'.$row->Field;
        }
        return true;    
        
        
    }
    
}

?>
