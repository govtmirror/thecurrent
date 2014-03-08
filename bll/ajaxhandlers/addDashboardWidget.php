<?php
/*
Inputs
-$addDashboardWidget_container_ID
-$addDashboardWidget_widgetType
-$addDashboardWidget_title
-$addDashboardWidget_description
-$addDashboardWidget_params
-$addDashboardWidget_priority

Outputs ~~~ loadDashboardContentEdit.php
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

if(isset($_REQUEST["user_ID"]) && is_numeric($_REQUEST["user_ID"])) {$addDashboardWidget_user_ID = (int)$_REQUEST["user_ID"];}
if(isset($_REQUEST["accessgroup_ID"]) && is_numeric($_REQUEST["accessgroup_ID"])) {$addDashboardWidget_accessgroup_ID = (int)$_REQUEST["accessgroup_ID"];}
if(isset($_REQUEST["container_ID"]) && is_numeric($_REQUEST["container_ID"])) {$addDashboardWidget_container_ID = (int)$_REQUEST["container_ID"];}
if(isset($_REQUEST["widgetType"]) && is_string($_REQUEST["widgetType"])) {$addDashboardWidget_widgetType = $_REQUEST["widgetType"];}
if(isset($_REQUEST["title"]) && is_string($_REQUEST["title"])) {$addDashboardWidget_title = $_REQUEST["title"];}
if(isset($_REQUEST["description"]) && is_string($_REQUEST["description"])) {$addDashboardWidget_description = $_REQUEST["description"];}
if(isset($_REQUEST["params"]) && is_string($_REQUEST["params"])) {$addDashboardWidget_params = $_REQUEST["params"];}
if(isset($_REQUEST["priority"]) && is_string($_REQUEST["priority"])) {$addDashboardWidget_priority = $_REQUEST["priority"];}
if(isset($_REQUEST["viewType"]) && is_string($_REQUEST["viewType"])) {$addDashboardWidget_viewType = $_REQUEST["viewType"];}



if(!isset($addDashboardWidget_user_ID))
{
    throw new Exception("cannot load dashboard tab");
}
if(!isset($addDashboardWidget_accessgroup_ID))
{
    throw new Exception("cannot load dashboard tab");
}
if(!isset($addDashboardWidget_container_ID))
{
    throw new Exception("cannot load dashboard tab");
}
if(!isset($addDashboardWidget_widgetType))
{
    throw new Exception("cannot load dashboard tab");
}
if(!isset($addDashboardWidget_priority))
{
    throw new Exception("cannot load dashboard tab");
}
if(empty($addDashboardWidget_title))
{
    $addDashboardWidget_title = '(blank)';
}
if(!isset($addDashboardWidget_description))
{
    $addDashboardWidget_description = '';
}


//$addDashboardWidget_title = addslashes($addDashboardWidget_title);
//$addDashboardWidget_description = addslashes($addDashboardWidget_description);

//$addDashboardWidget_widgetType = $addDashboardWidget_widgetType . "Widget";
$widget = new $addDashboardWidget_widgetType($addDashboardWidget_title,$addDashboardWidget_description);
//$widget instanceof TC_Source;
if(isset($addDashboardWidget_viewType))
{
    $widget->set_viewtype($addDashboardWidget_viewType);
}

if(isset($addDashboardWidget_params))
{
    //$paramArr = array();
    //parse_str($addDashboardWidget_params, $paramArr);

    $paramArr = unserialize(stripslashes($addDashboardWidget_params));
    // logError(var_export($paramArr, true));
    foreach($paramArr as $key => $value)
    {
        $setFunc = 'set_'.$key;

        $widget->$setFunc($value);
        // logError(var_export($widget, true));
    }
}

$dbe = new TC_DashboardSource_EntityModel(null,
                                        null,
                                        $widget,
                                        1,
                                        date('Y-m-d H:i:s'),
                                        date('Y-m-d H:i:s'),
                                        $addDashboardWidget_user_ID,
                                        $addDashboardWidget_priority);

//$dbe = new TC_DashboardSource_EntityModel(null, null, $widget, 1, 1, date('Y-m-d H:i:s'), date('Y-m-d H:i:s'), $addDashboardWidget_user_ID, $addDashboardWidget_priority);

//$dbe->setHost($widget);
//$dbe->setPriority($addDashboardWidget_priority);




$strategy = new TC_RepositoryDashboardSourceStrategy();
$repo = new Repository($strategy);
$repo->loadEntity($dbe);
$setPar = new THOR_SetParameterCapsule(null,
                                        array('container_id' => $addDashboardWidget_container_ID
                                                ),
                                        array());
$repo->save($setPar);

//$repo->save($addDashboardWidget_user_ID, $addDashboardWidget_accessgroup_ID, array('container_id' => $addDashboardWidget_container_ID));

/*
if(isset($addDashboardWidget_widgetType)){unset($addDashboardWidget_widgetType);}
if(isset($addDashboardWidget_description)){unset($addDashboardWidget_description);}
if(isset($addDashboardWidget_title)){unset($addDashboardWidget_title);}
if(isset($addDashboardWidget_params)){($addDashboardWidget_params);}
if(isset($addDashboardWidget_priority)){($addDashboardWidget_priority);}
if(isset($strategy)){unset($strategy);}
if(isset($repo)){unset($repo);}
if(isset($dbe)){unset($dbe);}
if(isset($paramArr)){unset($paramArr);}
if(isset($setFunc)){unset($setFunc);}
if(isset($widget)){unset($widget);}



//render(AJAX_PATH,'loadDashboardContentEdit.php', array('container_ID' => $addDashboardWidget_container_ID));


if(isset($addDashboardWidget_container_ID)){unset($addDashboardWidget_container_ID);}
*/



?>
