<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */



/** Check if environment is development and display errors **/

function setReporting() {
    if (DEVELOPMENT_ENVIRONMENT == true)
    {
        //error_reporting(E_ALL);
        error_reporting(E_ALL & ~E_DEPRECATED & ~E_WARNING & ~E_STRICT & ~E_NOTICE);
        ini_set('display_errors','1');
    }
    else
    {
        //error_reporting(0);
        error_reporting(E_ALL & ~E_DEPRECATED & ~E_WARNING & ~E_STRICT & ~E_NOTICE);
        ini_set('display_errors','0');
        ini_set('log_errors', 'On');
        ini_set('error_log', ROOT.DS.'tmp'.DS.'logs'.DS.'error.log');
    }
}

/** Check for Magic Quotes and remove them **/

function stripSlashesDeep($value) {
$value = is_array($value) ? array_map('stripSlashesDeep', $value) : stripslashes($value);
return $value;
}

function removeMagicQuotes() {
if ( get_magic_quotes_gpc() ) {
$_GET    = stripSlashesDeep($_GET   );
$_POST   = stripSlashesDeep($_POST  );
$_COOKIE = stripSlashesDeep($_COOKIE);
}
}

/** Check register globals and remove them **/
 // for MVC only
/*
function unregisterGlobals() {
if (ini_get('register_globals')) {
$array = array('_SESSION', '_POST', '_GET', '_COOKIE', '_REQUEST', '_SERVER', '_ENV', '_FILES');
foreach ($array as $value) {
foreach ($GLOBALS[$value] as $key => $var) {
if ($var === $GLOBALS[$key]) {
unset($GLOBALS[$key]);
}
}
}
}
}
 *
 */

/** Main Call Function **/
/*
function callHook() {
global $url;

$urlArray = array();
$urlArray = explode("/",$url);

$controller = $urlArray[0];
array_shift($urlArray);
$action = $urlArray[0];
array_shift($urlArray);
$queryString = $urlArray;

$controllerName = $controller;
$controller = ucwords($controller);
$model = rtrim($controller, 's');
$controller .= 'Controller';
$dispatch = new $controller($model,$controllerName,$action);

if ((int)method_exists($controller, $action)) {
call_user_func_array(array($dispatch,$action),$queryString);
} else {
 *
 */
/* Error Generation Code Here */
/*
}
}
 */
//no go
function getAllDirectories()
{
    $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator(ROOT . DS), RecursiveIteratorIterator::SELF_FIRST);
    $returnMe = array();
    foreach($iterator as $file)
    {
        if($file->isDir())
        {
            $returnMe[] = $file->getRealPath();
        }
    }
    return $returnMe;

}




/** Autoload any classes that are required **/

Autoloader::setCacheFilePath(ROOT . DS . 'tmp/autoloaderfiles/log.txt' );
Autoloader::setClassPaths(

            array
            (
                ROOT . DS . 'models/',

                //ROOT . DS . 'bll/ajaxhandlers',
                //ROOT . DS . 'bll/modelbuilders/',
                //ROOT . DS . 'bll/modelbuilders/containers',
                //ROOT . DS . 'bll/modelbuilders/dashboardwidgets',
                //ROOT . DS . 'bll/modelbuilders/sidebarwidgets',
                //ROOT . DS . 'bll/repostrategies/',
                ROOT . DS . 'config/',
                ROOT . DS . 'library/',
                ROOT . DS . 'bll/'
                //ROOT . DS . 'library/authentication/',
                //ROOT . DS . 'library/rss/',

                //ROOT . DS . 'models/containers/',
                //ROOT . DS . 'models/sidebarwidgets/',
                //ROOT . DS . 'models/dashboardwidgets/',
                //ROOT . DS . 'models/sidebarwidgets/internal',
                //ROOT . DS . 'models/sidebarwidgets/external',
                //ROOT . DS . 'views/',
                //ROOT . DS . 'views/containeredit/',
                //ROOT . DS . 'views/containerviews/',
                //ROOT . DS . 'views/widgetedit/',
                //ROOT . DS . 'views/widgetviews/'
            )

        );
        spl_autoload_register(array('Autoloader', 'loadClass'));

        require_once ROOT . DS . 'library/htmlpurifier-4.4.0/library/HTMLPurifier.auto.php';
        require_once ROOT . DS . 'library/rss/simplepie-simplepie-d2dd1d4/simplepie.inc';

foreach(MySQLConfig::getTables() as $table)
{
    define(strtoupper($table), strtoupper($table));
    //define(strtoupper($table).'_DBFIELDS', serialize(MySQLConfig::getFields($table)));
    define(strtoupper($table).'_DBFIELDS', serialize(MySQLConfig::getFieldsNoTableName($table)));
    define(strtoupper($table).'_DB_TABLEFIELDS', serialize(MySQLConfig::getFields($table)));

}
//Autoloader::addClassPath(ROOT . DS .'views/widgetviews/');




/*
function __autoload($className) {
if (file_exists(ROOT . DS . 'library' . DS . strtolower($className) . '.class.php')) {
require_once(ROOT . DS . 'library' . DS . strtolower($className) . '.class.php');
} else if (file_exists(ROOT . DS . 'application' . DS . 'controllers' . DS . strtolower($className) . '.php')) {
require_once(ROOT . DS . 'application' . DS . 'controllers' . DS . strtolower($className) . '.php');
} else if (file_exists(ROOT . DS . 'application' . DS . 'models' . DS . strtolower($className) . '.php')) {
require_once(ROOT . DS . 'application' . DS . 'models' . DS . strtolower($className) . '.php');
} else {
 *
 */
/* Error Generation Code Here */
/*
}
}
 *
 */


setReporting();
removeMagicQuotes();
ini_set('memory_limit', '-1');
ini_set('max_execution_time', 123456);
date_default_timezone_set('America/New_York');
//unregisterGlobals();
//callHook();

global $corridorID, $activeDashboardTab;
if(empty($corridorID))
{
    //$corridorID = TC_Authenticator::getUserID();
}






?>
