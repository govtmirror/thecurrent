<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TC_RepositoryStrategy
 *
 * @author KottkeDP
 */
class TC_RepositoryStrategy  extends RepositoryStrategy{
    public function __construct(GetStrategy $getStrategy = null, SetStrategy $setStrategy = null) {
        
        $ds = MySQLConfig::dsConnect();
        parent::__construct($getStrategy, $setStrategy, $ds);
    }
}

?>
