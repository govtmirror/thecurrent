<?php

/*below goes on every page if you want it to work!*/

if(!isset($_SERVER['DOCUMENT_ROOT'])){ if(isset($_SERVER['SCRIPT_FILENAME'])){
$_SERVER['DOCUMENT_ROOT'] = str_replace( '\\', '/', substr($_SERVER['SCRIPT_FILENAME'], 0, 0-strlen($_SERVER['PHP_SELF'])));
}; };
if(!isset($_SERVER['DOCUMENT_ROOT'])){ if(isset($_SERVER['PATH_TRANSLATED'])){
$_SERVER['DOCUMENT_ROOT'] = str_replace( '\\', '/', substr(str_replace('\\\\', '\\', $_SERVER['PATH_TRANSLATED']), 0, 0-strlen($_SERVER['PHP_SELF'])));
}; };


require_once ($_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'library' . DIRECTORY_SEPARATOR . 'bootstrap.php');

if(isset($_REQUEST["user_ID"]) && is_numeric($_REQUEST["user_ID"])) {$loadDashboardContentAndNav_user_ID = (int)$_REQUEST["user_ID"];}
if(isset($_REQUEST["entity_ID"]) && is_numeric($_REQUEST["entity_ID"])) {$loadDashboardContentAndNav_entity_ID = (int)$_REQUEST["entity_ID"];}
//if(isset($_REQUEST["model_ID"]) && is_numeric($_REQUEST["model_ID"])) {$loadDashboardContentAndNav_model_ID = (int)$_REQUEST["model_ID"];}


        if(empty($loadDashboardContentAndNav_user_ID))
        {
            $loadDashboardContentAndNav_user_ID_array = TC_Authenticator::getUserIDAndInitialize();
            $loadDashboardContentAndNav_user_ID = $loadDashboardContentAndNav_user_ID_array[0];
        }

        //$dashboardStrat = new DashboardStrategy();

        //$containers = DashboardGrabber::getActiveContainersForUser($loadDashboardNav_user_ID);
        $containers = TC_Utility::getActiveContainersForUser($loadDashboardContentAndNav_user_ID, new TC_DefaultAccessProfile());
        // $containersUpdate = TC_Utility::getDashboardUpdates(array('user_id' => $loadDashboardContentAndNav_user_ID));


        /*
        if(!(isset($loadDashboardContentAndNav_entity_ID) && array_key_exists($loadDashboardContentAndNav_entity_ID, $containers)))
        {
            if(empty($containers))
            {
                $loadDashboardContentAndNav_entity_ID = null;
            }
            else
            {
                $loadDashboardContentAndNav_entity_ID = array_shift(array_keys($containers));
            }
        }
        */
        $updateAvailable = false;
        $updatePageId = false;

        if(empty($containers))
        {
            $loadDashboardContentAndNav_entity_ID = null;
            $loadDashboardContentAndNav_model_ID = null;
        }
        else
        {
            $tempEntity = getEntityFromRepoPool($loadDashboardContentAndNav_entity_ID, $containers, 'get_entity_id');
            if(!(isset($loadDashboardContentAndNav_entity_ID) && $tempEntity))
            {
                //print_r($containers);
                $containersTemp = $containers;

                $tempEntity = array_shift($containersTemp);
                $loadDashboardContentAndNav_entity_ID = $tempEntity->get_entity_id();
                $loadDashboardContentAndNav_model_ID = $tempEntity->get_host_id();
                //$loadDashboardContentAndNav_entity_ID = array_shift(array_keys($containersTemp));

            }
            else
            {
                //if(!isset($loadDashboardContentAndNav_model_ID))
                //{
                    //$tempEntity = getEntityFromRepoPool($loadDashboardContentAndNav_entity_ID, $containers, 'get_entity_id'); //$containers[$loadDashboardContentAndNav_entity_ID];
                    $loadDashboardContentAndNav_model_ID = $tempEntity->get_host_id();
                // }
                //$loadDashboardContentAndNav_entity_ID = null;
                //$loadDashboardContentAndNav_model_ID = null;
            }
        }

        $updatesArr = TC_Utility::getDashboardUpdates(array('user_id' => $loadDashboardContentAndNav_user_ID));
        // logError(var_export($updatesArr, true));

        if(array_key_exists($loadDashboardContentAndNav_entity_ID, $updatesArr))
        {
            $updatesTemp = $updatesArr[$loadDashboardContentAndNav_entity_ID];
            $updatePage = $updatesTemp['new_page'];
            if($updatePage)
            {
                $updateAvailable = true;
                $updatePageId = $updatePage->get_entity_id();
            }
        }
        // var_dump($tempEntity);
        //if(isset($containersTemp)){unset($containersTemp);}
        //$returnMe = array();

        //$returnMe['nav'] =
        echo '<div id="ajaxRenderNav">';
        render(CONTAINER_VIEW_PATH,
                'DashboardTabNav.php',
                array('user_ID' =>$loadDashboardContentAndNav_user_ID,
                    'entity_ID' => $loadDashboardContentAndNav_entity_ID,
                    'entity_set' => $containers,
                    'model_ID' => $loadDashboardContentAndNav_model_ID,
                    'entity' => $tempEntity));
        echo '</div>';
        //$returnMe['content'] =
        echo '<div id="ajaxRenderContent">';
        render(CONTAINER_VIEW_PATH,
                'DashboardTab.php',
                array('entity_ID' => $loadDashboardContentAndNav_entity_ID,
                    'user_ID' => $loadDashboardContentAndNav_user_ID,
                    'model_ID' => $loadDashboardContentAndNav_model_ID,
                    'entity' => $tempEntity,
                    'updateAvailable' => $updateAvailable,
                    'updateId' => $updatePageId
                    // 'entities_update' => $containersUpdate
                    ));
        echo '</div>';

  /*
if(isset($loadDashboardContentAndNav_user_ID)){unset($loadDashboardContentAndNav_user_ID);}
if(isset($loadDashboardContentAndNav_entity_ID)){unset($loadDashboardContentAndNav_entity_ID);}
if(isset($loadDashboardContentAndNav_model_ID)){unset($loadDashboardContentAndNav_model_ID);}
if(isset($containers)){unset($containers);}
*/


?>
