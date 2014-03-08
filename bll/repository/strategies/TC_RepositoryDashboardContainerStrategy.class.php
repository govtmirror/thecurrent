<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TC_RepositoryDashboardContainerStrategy
 *
 * @author Optimus
 */
class TC_RepositoryDashboardContainerStrategy extends TC_RepositoryStrategy{
    
    public function __construct() {
        $getStrategy = new TC_THOR_GetContainersForUserDashboardView_GetRepo();
        $setStrategy = new TC_THOR_SetContainersForUserDashboardView_SetRepo();
        parent::__construct($getStrategy, $setStrategy);
    }

}

?>
