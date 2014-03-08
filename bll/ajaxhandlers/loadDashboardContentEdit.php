<?php
/*
Inputs
-$loadDashboardContentEdit_user_ID
-$loadDashboardContentEdit_entity_ID

Outputs ~~~ DashboardTabEdit.php
-entity_ID
-
*/
/*below goes on every page if you want it to work!*/

if(!isset($_SERVER['DOCUMENT_ROOT'])){ if(isset($_SERVER['SCRIPT_FILENAME'])){
$_SERVER['DOCUMENT_ROOT'] = str_replace( '\\', '/', substr($_SERVER['SCRIPT_FILENAME'], 0, 0-strlen($_SERVER['PHP_SELF'])));
}; };
if(!isset($_SERVER['DOCUMENT_ROOT'])){ if(isset($_SERVER['PATH_TRANSLATED'])){
$_SERVER['DOCUMENT_ROOT'] = str_replace( '\\', '/', substr(str_replace('\\\\', '\\', $_SERVER['PATH_TRANSLATED']), 0, 0-strlen($_SERVER['PHP_SELF'])));
}; };


require_once ($_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'library' . DIRECTORY_SEPARATOR . 'bootstrap.php');


if(isset($_REQUEST["user_ID"]) && is_numeric($_REQUEST["user_ID"])) {$loadDashboardContentEdit_user_ID = (int)$_REQUEST["user_ID"];}
//if(isset($_REQUEST["accessgroup_ID"]) && is_numeric($_REQUEST["accessgroup_ID"])) {$loadDashboardContentEdit_accessgroup_ID = (int)$_REQUEST["accessgroup_ID"];}
if(isset($_REQUEST["entity_ID"]) && is_numeric($_REQUEST["entity_ID"])) {$loadDashboardContentEdit_entity_ID = (int)$_REQUEST["entity_ID"];}
//if(isset($_REQUEST["model_ID"]) && is_numeric($_REQUEST["model_ID"])) {$loadDashboardContentEdit_model_ID = (int)$_REQUEST["model_ID"];}

        //$dashboardStrat = new DashboardStrategy();
    if(!isset($loadDashboardContentEdit_user_ID))
    {
        $loadDashboardContentEdit_user_ID_array = TC_Authenticator::getUserIDAndInitialize();
        $loadDashboardContentEdit_user_ID = $loadDashboardContentEdit_user_ID_array[0];
    }
    if(isset($loadDashboardContentEdit_user_ID) && $loadDashboardContentEdit_user_ID == 0)
    {
        throw new Exception("Cannot edit without Corridor authentication");
    }
    elseif(isset($loadDashboardContentEdit_user_ID))
    {
	    	$showPublish = false;
	    	$showUnsub = false;
	    	$showClone = false;


        $accessprofile = new AccessProfile(ValidAccessProfiles::DASHBOARD_EDIT, ValidAccessTypes::EDIT, ValidAccessContexts::DASHBOARD, ValidAccessLevels::BASIC_ACCESS);
        $accessprofileUnsub = new AccessProfile(ValidAccessProfiles::DASHBOARD_UNSUBSCRIBE, ValidAccessTypes::UNSUBSCRIBE, ValidAccessContexts::DASHBOARD, ValidAccessLevels::BASIC_ACCESS);
        $accessprofilePub = new AccessProfile(ValidAccessProfiles::DASHBOARD_PUBLISH, ValidAccessTypes::PUBLISH, ValidAccessContexts::DASHBOARD, ValidAccessLevels::BASIC_ACCESS);
        $accessprofileClone = new AccessProfile(ValidAccessProfiles::DASHBOARD_CLONE, ValidAccessTypes::_CLONE, ValidAccessContexts::DASHBOARD, ValidAccessLevels::BASIC_ACCESS);

        $containers = TC_Utility::getActiveContainersForUser($loadDashboardContentEdit_user_ID, $accessprofile);
        $containersPub = TC_Utility::getActiveContainersForUser($loadDashboardContentEdit_user_ID, $accessprofilePub);
        $containersUnsub = TC_Utility::getActiveContainersForUser($loadDashboardContentEdit_user_ID, $accessprofileUnsub);
        $containersClone = TC_Utility::getActiveContainersForUser($loadDashboardContentEdit_user_ID, $accessprofileClone);

        if(empty($containers))
        {
            $loadDashboardContentEdit_entity_ID = null;
            $loadDashboardContentEdit_model_ID = null;
        }
        else
        {
            $tempEntity = getEntityFromRepoPool($loadDashboardContentEdit_entity_ID, $containers, 'get_entity_id');
            if(!(isset($loadDashboardContentEdit_entity_ID) && $tempEntity))
            {

                    $tempEntity = array_shift($containers);
                    $loadDashboardContentEdit_entity_ID = $tempEntity->get_entity_id();
                    $loadDashboardContentEdit_model_ID = $tempEntity->get_host_id();

                    //$loadDashboardContentEdit_entity_ID = array_shift(array_keys($containers));


            }
            else
            {
                // if(!isset($loadDashboardContentEdit_model_ID))
                // {
                    //$tempEntity = $containers[$loadDashboardContentEdit_entity_ID];
                    $loadDashboardContentEdit_model_ID = $tempEntity->get_host_id();
                // }
            }

            if(getEntityFromRepoPool($loadDashboardContentEdit_entity_ID, $containersPub, 'get_entity_id')){
                $showPublish = true;
            }
            if(getEntityFromRepoPool($loadDashboardContentEdit_entity_ID, $containersUnsub, 'get_entity_id')){
                $showUnsub = true;
            }
            if(getEntityFromRepoPool($loadDashboardContentEdit_entity_ID, $containersClone, 'get_entity_id')){
                $showClone = true;
            }
        }
    }






    //if(isset($containers)){unset($containers);}
//$logID = logTiming(null,"test",null,null,1);
    render(CONTAINER_EDIT_PATH,
            'DashboardTabEdit.php',
            array('entity_ID' => $loadDashboardContentEdit_entity_ID,
                'user_ID' => $loadDashboardContentEdit_user_ID,
                'model_ID' => $loadDashboardContentEdit_model_ID,
                'entity' => $tempEntity,
                'showPublish' => $showPublish,
                'showUnsub' => $showUnsub,
                'showClone' => $showClone

            )
    );
//logTiming(null, null, 1, $logID);
    /*
if(isset($loadDashboardContentEdit_user_ID)){unset($loadDashboardContentEdit_user_ID);}
if(isset($loadDashboardContentEdit_entity_ID)){unset($loadDashboardContentEdit_entity_ID);}
if(isset($loadDashboardContentEdit_model_ID)){unset($loadDashboardContentEdit_model_ID);}
*/


?>
