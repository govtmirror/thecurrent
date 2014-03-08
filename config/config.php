<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

define ('DEVELOPMENT_ENVIRONMENT',true);
define ('STAGING_ENVIRONMENT',true);

define('DB_NAME', 'the_current_revised_staging');
define('DB_USER', 'root');
define('DB_PASSWORD', 'root');
define('DB_HOST', '127.0.0.1');


define('DS', DIRECTORY_SEPARATOR);

define('FULL_ROOT', dirname(dirname(dirname(__FILE__))));
define('ROOT', dirname(dirname(__FILE__)));
define('INCLUDES', ROOT . DS . 'public' . DS);
define('SITE_DOMAIN','http://thecurrent.state.gov');

define('BLL_PATH', ROOT.DS."bll".DS);
define('VIEW_PATH', ROOT.DS."views".DS);
define('MODEL_PATH', ROOT.DS."models".DS);
define('CONTAINER_VIEW_PATH', VIEW_PATH."containerviews".DS);
define('WIDGET_VIEW_PATH', VIEW_PATH."widgetviews".DS);
define('CONTAINER_EDIT_PATH', VIEW_PATH."containeredit".DS);
define('WIDGET_EDIT_PATH', VIEW_PATH."widgetedit".DS);
define('AJAX_PATH', BLL_PATH."ajaxhandlers".DS);

define('GLOBAL_PRIMARY_KEY_NAME', 'id');

define('MAX_DASHBOARD_TABS', 15);
define('MAX_DASHBOARD_WIDGETS_PER_TAB',9);
define('MAX_COLUMNS_PER_DASHBOARD__TAB',3);
//define('TAB_COLLECTION_TYPES_WITH_NO_MAX', serialize(array('user_shared','catalog_subitted','catalog_default')));

define('MAX_DASHBOARD_TABS_PER_GROUP', 10);
define('MAX_SUBSCRIBED_TABS_PER_USER', 10);
define('MAX_PUBLISHED_TABS_PER_USER', 10);

define('CATALOG_PAGE_SIZE', 10);

define('GLOBAL_FEED_ITEM_CAP',10);
define('GLOBAL_FEED_DESCRIPTION_CHAR_CAP',150);

define('SHAREPAGEPATH', 'share.php');

define('MEDIA_VIEW_TYPE_ID',2);

define('SYSTEM_USER_ID',0);
define('DEFAULT_GLOBAL_ADMIN', 1234);

define('DISCUSSION_PAGE_FOLDER', 'discussion');
define('DISCUSSION_PAGE_ID',5);

define('DB_NULL', 'NULL');

define('ADMIN_EMAIL','edipcurrentadmin@state.gov');

define('PIWIK_TRACKING_NUMBER',184);
define('CORRIDOR_URL','http://corridor.state.gov');
define('CORRIDOR_WEB_SERVICE_URL','http://corridor.state.gov/rssfeeds/rss.php');

define('CORRIDOR_GROUP_WEB_SERVICE_URL','http://corridor.state.gov/rssfeeds/generateGroupsList.php');

define('CORRIDOR_TAG_API_URL', '/bll/ajaxhandlers/corridorTagTest.js');
// define('CORRIDOR_TAG_API_URL', 'http://corridor.state.gov/api/tags/');

//define('YES',dirname(dirname(__FILE__)));
/*
define('ROOT_PATH', realpath(dirname(__FILE__).'/../../').'/');
$projectDir = implode('/', array_intersect(explode('/', $_SERVER["REQUEST_URI"]),explode('/', str_replace('\\','/',ROOT_PATH))));
if($projectDir[strlen($projectDir)-1] != '/')
{
    $projectDir .= '/';
}
define('PROJECT_DIR', $projectDir);
define('BASE_URL', 'http://' . $_SERVER['HTTP_HOST'].PROJECT_DIR);
*/



/*
define('DB_TABLES', serialize(array(
    "CONTAINERPARAMFIELDS",
    "CONTAINERPARAMVALUES",
    "CONTAINERS",
    "CONTAINERS_FIELDS_VALUES",
    "CONTAINERTYPES",
    "REGIONPARAMFIELDS",
    "REGIONPARAMVALUES",
    "REGIONS",
    "REGIONS_FIELDS_VALUES",
    "REGIONTYPES",
    "WIDGETPARAMFIELDS",
    "WIDGETPARAMVALUES",
    "WIDGETS",
    "WIDGETS_FIELDS_VALUES",
    "WIDGETTYPES"
)));

foreach(unserialize(DB_TABLES) as $table)
{

    define("$table", '');

}
 *
 */

?>
