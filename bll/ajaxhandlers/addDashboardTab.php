<?php
/*
Inputs
-$addDashboardTab_user_ID
-$addDashboardTab_container_ID
-$addDashboardTab_title
-$addDashboardTab_description
-$addDashboardTab_params

Outputs ~~~ loadDashboardNavEdit.php
-
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

if(isset($_REQUEST["user_ID"]) && is_numeric($_REQUEST["user_ID"])) {$addDashboardTab_user_ID = (int)$_REQUEST["user_ID"];}
if(isset($_REQUEST["accessgroup_ID"]) && is_numeric($_REQUEST["accessgroup_ID"])) {$addDashboardTab_accessgroup_ID = (int)$_REQUEST["accessgroup_ID"];}
//if(isset($_REQUEST["container_ID"]) && is_numeric($_REQUEST["container_ID"])) {$addDashboardTab_container_ID = (int)$_REQUEST["container_ID"];}
if(isset($_REQUEST["title"]) && is_string($_REQUEST["title"])) {$addDashboardTab_title = $_REQUEST["title"];}
if(isset($_REQUEST["description"]) && is_string($_REQUEST["description"])) {$addDashboardTab_description = $_REQUEST["description"];}
if(isset($_REQUEST["params"]) && is_string($_REQUEST["params"])) {$addDashboardTab_params = $_REQUEST["params"];}

if(!isset($addDashboardTab_user_ID))
{
    throw new Exception("cannot load dashboard tab");
}
if(!isset($addDashboardTab_accessgroup_ID))
{
    throw new Exception("cannot load dashboard tab");
}
if(empty($addDashboardTab_title))
{
    $addDashboardTab_title = '(blank)';
}
if(!isset($addDashboardTab_description))
{
    $addDashboardTab_description = '';
}
error_reporting(0);
//$addDashboardTab_title = addslashes($addDashboardTab_title);
//$addDashboardTab_description = addslashes($addDashboardTab_description);
/*
if(empty($addDashboardTab_user_ID))
{
    $addDashboardTab_user_ID = CorridorAuthClient::authenticateUser();
}
 */
$dashboard = new TC_DashboardTab($addDashboardTab_title, $addDashboardTab_description, ValidDashboardTabViews::STANDARD);

if(isset($addDashboardTab_params))
{
    $paramArr = array();
    parse_str($addDashboardTab_params, $paramArr);

    foreach($paramArr as $key => $value)
    {
        $setFunc = 'set_'.$key;
        $dashboard->$setFunc($value);
    }
}

$dbe = new TC_DashboardTab_EntityModel(null,
                                        null,
                                        $dashboard,
                                        1,
                                        date('Y-m-d H:i:s'),
                                        date('Y-m-d H:i:s'),
                                        $addDashboardTab_user_ID);

//$dbe = new TC_DashboardTab_EntityModel(null, null, $dashboard, 1, 1, date('Y-m-d H:i:s'), date('Y-m-d H:i:s'), $addDashboardTab_user_ID, null);
//$dbe = new ContainerDatabaseEntity();
//$dbe->set_host($dashboard);
//$dbe->setHost($dashboard);

$strategy = new TC_RepositoryDashboardContainerStrategy();
$repo = new Repository($strategy);
$repo->loadEntity($dbe);
$setPar = new THOR_SetParameterCapsule(null,
                                        array('user_id' => $addDashboardTab_user_ID,
                                                'accessGroup_IDs' => array($addDashboardTab_accessgroup_ID => 1)),
                                        array());


$returnMe = array_pop($repo->save($setPar))->get_item();
if(isset($returnMe)/* && !empty($resultsArr)*/)
{
        //$returnMe1 = array_pop($resultsArr);

        if($returnMe instanceof TC_DashboardTab_EntityModel)
        {
            $returnMe = $returnMe->get_entity_id();
        }
        else
        {
            $returnMe = null;
        }
}
else
{
        $returnMe = null;
}

//$returnMe1 = array_pop($repo->save($addDashboardTab_user_ID, $addDashboardTab_accessgroup_ID));
//$returnMe = $returnMe1->get_entity_id();
//$returnMe = $repo->save(array('user_id' => $addDashboardTab_user_ID));


/*
if(isset($addDashboardTab_title)){unset($addDashboardTab_title);}
if(isset($addDashboardTab_description)){unset($addDashboardTab_description);}
if(isset($addDashboardTab_params)){unset($addDashboardTab_params);}
if(isset($strategy)){unset($strategy);}
if(isset($repo)){unset($repo);}
if(isset($dbe)){unset($dbe);}
if(isset($paramArr)){unset($paramArr);}
if(isset($setFunc)){unset($setFunc);}
if(isset($dashboard)){unset($dashboard);}




//render(AJAX_PATH,'loadDashboardNavEdit.php', array('user_ID' => $addDashboardTab_user_ID,'container_ID' => null));


if(isset($addDashboardTab_user_ID)){unset($addDashboardTab_user_ID);}
*/
echo $returnMe;

?>