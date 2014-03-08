<?php

/**
 * Description of TC_CorridorUserSource_Builder
 *
 * @author KottkeDP
 */
class TC_CorridorUserSource_Builder extends TC_DashboardSourceBuilder {
    
    public function __construct($id, $repo = null, $args = null) {
        
        parent::__construct('TC_CorridorUserSource', $id, $repo, $args);
    }
    
}

?>
