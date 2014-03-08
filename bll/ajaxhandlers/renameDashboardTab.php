<?php
/*
Inputs
-$renameDashboardTab_user_ID
-$renameDashboardTab_entity_ID
-$renameDashboardTab_title
-$renameDashboardTab_description
//-$renameDashboardTab_params

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

if(isset($_REQUEST["user_ID"]) && is_numeric($_REQUEST["user_ID"])) {$renameDashboardTab_user_ID = (int)$_REQUEST["user_ID"];}
if(isset($_REQUEST["entity_ID"]) && is_numeric($_REQUEST["entity_ID"])) {$renameDashboardTab_entity_ID = (int)$_REQUEST["entity_ID"];}
// if(isset($_REQUEST["accessgroup_ID"]) && is_numeric($_REQUEST["accessgroup_ID"])) {$renameDashboardTab_accessgroup_ID = (int)$_REQUEST["accessgroup_ID"];}
if(isset($_REQUEST["title"]) && is_string($_REQUEST["title"])) {$renameDashboardTab_title = $_REQUEST["title"];}
if(isset($_REQUEST["description"]) && is_string($_REQUEST["description"])) {$renameDashboardTab_description = $_REQUEST["description"];}
//if(isset($_REQUEST["params"]) && is_string($_REQUEST["params"])) {$renameDashboardTab_params = $_REQUEST["params"];}


if(!isset($renameDashboardTab_user_ID))
{
    throw new Exception("cannot rename dashboard tab");
}
// if(!isset($renameDashboardTab_accessgroup_ID))
// {
//     throw new Exception("cannot rename dashboard tab");
// }
if(!isset($renameDashboardTab_entity_ID))
{
    throw new Exception("cannot rename dashboard tab");
}
if(empty($renameDashboardTab_title))
{
    $renameDashboardTab_title = '(blank)';
}
if(!isset($renameDashboardTab_description))
{
    $renameDashboardTab_description = '';
}

//$renameDashboardTab_title = addslashes($renameDashboardTab_title);
//$renameDashboardTab_description = addslashes($renameDashboardTab_description);
//logError($renameDashboardTab_user_ID);
//logError($renameDashboardTab_accessgroup_ID);
//logError($renameDashboardTab_entity_ID);

$strategy = new TC_RepositoryDashboardContainerStrategy();
$repo = new Repository($strategy);
//logError(count($repo->getOne($renameDashboardTab_user_ID, $renameDashboardTab_accessgroup_ID, $renameDashboardTab_entity_ID)));
$getPar = new THOR_GetParameterCapsule(array(),
                                        array('entity_id' => $renameDashboardTab_entity_ID,
                                                'user_id' => $renameDashboardTab_user_ID,
                                                'accessprofile' => new TC_DefaultAccessProfile()),
                                        array('overrideUAC' => false),
                                        array());
$db = $repo->getOne($getPar);


//$db = array_pop($repo->getOne($renameDashboardTab_user_ID, new TC_DefaultAccessProfile(), $renameDashboardTab_entity_ID, array('overrideUAC' => true)));
//logError(var_dump($db));
//$db instanceof DatabaseEntity;
$tab = $db->get_host();
/*
if(isset($renameDashboardTab_params))
{
    $paramArr = array();
    parse_str($renameDashboardTab_params, $paramArr);

    foreach($paramArr as $key => $value)
    {
        $setFunc = 'set_'.$key;
        $tab->$setFunc($value);
    }
}
*/
$tab->set_title($renameDashboardTab_title);
//$tab->set_description($renameDashboardTab_description);

$setPar = new THOR_SetParameterCapsule(null, array(/*'accessGroup_IDs' => array($renameDashboardTab_accessgroup_ID => 1),*/ 'user_id' => $renameDashboardTab_user_ID), array());
$repo->save($setPar);

//$repo->save($renameDashboardTab_user_ID,$renameDashboardTab_accessgroup_ID);
/*
if(isset($renameDashboardTab_title)){unset($renameDashboardTab_title);}
if(isset($renameDashboardTab_description)){unset($renameDashboardTab_description);}
//if(isset($renameDashboardTab_params)){unset($renameDashboardTab_params);}
if(isset($strategy)){unset($strategy);}
if(isset($repo)){unset($repo);}
if(isset($db)){unset($db);}
if(isset($tab)){unset($tab);}
if(isset($paramArr)){unset($paramArr);}
if(isset($setFunc)){unset($setFunc);}



//render(AJAX_PATH,'loadDashboardNavEdit.php', array('user_ID' => $renameDashboardTab_user_ID,'entity_ID' => $renameDashboardTab_entity_ID));


if(isset($renameDashboardTab_user_ID)){unset($renameDashboardTab_user_ID);}
if(isset($renameDashboardTab_entity_ID)){unset($renameDashboardTab_entity_ID);}

*/


?>
