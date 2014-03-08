<?php

if(!isset($_SERVER['DOCUMENT_ROOT'])){ if(isset($_SERVER['SCRIPT_FILENAME'])){
$_SERVER['DOCUMENT_ROOT'] = str_replace( '\\', '/', substr($_SERVER['SCRIPT_FILENAME'], 0, 0-strlen($_SERVER['PHP_SELF'])));
}; };
if(!isset($_SERVER['DOCUMENT_ROOT'])){ if(isset($_SERVER['PATH_TRANSLATED'])){
$_SERVER['DOCUMENT_ROOT'] = str_replace( '\\', '/', substr(str_replace('\\\\', '\\', $_SERVER['PATH_TRANSLATED']), 0, 0-strlen($_SERVER['PHP_SELF'])));
}; };


require_once ($_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'library' . DIRECTORY_SEPARATOR . 'bootstrap.php');

if(isset($_REQUEST["user_ID"]) && is_numeric($_REQUEST["user_ID"])) {$loadDashboardContentEditAndNavEdit_user_ID = (int)$_REQUEST["user_ID"];}
if(isset($_REQUEST["entity_ID"]) && is_numeric($_REQUEST["entity_ID"])) {$loadDashboardContentEditAndNavEdit_entity_ID = (int)$_REQUEST["entity_ID"];}
//if(isset($_REQUEST["model_ID"]) && is_numeric($_REQUEST["model_ID"])) {$loadDashboardContentEditAndNavEdit_model_ID = (int)$_REQUEST["model_ID"];}
/*
    if(empty($loadDashboardNavEdit_user_ID))
        {
            throw new Exception("Cannot edit without Corridor authentication");
            //$loadDashboardNavEdit_user_ID = CorridorAuthClient::authenticateUser();
        }
 *
 */
    if(!isset($loadDashboardContentEditAndNavEdit_user_ID))
        {
            $loadDashboardContentEditAndNavEdit_user_ID_array = TC_Authenticator::getUserIDAndInitialize();
            $loadDashboardContentEditAndNavEdit_user_ID = $loadDashboardContentEditAndNavEdit_user_ID_array[0];

        }
    if(isset($loadDashboardContentEditAndNavEdit_user_ID) && $loadDashboardContentEditAndNavEdit_user_ID == SYSTEM_USER_ID)
        {
            throw new Exception("Cannot edit without Corridor authentication");
        }
    else if(isset($loadDashboardContentEditAndNavEdit_user_ID))
        {

            $showPublish = false;
            $showUnsub = false;
            $showClone = false;

            $accessprofile = new AccessProfile(ValidAccessProfiles::DASHBOARD_REORDER, ValidAccessTypes::REORDER, ValidAccessContexts::DASHBOARD, ValidAccessLevels::BASIC_ACCESS);
            $accessprofile2 = new AccessProfile(ValidAccessProfiles::DASHBOARD_EDIT, ValidAccessTypes::EDIT, ValidAccessContexts::DASHBOARD, ValidAccessLevels::BASIC_ACCESS);


            $accessprofileDelete = new AccessProfile(ValidAccessProfiles::DASHBOARD_DELETE, ValidAccessTypes::DELETE, ValidAccessContexts::DASHBOARD, ValidAccessLevels::BASIC_ACCESS);
            $accessprofileUnsub = new AccessProfile(ValidAccessProfiles::DASHBOARD_UNSUBSCRIBE, ValidAccessTypes::UNSUBSCRIBE, ValidAccessContexts::DASHBOARD, ValidAccessLevels::BASIC_ACCESS);
            $accessprofilePub = new AccessProfile(ValidAccessProfiles::DASHBOARD_PUBLISH, ValidAccessTypes::PUBLISH, ValidAccessContexts::DASHBOARD, ValidAccessLevels::BASIC_ACCESS);
            $accessprofileRename = new AccessProfile(ValidAccessProfiles::DASHBOARD_RENAME, ValidAccessTypes::RENAME, ValidAccessContexts::DASHBOARD, ValidAccessLevels::BASIC_ACCESS);
            $accessprofileClone = new AccessProfile(ValidAccessProfiles::DASHBOARD_CLONE, ValidAccessTypes::_CLONE, ValidAccessContexts::DASHBOARD, ValidAccessLevels::BASIC_ACCESS);

            $containers = TC_Utility::getActiveContainersForUser($loadDashboardContentEditAndNavEdit_user_ID, $accessprofile);
            $containers2 = TC_Utility::getActiveContainersForUser($loadDashboardContentEditAndNavEdit_user_ID, $accessprofile2);
            //$containers = DashboardGrabber::getActiveContainersForUser($loadDashboardNavEdit_user_ID);

            $containersDelete = TC_Utility::getActiveContainersForUser($loadDashboardContentEditAndNavEdit_user_ID, $accessprofileDelete);
            $containersPub = TC_Utility::getActiveContainersForUser($loadDashboardContentEditAndNavEdit_user_ID, $accessprofilePub);
            $containersUnsub = TC_Utility::getActiveContainersForUser($loadDashboardContentEditAndNavEdit_user_ID, $accessprofileUnsub);
            $containersRename = TC_Utility::getActiveContainersForUser($loadDashboardContentEditAndNavEdit_user_ID, $accessprofileRename);
            $containersClone = TC_Utility::getActiveContainersForUser($loadDashboardContentEditAndNavEdit_user_ID, $accessprofileClone);


            if(empty($containers2))
            {
                $loadDashboardContentEditAndNavEdit_entity_ID = null;
                $loadDashboardContentEditAndNavEdit_model_ID = null;
            }
            else
            {
                $tempEntity = getEntityFromRepoPool($loadDashboardContentEditAndNavEdit_entity_ID, $containers2, 'get_entity_id');
                if(!(isset($loadDashboardContentEditAndNavEdit_entity_ID) && $tempEntity))
                {
                    $containersTemp = $containers2;


                    $tempEntity = array_shift($containersTemp);
                    $loadDashboardContentEditAndNavEdit_entity_ID = $tempEntity->get_entity_id();
                    $loadDashboardContentEditAndNavEdit_model_ID = $tempEntity->get_host_id();


                    //$loadDashboardContentEditAndNavEdit_entity_ID = array_shift(array_keys($containersTemp));

                }
                else
                {
                    //if(!isset($loadDashboardContentEditAndNavEdit_model_ID))
                    // {
                        // $tempEntity = $containers2[$loadDashboardContentEditAndNavEdit_entity_ID];
                        $loadDashboardContentEditAndNavEdit_model_ID = $tempEntity->get_host_id();
                    // }
                    //$loadDashboardContentEditAndNavEdit_entity_ID = null;
                }

                if(getEntityFromRepoPool($loadDashboardContentEditAndNavEdit_entity_ID, $containersPub, 'get_entity_id')){
                    $showPublish = true;
                }
                if(getEntityFromRepoPool($loadDashboardContentEditAndNavEdit_entity_ID, $containersUnsub, 'get_entity_id')){
                    $showUnsub = true;
                }
                if(getEntityFromRepoPool($loadDashboardContentEditAndNavEdit_entity_ID, $containersClone, 'get_entity_id')){
                    $showClone = true;
                }
            }

        }

        //$dashboardStrat = new DashboardStrategy();




        if(isset($containersTemp)){unset($containersTemp);}

        echo '<div id="ajaxRenderNav">';
        render(CONTAINER_EDIT_PATH,
                'DashboardTabNavEdit.php',
                array('user_ID' =>$loadDashboardContentEditAndNavEdit_user_ID,
                    'entity_ID' => $loadDashboardContentEditAndNavEdit_entity_ID,
                    'entity_reorder_set' => $containers,
                    'entity_edit_set' => $containers2,

                    'entity_rename_set' => $containersRename,
                    'entity_delete_set' => $containersDelete,
                    'entity_publish_set' => $containersPub,
                    'entity_unsub_set' => $containersUnsub,


                    'model_ID' => $loadDashboardContentEditAndNavEdit_model_ID,
                    'entity' => $tempEntity
                )
        );
        echo '</div>';
        //$returnMe['content'] =
        echo '<div id="ajaxRenderContent">';
        render(CONTAINER_EDIT_PATH,
                'DashboardTabEdit.php',
                array('entity_ID' => $loadDashboardContentEditAndNavEdit_entity_ID,
                        'user_ID' => $loadDashboardContentEditAndNavEdit_user_ID,
                        'model_ID' => $loadDashboardContentEditAndNavEdit_model_ID,
                        'entity' => $tempEntity,
                        'showPublish' => $showPublish,
                        'showUnsub' => $showUnsub,
                        'showClone' => $showClone
                )
        );
        echo '</div>';



        /*
if(isset($loadDashboardContentEditAndNavEdit_entity_ID)){unset($loadDashboardContentEditAndNavEdit_entity_ID);}
if(isset($loadDashboardContentEditAndNavEdit_model_ID)){unset($loadDashboardContentEditAndNavEdit_model_ID);}
if(isset($loadDashboardContentEditAndNavEdit_user_ID)){unset($loadDashboardContentEditAndNavEdit_user_ID);}

if(isset($containers)){unset($containers);}
if(isset($containers2)){unset($containers2);}
*/

?>
