<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TC_THOR_GetContainersForUserDashboardView_GetRepo
 *
 * @author KottkeDP
 */
class TC_THOR_GetContainersForPublicCatalogView_GetRepo extends GetStrategy{
	protected $container_manager;
	protected $uac_manager;

	public function __construct($dataSource = null) {
	    if(!isset($dataSource))
	    {
	        $dataSource = MySQLConfig::dsConnect();
	    }
	    $container_manager = new TC_THOR_ContainerDatabaseManager($dataSource);
	    $this->set_container_manager($container_manager);
	    $uac_manager = new THOR_UserAccessDatabaseManager($dataSource);
	    $this->set_uac_manager($uac_manager);

	    parent::__construct($dataSource);
	}


	// public function getQuery(IGetParameterModel $param){

	// 		    $params = $param->get_parameters();
	// 		    $options = $param->get_options();
	// 		    //expected params
	// 		    // - user_id
	// 		    // - accessprofile


	// 		    $catalogReadProfile = new AccessProfile(ValidAccessProfiles::CATALOG_READ, ValidAccessTypes::VIEW, ValidAccessContexts::CATALOG, ValidAccessLevels::BASIC_ACCESS);
	// 		    $catalogUnsubProfile = new AccessProfile(ValidAccessProfiles::CATALOG_UNSUBSCRIBE, ValidAccessTypes::UNSUBSCRIBE, ValidAccessContexts::CATALOG, ValidAccessLevels::BASIC_ACCESS);


	// 		    if(array_key_exists('entity_id', $params) && $params['entity_id'])
	// 		    {
	// 		        $entity_id = $params['entity_id'];
	// 		    }
	// 		    else
	// 		    {
	// 		        $entity_id = null;
	// 		        //$user_id = SYSTEM_USER_ID;
	// 		    }
	// 		    if(array_key_exists('searchTerm', $params) && $params['searchTerm'])
	// 		    {
	// 		        $searchTerm = $params['searchTerm'];
	// 		    }
	// 		    else
	// 		    {
	// 		        $searchTerm = null;
	// 		    }
	// 		    if(array_key_exists('tag_ids', $params) && $params['tag_ids'])
	// 		    {
	// 		        $tag_ids = $params['tag_ids'];
	// 		    }
	// 		    else
	// 		    {
	// 		        $tag_ids = array();
	// 		    }
	// 		    if(array_key_exists('pageNum', $params) && $params['pageNum'])
	// 		    {
	// 		        $pageNum = $params['pageNum'];
	// 		    }
	// 		    else
	// 		    {
	// 		        $pageNum = 1;
	// 		    }


	// 		    if(array_key_exists('isPaged', $params) && $params['isPaged'])
	// 		    {
	// 		        $isPaged = $params['isPaged'];
	// 		    }
	// 		    else
	// 		    {
	// 		        $isPaged = true;
	// 		    }

	// 		    if($isPaged)
	// 		    {
	// 		    	$limit = CATALOG_PAGE_SIZE * ($pageNum - 1) . ',' . CATALOG_PAGE_SIZE ;//* $pageNum;
	// 		    }
	// 		    else
	// 		    {
	// 		    	$limit = null;
	// 		    }


	// 		    // searchTerms
	// 		    // tagId
	// 		    // ordering info
	// 		    //
	// 		    //
	// 		    //expect access group parameter option
	// 		    //get user access groups
	// 		    //


	// 		    $containersDV = $this->get_container_manager()->get_containersMetaAndTaxMasterQuery();

	// 		    $friendlies = $this->get_container_manager()->get_containersMetaAndTaxMasterQuery()->get_friendlyNames();
	// 		    $persistables = $this->get_container_manager()->get_containersMetaAndTaxMasterQuery()->get_persistableInputCollection();


	// 		    if(array_key_exists('orderBy', $params) && $params['orderBy'])
	// 		    {

	// 	  		    switch ($params['orderBy']) {
	// 	  		    	case ValidCatalogOrderTypes::RECENCY :
	// 	  		    		$order = array($containersDV->encodeColumnForSQL($persistables[$friendlies['ENTITIES']], 'last_edited') =>
	// 	  	                                        array('direction' => 'DESC')
	// 	  	                                    );
	// 	  	    		break;
	// 	  	    		// TODO : Implement this
	// 	  	    		// case ValidCatalogOrderTypes::RATING :
	// 	  		    	// 	$order = array($containersDV->encodeColumnForSQL($persistables[$friendlies['METADATA']], '') =>
	// 	  	      //                                   array('direction' => 'DESC', 'cast_type' => 'unsigned')
	// 	  	      //                               );
	// 	  		    	// break;

	// 	  	    		// case ValidCatalogOrderTypes::FOLLOWERS :
	// 	  		    	// 	$order = array($containersDV->encodeColumnForSQL($persistables[$friendlies['ENTITIES']], 'last_edited') =>
	// 	  	      //                                   array('direction' => 'ASC', 'cast_type' => 'unsigned')
	// 	  	      //                               );
	// 	  		    	// break;

	// 	  		    	default:
	// 	  		    		$order = array($containersDV->encodeColumnForSQL($persistables[$friendlies['ENTITIES']], 'last_edited') =>
	// 	  	                                        array('direction' => 'DESC')
	// 	  	                                    );
	// 	  		    		break;
	// 	  		    }
	// 		    }
	// 		    else
	// 		    {
	// 		    		$order = array($containersDV->encodeColumnForSQL($persistables[$friendlies['ENTITIES']], 'last_edited') =>
	// 	                                        array('direction' => 'DESC')
	// 	                                    );
	// 		    }



	// 		    $entitytype = $this->get_container_manager()->entityTypeVerification(ValidEntityTypes::TAB);
	// 		    // $metadatatype = $this->get_container_manager()->metadataTypeVerification(ValidMetadataTypes::DASHBOARD_PRIORITY);

