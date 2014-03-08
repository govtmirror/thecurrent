<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TC_RepositoryCatalogPageStrategy
 *
 * @author Optimus
 */
class TC_RepositoryCatalogPageStrategy extends TC_RepositoryStrategy{

    public function __construct() {
        $getStrategy = new TC_THOR_GetContainersForPublicCatalogView_GetRepo();
        $setStrategy = null;
        parent::__construct($getStrategy, $setStrategy);
    }

}

?>
