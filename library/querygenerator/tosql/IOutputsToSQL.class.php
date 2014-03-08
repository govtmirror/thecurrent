<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author Dan Kottke
 */
interface IOutputsToSQL {
    public function toSQL($region = null);
     //public function toSQL(QueryToSQLProfile $params);
}

?>