	// 		    $taxonomy = $this->get_container_manager()->tagTaxonomyVerification();


	// 		    $condition = new QueryConditionComparison(ValidSQLComparisonOperations::EQUALS,
	// 		                                                new QueryFreeFormConstant(DB_NAME."."."TAXONOMIES".".".$persistables[$friendlies['TAXONOMIES']]->get_keyName()),
	// 		                                                new QueryFreeFormConstant($taxonomy->get_keyValue()));

	// 		    if($entity_id)
	// 		    {
	// 		        $conditionEnt = new QueryConditionComparison(ValidSQLComparisonOperations::EQUALS,
	// 		                                                new QueryFreeFormConstant(DB_NAME."."."ENTITIES".".".$persistables[$friendlies['ENTITIES']]->get_keyName()),
	// 		                                                new QueryFreeFormConstant($entity_id));

	// 		        $condition = new QueryConditionComparison(ValidSQLComparisonOperations::_AND,
	// 		                                                $condition,
	// 		                                                $conditionEnt);
	// 		        //$conditionEnt = new QueryConditionComparison(ValidSQLComparisonOperations::EQUALS, 1, 1);
	// 		    }

	// 		    if($searchTerm){
	// 		    	$conditionSearch = new QueryConditionComparison(ValidSQLComparisonOperations::LIKE,
	// 		    	                                        new QueryFreeFormConstant(DB_NAME."."."CONTAINERS"."."."title"),
	// 		    	                                        new QueryStringConstant("%" . $searchTerm . "%"));

	// 		    	$condition = new QueryConditionComparison(ValidSQLComparisonOperations::_AND,
	// 		    	                                        $condition,
	// 		    	                                        $conditionSearch);
	// 		    }

	// 		    if($tag_ids){
	// 		    	$conditionTag = new QueryConditionComparison(ValidSQLComparisonOperations::EQUALS, 1, 1);

	// 		    	foreach($tag_ids as $tag_id){
	// 		    		$conditionTag2 = new QueryConditionComparison(ValidSQLComparisonOperations::EQUALS,
	// 		    		                                        new QueryFreeFormConstant(DB_NAME."."."TERMS_TAXONOMIES"."."."termtaxonomy_id"),
	// 		    		                                        new QueryFreeFormConstant($tag_id));

	// 		    		$conditionTag = new QueryConditionComparison(ValidSQLComparisonOperations::_OR,
	// 		    		                                        $conditionTag,
	// 		    		                                        $conditionTag2);

	// 		    	}


	// 		    	$condition = new QueryConditionComparison(ValidSQLComparisonOperations::_AND,
	// 		    	                                        $condition,
	// 		    	                                        $conditionTag);
	// 		    }





	// 	      $entitiesEncounteredKeys = $this->get_uac_manager()->getUACEntitiesFromGroupRightsIDs(SYSTEM_USER_ID,
	// 	                                                                                          $catalogReadProfile,
	// 	                                                                                          $entitytype->get_keyValue());

	// 	      $uac_verified_entities_string = implode(',', $entitiesEncounteredKeys);
	// 	      if(!$uac_verified_entities_string)
	// 	      {
	// 	          $UAC_Filter = new QueryConditionComparison(ValidSQLComparisonOperations::EQUALS, 0, 1);
	// 	      }
	// 	      else
	// 	      {
	// 	          $UAC_Filter = new QueryConditionComparison(ValidSQLComparisonOperations::IN,
	// 	                                                  new QueryFreeFormConstant(DB_NAME."."."ENTITIES".".".$persistables[$friendlies['ENTITIES']]->get_keyName()),
	// 	                                                  new QueryFreeFormConstant("(".$uac_verified_entities_string.")"));
	// 	      }
	// 	      $condition = new QueryConditionComparison(ValidSQLComparisonOperations::_AND,
	// 	                                              $condition,
	// 	                                              $UAC_Filter);


	// 		    // $persistables[$friendlies['METADATATYPES']]->type = $metadatatype->type;
	// 		    $persistables[$friendlies['ENTITYTYPES']]->type = $entitytype->type;
	// 		    return $containersDV;

	// }


