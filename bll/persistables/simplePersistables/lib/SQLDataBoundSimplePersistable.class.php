<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MySQLDataBoundValueModel
 *
 * @author KottkeDP
 */
abstract class SQLDataBoundSimplePersistable extends DataBoundSimplePersistable{

    protected $database;
    protected $table;
    protected $connection;
    //protected $source;

    public function __construct($sourceKeys,
                                $database = null,
                                $table = null,/* $isActive = null,*/
                                $keyName = null,
                                $keyValue = null,
                                $isDirty = null,
                                $connection = null,
                                $nonAIKey = false) {

        $this->set_database($database);
        $this->set_table($table);
        $this->set_connection($connection);

        parent::__construct($sourceKeys, /*$isActive,*/ $keyName, $keyValue, $isDirty, $nonAIKey);
    }



    public function get_database() {
        return $this->database;
    }

    private function set_database($database) {
        $this->database = $database;
    }

    public function get_table() {
        return $this->table;
    }

    private function set_table($table) {
        $this->table = $table;
    }

    public function get_connection() {
        return $this->connection;
    }

    public function set_connection($connection) {
        $this->connection = $connection;
    }

    public function get_source() {
        return $this->get_database() . "." . $this->get_table();
    }



        /*
    public function getUniqueReferenceKey() {

        $serializeMe = array($this->get_database(), $this->get_table());
        return serialize($serializeMe);
        //return $this->get_database() . "___" . $this->get_table();
    }
    */





}

?>
