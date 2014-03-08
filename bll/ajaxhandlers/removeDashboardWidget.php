<?php
/*
Inputs
-$removeDashboardWidget_entity_ID
-$removeDashboardWidget_container_ID

Outputs ~~~ .php
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

if(isset($_REQUEST["user_ID"]) && is_numeric($_REQUEST["user_ID"])) {$removeDashboardWidget_user_ID = (int)$_REQUEST["user_ID"];}
if(isset($_REQUEST["entity_ID"]) && is_numeric($_REQUEST["entity_ID"])) {$removeDashboardWidget_entity_ID = (int)$_REQUEST["entity_ID"];}
if(isset($_REQUEST["accessgroup_ID"]) && is_numeric($_REQUEST["accessgroup_ID"])) {$removeDashboardWidget_accessgroup_ID = (int)$_REQUEST["accessgroup_ID"];}
if(isset($_REQUEST["container_ID"]) && is_numeric($_REQUEST["container_ID"])) {$removeDashboardWidget_container_ID = (int)$_REQUEST["container_ID"];}

if(!isset($removeDashboardWidget_user_ID))
{
    throw new Exception("cannot remove dashboard tab");
}
if(!isset($removeDashboardWidget_entity_ID))
{
    throw new Exception("cannot remove dashboard widget");
}
if(!isset($removeDashboardWidget_accessgroup_ID))
{
    throw new Exception("cannot remove dashboard tab");
}
if(!isset($removeDashboardWidget_container_ID))
{
    throw new Exception("cannot remove dashboard widget");
}

$strategy = new TC_RepositoryDashboardSourceStrategy();
$repo = new Repository($strategy);
$getPar = new THOR_GetParameterCapsule(array(), array('entity_id' => $removeDashboardWidget_entity_ID, 'container_id' => $removeDashboardWidget_container_ID), array('overrideUAC' => false));
$db = $repo->getOne($getPar);

//$db = array_pop($repo->getOne($removeDashboardWidget_user_ID, new TC_DefaultAccessProfile(), $removeDashboardWidget_entity_ID, array('overrideUAC' => true)));

//$db instanceof DatabaseEntity;
$db->set_is_active(0);
$setPar = new THOR_SetParameterCapsule(null, array('container_id' => $removeDashboardWidget_container_ID), array());
$repo->save($setPar);
//$repo->save($removeDashboardWidget_user_ID, $removeDashboardWidget_accessgroup_ID, array('container_id' => $removeDashboardWidget_container_ID));

/*
if(isset($removeDashboardWidget_entity_ID)){unset($removeDashboardWidget_entity_ID);}
if(isset($strategy)){unset($strategy);}
if(isset($repo)){unset($repo);}
if(isset($db)){unset($db);}



//render(AJAX_PATH,'loadDashboardContentEdit.php', array('container_ID' => $removeDashboardWidget_container_ID));


if(isset($removeDashboardWidget_container_ID)){unset($removeDashboardWidget_container_ID);}
*/



?>
