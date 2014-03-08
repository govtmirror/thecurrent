<?php
/*
Inputs
-$loadDashboardPreview_user_ID
-$loadDashboardPreview_entity_ID

Outputs ~~~ DashboardTab.php
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


if(isset($_REQUEST["user_ID"]) && is_numeric($_REQUEST["user_ID"])) {$loadDashboardPreview_user_ID = (int)$_REQUEST["user_ID"];}
//if(isset($_REQUEST["accessgroup_ID"]) && is_numeric($_REQUEST["accessgroup_ID"])) {$loadDashboardPreview_accessgroup_ID = (int)$_REQUEST["accessgroup_ID"];}
if(isset($_REQUEST["entity_ID"]) && is_numeric($_REQUEST["entity_ID"])) {$loadDashboardPreview_entity_ID = (int)$_REQUEST["entity_ID"];}
//if(isset($_REQUEST["model_ID"]) && is_numeric($_REQUEST["model_ID"])) {$loadDashboardPreview_model_ID = (int)$_REQUEST["model_ID"];}

        //$dashboardStrat = new DashboardStrategy();
    if(empty($loadDashboardPreview_user_ID))
    {
        $loadDashboardPreview_user_ID_array =  TC_Authenticator::getUserIDAndInitialize();
        $loadDashboardPreview_user_ID = $loadDashboardPreview_user_ID_array[0];
    }
    //if(!isset($loadDashboardPreview_accessgroup_ID))
    //{
        //$loadDashboardPreview_accessgroup_ID = TC_PersistenceUtility::getGlobalGroupID($loadDashboardPreview_user_ID);
    //}


    $tempEntity = TC_Utility::getCatalogPreview($loadDashboardPreview_entity_ID, $loadDashboardPreview_user_ID);

    $loadDashboardPreview_entity_ID = $tempEntity->get_entity_id();
    $loadDashboardPreview_model_ID = $tempEntity->get_host_id();




    //if(isset($containers)){unset($containers);}
//$logID = logTiming(null,"test",null,null,1);
    render(CONTAINER_VIEW_PATH,
                'DashboardTab.php',
                array('entity_ID' => $loadDashboardPreview_entity_ID,
                        'user_ID' => $loadDashboardPreview_user_ID,
                        'model_ID' => $loadDashboardPreview_model_ID,
                        'entity' => $tempEntity));
//logTiming(null, null, 1, $logID);
    /*
    if(isset($loadDashboardPreview_user_ID)){unset($loadDashboardPreview_user_ID);}
if(isset($loadDashboardPreview_entity_ID)){unset($loadDashboardPreview_entity_ID);}
if(isset($loadDashboardPreview_model_ID)){unset($loadDashboardPreview_model_ID);}
     *
     */


?>
