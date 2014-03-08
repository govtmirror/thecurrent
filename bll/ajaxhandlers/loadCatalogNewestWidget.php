<?php
/*below goes on every page if you want it to work!*/

if(!isset($_SERVER['DOCUMENT_ROOT'])){ if(isset($_SERVER['SCRIPT_FILENAME'])){
$_SERVER['DOCUMENT_ROOT'] = str_replace( '\\', '/', substr($_SERVER['SCRIPT_FILENAME'], 0, 0-strlen($_SERVER['PHP_SELF'])));
}; };
if(!isset($_SERVER['DOCUMENT_ROOT'])){ if(isset($_SERVER['PATH_TRANSLATED'])){
$_SERVER['DOCUMENT_ROOT'] = str_replace( '\\', '/', substr(str_replace('\\\\', '\\', $_SERVER['PATH_TRANSLATED']), 0, 0-strlen($_SERVER['PHP_SELF'])));
}; };


require_once ($_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'library' . DIRECTORY_SEPARATOR . 'bootstrap.php');

// if(isset($_REQUEST["user_id"]) && is_numeric($_REQUEST["user_id"])) {$loadCatalogNewestWidget_user_id = (int)$_REQUEST["user_id"];}
// if(isset($_REQUEST["entity_id"]) && is_numeric($_REQUEST["entity_id"])) {$loadCatalogNewestWidget_entity_id = (int)$_REQUEST["entity_id"];}
// if(isset($_REQUEST["tag_ids"]) && is_numeric($_REQUEST["tag_ids"])) {$loadCatalogNewestWidget_tag_ids = (int)$_REQUEST["tag_ids"];}
// if(isset($_REQUEST["pageNum"]) && is_numeric($_REQUEST["pageNum"])) {$loadCatalogNewestWidget_pageNum = (int)$_REQUEST["pageNum"];}

// if(isset($_REQUEST["searchTerm"])) {$loadCatalogNewestWidget_searchTerm = $_REQUEST["searchTerm"];}
// if(isset($_REQUEST["orderBy"])) {$loadCatalogNewestWidget_orderBy = $_REQUEST["orderBy"];}



// $loadCatalogNewestWidget_orderBy = $_REQUEST["orderBy"] ? $_REQUEST["orderBy"] : null;

// $loadCatalogNewestWidget_isPaged = $_REQUEST["isPaged"] ? $_REQUEST["isPaged"] : null;
// $loadCatalogNewestWidget_accessprofile = $_REQUEST["accessprofile"] ? $_REQUEST["accessprofile"] : null;
// $loadCatalogNewestWidget_accessGroupID = $_REQUEST["accessGroupID"] ? $_REQUEST["accessGroupID"] : null;



/*



entity_id
searchTerm
tag_ids
pageNum
orderBy
user_id

tag list stored

 */

// logError($loadCatalogNewestWidget_tag_ids);

$latestArray = TC_Utility::getCatalogPagesDataArray(array(
                                                // 'pageNum' => 1,
                                                'isPaged' => false,
                                                'orderBy' => ValidCatalogOrderTypes::RECENCY
                                                  ));


  		render(WIDGET_VIEW_PATH,
              'TC_CatalogSideBarNewest.php',
              $latestArray
              // array('entity_read_set' => $CatalogMainSidebar_entity_read_set, 'entity_unsub_set' => $CatalogMainSidebar_entity_unsub_set)
      );
















?>