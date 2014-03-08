<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TC_RepositoryDashboardSourceStrategy
 *
 * @author Optimus
 */
class TC_RepositoryDashboardSourceStrategy extends TC_RepositoryStrategy{
    public function __construct() {
        $getStrategy = new TC_THOR_GetSourcesForUserDashboardView_GetRepo();
        $setStrategy = new TC_THOR_SetSourcesForUserDashboardView_SetRepo();
        parent::__construct($getStrategy, $setStrategy);
    }
}

?>
