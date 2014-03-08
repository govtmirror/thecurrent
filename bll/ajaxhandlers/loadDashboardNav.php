<?php
/*
Inputs
-$loadDashboardNav_user_ID
-$loadDashboardNav_entity_ID

Outputs ~~~ DashboardTabNav.php
-entity_ID
-entity_IDs
*/
/*below goes on every page if you want it to work!*/

if(!isset($_SERVER['DOCUMENT_ROOT'])){ if(isset($_SERVER['SCRIPT_FILENAME'])){
$_SERVER['DOCUMENT_ROOT'] = str_replace( '\\', '/', substr($_SERVER['SCRIPT_FILENAME'], 0, 0-strlen($_SERVER['PHP_SELF'])));
}; };
if(!isset($_SERVER['DOCUMENT_ROOT'])){ if(isset($_SERVER['PATH_TRANSLATED'])){
$_SERVER['DOCUMENT_ROOT'] = str_replace( '\\', '/', substr(str_replace('\\\\', '\\', $_SERVER['PATH_TRANSLATED']), 0, 0-strlen($_SERVER['PHP_SELF'])));
}; };


require_once ($_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'library' . DIRECTORY_SEPARATOR . 'bootstrap.php');

if(isset($_REQUEST["user_ID"]) && is_numeric($_REQUEST["user_ID"])) {$loadDashboardNav_user_ID = (int)$_REQUEST["user_ID"];}
if(isset($_REQUEST["entity_ID"]) && is_numeric($_REQUEST["entity_ID"])) {$loadDashboardNav_entity_ID = (int)$_REQUEST["entity_ID"];}
//if(isset($_REQUEST["model_ID"]) && is_numeric($_REQUEST["model_ID"])) {$loadDashboardNav_model_ID = (int)$_REQUEST["model_ID"];}

        if(empty($loadDashboardNav_user_ID))
        {
            $loadDashboardNav_user_ID_array = TC_Authenticator::getUserIDAndInitialize();
            $loadDashboardNav_user_ID = $loadDashboardNav_user_ID_array[0];
        }

        //$dashboardStrat = new DashboardStrategy();

        //$containers = DashboardGrabber::getActiveContainersForUser($loadDashboardNav_user_ID);
        $containers = TC_Utility::getActiveContainersForUser($loadDashboardNav_user_ID, new TC_DefaultAccessProfile());

        if(empty($containers))
        {
            $loadDashboardNav_entity_ID = null;
            $loadDashboardNav_model_ID = null;
        }
        else
        {
            $tempEntity = getEntityFromRepoPool($loadDashboardNav_entity_ID, $containers, 'get_entity_id');
            if(!(isset($loadDashboardNav_entity_ID) && $tempEntity))
            {
                //print_r($containers);
                $containersTemp = $containers;

                $tempEntity = array_shift($containersTemp);
                $loadDashboardNav_entity_ID = $tempEntity->get_entity_id();
                $loadDashboardNav_model_ID = $tempEntity->get_host_id();

                //$loadDashboardNav_entity_ID = array_shift(array_keys($containersTemp));

            }
            else
            {
                // if(!isset($loadDashboardNav_model_ID))
                // {
                    // $tempEntity = $containers[$loadDashboardNav_entity_ID];
                    $loadDashboardNav_model_ID = $tempEntity->get_host_id();
                // }
            }
        }

        //if(isset($containersTemp)){unset($containersTemp);}

        render(CONTAINER_VIEW_PATH,
                'DashboardTabNav.php',
                array('user_ID' =>$loadDashboardNav_user_ID,
                    'entity_ID' => $loadDashboardNav_entity_ID,
                    'entity_set' => $containers,
                    'model_ID' => $loadDashboardNav_model_ID,
                    'entity' => $tempEntity));
/*
if(isset($loadDashboardNav_user_ID)){unset($loadDashboardNav_user_ID);}
if(isset($loadDashboardNav_entity_ID)){unset($loadDashboardNav_entity_ID);}
if(isset($loadDashboardNav_model_ID)){unset($loadDashboardNav_model_ID);}
if(isset($containers)){unset($containers);}
*/
?>