<?php
/*
Inputs
-$reorderDashboardTab_user_ID
-$reorderDashboardTab_entity_ID
-$reorderDashboardTab_priority
-$reorderDashboardTab_params

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

if(isset($_REQUEST["user_ID"]) && is_numeric($_REQUEST["user_ID"])) {$reorderDashboardTab_user_ID = (int)$_REQUEST["user_ID"];}
// if(isset($_REQUEST["accessgroup_ID"]) && is_numeric($_REQUEST["accessgroup_ID"])) {$reorderDashboardTab_accessgroup_ID = (int)$_REQUEST["accessgroup_ID"];}
if(isset($_REQUEST["entity_ID"]) && is_numeric($_REQUEST["entity_ID"])) {$reorderDashboardTab_entity_ID = (int)$_REQUEST["entity_ID"];}
if(isset($_REQUEST["priority"]) && is_numeric($_REQUEST["priority"])) {$reorderDashboardTab_priority = (int)$_REQUEST["priority"];}
if(isset($_REQUEST["params"]) && is_string($_REQUEST["params"])) {$reorderDashboardTab_params = $_REQUEST["params"];}


if(!isset($reorderDashboardTab_user_ID))
{
    throw new Exception("cannot reorder dashboard tab");
}
// if(!isset($reorderDashboardTab_accessgroup_ID))
// {
//     throw new Exception("cannot remove dashboard tab");
// }
if(!isset($reorderDashboardTab_entity_ID))
{
    throw new Exception("cannot reorder dashboard tab");
}
if(!isset($reorderDashboardTab_priority))
{
    throw new Exception("cannot reorder dashboard tab");
}

$strategy = new TC_RepositoryDashboardContainerStrategy();
$repo = new Repository($strategy);

$getPar = new THOR_GetParameterCapsule(array(),
                                        array('entity_id' => $reorderDashboardTab_entity_ID,
                                                'user_id' => $reorderDashboardTab_user_ID,
                                                'accessprofile' => new TC_DefaultAccessProfile()),
                                        array('overrideUAC' => false),
                                        array());
$db = $repo->getOne($getPar);


//$db = array_pop($repo->getOne($reorderDashboardTab_user_ID, new TC_DefaultAccessProfile(), $reorderDashboardTab_entity_ID, array('overrideUAC' => true)));

//$db instanceof TC_DashboardTab_Entity;

$db->set_dashboard_priority($reorderDashboardTab_priority);

$setPar = new THOR_SetParameterCapsule(null, array(/*'accessGroup_IDs' => array($reorderDashboardTab_accessgroup_ID => 1),*/ 'user_id' => $reorderDashboardTab_user_ID), array());
$repo->save($setPar);
//$repo->save($reorderDashboardTab_user_ID, $reorderDashboardTab_accessgroup_ID);

/*
if(isset($reorderDashboardTab_priority)){unset($reorderDashboardTab_priority);}
if(isset($reorderDashboardTab_params)){unset($reorderDashboardTab_params);}
if(isset($strategy)){unset($strategy);}
if(isset($repo)){unset($repo);}
if(isset($db)){unset($db);}
if(isset($paramArr)){unset($paramArr);}




//render(AJAX_PATH,'loadDashboardNavEdit.php', array('user_ID' => $reorderDashboardTab_user_ID,'entity_ID' => $reorderDashboardTab_entity_ID));


if(isset($reorderDashboardTab_user_ID)){unset($reorderDashboardTab_user_ID);}
if(isset($reorderDashboardTab_entity_ID)){unset($reorderDashboardTab_entity_ID);}
*/



?>
