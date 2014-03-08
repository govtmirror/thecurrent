<?php

if(!isset($_SERVER['DOCUMENT_ROOT'])){ if(isset($_SERVER['SCRIPT_FILENAME'])){
$_SERVER['DOCUMENT_ROOT'] = str_replace( '\\', '/', substr($_SERVER['SCRIPT_FILENAME'], 0, 0-strlen($_SERVER['PHP_SELF'])));
}; };
if(!isset($_SERVER['DOCUMENT_ROOT'])){ if(isset($_SERVER['PATH_TRANSLATED'])){
$_SERVER['DOCUMENT_ROOT'] = str_replace( '\\', '/', substr(str_replace('\\\\', '\\', $_SERVER['PATH_TRANSLATED']), 0, 0-strlen($_SERVER['PHP_SELF'])));
}; };


require_once ($_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'library' . DIRECTORY_SEPARATOR . 'bootstrap.php');

if(isset($_REQUEST["user_ID"]) && is_numeric($_REQUEST["user_ID"])) {$loadDashboardNavEdit_user_ID = (int)$_REQUEST["user_ID"];}
if(isset($_REQUEST["entity_ID"]) && is_numeric($_REQUEST["entity_ID"])) {$loadDashboardNavEdit_entity_ID = (int)$_REQUEST["entity_ID"];}
//if(isset($_REQUEST["model_ID"]) && is_numeric($_REQUEST["model_ID"])) {$loadDashboardNavEdit_model_ID = (int)$_REQUEST["model_ID"];}
/*
    if(empty($loadDashboardNavEdit_user_ID))
        {
            throw new Exception("Cannot edit without Corridor authentication");
            //$loadDashboardNavEdit_user_ID = CorridorAuthClient::authenticateUser();
        }
 *
 */
    if(!isset($loadDashboardNavEdit_user_ID))
        {
            $loadDashboardNavEdit_user_ID_array = TC_Authenticator::getUserIDAndInitialize();
            $loadDashboardNavEdit_user_ID = $loadDashboardNavEdit_user_ID_array[0];

        }
    if(isset($loadDashboardNavEdit_user_ID) && $loadDashboardNavEdit_user_ID == SYSTEM_USER_ID)
        {
            throw new Exception("Cannot edit without Corridor authentication");
        }
    elseif(isset($loadDashboardNavEdit_user_ID))
        {
            $accessprofile = new AccessProfile(ValidAccessProfiles::DASHBOARD_REORDER, ValidAccessTypes::REORDER, ValidAccessContexts::DASHBOARD, ValidAccessLevels::BASIC_ACCESS);
            $accessprofile2 = new AccessProfile(ValidAccessProfiles::DASHBOARD_EDIT, ValidAccessTypes::EDIT, ValidAccessContexts::DASHBOARD, ValidAccessLevels::BASIC_ACCESS);

            $accessprofileDelete = new AccessProfile(ValidAccessProfiles::DASHBOARD_DELETE, ValidAccessTypes::DELETE, ValidAccessContexts::DASHBOARD, ValidAccessLevels::BASIC_ACCESS);
            $accessprofileUnsub = new AccessProfile(ValidAccessProfiles::DASHBOARD_UNSUBSCRIBE, ValidAccessTypes::UNSUBSCRIBE, ValidAccessContexts::DASHBOARD, ValidAccessLevels::BASIC_ACCESS);
            $accessprofilePub = new AccessProfile(ValidAccessProfiles::DASHBOARD_PUBLISH, ValidAccessTypes::PUBLISH, ValidAccessContexts::DASHBOARD, ValidAccessLevels::BASIC_ACCESS);
            $accessprofileRename = new AccessProfile(ValidAccessProfiles::DASHBOARD_RENAME, ValidAccessTypes::RENAME, ValidAccessContexts::DASHBOARD, ValidAccessLevels::BASIC_ACCESS);


            $containers = TC_Utility::getActiveContainersForUser($loadDashboardNavEdit_user_ID, $accessprofile);
            $containers2 = TC_Utility::getActiveContainersForUser($loadDashboardNavEdit_user_ID, $accessprofile2);


            $containersDelete = TC_Utility::getActiveContainersForUser($loadDashboardNavEdit_user_ID, $accessprofileDelete);
            $containersPub = TC_Utility::getActiveContainersForUser($loadDashboardNavEdit_user_ID, $accessprofilePub);
            $containersUnsub = TC_Utility::getActiveContainersForUser($loadDashboardNavEdit_user_ID, $accessprofileUnsub);
            $containersRename = TC_Utility::getActiveContainersForUser($loadDashboardNavEdit_user_ID, $accessprofileRename);

            //$containers = DashboardGrabber::getActiveContainersForUser($loadDashboardNavEdit_user_ID);
            if(empty($containers2))
            {
                $loadDashboardNavEdit_entity_ID = null;
                $loadDashboardNavEdit_model_ID = null;
            }
            else
            {
                $tempEntity = getEntityFromRepoPool($loadDashboardNavEdit_entity_ID, $containers2, 'get_entity_id');
                if(!(isset($loadDashboardNavEdit_entity_ID) && $tempEntity))
                {
                    $containersTemp = $containers2;

                    $tempEntity = array_shift($containersTemp);
                    $loadDashboardNavEdit_entity_ID = $tempEntity->get_entity_id();
                    $loadDashboardNavEdit_model_ID = $tempEntity->get_host_id();

                    //$loadDashboardNavEdit_entity_ID = array_shift(array_keys($containersTemp));

                }
                else
                {
                    // if(!isset($loadDashboardNavEdit_model_ID))
                    // {
                        // $tempEntity = $containers2[$loadDashboardNavEdit_entity_ID];
                        $loadDashboardNavEdit_model_ID = $tempEntity->get_host_id();
                    // }
                }
            }

        }

        //$dashboardStrat = new DashboardStrategy();




        //if(isset($containersTemp)){unset($containersTemp);}

        render(CONTAINER_EDIT_PATH,
                'DashboardTabNavEdit.php',
                array('user_ID' =>$loadDashboardNavEdit_user_ID,
                    'entity_ID' => $loadDashboardNavEdit_entity_ID,
                    'entity_reorder_set' => $containers,
                    'entity_edit_set' => $containers2,

                    'entity_rename_set' => $containersRename,
                    'entity_delete_set' => $containersDelete,
                    'entity_publish_set' => $containersPub,
                    'entity_unsub_set' => $containersUnsub,


                    'model_ID' => $loadDashboardNavEdit_model_ID,
                    'entity' => $tempEntity));
/*
if(isset($loadDashboardNavEdit_user_ID)){unset($loadDashboardNavEdit_user_ID);}
if(isset($loadDashboardNavEdit_entity_ID)){unset($loadDashboardNavEdit_entity_ID);}
if(isset($loadDashboardNavEdit_model_ID)){unset($loadDashboardNavEdit_model_ID);}

if(isset($containers)){unset($containers);}
if(isset($containers2)){unset($containers2);}
*/


?>