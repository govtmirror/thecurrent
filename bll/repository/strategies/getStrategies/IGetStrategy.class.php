<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author KottkeDP
 */
interface IGetStrategy {
    public function get(IGetParameterModel $param); //IParameterObject $params = null, $domainCollection = null param in most implementations
    //public function getOne(IGetParameterModel $param); //IParameterObject $params = null, $domainCollection = null param in most implementations
    //public function getIDs(IGetParameterModel $param); //IParameterObject $params = null, $domainCollection = null param in most implementations
}

?>
