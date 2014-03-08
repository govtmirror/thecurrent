<?php
// /*below goes on every page if you want it to work!*/

// if(!isset($_SERVER['DOCUMENT_ROOT'])){ if(isset($_SERVER['SCRIPT_FILENAME'])){
// $_SERVER['DOCUMENT_ROOT'] = str_replace( '\\', '/', substr($_SERVER['SCRIPT_FILENAME'], 0, 0-strlen($_SERVER['PHP_SELF'])));
// }; };
// if(!isset($_SERVER['DOCUMENT_ROOT'])){ if(isset($_SERVER['PATH_TRANSLATED'])){
// $_SERVER['DOCUMENT_ROOT'] = str_replace( '\\', '/', substr(str_replace('\\\\', '\\', $_SERVER['PATH_TRANSLATED']), 0, 0-strlen($_SERVER['PHP_SELF'])));
// }; };


// require_once ($_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'library' . DIRECTORY_SEPARATOR . 'bootstrap.php');

// // if(isset($_REQUEST["user_ID"]) && is_numeric($_REQUEST["user_ID"])) {$loadCatalog_user_ID = (int)$_REQUEST["user_ID"];}
// // if(isset($_REQUEST["entity_ID"]) && is_numeric($_REQUEST["entity_ID"])) {$loadCatalog_entity_ID = (int)$_REQUEST["entity_ID"];}
// // if(isset($_REQUEST["tag_IDs"]) && is_numeric($_REQUEST["tag_IDs"])) {$loadCatalog_tag_IDs = (int)$_REQUEST["tag_IDs"];}
// // if(isset($_REQUEST["pageNum"]) && is_numeric($_REQUEST["pageNum"])) {$loadCatalog_pageNum = (int)$_REQUEST["pageNum"];}

// // if(isset($_REQUEST["searchTerm"])) {$loadCatalog_searchTerm = $_REQUEST["searchTerm"];}
// // if(isset($_REQUEST["orderBy"])) {$loadCatalog_orderBy = $_REQUEST["orderBy"];}


// $loadCatalog_user_ID = $_REQUEST["user_ID"] ? (int)$_REQUEST["user_ID"] : null;
// $loadCatalog_entity_ID = $_REQUEST["entity_ID"] ? (int)$_REQUEST["entity_ID"] : null;
// $loadCatalog_tag_IDs = $_REQUEST["tag_IDs"] ? (int)$_REQUEST["tag_IDs"] : array();
// $loadCatalog_pageNum = $_REQUEST["pageNum"] ? (int)$_REQUEST["pageNum"] : null;
// $loadCatalog_searchTerm = $_REQUEST["searchTerm"] ? $_REQUEST["searchTerm"] : null;
// $loadCatalog_orderBy = $_REQUEST["orderBy"] ? $_REQUEST["orderBy"] : null;

// $loadCatalog_isPaged = $_REQUEST["isPaged"] ? $_REQUEST["isPaged"] : null;



// /*



// entity_ID
// searchTerm
// tag_IDs
// pageNum
// orderBy
// user_ID

// tag list stored

//  */

// if(!isset($loadCatalog_user_ID))
//     {
//         $loadCatalog_user_ID_array = TC_Authenticator::getUserIDAndInitialize();
//         $loadCatalog_user_ID = $loadCatalog_user_ID_array[0];

//     }
// if(isset($loadCatalog_user_ID) && $loadCatalog_user_ID == SYSTEM_USER_ID)
//     {
//         throw new Exception("Cannot edit without Corridor authentication");
//     }
// else if(isset($loadCatalog_user_ID))
//     {


//     	$accessprofileRead = new AccessProfile(ValidAccessProfiles::CATALOG_READ, ValidAccessTypes::VIEW, ValidAccessContexts::CATALOG, ValidAccessLevels::BASIC_ACCESS);
//     	$accessprofileUnsub = new AccessProfile(ValidAccessProfiles::CATALOG_UNSUBSCRIBE, ValidAccessTypes::UNSUBSCRIBE, ValidAccessContexts::CATALOG, ValidAccessLevels::BASIC_ACCESS);

