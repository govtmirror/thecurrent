<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SB_TheCurrentBuzzWidget
 *
 * @author optimus
 */
class TC_SB_TheCurrentBuzzWidget extends TC_SB_SidebarWidget{
    public function __construct() {        
        parent::__construct('The Current Buzz', '$iconURL', 'TC_GenericRSSSource', 6, array('link'=>'http://cas.state.gov/thecurrentbuzz/feed/'),'JSServerDiverted_CAS');
    }
}

?>
