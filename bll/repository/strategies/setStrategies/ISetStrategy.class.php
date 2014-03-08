<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author KottkeDP
 */
interface ISetStrategy {
    public function save(ISetParameterModel $param); //IPersistable $item = null, IParameterObject $params = NULL in most implementations
}

?>