//     	$containersRead = TC_Utility::getPublishedPagesForCatalog(array(
// 																																		'user_id' => $loadCatalog_user_ID,
// 																																		'entity_id' => $loadCatalog_entity_ID,
// 																																		'tag_ids' => $loadCatalog_tag_IDs,
// 																																		'pageNum' => $loadCatalog_pageNum,
// 																																		'searchTerm' => $loadCatalog_searchTerm,
// 																																		'orderBy' => $loadCatalog_orderBy,
// 																																		'isPaged' => $loadCatalog_isPaged,
// 																																		'accessprofile' => $accessprofileRead

// 																																			));

//     	$containersUnsub = TC_Utility::getPublishedPagesForCatalog(array(
// 																																		'user_id' => $loadCatalog_user_ID,
// 																																		'entity_id' => $loadCatalog_entity_ID,
// 																																		'tag_ids' => $loadCatalog_tag_IDs,
// 																																		'pageNum' => $loadCatalog_pageNum,
// 																																		'searchTerm' => $loadCatalog_searchTerm,
// 																																		'orderBy' => $loadCatalog_orderBy,
// 																																		'isPaged' => $loadCatalog_isPaged,
// 																																		'accessprofile' => $accessprofileUnsub

// 																																			));






//     	// $tempEntity = getEntityFromRepoPool($loadCatalog_entity_ID, $containersRead, 'get_entity_id');

//   		// $loadCatalog_model_ID = isset($loadCatalog_entity_ID) && $tempEntity ? $tempEntity->get_host_id() : null;

//   		$json_url = CORRIDOR_TAG_API_URL;
//   		$json = file_get_contents($json_url);
//   		$data = json_decode($json);



//   		// echo '<div id="ajaxRenderSidebar">';
//   		// render(CONTAINER_VIEW_PATH,
//   		//         'CatalogMainSidebar.php',
//   		//         array('user_ID' =>$loadCatalog_user_ID,
//   		//             'entity_ID' => $loadCatalog_entity_ID,
//   		//             'tag_IDs' => $loadCatalog_tag_IDs,
//   		//             'pageNum' => $loadCatalog_pageNum,

//   		//             'searchTerm' => $loadCatalog_searchTerm,
//   		//             'orderBy' => $loadCatalog_orderBy,
//   		//             'entity_read_set' => $containersRead,
//   		//             'entity_unsub_set' => $containersUnsub,
//   		//             'tags' => $data//,

//   		//         )
//   		// );
//   		// echo '</div>';
//   		// //$returnMe['content'] =
//   		// echo '<div id="ajaxRenderPanel">';
//   		// render(CONTAINER_VIEW_PATH,
//   		//         'CatalogPanel.php',
//   		//         array('user_ID' =>$loadCatalog_user_ID,
//   		//             'entity_ID' => $loadCatalog_entity_ID,
//   		//             'tag_IDs' => $loadCatalog_tag_IDs,
//   		//             'pageNum' => $loadCatalog_pageNum,

//   		//             'searchTerm' => $loadCatalog_searchTerm,
//   		//             'orderBy' => $loadCatalog_orderBy,
//   		//             'entity_read_set' => $containersRead,
//   		//             'entity_unsub_set' => $containersUnsub,
//   		//             'tags' => $data//,

//   		//         )
//   		// );
//   		// echo '</div>';

//   		return array('user_ID' =>$loadCatalog_user_ID,
//   		            'entity_ID' => $loadCatalog_entity_ID,
//   		            'tag_IDs' => $loadCatalog_tag_IDs,
//   		            'pageNum' => $loadCatalog_pageNum,
//   		            'isPaged' => $loadCatalog_isPaged,

//   		            'searchTerm' => $loadCatalog_searchTerm,
//   		            'orderBy' => $loadCatalog_orderBy,
//   		            'entity_read_set' => $containersRead,
//   		            'entity_unsub_set' => $containersUnsub,
//   		            'tags' => $data

//     							);




//     }










?>