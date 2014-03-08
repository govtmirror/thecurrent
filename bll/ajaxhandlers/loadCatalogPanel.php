<?php
/*below goes on every page if you want it to work!*/

if(!isset($_SERVER['DOCUMENT_ROOT'])){ if(isset($_SERVER['SCRIPT_FILENAME'])){
$_SERVER['DOCUMENT_ROOT'] = str_replace( '\\', '/', substr($_SERVER['SCRIPT_FILENAME'], 0, 0-strlen($_SERVER['PHP_SELF'])));
}; };
if(!isset($_SERVER['DOCUMENT_ROOT'])){ if(isset($_SERVER['PATH_TRANSLATED'])){
$_SERVER['DOCUMENT_ROOT'] = str_replace( '\\', '/', substr(str_replace('\\\\', '\\', $_SERVER['PATH_TRANSLATED']), 0, 0-strlen($_SERVER['PHP_SELF'])));
}; };


require_once ($_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'library' . DIRECTORY_SEPARATOR . 'bootstrap.php');

// if(isset($_REQUEST["user_id"]) && is_numeric($_REQUEST["user_id"])) {$loadCatalogPanel_user_id = (int)$_REQUEST["user_id"];}
// if(isset($_REQUEST["entity_id"]) && is_numeric($_REQUEST["entity_id"])) {$loadCatalogPanel_entity_id = (int)$_REQUEST["entity_id"];}
// if(isset($_REQUEST["tag_ids"]) && is_numeric($_REQUEST["tag_ids"])) {$loadCatalogPanel_tag_ids = (int)$_REQUEST["tag_ids"];}
// if(isset($_REQUEST["pageNum"]) && is_numeric($_REQUEST["pageNum"])) {$loadCatalogPanel_pageNum = (int)$_REQUEST["pageNum"];}

// if(isset($_REQUEST["searchTerm"])) {$loadCatalogPanel_searchTerm = $_REQUEST["searchTerm"];}
// if(isset($_REQUEST["orderBy"])) {$loadCatalogPanel_orderBy = $_REQUEST["orderBy"];}


$loadCatalogPanel_user_id = $_REQUEST["user_id"] ? (int)$_REQUEST["user_id"] : null;
$loadCatalogPanel_entity_id = $_REQUEST["entity_id"] ? (int)$_REQUEST["entity_id"] : null;
$loadCatalogPanel_tag_ids = $_REQUEST["tag_ids"] ? $_REQUEST["tag_ids"] : null;
$loadCatalogPanel_pageNum = $_REQUEST["pageNum"] ? (int)$_REQUEST["pageNum"] : null;
$loadCatalogPanel_searchTerm = $_REQUEST["searchTerm"] ? $_REQUEST["searchTerm"] : null;
$loadCatalogPanel_orderBy = $_REQUEST["orderBy"] ? $_REQUEST["orderBy"] : null;

$loadCatalogPanel_isPaged = $_REQUEST["isPaged"] ? $_REQUEST["isPaged"] : null;
$loadCatalogPanel_accessprofile = $_REQUEST["accessprofile"] ? $_REQUEST["accessprofile"] : null;
$loadCatalogPanel_accessGroupID = $_REQUEST["accessGroupID"] ? $_REQUEST["accessGroupID"] : null;



/*



entity_id
searchTerm
tag_ids
pageNum
orderBy
user_id

tag list stored

 */

$loadCatalogPanel_tag_ids = $loadCatalogPanel_tag_ids ? json_decode($loadCatalogPanel_tag_ids) : null;
// logError($loadCatalogPanel_tag_ids);

$dataArr = TC_Utility::getCatalogPagesDataArray(array(
                                                'user_id' => $loadCatalogPanel_user_id,
                                                'entity_id' => $loadCatalogPanel_entity_id,
                                                'tag_ids' => $loadCatalogPanel_tag_ids,
                                                'pageNum' => $loadCatalogPanel_pageNum,
                                                'searchTerm' => $loadCatalogPanel_searchTerm,
                                                'isPaged' => $loadCatalogPanel_isPaged,
                                                'accessprofile' => $loadCatalogPanel_accessprofile,
                                                'orderBy' => $loadCatalogPanel_orderBy,
                                                'accessGroupID' => $loadCatalogPanel_accessGroupID
                                                  ));




  		render(CONTAINER_VIEW_PATH,
  		        'CatalogPanel.php',
  		        $dataArr
  		);
















?>