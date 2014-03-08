<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class TC_DashboardTabBuilder extends ViewModelBuilder {
    
    public function __construct( $id, $repo = null, $args = null) {
        $strat = new TC_RepositoryDashboardContainerStrategy();
        parent::__construct('TC_DashboardTab', $strat, $id, $repo, $args);
        unset($strat);
    }
    
    
    
}

?>
