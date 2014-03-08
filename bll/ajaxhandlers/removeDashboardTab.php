<?php
/*
Inputs
-$removeDashboardTab_user_ID
-$removeDashboardTab_entity_ID

Outputs ~~~ .php
-user_ID
-entity_ID
*/
/*below goes on every page if you want it to work!*/



if(!isset($_SERVER['DOCUMENT_ROOT'])){ if(isset($_SERVER['SCRIPT_FILENAME'])){
$_SERVER['DOCUMENT_ROOT'] = str_replace( '\\', '/', substr($_SERVER['SCRIPT_FILENAME'], 0, 0-strlen($_SERVER['PHP_SELF'])));
}; };
if(!isset($_SERVER['DOCUMENT_ROOT'])){ if(isset($_SERVER['PATH_TRANSLATED'])){
$_SERVER['DOCUMENT_ROOT'] = str_replace( '\\', '/', substr(str_replace('\\\\', '\\', $_SERVER['PATH_TRANSLATED']), 0, 0-strlen($_SERVER['PHP_SELF'])));
}; };



require_once ($_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'library' . DIRECTORY_SEPARATOR . 'bootstrap.php');

if(isset($_REQUEST["user_ID"]) && is_numeric($_REQUEST["user_ID"])) {$removeDashboardTab_user_ID = (int)$_REQUEST["user_ID"];}
// if(isset($_REQUEST["accessgroup_ID"]) && is_numeric($_REQUEST["accessgroup_ID"])) {$removeDashboardTab_accessgroup_ID = (int)$_REQUEST["accessgroup_ID"];}
if(isset($_REQUEST["entity_ID"]) && is_numeric($_REQUEST["entity_ID"])) {$removeDashboardTab_entity_ID = (int)$_REQUEST["entity_ID"];}

if(!isset($removeDashboardTab_user_ID))
{
    throw new Exception("cannot remove dashboard tab");
}
// if(!isset($removeDashboardTab_accessgroup_ID))
// {
//     throw new Exception("cannot remove dashboard tab");
// }
if(!isset($removeDashboardTab_entity_ID))
{
    throw new Exception("cannot remove dashboard tab");
}

$strategy = new TC_RepositoryDashboardContainerStrategy();
$repo = new Repository($strategy);
$getPar = new THOR_GetParameterCapsule(array(),
                                        array('entity_id' => $removeDashboardTab_entity_ID,
                                                'user_id' => $removeDashboardTab_user_ID,
                                                'accessprofile' => new TC_DefaultAccessProfile()),
                                        array('overrideUAC' => false),
                                        array());
$db = $repo->getOne($getPar);
//$db = array_pop($repo->getOne($removeDashboardTab_user_ID, new TC_DefaultAccessProfile(), $removeDashboardTab_entity_ID, array('overrideUAC' => true)));

//$db instanceof TC_DashboardTab_Entity;
$db->set_is_active(0);
$setPar = new THOR_SetParameterCapsule(null, array('accessGroup_IDs' => array(/*$removeDashboardTab_accessgroup_ID => 1),*/ 'user_id' => $removeDashboardTab_user_ID), array());
$repo->save($setPar);

$accessprofile = new AccessProfile(ValidAccessProfiles::DASHBOARD_EDIT, ValidAccessTypes::EDIT, ValidAccessContexts::DASHBOARD, ValidAccessLevels::BASIC_ACCESS);

$containerIDs = TC_Utility::getActiveContainerIDsForUser($removeDashboardTab_user_ID, $accessprofile);

        if(empty($containerIDs))
        {
            $entity_ID = null;
        }
        else
        {
            $entity_ID = array_shift(array_keys($containerIDs));
        }

        //$containerIDsTemp = clone $containerIDs;

   /*
if(isset($removeDashboardTab_entity_ID)){unset($removeDashboardTab_entity_ID);}
if(isset($strategy)){unset($strategy);}
if(isset($repo)){unset($repo);}
if(isset($db)){unset($db);}
if(isset($containerIDs)){unset($containerIDs);}
*/
//render(AJAX_PATH,'loadDashboardNavEdit.php', array('user_ID' => $removeDashboardTab_user_ID,'entity_ID' => $entity_ID));

//if(isset($removeDashboardTab_user_ID)){unset($removeDashboardTab_user_ID);}

//if(isset($entity_ID)){($entity_ID);}

?>