	public function get(IGetParameterModel $param) {

	    $params = $param->get_parameters();
	    $options = $param->get_options();

	    $catalogReadProfile = new AccessProfile(ValidAccessProfiles::CATALOG_READ, ValidAccessTypes::VIEW, ValidAccessContexts::CATALOG, ValidAccessLevels::BASIC_ACCESS);
	    // $catalogUnsubProfile = new AccessProfile(ValidAccessProfiles::CATALOG_UNSUBSCRIBE, ValidAccessTypes::UNSUBSCRIBE, ValidAccessContexts::CATALOG, ValidAccessLevels::BASIC_ACCESS);


	    if(array_key_exists('user_id', $params) && $params['user_id'])
	    {
	        $user_id = $params['user_id'];
	    }
	    else
	    {
	        $user_id = SYSTEM_USER_ID;
	    }

	    if(array_key_exists('entity_id', $params) && $params['entity_id'])
	    {
	        $entity_id = $params['entity_id'];
	    }
	    else
	    {
	        $entity_id = null;
	        //$user_id = SYSTEM_USER_ID;
	    }
	    if(array_key_exists('searchTerm', $params) && $params['searchTerm'])
	    {
	        $searchTerm = $params['searchTerm'];
	    }
	    else
	    {
	        $searchTerm = null;
	    }
	    if(array_key_exists('tag_ids', $params) && $params['tag_ids'])
	    {
	        $tag_ids = $params['tag_ids'];
	    }
	    else
	    {
	        $tag_ids = null;
	    }
	    if(array_key_exists('pageNum', $params) && $params['pageNum'])
	    {
	        $pageNum = $params['pageNum'];
	    }
	    else
	    {
	        $pageNum = 1;
	    }

	    if(array_key_exists('accessprofile', $params) && $params['accessprofile'])
	    {
	        $accessprofile = $params['accessprofile'];
	    }
	    else
	    {
	        $accessprofile = null;
	    }

	    if(array_key_exists('accessGroupID', $params))
	    {
	        $accessGroupID = $params['accessGroupID'];
	    }
	    else
	    {
	        $accessGroupID = null;
	    }

	    if(array_key_exists('isPaged', $params) && is_bool($params['isPaged']))
	    {
	        $isPaged = $params['isPaged'];
	    }
	    else
	    {
	        $isPaged = true;
	    }

	    if($isPaged){
	    	$limitStart = CATALOG_PAGE_SIZE * ($pageNum - 1);

	    }
	    // $limit = CATALOG_PAGE_SIZE * ($pageNum - 1) . ',' . CATALOG_PAGE_SIZE ;//* $pageNum;

	    // searchTerms
	    // tagId
	    // ordering info
	    //
	    //
	    //expect access group parameter option
	    //get user access groups
	    //


	    $containersDV = $this->get_container_manager()->get_containersMetaAndTaxMasterQuery();

	    $friendlies = $this->get_container_manager()->get_containersMetaAndTaxMasterQuery()->get_friendlyNames();
	    $persistables = $this->get_container_manager()->get_containersMetaAndTaxMasterQuery()->get_persistableInputCollection();


	    if(array_key_exists('orderBy', $params) && $params['orderBy'])
	    {

  		    switch ($params['orderBy']) {
  		    	case ValidCatalogOrderTypes::RECENCY :
  		    		$order = array(
  		    			$containersDV->encodeColumnForSQL($persistables[$friendlies['ENTITIES']], 'last_edited') => array('direction' => 'DESC')//,
  		    			// $containersDV->encodeColumnForSQL($persistables[$friendlies['ENTITIES']], 'id') => array('direction' => 'DESC')
              );
  	    		break;
  	    		// TODO : Implement this
  	    		// case ValidCatalogOrderTypes::RATING :
  		    	// 	$order = array($containersDV->encodeColumnForSQL($persistables[$friendlies['METADATA']], '') =>
  	      //                                   array('direction' => 'DESC', 'cast_type' => 'unsigned')
  	      //                               );
  		    	// break;

  	    		// case ValidCatalogOrderTypes::FOLLOWERS :
  		    	// 	$order = array($containersDV->encodeColumnForSQL($persistables[$friendlies['METADATA']], 'data') =>
  	      //                                   array('direction' => 'DESC', 'cast_type' => 'unsigned')
  	      //                               );
  		    	// break;

  		    	default:
  		    		$order = array($containersDV->encodeColumnForSQL($persistables[$friendlies['ENTITIES']], 'last_edited') =>
  	                                        array('direction' => 'DESC')
  	                                    );
  		    		break;
  		    }
	    }
	    else
	    {
	    		$order = array($containersDV->encodeColumnForSQL($persistables[$friendlies['ENTITIES']], 'last_edited') =>
                                        array('direction' => 'DESC')
                                    );
	    }



	    $entitytype = $this->get_container_manager()->entityTypeVerification(ValidEntityTypes::TAB);
	    // $metadatatype = $this->get_container_manager()->metadataTypeVerification(ValidMetadataTypes::DASHBOARD_PRIORITY);
	    $condition = new QueryConditionComparison(ValidSQLComparisonOperations::EQUALS, 1, 1);



	    if($entity_id)
	    {
	        $conditionEnt = new QueryConditionComparison(ValidSQLComparisonOperations::EQUALS,
	                                                new QueryFreeFormConstant(DB_NAME."."."ENTITIES".".".$persistables[$friendlies['ENTITIES']]->get_keyName()),
	                                                new QueryFreeFormConstant($entity_id));

	        $condition = new QueryConditionComparison(ValidSQLComparisonOperations::_AND,
	                                                $condition,
	                                                $conditionEnt);
	        //$conditionEnt = new QueryConditionComparison(ValidSQLComparisonOperations::EQUALS, 1, 1);
	    }

	    if($searchTerm){
	    	$conditionSearch = new QueryConditionComparison(ValidSQLComparisonOperations::LIKE,
	    	                                        new QueryFreeFormConstant(DB_NAME."."."CONTAINERS"."."."title"),
	    	                                        new QueryStringConstant("%" . $searchTerm . "%"));

	    	$condition = new QueryConditionComparison(ValidSQLComparisonOperations::_AND,
	    	                                        $condition,
	    	                                        $conditionSearch);
	    }

	    if($tag_ids){

	    	$taxonomy = $this->get_container_manager()->tagTaxonomyVerification();

	    				    	// $condition = new QueryConditionComparison(ValidSQLComparisonOperations::EQUALS, 1, 1);

	    	$conditionTag = new QueryConditionComparison(ValidSQLComparisonOperations::EQUALS,
	    	                                            new QueryFreeFormConstant(DB_NAME."."."TAXONOMIES".".".$persistables[$friendlies['TAXONOMIES']]->get_keyName()),
	    	                                            new QueryFreeFormConstant($taxonomy->get_keyValue()));

	    	$condition = new QueryConditionComparison(ValidSQLComparisonOperations::_AND,
	    	                                        $conditionTag,
	    	                                        $condition);

	    	$conditionTag = new QueryConditionComparison(ValidSQLComparisonOperations::EQUALS, 0, 1);

	    	foreach($tag_ids as $tag_id){
	    		$conditionTag2 = new QueryConditionComparison(ValidSQLComparisonOperations::EQUALS,
	    		                                        new QueryFreeFormConstant(DB_NAME."."."TERMS_TAXONOMIES"."."."term_id"),
	    		                                        new QueryFreeFormConstant($tag_id));

	    		$conditionTag = new QueryConditionComparison(ValidSQLComparisonOperations::_OR,
	    		                                        $conditionTag,
	    		                                        $conditionTag2);

	    	}


	    	$condition = new QueryConditionComparison(ValidSQLComparisonOperations::_AND,
	    	                                        $condition,
	    	                                        $conditionTag);
	    }





      $entitiesEncounteredKeys = $this->get_uac_manager()->getUACEntitiesFromGroupRightsIDs($user_id,
                                                                                          $accessprofile,
                                                                                          $entitytype->get_keyValue(),
                                                                                          $accessGroupID);

      $uac_verified_entities_string = implode(',', $entitiesEncounteredKeys);
      if(!$uac_verified_entities_string)
      {
          $UAC_Filter = new QueryConditionComparison(ValidSQLComparisonOperations::EQUALS, 0, 1);
      }
      else
      {
          $UAC_Filter = new QueryConditionComparison(ValidSQLComparisonOperations::IN,
                                                  new QueryFreeFormConstant(DB_NAME."."."ENTITIES".".".$persistables[$friendlies['ENTITIES']]->get_keyName()),
                                                  new QueryFreeFormConstant("(".$uac_verified_entities_string.")"));
      }
      $condition = new QueryConditionComparison(ValidSQLComparisonOperations::_AND,
                                              $condition,
                                              $UAC_Filter);


	    // $persistables[$friendlies['METADATATYPES']]->type = $metadatatype->type;
	    $persistables[$friendlies['ENTITYTYPES']]->type = $entitytype->type;



	    // if($isPaged){
	    // 		    $paginationRangeQuery = SQLGen::Query(ValidQueryDatabaseFormats::MYSQL, DB_NAME);
	    // 	      $paginationRangeQuery = $paginationRangeQuery->fromTable('ENTITIES', 'ENTITIES')->
	    // 	      // join()->
	    // 	      // joinTable(ValidQueryJoinTypes::INNER, 'ENTITYTYPES', 'ENTITYTYPES', 'id', 'ENTITIES', 'type_id')->
	    // 	      select()->select('id', 'ENTITIES', 'id')->
	    // 	      select('last_edited', 'ENTITIES', 'last_edited');
	    // 	      // select('type', 'ENTITYTYPES', 'type')->
	    // 	     	// where( new QueryFreeFormConstant('ENTITYTYPES.type'), ValidSQLComparisonOperations::EQUALS, ValidEntityTypes::TAB);
	    // 	     	if(!$uac_verified_entities_string)
	    // 	     	{
	    // 	     		$paginationRangeQuery = $paginationRangeQuery->where( 0, ValidSQLComparisonOperations::EQUALS, 1);

	    // 	     	}
	    // 	     	else {
	    // 	     		$paginationRangeQuery = $paginationRangeQuery->where( new QueryFreeFormConstant('ENTITIES.id'), ValidSQLComparisonOperations::IN, new QueryFreeFormConstant("(".$uac_verified_entities_string.")"));

	    // 	     	}
	    // 	     	$paginationRangeQuery = $paginationRangeQuery->orderBy('last_edited', ValidQueryOrderDirections::DESC)->limit($limitStart.",".CATALOG_PAGE_SIZE);


	    // 	     	$paginationRangeQueryString = $paginationRangeQuery->toSQL();
	    // 	     	$paginationArr = array();

	    // 	     	$this->get_dataSource()->query($paginationRangeQueryString);
	    // 	     	while($row = $this->get_dataSource()->fetch())
	    // 	     	{
	    // 	     			array_push($paginationArr, $row->id);
	    // 	     	}
	    // 	     	if(!empty($paginationArr)){
	    // 	     		$condition = new QueryConditionComparison(ValidSQLComparisonOperations::_AND,
	    // 	     		                                        $condition,
	    // 	     		                                        new QueryConditionComparison(ValidSQLComparisonOperations::IN,
	    // 	                                                  new QueryFreeFormConstant(DB_NAME."."."ENTITIES".".".$persistables[$friendlies['ENTITIES']]->get_keyName()),
	    // 	                                                  new QueryFreeFormConstant("(".implode(',', $paginationArr).")")));
	    // 	     	}
	    // }





	    $containersDV->generateSQL(array(),
	                                $order,
	                                null,
	                                $condition);
	    // if(!isset($accessprofile)){
	    // 		echo $containersDV->get_generatedSQL();
	    // }
	    // if($pageNum == 2)
	    // logError($containersDV->get_generatedSQL());
	    // return;
	    //if($condition == $UAC_Filter)
	    //{
	    //    $this->fixPriority($user_id, $entitytype, $metadatatype, $entitiesEncounteredKeys, $UAC_Filter, $containersDV);
	    //}
	    //else
	    //{

	    //}



	    $containerObjects = array();
	    $containerIDs = array();

	    $entity_id_key = $containersDV->encodeColumnForSQL($persistables[$friendlies['ENTITIES']],
	                                      $persistables[$friendlies['ENTITIES']]->get_keyName());
	    $container_id_key = $containersDV->encodeColumnForSQL($persistables[$friendlies['CONTAINERS']],
	                                      $persistables[$friendlies['CONTAINERS']]->get_keyName());
	    $metadata_id_key = $containersDV->encodeColumnForSQL($persistables[$friendlies['METADATA']],
	                                      $persistables[$friendlies['METADATA']]->get_keyName());
	    $entitytag_id_key = $containersDV->encodeColumnForSQL($persistables[$friendlies['ENTITIES_TERMS_TAXONOMIES']],
	                                      $persistables[$friendlies['ENTITIES_TERMS_TAXONOMIES']]->get_keyName());
	    $termtax_id_key = $containersDV->encodeColumnForSQL($persistables[$friendlies['TERMS_TAXONOMIES']],
	                                      $persistables[$friendlies['TERMS_TAXONOMIES']]->get_keyName());
	    $termtax_term_key = $containersDV->encodeColumnForSQL($persistables[$friendlies['TERMS_TAXONOMIES']],
	                                      'term_id');
	    $entitytag_termtax_key = $containersDV->encodeColumnForSQL($persistables[$friendlies['ENTITIES_TERMS_TAXONOMIES']],
	                                      'termtaxonomy_id');
	    $container_title_key = $containersDV->encodeColumnForSQL($persistables[$friendlies['CONTAINERS']],
	                                      'title');
	    $container_description_key = $containersDV->encodeColumnForSQL($persistables[$friendlies['CONTAINERS']],
	                                      'description');
	    $container_modeltype_key = $containersDV->encodeColumnForSQL($persistables[$friendlies['CONTAINERMODELTYPES']],
	                                      'type');
	    $container_viewtype_key = $containersDV->encodeColumnForSQL($persistables[$friendlies['CONTAINERVIEWTYPES']],
	                                      'type');
	    $containerparamfields_field_key = $containersDV->encodeColumnForSQL($persistables[$friendlies['CONTAINERPARAMFIELDS']],
	                                      'field');
	    $containerparamfields_value_key = $containersDV->encodeColumnForSQL($persistables[$friendlies['CONTAINERS_PARAMFIELDS']],
	                                      'value');
	    $entity_created_date_key = $containersDV->encodeColumnForSQL($persistables[$friendlies['ENTITIES']],
	                                      'created_date');
	    $entity_last_edited_key = $containersDV->encodeColumnForSQL($persistables[$friendlies['ENTITIES']],
	                                      'last_edited');
	    $entity_owner_id_key = $containersDV->encodeColumnForSQL($persistables[$friendlies['ENTITIES']],
	                                      'owner_id');
	    $metadata_data_key = $containersDV->encodeColumnForSQL($persistables[$friendlies['METADATA']],
	                                      'data');
	    $metadata_owner_key = $containersDV->encodeColumnForSQL($persistables[$friendlies['METADATA']],
	                                      'owner_id');

	    $metadata_last_edited_key = $containersDV->encodeColumnForSQL($persistables[$friendlies['METADATA']],
	                                      'last_edited');
	    $metadata_created_date_key = $containersDV->encodeColumnForSQL($persistables[$friendlies['METADATA']],
	                                      'created_date');
	    $metadata_title_key = $containersDV->encodeColumnForSQL($persistables[$friendlies['METADATA']],
	                                      'title');
	    $metadata_type_key = $containersDV->encodeColumnForSQL($persistables[$friendlies['METADATA']],
	                                      'type_id');
	    $metadata_type_name_key = $containersDV->encodeColumnForSQL($persistables[$friendlies['METADATATYPES']],
	                                      'type');

	    $containersDV->execute();

	    // $lastEntityIdFound = null;
	    $tagIDs = array();
	    $fields = array();
	    $metaIDs = array();

	    $entitiesSkippedForPagination = array();

	    while($row = $containersDV->read())
	    {
	    	if($isPaged && count($entitiesSkippedForPagination) < $limitStart && !in_array($row->$entity_id_key, $entitiesSkippedForPagination))
	    	{
	    		$entitiesSkippedForPagination[$row->$entity_id_key] = $row->$entity_id_key;
	    		// array_push($entitiesSkippedForPagination, $row->entity_id_key);
	    		// echo $row->entity_id_key;
	    	}
    		elseif(!$isPaged ||
    			($isPaged &&
    			count($entitiesSkippedForPagination) >= $limitStart &&
    			// count($containerIDs) < CATALOG_PAGE_SIZE &&
    			!in_array($row->$entity_id_key, $entitiesSkippedForPagination))
    		)
    		{
    			// var_dump($entitiesSkippedForPagination);
    			// logError('('.count($entitiesSkippedForPagination)."-".$limitStart . ")");
	        if(!in_array($row->$entity_id_key, $containerIDs) && (!$isPaged || ($isPaged && count($containerIDs) < CATALOG_PAGE_SIZE) ))// && array_key_exists($row->entities_x_id, $uac_verified_entities) === true)
	        {


	            $entity = new TC_CatalogTab_EntityModel($row->$entity_id_key,
	                                                    $row->$container_id_key,
	                                                    null,
	                                                    1,
	                                                    $row->$entity_created_date_key,
	                                                    $row->$entity_last_edited_key,
	                                                    $row->$entity_owner_id_key);

	            $classType = trim($row->$container_modeltype_key);
	            //$classType .= "_Tab";
	            $container = new $classType(trim($row->$container_title_key));
	            //$container->set_modeltype($row->$container_modeltype_key);
	            if($row->$container_description_key)
	            {
	                $container->set_description(trim($row->$container_description_key));
	            }
	            if($row->$container_viewtype_key)
	            {
	                $container->set_viewtype(trim($row->$container_viewtype_key));
	            }


	            $entity->set_host($container);

	            $containerIDs[$row->$entity_id_key] = $row->$entity_id_key;
	            $containerObjects[$row->$entity_id_key] = $entity;
	            $tagIDs[$row->$entity_id_key] = array();
	            $metaIDs[$row->$entity_id_key] = array();
	            $fields[$row->$entity_id_key] = array();

	        }
	        // if(!in_array($row->$termtax_term_key, $tagIDs[$row->$entity_id_key])){
	        // 	// add entity tags
	        // 	$ent = $containerObjects[$row->$entity_id_key];
	        // 	$ent->add_tag($row->$termtax_term_key);
	        // 	$tagIDs[$row->$entity_id_key][] = $row->$termtax_term_key;
	        // }
	        if(!in_array($row->$metadata_id_key, $metaIDs[$row->$entity_id_key]) && in_array($row->$entity_id_key, $containerIDs)){

	        	$ent = $containerObjects[$row->$entity_id_key];
	        	$pairs = $ent->get_metadata();

	        	$metadata = new THOR_METADATA_DataBoundSimplePersistable();
	        	$metadata->data = $row->$metadata_data_key;
	        	$metadata->entity_id = $row->$entity_id_key;
	        	$metadata->owner_id = $row->$metadata_owner_key;
	        	$metadata->created_date = $row->$metadata_created_date_key;
	        	$metadata->last_edited = $row->$metadata_last_edited_key;
	        	$metadata->is_active = 1;
	        	$metadata->type_id = $row->$metadata_type_key;
	        	$metadata->title = $row->$metadata_title_key;

	        	$pairs[$row->$metadata_type_name_key] = $row->$metadata_data_key;
	        	$ent->set_metadata($pairs);
	        	$metaIDs[$row->$entity_id_key][] = $row->$metadata_id_key;
	        }
	        if(!in_array($row->$containerparamfields_field_key, $fields[$row->$entity_id_key]) && in_array($row->$entity_id_key, $containerIDs)){
	        	$container = $containerObjects[$row->$entity_id_key]->get_host();
	        	//if(property_exists($container, trim($row->$containerparamfields_field_key)))
	        	if(in_array( trim($row->$containerparamfields_field_key), $container->get_validFields())   )
	        	{
	        	    $tf = trim($row->$containerparamfields_field_key);
	        	    $tt = trim($row->$containerparamfields_value_key);
	        	    $temp = "set_$tf";
	        	    if(method_exists($container,$temp))
	        	    {
	        	        $container->$temp($tt);
	        	    }
	        	    $fields[$row->$entity_id_key][] = $row->$containerparamfields_field_key;

	        	}
	        }


	      }
	      // if($isPaged && count($containerIDs) >= CATALOG_PAGE_SIZE)
	      // 	{ break; }
	    }

	    foreach($containerIDs as $entityID)
	    {
        $taxDV = $this->get_container_manager()->get_taxonomyMasterQuery();
        $friendlies = $this->get_container_manager()->get_taxonomyMasterQuery()->get_friendlyNames();
        $persistables = $this->get_container_manager()->get_taxonomyMasterQuery()->get_persistableInputCollection();

        $taxonomy = $this->get_container_manager()->tagTaxonomyVerification();

        $condition = new QueryConditionComparison(ValidSQLComparisonOperations::EQUALS,
                                                new QueryFreeFormConstant(DB_NAME."."."ENTITIES".".".$persistables[$friendlies['ENTITIES']]->get_keyName()),
                                                new QueryFreeFormConstant($entityID));

        $conditionTag = new QueryConditionComparison(ValidSQLComparisonOperations::EQUALS,
                                                    new QueryFreeFormConstant(DB_NAME."."."TAXONOMIES".".".$persistables[$friendlies['TAXONOMIES']]->get_keyName()),
                                                    new QueryFreeFormConstant($taxonomy->get_keyValue()));

        $condition = new QueryConditionComparison(ValidSQLComparisonOperations::_AND,
                                                $conditionTag,
                                                $condition);

        $taxDV->generateSQL(array(), null, null, $condition);

        $entity_id_key = $taxDV->encodeColumnForSQL($persistables[$friendlies['ENTITIES']],
                                          $persistables[$friendlies['ENTITIES']]->get_keyName());
        $termtax_term_key = $taxDV->encodeColumnForSQL($persistables[$friendlies['TERMS_TAXONOMIES']],
                                          'term_id');

        $taxDV->execute();


        while($row = $taxDV->read())
        {
        	$ent = $containerObjects[$row->$entity_id_key];
        	$ent->add_tag($row->$termtax_term_key);
        	$tagIDs[$row->$entity_id_key][] = $row->$termtax_term_key;
        }

	    }



	    foreach($containerObjects as $object)
	    {
	        $object->set_priorVersion(clone $object);

	    }

	    $sortFunction = function ($a, $b) {
	    	return $a->get_last_edited() <= $b->get_last_edited();
	    };

	    if(array_key_exists('orderBy', $params) && $params['orderBy'])
	    {

  		    switch ($params['orderBy']) {
  		    	case ValidCatalogOrderTypes::RECENCY :
	  		    	$sortFunction = function ($a, $b) {
	  		    		return $a->get_last_edited() <= $b->get_last_edited();
	  		    	};
  	    		break;
  	    		// TODO : Implement this
  	    		// case ValidCatalogOrderTypes::RATING :
	  	    	// 	$sortFunction = function ($a, $b) {
	  	    	// 		return $a->get_last_edited() > $b->get_last_edited();
	  	    	// 	};
  		    	// break;

  	    		case ValidCatalogOrderTypes::FOLLOWERS :
							$sortFunction = function ($a, $b) {
								return $a->get_number_of_followers() <= $b->get_number_of_followers();
							};
  		    	break;

  		    	default:
  		    		$sortFunction = function ($a, $b) {
  		    			return $a->get_last_edited() <= $b->get_last_edited();
  		    		};
  		    		break;
  		    }
	    }

	    uasort($containerObjects, $sortFunction);











	    $param->set_outputCollection($containerObjects);
	    $param->set_outputReferenceIDs($containerIDs);
	    return $param;


	}

