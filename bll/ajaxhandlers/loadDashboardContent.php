<?php
/*
Inputs
-$loadDashboardContent_user_ID
-$loadDashboardContent_entity_ID

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


if(isset($_REQUEST["user_ID"]) && is_numeric($_REQUEST["user_ID"])) {$loadDashboardContent_user_ID = (int)$_REQUEST["user_ID"];}
//if(isset($_REQUEST["accessgroup_ID"]) && is_numeric($_REQUEST["accessgroup_ID"])) {$loadDashboardContent_accessgroup_ID = (int)$_REQUEST["accessgroup_ID"];}
if(isset($_REQUEST["entity_ID"]) && is_numeric($_REQUEST["entity_ID"])) {$loadDashboardContent_entity_ID = (int)$_REQUEST["entity_ID"];}
//if(isset($_REQUEST["model_ID"]) && is_numeric($_REQUEST["model_ID"])) {$loadDashboardContent_model_ID = (int)$_REQUEST["model_ID"];}

        //$dashboardStrat = new DashboardStrategy();
    if(empty($loadDashboardContent_user_ID))
    {
        $loadDashboardContent_user_ID_array =  TC_Authenticator::getUserIDAndInitialize();
        $loadDashboardContent_user_ID = $loadDashboardContent_user_ID_array[0];
    }
    //if(!isset($loadDashboardContent_accessgroup_ID))
    //{
        //$loadDashboardContent_accessgroup_ID = TC_PersistenceUtility::getGlobalGroupID($loadDashboardContent_user_ID);
    //}

    $containers = TC_Utility::getActiveContainersForUser($loadDashboardContent_user_ID, new TC_DefaultAccessProfile());
    // $containersUpdate = TC_Utility::getDashboardUpdates(array('user_id' => $loadDashboardContent_user_ID));
    //DashboardGrabber::getActiveContainersForUser($loadDashboardContent_user_ID);


    $updateAvailable = false;
    $updatePageId = false;

    $tempEntity = getEntityFromRepoPool($loadDashboardContent_entity_ID, $containers, 'get_entity_id');
    if(!(isset($loadDashboardContent_entity_ID) && $tempEntity))
    {


        if(empty($containers))
        {

            $loadDashboardContent_entity_ID = null;
            $loadDashboardContent_model_ID = null;
        }
        else
        {

            $tempEntity = array_shift($containers);
            $loadDashboardContent_entity_ID = $tempEntity->get_entity_id();//$tempEntity["id"];
            $loadDashboardContent_model_ID = $tempEntity->get_host_id();//$tempEntity["row_id"];

            //$loadDashboardContent_entity_ID = array_shift(array_keys($containers));
        }

        //$containersTemp = clone $containers;


    }
    else
    {
        // if(!isset($loadDashboardContent_model_ID))
        // {
            //$tempEntity = $containers[$loadDashboardContent_entity_ID];
            $loadDashboardContent_model_ID = $tempEntity->get_host_id();
        // }
    }

    $updatesArr = TC_Utility::getDashboardUpdates(array('user_id' => $loadDashboardContent_user_ID));
    // logError(var_export($updatesArr, true));

    if(array_key_exists($loadDashboardContent_entity_ID, $updatesArr))
    {
        $updatesTemp = $updatesArr[$loadDashboardContent_entity_ID];
        $updatePage = $updatesTemp['new_page'];
        if($updatePage)
        {
            $updateAvailable = true;
            $updatePageId = $updatePage->get_entity_id();

        }

    }


    //if(isset($containers)){unset($containers);}
//$logID = logTiming(null,"test",null,null,1);
    render(CONTAINER_VIEW_PATH,
                'DashboardTab.php',
                array('entity_ID' => $loadDashboardContent_entity_ID,
                        'user_ID' => $loadDashboardContent_user_ID,
                        'model_ID' => $loadDashboardContent_model_ID,
                        'entity' => $tempEntity,
                        'updateAvailable' => $updateAvailable,
                        'updateId' => $updatePageId//,
                        // 'entities_update' => $containersUpdate
                        ));
//logTiming(null, null, 1, $logID);
    /*
    if(isset($loadDashboardContent_user_ID)){unset($loadDashboardContent_user_ID);}
if(isset($loadDashboardContent_entity_ID)){unset($loadDashboardContent_entity_ID);}
if(isset($loadDashboardContent_model_ID)){unset($loadDashboardContent_model_ID);}
     *
     */


?>
