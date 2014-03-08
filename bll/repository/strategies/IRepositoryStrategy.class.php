<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author KottkeDP
 */
interface IRepositoryStrategy {
    
    public function get(IGetParameterModel $param);
    //public function getOne(IGetParameterModel $param);
    //public function getIDs(IGetParameterModel $param);
    public function save(ISetParameterModel $param);
    
}

?>
