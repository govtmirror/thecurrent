<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DashboardWidgetBuilder
 *
 * @author optimus
 */
abstract class TC_DashboardSourceBuilder extends ViewModelBuilder {
 
    public function __construct($modelType, $id, $repo = null, $args = null) {
        $strat = new TC_RepositoryDashboardSourceStrategy();
        parent::__construct($modelType, $strat, $id, $repo, $args);
        unset($strat);
    }   
    
    
    
    
}

?>
