<?php if (!(preg_match("/chrome/i", $_SERVER['HTTP_USER_AGENT']))) { ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php } ?>
<?php
                      
        /*below goes on every page if you want it to work!*/

	if(!isset($_SERVER['DOCUMENT_ROOT'])){ if(isset($_SERVER['SCRIPT_FILENAME'])){
$_SERVER['DOCUMENT_ROOT'] = str_replace( '\\', '/', substr($_SERVER['SCRIPT_FILENAME'], 0, 0-strlen($_SERVER['PHP_SELF'])));
}; };
if(!isset($_SERVER['DOCUMENT_ROOT'])){ if(isset($_SERVER['PATH_TRANSLATED'])){
$_SERVER['DOCUMENT_ROOT'] = str_replace( '\\', '/', substr(str_replace('\\\\', '\\', $_SERVER['PATH_TRANSLATED']), 0, 0-strlen($_SERVER['PHP_SELF'])));
}; };

        require_once ($_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'library' . DIRECTORY_SEPARATOR . 'bootstrap.php');        
        //require_once (ROOT . DS . 'header.php');     
        //$strat = new TC_RepositoryDashboardContainerStrategy();
        //$repo = new Repository($strat);
        //$auth_ID = TC_Authenticator::getUserID();
        //$entity = array_pop($repo->getOne(SYSTEM_USER_ID, new TC_DefaultAccessProfile(), 1, array('overrideUAC' => true)));
        //echo $entity->get_host_id();
        TC_Utility::initializeTheCurrent();
        
        
        //render(AJAX_PATH,'loadDashboardNav.php', array('user_ID' => $auth_ID));
        /*
        $strat = new TC_DashboardTabRepoStrategy();
        $repo = new Repository($strat);
        
        $dbc = new TC_DashboardTabGetStrategy();
        $accessProfile = new TC_DefaultAccessProfile();
        //TC_PersistenceUtility::initializeNewUser($auth_ID);
        TC_PersistenceUtility::initializeTheCurrent();
        */
        //echo count(TC_PersistenceUtility::getActiveContainerIDsForUser($auth_ID, new TC_DefaultAccessProfile()));
        //echo $dbc->get_uacGroupRoleMasterQuery() . ' WHERE ' . $dbc->getUACEntitiesFilter($auth_ID, new TC_DefaultAccessProfile(), 1, 1);
        //echo $dbc->getUACEntitiesFilter($auth_ID, new TC_DefaultAccessProfile(), 1, 1);
        //$dbc->fixPriority(SYSTEM_USER_ID, new TC_DefaultAccessProfile());
        //echo count($dbc->getIDs($auth_ID, new TC_DefaultAccessProfile()));
        
        /*
        $query = "SELECT ".
        DB_NAME.".".pullIndex($dbc->get_entities(), 'id')." AS entity_id".", ".
        DB_NAME.".".pullIndex($dbc->get_metadata(), 'id')." AS meta_id".", ".
        DB_NAME.".".pullIndex($dbc->get_containers(), 'title')." AS title".", ".
        DB_NAME.".".pullIndex($dbc->get_metadata(), 'data')." AS data".
        " FROM ".DB_NAME.".".ENTITIES.
        " INNER JOIN ".DB_NAME.".".ENTITYTYPES.
        " ON ".DB_NAME.".".pullIndex($dbc->get_entities(), 'type_id')." = ".DB_NAME.".".pullIndex($dbc->get_entitytypes(), 'id').            
        " INNER JOIN ".DB_NAME.".".CONTAINERS.
        " ON ".DB_NAME.".".pullIndex($dbc->get_containers(), 'id')." = ".DB_NAME.".".pullIndex($dbc->get_entities(), 'row_id').
                
        " LEFT JOIN ".DB_NAME.".".METADATA.
        " ON ".DB_NAME.".".pullIndex($dbc->get_metadata(), 'entity_id')." = ".DB_NAME.".".pullIndex($dbc->get_entities(), 'id').
        " LEFT JOIN ".DB_NAME.".".METADATATYPES.
        " ON ".DB_NAME.".".pullIndex($dbc->get_metadatatypes(), 'id')." = ".DB_NAME.".".pullIndex($dbc->get_metadata(), 'type_id').
        " WHERE ".DB_NAME.".".pullIndex($dbc->get_metadata(), 'id')." = NULL"
        ;
         * 
         */
        //echo $query;
        /*
        $updateArr = array();
        $dbc->get_dataSource()->query($query); 
        while($row = $dbc->get_dataSource()->fetch())
        {
            //if(!isset($row->meta_id))
            //{
                array_push($updateArr, $row->entity_id);
                
            //}
        }
        
        foreach($updateArr as $key => $value)
        {
            //assume max checks against MAX_DASHBOARD_TABS_PER_GROUP have been made upon entity insert
            $dbc->insertMetadata($value, 
                                        $metadatatype_id, 
                                        1, 
                                        $user_id, 
                                        ValidMetadataTypes::DASHBOARD_PRIORITY, 
                                        $maxPriority + 1, 
                                        "Allows one to order dashboard tabs");
            $maxPriority++;
        }
        
        
        echo $maxPriority;
        */
        /*
        $universalGroupID = $strat->getUniversalAccessGroup(SYSTEM_USER_ID);
        
        $statefeedstab = new TC_DashboardTab('State Feeds', 'Global State Feeds Tab', ValidDashboardTabViews::STANDARD);
        $statefeeds = new TC_DashboardTab_Entity(null, null, $statefeedstab, 1, 1, date('Y-m-d H:i:s'), date('Y-m-d H:i:s'), SYSTEM_USER_ID, 1);
        $repo->loadEntity($statefeeds);
        
        $repo->save(SYSTEM_USER_ID, $universalGroupID);
        */
        
        /*
        $auth_ID =  TC_Authenticator::getUserID(); 
        //echo $auth_ID;
        //TC_PersistenceUtility::initializeNewUser($auth_ID);
        //$accessgroup_id = TC_PersistenceUtility::getPersonalGroupID($auth_ID); 
        //echo $accessgroup_id;
        TC_PersistenceUtility::initializeTheCurrent();
        //$dbc = new TC_DashboardTabGetStrategy();
        //$dbc->fixPriority($auth_ID, new TC_DefaultAccessProfile());
        
        //echo $dbc->get_uacUserRoleMasterQuery();
        //echo $dbc->getQuery();
        //echo TC_PersistenceUtility::getActiveContainerIDsForUser($auth_ID, new TC_DefaultAccessProfile());
        //render(AJAX_PATH,'loadDashboardNav.php', array('user_ID' => $auth_ID));
        */
        ?>