	public function getCount(IGetParameterModel $param){

			    $params = $param->get_parameters();
			    $options = $param->get_options();

			    $catalogReadProfile = new AccessProfile(ValidAccessProfiles::CATALOG_READ, ValidAccessTypes::VIEW, ValidAccessContexts::CATALOG, ValidAccessLevels::BASIC_ACCESS);

			    if(array_key_exists('user_id', $params) && $params['user_id'])
			    {
			        $user_id = $params['user_id'];
			    }
			    else
			    {
			        $user_id = SYSTEM_USER_ID;
			    }
			    if(array_key_exists('entity_id', $params) && $params['entity_id'])
			    {
			        $entity_id = $params['entity_id'];
			    }
			    else
			    {
			        $entity_id = null;
			        //$user_id = SYSTEM_USER_ID;
			    }
			    if(array_key_exists('searchTerm', $params) && $params['searchTerm'])
			    {
			        $searchTerm = $params['searchTerm'];
			    }
			    else
			    {
			        $searchTerm = null;
			    }
			    if(array_key_exists('tag_ids', $params) && $params['tag_ids'])
			    {
			        $tag_ids = $params['tag_ids'];
			    }
			    else
			    {
			        $tag_ids = null;
			    }
			    $isPaged = false;

			    if(array_key_exists('accessGroupID', $params))
			    {
			        $accessGroupID = $params['accessGroupID'];
			    }
			    else
			    {
			        $accessGroupID = null;
			    }

			    if(array_key_exists('accessprofile', $params) && $params['accessprofile'])
			    {
			        $accessprofile = $params['accessprofile'];
			    }
			    else
			    {
			        $accessprofile = null;
			    }
			    // searchTerms
			    // tagId
			    // ordering info
			    //
			    //
			    //expect access group parameter option
			    //get user access groups
			    //


			    $containersDV = $this->get_container_manager()->get_containersMetaAndTaxMasterQuery();

			    $friendlies = $this->get_container_manager()->get_containersMetaAndTaxMasterQuery()->get_friendlyNames();
			    $persistables = $this->get_container_manager()->get_containersMetaAndTaxMasterQuery()->get_persistableInputCollection();






			    $entitytype = $this->get_container_manager()->entityTypeVerification(ValidEntityTypes::TAB);
			    // $metadatatype = $this->get_container_manager()->metadataTypeVerification(ValidMetadataTypes::DASHBOARD_PRIORITY);


			    $condition = new QueryConditionComparison(ValidSQLComparisonOperations::EQUALS, 1, 1);



			    if($entity_id)
			    {
			        $conditionEnt = new QueryConditionComparison(ValidSQLComparisonOperations::EQUALS,
			                                                new QueryFreeFormConstant(DB_NAME."."."ENTITIES".".".$persistables[$friendlies['ENTITIES']]->get_keyName()),
			                                                new QueryFreeFormConstant($entity_id));

			        $condition = new QueryConditionComparison(ValidSQLComparisonOperations::_AND,
			                                                $condition,
			                                                $conditionEnt);
			        //$conditionEnt = new QueryConditionComparison(ValidSQLComparisonOperations::EQUALS, 1, 1);
			    }

			    if($searchTerm){
			    	$conditionSearch = new QueryConditionComparison(ValidSQLComparisonOperations::LIKE,
			    	                                        new QueryFreeFormConstant(DB_NAME."."."CONTAINERS"."."."title"),
			    	                                        new QueryStringConstant("%" . $searchTerm . "%"));

			    	$condition = new QueryConditionComparison(ValidSQLComparisonOperations::_AND,
			    	                                        $condition,
			    	                                        $conditionSearch);
			    }

			    if($tag_ids){

			    	$taxonomy = $this->get_container_manager()->tagTaxonomyVerification();

			    				    	// $condition = new QueryConditionComparison(ValidSQLComparisonOperations::EQUALS, 1, 1);

			    	$conditionTag = new QueryConditionComparison(ValidSQLComparisonOperations::EQUALS,
			    	                                            new QueryFreeFormConstant(DB_NAME."."."TAXONOMIES".".".$persistables[$friendlies['TAXONOMIES']]->get_keyName()),
			    	                                            new QueryFreeFormConstant($taxonomy->get_keyValue()));

			    	$condition = new QueryConditionComparison(ValidSQLComparisonOperations::_AND,
			    	                                        $conditionTag,
			    	                                        $condition);

			    	$conditionTag = new QueryConditionComparison(ValidSQLComparisonOperations::EQUALS, 0, 1);

			    	foreach($tag_ids as $tag_id){
			    		$conditionTag2 = new QueryConditionComparison(ValidSQLComparisonOperations::EQUALS,
			    		                                        new QueryFreeFormConstant(DB_NAME."."."TERMS_TAXONOMIES"."."."term_id"),
			    		                                        new QueryFreeFormConstant($tag_id));

			    		$conditionTag = new QueryConditionComparison(ValidSQLComparisonOperations::_OR,
			    		                                        $conditionTag,
			    		                                        $conditionTag2);

			    	}


			    	$condition = new QueryConditionComparison(ValidSQLComparisonOperations::_AND,
			    	                                        $condition,
			    	                                        $conditionTag);
			    }





		      $entitiesEncounteredKeys = $this->get_uac_manager()->getUACEntitiesFromGroupRightsIDs($user_id,
		                                                                                          $accessprofile,
		                                                                                          $entitytype->get_keyValue(),
		                                                                                          $accessGroupID);

		      $uac_verified_entities_string = implode(',', $entitiesEncounteredKeys);
		      if(!$uac_verified_entities_string)
		      {
		          $UAC_Filter = new QueryConditionComparison(ValidSQLComparisonOperations::EQUALS, 0, 1);
		      }
		      else
		      {
		          $UAC_Filter = new QueryConditionComparison(ValidSQLComparisonOperations::IN,
		                                                  new QueryFreeFormConstant(DB_NAME."."."ENTITIES".".".$persistables[$friendlies['ENTITIES']]->get_keyName()),
		                                                  new QueryFreeFormConstant("(".$uac_verified_entities_string.")"));
		      }
		      $condition = new QueryConditionComparison(ValidSQLComparisonOperations::_AND,
		                                              $condition,
		                                              $UAC_Filter);


			    // $persistables[$friendlies['METADATATYPES']]->type = $metadatatype->type;
			    $persistables[$friendlies['ENTITYTYPES']]->type = $entitytype->type;




			    $containersDV->generateSQL(array(),
			                                null,
			                                null,
			                                $condition);
			    // echo $containersDV->get_generatedSQL();
			    // if(!isset($accessprofile)){
			    // 		echo $containersDV->get_generatedSQL();
			    // }
			    // if($accessGroupID)
			    // logError($containersDV->get_generatedSQL());
			    // echo $containersDV->get_generatedSQL();
			    // return;
			    //if($condition == $UAC_Filter)
			    //{
			    //    $this->fixPriority($user_id, $entitytype, $metadatatype, $entitiesEncounteredKeys, $UAC_Filter, $containersDV);
			    //}
			    //else
			    //{

			    //}



			    $containerIDs = array();

			    $entity_id_key = $containersDV->encodeColumnForSQL($persistables[$friendlies['ENTITIES']],
			                                      $persistables[$friendlies['ENTITIES']]->get_keyName());
			    $container_id_key = $containersDV->encodeColumnForSQL($persistables[$friendlies['CONTAINERS']],
			                                      $persistables[$friendlies['CONTAINERS']]->get_keyName());
			    $metadata_id_key = $containersDV->encodeColumnForSQL($persistables[$friendlies['METADATA']],
			                                      $persistables[$friendlies['METADATA']]->get_keyName());
			    $entitytag_id_key = $containersDV->encodeColumnForSQL($persistables[$friendlies['ENTITIES_TERMS_TAXONOMIES']],
			                                      $persistables[$friendlies['ENTITIES_TERMS_TAXONOMIES']]->get_keyName());
			    $termtax_id_key = $containersDV->encodeColumnForSQL($persistables[$friendlies['TERMS_TAXONOMIES']],
			                                      $persistables[$friendlies['TERMS_TAXONOMIES']]->get_keyName());
			    $termtax_term_key = $containersDV->encodeColumnForSQL($persistables[$friendlies['TERMS_TAXONOMIES']],
			                                      'term_id');
			    $entitytag_termtax_key = $containersDV->encodeColumnForSQL($persistables[$friendlies['ENTITIES_TERMS_TAXONOMIES']],
			                                      'termtaxonomy_id');
			    $container_title_key = $containersDV->encodeColumnForSQL($persistables[$friendlies['CONTAINERS']],
			                                      'title');
			    $container_description_key = $containersDV->encodeColumnForSQL($persistables[$friendlies['CONTAINERS']],
			                                      'description');
			    $container_modeltype_key = $containersDV->encodeColumnForSQL($persistables[$friendlies['CONTAINERMODELTYPES']],
			                                      'type');
			    $container_viewtype_key = $containersDV->encodeColumnForSQL($persistables[$friendlies['CONTAINERVIEWTYPES']],
			                                      'type');
			    $containerparamfields_field_key = $containersDV->encodeColumnForSQL($persistables[$friendlies['CONTAINERPARAMFIELDS']],
			                                      'field');
			    $containerparamfields_value_key = $containersDV->encodeColumnForSQL($persistables[$friendlies['CONTAINERS_PARAMFIELDS']],
			                                      'value');
			    $entity_created_date_key = $containersDV->encodeColumnForSQL($persistables[$friendlies['ENTITIES']],
			                                      'created_date');
			    $entity_last_edited_key = $containersDV->encodeColumnForSQL($persistables[$friendlies['ENTITIES']],
			                                      'last_edited');
			    $entity_owner_id_key = $containersDV->encodeColumnForSQL($persistables[$friendlies['ENTITIES']],
			                                      'owner_id');
			    $metadata_data_key = $containersDV->encodeColumnForSQL($persistables[$friendlies['METADATA']],
			                                      'data');
			    $metadata_owner_key = $containersDV->encodeColumnForSQL($persistables[$friendlies['METADATA']],
			                                      'owner_id');

			    $metadata_last_edited_key = $containersDV->encodeColumnForSQL($persistables[$friendlies['METADATA']],
			                                      'last_edited');
			    $metadata_created_date_key = $containersDV->encodeColumnForSQL($persistables[$friendlies['METADATA']],
			                                      'created_date');
			    $metadata_title_key = $containersDV->encodeColumnForSQL($persistables[$friendlies['METADATA']],
			                                      'title');
			    $metadata_type_key = $containersDV->encodeColumnForSQL($persistables[$friendlies['METADATA']],
			                                      'type_id');

			    $containersDV->execute();

			    while($row = $containersDV->read())
			    {
			        if(!in_array($row->$entity_id_key, $containerIDs))// && array_key_exists($row->entities_x_id, $uac_verified_entities) === true)
			        {
			            $containerIDs[$row->$entity_id_key] = $row->$entity_id_key;
			        }
			    }
			    return count($containerIDs);

	}
	/*
	public function getIDs(IGetParameterModel $param) {

	}

	public function getOne(IGetParameterModel $param) {

	}
	*/

	public function get_container_manager() {
	    return $this->container_manager;
	}

	public function set_container_manager($container_manager) {
	    $this->container_manager = $container_manager;
	}

	public function get_uac_manager() {
	    return $this->uac_manager;
	}

	public function set_uac_manager($uac_manager) {
	    $this->uac_manager = $uac_manager;
	}

}
?>