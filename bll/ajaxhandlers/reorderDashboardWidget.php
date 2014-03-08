<?php
/*
Inputs
-$reorderDashboardWidget_entity_ID
-$reorderDashboardWidget_container_ID
-$reorderDashboardWidget_priority

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

if(isset($_REQUEST["user_ID"]) && is_numeric($_REQUEST["user_ID"])) {$reorderDashboardWidget_user_ID = (int)$_REQUEST["user_ID"];}
if(isset($_REQUEST["accessgroup_ID"]) && is_numeric($_REQUEST["accessgroup_ID"])) {$reorderDashboardWidget_accessgroup_ID = (int)$_REQUEST["accessgroup_ID"];}
if(isset($_REQUEST["entity_ID"]) && is_numeric($_REQUEST["entity_ID"])) {$reorderDashboardWidget_entity_ID = (int)$_REQUEST["entity_ID"];}
if(isset($_REQUEST["container_ID"]) && is_numeric($_REQUEST["container_ID"])) {$reorderDashboardWidget_container_ID = (int)$_REQUEST["container_ID"];}
if(isset($_REQUEST["priority"]) && is_numeric($_REQUEST["priority"])) {$reorderDashboardWidget_priority = (int)$_REQUEST["priority"];}

if(!isset($reorderDashboardWidget_user_ID))
{
    throw new Exception("cannot reorder dashboard tab");
}
if(!isset($reorderDashboardWidget_accessgroup_ID))
{
    throw new Exception("cannot reorder dashboard tab");
}
if(!isset($reorderDashboardWidget_entity_ID))
{
    throw new Exception("cannot reorder dashboard widget");
}
if(!isset($reorderDashboardWidget_container_ID))
{
    throw new Exception("cannot reorder dashboard widget");
}
if(!isset($reorderDashboardWidget_priority))
{
    throw new Exception("cannot reorder dashboard widget");
}

$strategy = new TC_RepositoryDashboardSourceStrategy();
$repo = new Repository($strategy);

$getPar = new THOR_GetParameterCapsule(array(), array('entity_id' => $reorderDashboardWidget_entity_ID, 'container_id' => $reorderDashboardWidget_container_ID), array('overrideUAC' => false));
$db = $repo->getOne($getPar);


//$db = array_pop($repo->getOne($reorderDashboardWidget_user_ID, new TC_DefaultAccessProfile(), $reorderDashboardWidget_entity_ID));

$db->set_dashboard_priority($reorderDashboardWidget_priority);

/*
$myFile = "DBtestFile.txt";
	$fh = fopen($myFile, 'a') or die("can't open file");

        ob_start();
        var_dump($db->getHost());
        $stringData = ob_get_clean();



	fwrite($fh, $stringData);


	fclose($fh);
*/

//$db->setIsActive(false);
// $db->set_is_active(0);
$setPar = new THOR_SetParameterCapsule(null, array('container_id' => $reorderDashboardWidget_container_ID), array());
$repo->save($setPar);

//$repo->save($reorderDashboardWidget_user_ID, $reorderDashboardWidget_accessgroup_ID, array('container_id' => $reorderDashboardWidget_container_ID));

/*
if(isset($reorderDashboardWidget_entity_ID)){unset($reorderDashboardWidget_entity_ID);}
if(isset($reorderDashboardWidget_priority)){unset($reorderDashboardWidget_priority);}
if(isset($strategy)){unset($strategy);}
if(isset($repo)){unset($repo);}
if(isset($db)){unset($db);}



//render(AJAX_PATH,'loadDashboardContentEdit.php', array('container_ID' => $reorderDashboardWidget_container_ID));


if(isset($reorderDashboardWidget_container_ID)){unset($reorderDashboardWidget_container_ID);}
*/
?>
