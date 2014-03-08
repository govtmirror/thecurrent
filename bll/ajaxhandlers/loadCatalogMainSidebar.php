<?php
/*below goes on every page if you want it to work!*/

if(!isset($_SERVER['DOCUMENT_ROOT'])){ if(isset($_SERVER['SCRIPT_FILENAME'])){
$_SERVER['DOCUMENT_ROOT'] = str_replace( '\\', '/', substr($_SERVER['SCRIPT_FILENAME'], 0, 0-strlen($_SERVER['PHP_SELF'])));
}; };
if(!isset($_SERVER['DOCUMENT_ROOT'])){ if(isset($_SERVER['PATH_TRANSLATED'])){
$_SERVER['DOCUMENT_ROOT'] = str_replace( '\\', '/', substr(str_replace('\\\\', '\\', $_SERVER['PATH_TRANSLATED']), 0, 0-strlen($_SERVER['PHP_SELF'])));
}; };


require_once ($_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'library' . DIRECTORY_SEPARATOR . 'bootstrap.php');

// if(isset($_REQUEST["user_id"]) && is_numeric($_REQUEST["user_id"])) {$loadCatalogMainSidebar_user_id = (int)$_REQUEST["user_id"];}
// if(isset($_REQUEST["entity_id"]) && is_numeric($_REQUEST["entity_id"])) {$loadCatalogMainSidebar_entity_id = (int)$_REQUEST["entity_id"];}
// if(isset($_REQUEST["tag_ids"]) && is_numeric($_REQUEST["tag_ids"])) {$loadCatalogMainSidebar_tag_ids = (int)$_REQUEST["tag_ids"];}
// if(isset($_REQUEST["pageNum"]) && is_numeric($_REQUEST["pageNum"])) {$loadCatalogMainSidebar_pageNum = (int)$_REQUEST["pageNum"];}

// if(isset($_REQUEST["searchTerm"])) {$loadCatalogMainSidebar_searchTerm = $_REQUEST["searchTerm"];}
// if(isset($_REQUEST["orderBy"])) {$loadCatalogMainSidebar_orderBy = $_REQUEST["orderBy"];}


$loadCatalogMainSidebar_user_id = $_REQUEST["user_id"] ? (int)$_REQUEST["user_id"] : null;
// $loadCatalogMainSidebar_entity_id = $_REQUEST["entity_id"] ? (int)$_REQUEST["entity_id"] : null;
$loadCatalogMainSidebar_tag_ids = $_REQUEST["tag_ids"] ? $_REQUEST["tag_ids"] : null;
// $loadCatalogMainSidebar_pageNum = $_REQUEST["pageNum"] ? (int)$_REQUEST["pageNum"] : null;
$loadCatalogMainSidebar_searchTerm = $_REQUEST["searchTerm"] ? $_REQUEST["searchTerm"] : null;
// $loadCatalogMainSidebar_orderBy = $_REQUEST["orderBy"] ? $_REQUEST["orderBy"] : null;

// $loadCatalogMainSidebar_isPaged = $_REQUEST["isPaged"] ? $_REQUEST["isPaged"] : null;
// $loadCatalogMainSidebar_accessprofile = $_REQUEST["accessprofile"] ? $_REQUEST["accessprofile"] : null;
// $loadCatalogMainSidebar_accessGroupID = $_REQUEST["accessGroupID"] ? $_REQUEST["accessGroupID"] : null;



/*



entity_id
searchTerm
tag_ids
pageNum
orderBy
user_id

tag list stored

 */

$loadCatalogMainSidebar_tag_ids = $loadCatalogMainSidebar_tag_ids ? json_decode($loadCatalogMainSidebar_tag_ids) : null;
// logError($loadCatalogMainSidebar_tag_ids);

$latestArray = TC_Utility::getCatalogPagesDataArray(array(
																								// 'pageNum' => 1,
                                                'isPaged' => false,
                                                'accessprofile' => new AccessProfile(ValidAccessProfiles::CATALOG_READ, ValidAccessTypes::VIEW, ValidAccessContexts::CATALOG, ValidAccessLevels::BASIC_ACCESS),
                                                'orderBy' => ValidCatalogOrderTypes::RECENCY
                                                  ));

		$latestArray['tag_ids'] = $loadCatalogMainSidebar_tag_ids;
		$latestArray['searchTerm'] = $loadCatalogMainSidebar_searchTerm;


  		render(CONTAINER_VIEW_PATH,
  		        'CatalogMainSidebar.php',
  		        $latestArray
  		        // array('tag_ids' => $loadCatalogMainSidebar_tag_ids, 'searchTerm' => $loadCatalogMainSidebar_searchTerm, 'latestArray' => $latestArray)
  		);
















?>