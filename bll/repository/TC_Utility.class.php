<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TC_Utility
 *
 * @author KottkeDP
 */
class TC_Utility {


    public static function getActiveContainerGetParamForUser($user_id, $accessProfile = null, $groupID = null)
    {
        // $returnMe = array();

        // $strategy = new TC_RepositoryDashboardContainerStrategy();
        $getPar = new THOR_GetParameterCapsule(array(),
                                            array('user_id' => $user_id,
                                                'accessprofile' => $accessProfile,
                                                'accessGroupID' => $groupID ),
                                            array(),
                                            array());
        return $getPar;

        // $repo = new Repository($strategy);

        // $returnMe = $repo->get($getPar);
        // return $returnMe;
    }
    public static function getActiveContainerIDsForUser($user_id, $accessProfile = null, $groupID = null)
    {
        $strategy = new TC_RepositoryDashboardContainerStrategy();
        $getPar = self::getActiveContainerGetParamForUser($user_id, $accessProfile, $groupID);
        $repo = new Repository($strategy);
        $returnMe = $repo->getIDs($getPar);

        return $returnMe;
    }

    public static function getActiveContainersForUser($user_id, $accessProfile = null, $groupID = null)
    {
        $strategy = new TC_RepositoryDashboardContainerStrategy();
        $getPar = self::getActiveContainerGetParamForUser($user_id, $accessProfile, $groupID);
        $repo = new Repository($strategy);
        $returnMe = $repo->get($getPar);

        return $returnMe;
    }

    public static function getActiveWidgetGetParamForDashboard($container_id)
    {
        // $strategy = new TC_RepositoryDashboardSourceStrategy();
        $getPar = new THOR_GetParameterCapsule(array(),
                                            array('container_id' => $container_id),
                                            array(),
                                            array());
        return $getPar;

        // $repo = new Repository($strategy);

        // $returnMe = $repo->get($getPar);
        // return $returnMe;
    }

    public static function getActiveWidgetIDsForDashboard($container_id)
    {
        $strategy = new TC_RepositoryDashboardSourceStrategy();
        $getPar = self::getActiveWidgetGetParamForDashboard($container_id);
        $repo = new Repository($strategy);
        $returnMe = $repo->getIDs($getPar);

        return $returnMe;
    }


    public static function getActiveWidgetsForDashboard($container_id)
    {
        $strategy = new TC_RepositoryDashboardSourceStrategy();
        $getPar = self::getActiveWidgetGetParamForDashboard($container_id);
        $repo = new Repository($strategy);
        $returnMe = $repo->get($getPar);

        return $returnMe;
    }


    public static function getPublishedPagesForCatalog($params = array()){

			// $user_id = array_key_exists('user_id', $params) ? $params['user_id'] : null;
			// $entity_id = array_key_exists('entity_id', $params) ? $params['entity_id'] : null;
   //  	$tag_ids = array_key_exists('tag_ids', $params) ? $params['tag_ids'] : null;
   //  	$pageNum = array_key_exists('pageNum', $params) ? $params['pageNum'] : null;
   //  	$isPaged = array_key_exists('isPaged', $params) ? $params['isPaged'] : null;
   //  	$searchTerm = array_key_exists('searchTerm', $params) ? $params['searchTerm'] : null;
   //  	$orderBy = array_key_exists('orderBy', $params) ? $params['orderBy'] : null;
   //  	$accessprofile = array_key_exists('accessprofile', $params) ? $params['accessprofile'] : null;

    	$strat = new TC_RepositoryCatalogPageStrategy();
    	$getPar = new THOR_GetParameterCapsule(array(),
    	                                    $params,
    	                                    array(),
    	                                    array());
    	$repo = new Repository($strat);
    	$returnMe = $repo->get($getPar);
    	// var_dump($returnMe);
    	return $returnMe;


    }

        public static function getPublishedPageIdsForCatalog($params = array()){

                // $user_id = array_key_exists('user_id', $params) ? $params['user_id'] : null;
                // $entity_id = array_key_exists('entity_id', $params) ? $params['entity_id'] : null;
       //   $tag_ids = array_key_exists('tag_ids', $params) ? $params['tag_ids'] : null;
       //   $pageNum = array_key_exists('pageNum', $params) ? $params['pageNum'] : null;
       //   $isPaged = array_key_exists('isPaged', $params) ? $params['isPaged'] : null;
       //   $searchTerm = array_key_exists('searchTerm', $params) ? $params['searchTerm'] : null;
       //   $orderBy = array_key_exists('orderBy', $params) ? $params['orderBy'] : null;
       //   $accessprofile = array_key_exists('accessprofile', $params) ? $params['accessprofile'] : null;

            $strat = new TC_RepositoryCatalogPageStrategy();
            $getPar = new THOR_GetParameterCapsule(array(),
                                                $params,
                                                array(),
                                                array());
            $repo = new Repository($strat);
            $returnMe = $repo->getIDs($getPar);
            // var_dump($returnMe);
            return $returnMe;


        }


		public static function getCatalogPageCount($params = array()){
							// $user_id = array_key_exists('user_id', $params) ? $params['user_id'] : null;
							// $entity_id = array_key_exists('entity_id', $params) ? $params['entity_id'] : null;
				   //  	$tag_ids = array_key_exists('tag_ids', $params) ? $params['tag_ids'] : null;
				   //  	$pageNum = array_key_exists('pageNum', $params) ? $params['pageNum'] : null;
				   //  	$isPaged = array_key_exists('isPaged', $params) ? $params['isPaged'] : null;
				   //  	$searchTerm = array_key_exists('searchTerm', $params) ? $params['searchTerm'] : null;
				   //  	$orderBy = array_key_exists('orderBy', $params) ? $params['orderBy'] : null;
				   //  	$accessprofile = array_key_exists('accessprofile', $params) ? $params['accessprofile'] : null;

				    	$strat = new TC_THOR_GetContainersForPublicCatalogView_GetRepo();
				    	$getPar = new THOR_GetParameterCapsule(array(),
				    	                                    $params,
				    	                                    array(),
				    	                                    array());
				    	// $repo = new Repository($strat);
				    	$returnMe = $strat->getCount($getPar);
				    	// var_dump($returnMe);
				    	return $returnMe;

		}


    public static function createPageForUser($user_id,
                                            $accessgroup_ids,
                                            $title,
                                            $description = null,
                                            $dashboardViewType = null)
    {

        if(!isset($description))
        {
            $description = 'UNKNOWN';
        }
        if(!isset($dashboardViewType))
        {
            $dashboardViewType = ValidDashboardTabViews::STANDARD;
        }
        $mytab = new TC_DashboardTab($title, $description, $dashboardViewType);

        $myEntity = new TC_DashboardTab_EntityModel(null,
                                                    null,
                                                    $mytab,
                                                    1,
                                                    date('Y-m-d H:i:s'),
                                                    date('Y-m-d H:i:s'),
                                                    $user_id,
                                                    null,
                                                    null);

        $strategy = new TC_RepositoryDashboardContainerStrategy();
        $setPar = new THOR_SetParameterCapsule(null,
                                            array('user_id' => $user_id,
                                                'accessGroup_IDs' => $accessgroup_ids),
                                            array());

        $repo = new Repository($strategy);
        $repo->loadEntity($myEntity);
        // var_dump($repo->get_pool());
        $repo->save($setPar);


    }

    public static function cloneDashboard($user_id, $entityID, $accessgroup_id, $priority = null)
    {
        $strategy = new TC_RepositoryDashboardContainerStrategy();
        $repo = new Repository($strategy);
        $getPar = new THOR_GetParameterCapsule(array(),
                                                array('user_id' => $user_id,
                                                    'entity_id' => $entityID ),
                                                array('overrideUAC' => true),
                                                array());
        $sharedTab = $repo->getOne($getPar);

        $widgetStrat = new TC_RepositoryDashboardSourceStrategy();
        $tempRepo = new Repository($widgetStrat);

        $widArr = array();
        $host = $sharedTab->get_host();
        $containerID = $sharedTab->get_host_id();
        if(!($host instanceof TC_DashboardTab))
        {
            throw new Exception("something is wrong, should be a dashboard");
        }
        $wGetParm = new THOR_GetParameterCapsule(array(),
                                                array('container_id' => $containerID),
                                                array(),
                                                array());
        $defaultWidgetsInTab = $tempRepo->get($wGetParm);

        foreach($defaultWidgetsInTab AS $WID => $widget)
        {
            //$widget instanceof Entity;

            $widget->set_entity_id(null);
            $widget->set_host_id(null);
            $widArr[] = $widget;
        }
        $contArr = array();

        // $host->set_description("shared from entity_".$sharedTab->get_entity_id(). "_ container_".$sharedTab->get_host_id()."_");
        //Todo: metadata gets plugged in here

        //$meta = new THOR_METADATA_DataBoundSimplePersistable();

        // $host->set_description($host->get_description());

        $sharedTab->set_entity_id(null);
        $sharedTab->set_host_id(null);

        if(isset($priority))
        {

            $sharedTab->set_dashboard_priority($priority);
        }
        else
        {
            $sharedTab->set_dashboard_priority(null);
        }

        $contArr[] = $sharedTab;
        $repo->set_pool($contArr);

        $tabSetParam = new THOR_SetParameterCapsule($sharedTab,
                                                    array('user_id' => $user_id,
                                                          'accessGroup_IDs' => array($accessgroup_id => 1)),
                                                    array());
        /*
        $tabSetParam = new THOR_SetParameterCapsule(null,
                                                    $sharedTab,
                                                    array('user_id' => $user_id,
                                                          'accessGroup_IDs' => array($accessgroup_id)),
                                                    array(),
                                                    null);
        */
       // logError($host->get_description());
        $newContainer = array_pop($repo->save($tabSetParam))->get_item();

        $newContainerID = $newContainer->get_host_id();
        $tempRepo->set_pool($widArr);
        $sourceSetParam = new THOR_SetParameterCapsule(null,
                                                    array('container_id' => $newContainerID),
                                                    array());
        $tempRepo->save($sourceSetParam);


        return  $newContainer;

    }
    public static function shareDashboard($user_id, $entityID, $priority = null)
    {
        if($user_id == SYSTEM_USER_ID)
        {return false;}
        $accessgroup = self::verifyAndGetPersonalGroup($user_id);
        return self::cloneDashboard($user_id, $entityID, $accessgroup->get_keyValue(), $priority);

    }

    public static function getCatalogPreview($entity_id, $user_id = null){
    		$accessprofileRead = new AccessProfile(ValidAccessProfiles::CATALOG_READ, ValidAccessTypes::VIEW, ValidAccessContexts::CATALOG, ValidAccessLevels::BASIC_ACCESS);

    		$res = self::getPublishedPagesForCatalog(array('entity_id' => $entity_id,
    			'user_id' => $user_id,
    			'isPaged' => false));
    		return empty($res) ? false : array_pop($res);
    }

    public static function checkTheCurrentForInitialization()
    {
        $returnMe = false;
        $defaults = self::getActiveContainerIDsForUser(SYSTEM_USER_ID, new TC_DefaultAccessProfile());
        if(count($defaults) == 0)
        {
            $returnMe = false;
        }
        else
        {
            $returnMe = true;
        }
        return $returnMe;
    }

    public static function getGroupsOfType($accessgrouptype_id, $user_id = null, $entity_id = null, $metadataFieldValuePair = null)
    {

        $uac = new THOR_UserAccessDatabaseManager();
        return $uac->getAccessGroupsForUserOrEntity($user_id, $accessgrouptype_id, $entity_id, $metadataFieldValuePair);

    }

    public static function verifyUser($user_id, $email = null, $login = null, $name = null)
    {
        $uac = new THOR_UserAccessDatabaseManager();
        return $uac->userVerification($user_id, $email, $login, $name);
    }


    public static function setEntityInGroup($accessgroup_id, $entity_id, $is_active = null)
    {
        if(!isset($is_active))
        {
            $is_active = 1;
        }
        $uac = new THOR_UserAccessDatabaseManager();
        $returnMe = $uac->setEntityToGroupUAC($accessgroup_id, $entity_id, $is_active);
        return $returnMe;
    }

    public static function setUserInGroup($accessgroup_id, $user_id, $is_active = null)
    {
        if(!isset($is_active))
        {
            $is_active = 1;
        }
        $uac = new THOR_UserAccessDatabaseManager();
        $returnMe = $uac->setUserToGroupUAC($accessgroup_id, $user_id, $is_active);
        return $returnMe;
    }


    public static function setAccessForGroup($accessProfile, $accessgroup_id, $is_active = null)
    {
        if(!isset($is_active))
        {
            $is_active = 1;
        }
        $uac = new THOR_UserAccessDatabaseManager();
        $returnMe = $uac->setGroupUAC($accessProfile, $accessgroup_id, $is_active);
        return $returnMe;
    }


    public static function verifyAndGetGlobalGroup($user_id = null, $forceAccessCheck = false)
    {
        $litmus = self::verifyAndGetUniqueGroup(ValidAccessGroupTypes::EVERYONE, $user_id, $forceAccessCheck);
        $accessgroup = $litmus[0];
        if($litmus[1] === 1 || $forceAccessCheck)
        {

            self::initializeNewUser(SYSTEM_USER_ID);

            self::setAccessForGroup(new TC_DefaultAccessProfile(), $accessgroup->get_keyValue());

            self::setAccessForGroup(new AccessProfile(ValidAccessProfiles::DASHBOARD_REORDER,
                                                        ValidAccessTypes::REORDER,
                                                        ValidAccessContexts::DASHBOARD,
                                                        ValidAccessLevels::BASIC_ACCESS),
                                    $accessgroup->get_keyValue());

            self::setAccessForGroup(new AccessProfile(ValidAccessProfiles::DASHBOARD_READ,
                                                        ValidAccessTypes::VIEW,
                                                        ValidAccessContexts::DASHBOARD,
                                                        ValidAccessLevels::BASIC_ACCESS),
                                    $accessgroup->get_keyValue());

            self::setUserInGroup($accessgroup->get_keyValue(), SYSTEM_USER_ID);

        }
        return $accessgroup;
    }

    public static function verifyAndGetGlobalAdminGroup($user_id = null, $forceAccessCheck = false)
    {
        $litmus = self::verifyAndGetUniqueGroup(ValidAccessGroupTypes::GLOBAL_ADMIN, $user_id, $forceAccessCheck);
        $accessgroup = $litmus[0];
        if($litmus[1] === 1 || $forceAccessCheck)
        {

            self::initializeNewUser(DEFAULT_GLOBAL_ADMIN);

            //self::setAccessForGroup(new TC_DefaultAccessProfile(), $accessgroup->get_keyValue());
            self::setAccessForGroup(new AccessProfile(ValidAccessProfiles::DASHBOARD_REORDER,
                                                        ValidAccessTypes::REORDER,
                                                        ValidAccessContexts::DASHBOARD,
                                                        ValidAccessLevels::BASIC_ACCESS),
                                    $accessgroup->get_keyValue());
            self::setAccessForGroup(new AccessProfile(ValidAccessProfiles::DASHBOARD_READ,
                                                        ValidAccessTypes::VIEW,
                                                        ValidAccessContexts::DASHBOARD,
                                                        ValidAccessLevels::BASIC_ACCESS),
                                    $accessgroup->get_keyValue());
            self::setAccessForGroup(new AccessProfile(ValidAccessProfiles::DASHBOARD_EDIT,
                                                        ValidAccessTypes::EDIT,
                                                        ValidAccessContexts::DASHBOARD,
                                                        ValidAccessLevels::BASIC_ACCESS),
                                    $accessgroup->get_keyValue());
            self::setAccessForGroup(new AccessProfile(ValidAccessProfiles::DASHBOARD_RENAME,
                                                        ValidAccessTypes::RENAME,
                                                        ValidAccessContexts::DASHBOARD,
                                                        ValidAccessLevels::BASIC_ACCESS),
                                    $accessgroup->get_keyValue());
            self::setAccessForGroup(new AccessProfile(ValidAccessProfiles::DASHBOARD_DELETE,
                                                        ValidAccessTypes::DELETE,
                                                        ValidAccessContexts::DASHBOARD,
                                                        ValidAccessLevels::BASIC_ACCESS),
                                    $accessgroup->get_keyValue());

            self::setUserInGroup($accessgroup->get_keyValue(), DEFAULT_GLOBAL_ADMIN);

        }
        return $accessgroup;
    }
    /*
    public static function verifyAndGetAdminGroup($referencedaccessgroup_id, $accessgrouptype_id, $user_id = null)
    {

        {
            throw new Exception("This function can only set up initial group");
        }
        $uac = new THOR_UserAccessDatabaseManager();
        $title = $accessgrouptype;

        $accessgrouptype = $uac->accessGroupTypeVerification($accessgrouptype);
        $accessgrouptype_id = $accessgrouptype->get_keyValue();

        $returnMe = array();

        $accessgroups = self::getGroupsOfType($accessgrouptype_id, $user_id);
        if(count($accessgroups) === 0)
        {
            if(isset($user_id))
            {
                self::verifyUser($user_id);
                $accessgroups = self::getGroupsOfType($accessgrouptype_id);
            }
            if(count($accessgroups) === 0)
            {
                $accessgroup = $uac->createAccessGroup($title, $accessgrouptype_id);
                $returnMe[1] = 1;
            }
            if(isset($user_id))
            {
                self::setUserInGroup($accessgroup->get_keyValue(), $user_id);
            }
        }
        else
        {
            $accessgroup = array_pop($accessgroups);
            $returnMe[1] = 0;
        }

        $returnMe[0] = $accessgroup;
        return $returnMe;



        //$litmus = self::verifyAndGetUniqueGroup(ValidAccessGroupTypes::EVERYONE, $user_id);
        //$accessgroup = $litmus[0];

            //self::verifyUser(DEFAULT_GLOBAL_ADMIN);

        if(isset($user_id))
        {
            self::verifyUser($user_id);

            self::setAccessForGroup(new TC_DefaultAccessProfile(), $accessgroup->get_keyValue());
            self::setAccessForGroup(new AccessProfile(ValidAccessProfiles::DASHBOARD_REORDER,
                                                        ValidAccessTypes::REORDER,
                                                        ValidAccessContexts::DASHBOARD,
                                                        ValidAccessLevels::BASIC_ACCESS),
                                    $accessgroup->get_keyValue());

            self::setUserInGroup($accessgroup->get_keyValue(), $user_id);
        }
        //self::verifyUser(DEFAULT_GLOBAL_ADMIN);
        //self::setUserInGroup($accessgroup->get_keyValue(), DEFAULT_GLOBAL_ADMIN);

            if(isset($user_id) && $user_id !== DEFAULT_GLOBAL_ADMIN && $user_id !== SYSTEM_USER_ID)
            {
                //self::verifyUser($user_id);
                self::setUserInGroup($accessgroup->get_keyValue(), $user_id);
            }

            //self::setRightsForUserInGroup($accessgroup_id, DEFAULT_GLOBAL_ADMIN, new AccessProfile(ValidAccessProfiles::DASHBOARD_EDIT, ValidAccessTypes::EDIT, ValidAccessContexts::DASHBOARD, 1));

        //self::setUserInGroup($accessgroup->get_keyValue(), DEFAULT_GLOBAL_ADMIN);

    }
    */

    public static function verifyAndGetSystemGroup($forceAccessCheck = false)
    {
        $litmus = self::verifyAndGetUniqueGroup(ValidAccessGroupTypes::NOBODY, null, $forceAccessCheck);
        $accessgroup = $litmus[0];
        if($litmus[1] === 1 || $forceAccessCheck)
        {
            self::setAccessForGroup(new AccessProfile(ValidAccessProfiles::VOID_VOID,
                                                        ValidAccessTypes::VOID,
                                                        ValidAccessContexts::VOID,
                                                        ValidAccessLevels::BASIC_ACCESS),
                                    $accessgroup->get_keyValue());

            self::setUserInGroup($accessgroup->get_keyValue(), SYSTEM_USER_ID);
        }

        return $accessgroup;
        //return self::verifyAndGetUniqueGroup(ValidAccessGroupTypes::NOBODY);
    }

    public static function verifyAndGetVersionedGroupForEntity($entity_id, $forceAccessCheck = false)
    {

    		$uac = new THOR_UserAccessDatabaseManager();
    		$title = ValidAccessGroupTypes::VERSIONED;

    		$accessgrouptype = $uac->accessGroupTypeVerification(ValidAccessGroupTypes::VERSIONED);
    		$accessgrouptype_id = $accessgrouptype->get_keyValue();

    		//$returnMe = array();
    		$accessgroups = self::getGroupsOfType($accessgrouptype_id, null, $entity_id);
    		if(count($accessgroups) === 0 || $forceAccessCheck)
    		{
    		    //self::verifyUser($user_id);
    		    if(count($accessgroups) === 0)
                {
                    $accessgroup = $uac->createAccessGroup($title, $accessgrouptype_id);
                }
                else
                {
                    $accessgroup = array_pop($accessgroups);
                }
    		    self::setAccessForGroup(new AccessProfile(ValidAccessProfiles::VOID_VOID,
    		                                                ValidAccessTypes::VOID,
    		                                                ValidAccessContexts::VOID,
    		                                                ValidAccessLevels::BASIC_ACCESS),
    		                            $accessgroup->get_keyValue());

    		    self::setEntityInGroup($accessgroup->get_keyValue(), $entity_id);
    		    self::setUserInGroup($accessgroup->get_keyValue(), SYSTEM_USER_ID);

    		    //$returnMe[1] = 1;
    		}
    		else
    		{
    		    $accessgroup = array_pop($accessgroups);
    		    //$returnMe[1] = 0;
    		}
    		return $accessgroup;

    }

    public static function preDataForGroups($user_id, $entity_id, $accessgrouptype, $title = null /*, $forceAccessCheck = false*/ )
    {
    	$uac = new THOR_UserAccessDatabaseManager();
    	$title = $title ? $title : $accessgrouptype;

    	$accessgrouptype = $uac->accessGroupTypeVerification($accessgrouptype);
    	$accessgrouptype_id = $accessgrouptype->get_keyValue();

    	//$returnMe = array();
    	$accessgroups = self::getGroupsOfType($accessgrouptype_id, $user_id, $entity_id);

    	$returnMe = array('title'=>$title,
    										'uac'=>$uac,
    										'accessgrouptype'=>$accessgrouptype,
    										'accessgrouptype_id'=>$accessgrouptype_id,
    										'accessgroups'=>$accessgroups);
    	return $returnMe;
    }

    public static function getVersionedPublisherGroupForUserAndEntity(
																	$user_id,
																	$entity_id,
																	$predata = null /*,
                                                                    $forceAccessCheck = false*/ )
    {

	  		$predata = $predata ? $predata : self::preDataForGroups($user_id, $entity_id, ValidAccessGroupTypes::VERSIONED_PUBLISHER );

	    	// $accessgroups = self::getGroupsOfType($accessgrouptype_id, $user_id, $entity_id);
	    	if(count($predata['accessgroups']) === 0)
	    	{
	    			$accessgroup = null;
	    	}
	    	else
	    	{
	    	    $accessgroup = array_pop($predata['accessgroups']);
	    	    //$returnMe[1] = 0;
	    	}
	    	return $accessgroup;

    }



    public static function createVersionedPublisherGroupForUserAndEntity(
    																		$user_id,
    																		$entity_id,
    																		$predata = null)
    {
    		$predata = $predata ? $predata : self::preDataForGroups($user_id, $entity_id, ValidAccessGroupTypes::VERSIONED_PUBLISHER );
		    $accessgroup = $predata['uac']->createAccessGroup($predata['title'], $predata['accessgrouptype_id']);

		    self::setAccessForGroup(new TC_DefaultAccessProfile(), $accessgroup->get_keyValue());


		    self::setAccessForGroup(new AccessProfile(ValidAccessProfiles::DASHBOARD_REORDER,
		                                                ValidAccessTypes::REORDER,
		                                                ValidAccessContexts::DASHBOARD,
		                                                ValidAccessLevels::BASIC_ACCESS),
		                            $accessgroup->get_keyValue());
		    self::setAccessForGroup(new AccessProfile(ValidAccessProfiles::DASHBOARD_READ,
		                                                ValidAccessTypes::VIEW,
		                                                ValidAccessContexts::DASHBOARD,
		                                                ValidAccessLevels::BASIC_ACCESS),
		                            $accessgroup->get_keyValue());
		    self::setAccessForGroup(new AccessProfile(ValidAccessProfiles::DASHBOARD_EDIT,
		                                                ValidAccessTypes::EDIT,
		                                                ValidAccessContexts::DASHBOARD,
		                                                ValidAccessLevels::BASIC_ACCESS),
		                            $accessgroup->get_keyValue());
		    self::setAccessForGroup(new AccessProfile(ValidAccessProfiles::DASHBOARD_RENAME,
		                                                ValidAccessTypes::RENAME,
		                                                ValidAccessContexts::DASHBOARD,
		                                                ValidAccessLevels::BASIC_ACCESS),
		                            $accessgroup->get_keyValue());
		    self::setAccessForGroup(new AccessProfile(ValidAccessProfiles::DASHBOARD_PUBLISH,
		                                                ValidAccessTypes::PUBLISH,
		                                                ValidAccessContexts::DASHBOARD,
		                                                ValidAccessLevels::BASIC_ACCESS),
		                            $accessgroup->get_keyValue());
		    self::setAccessForGroup(new AccessProfile(ValidAccessProfiles::DASHBOARD_CLONE,
		                                                ValidAccessTypes::_CLONE,
		                                                ValidAccessContexts::DASHBOARD,
		                                                ValidAccessLevels::BASIC_ACCESS),
		                            $accessgroup->get_keyValue());


		    self::setEntityInGroup($accessgroup->get_keyValue(), $entity_id);
		    self::setUserInGroup($accessgroup->get_keyValue(), $user_id);

    		return $accessgroup;

    }

    public static function verifyAndGetVersionedPublisherGroupForUserAndEntity($user_id, $entity_id, $predata = null)
    {

    		$predata = $predata ? $predata : self::preDataForGroups($user_id, $entity_id, ValidAccessGroupTypes::VERSIONED_PUBLISHER );

    		if(!($group = self::getVersionedPublisherGroupForUserAndEntity($user_id, $entity_id, $predata))){
    				$group = self::createVersionedPublisherGroupForUserAndEntity($user_id, $entity_id, $predata);
    		}
    		return $group;

    		// $uac = new THOR_UserAccessDatabaseManager();
    		// $title = ValidAccessGroupTypes::VERSIONED_PUBLISHER;

    		// $accessgrouptype = $uac->accessGroupTypeVerification(ValidAccessGroupTypes::VERSIONED_PUBLISHER);
    		// $accessgrouptype_id = $accessgrouptype->get_keyValue();

    		// $accessgroups = self::getGroupsOfType($accessgrouptype_id, $user_id, $entity_id);

    		// if(count($accessgroups) === 0)
    		// {
    		//     //self::verifyUser($user_id);
    		//     $accessgroup = $uac->createAccessGroup($title, $accessgrouptype_id);

    		//     self::setAccessForGroup(new TC_DefaultAccessProfile(), $accessgroup->get_keyValue());
    		//     self::setAccessForGroup(new AccessProfile(ValidAccessProfiles::DASHBOARD_REORDER,
    		//                                                 ValidAccessTypes::REORDER,
    		//                                                 ValidAccessContexts::DASHBOARD,
    		//                                                 ValidAccessLevels::BASIC_ACCESS),
    		//                             $accessgroup->get_keyValue());
    		//     self::setAccessForGroup(new AccessProfile(ValidAccessProfiles::DASHBOARD_EDIT,
    		//                                                 ValidAccessTypes::EDIT,
    		//                                                 ValidAccessContexts::DASHBOARD,
    		//                                                 ValidAccessLevels::BASIC_ACCESS),
    		//                             $accessgroup->get_keyValue());

    		//     self::setEntityInGroup($accessgroup->get_keyValue(), $entity_id);
    		//     self::setUserInGroup($accessgroup->get_keyValue(), $user_id);
    		//     //$returnMe[1] = 1;
    		// }
    		// else
    		// {
    		//     $accessgroup = array_pop($accessgroups);
    		//     //$returnMe[1] = 0;
    		// }
    		// return $accessgroup;

    }







    public static function verifyAndGetVersionedMostRecentGroup($user_id = null, $forceAccessCheck = false)
    {
        $litmus = self::verifyAndGetUniqueGroup(ValidAccessGroupTypes::VERSIONED_MOSTRECENT, $user_id, $forceAccessCheck);
        $accessgroup = $litmus[0];
        if($litmus[1] === 1 || $forceAccessCheck)
        {
            self::initializeNewUser(SYSTEM_USER_ID);
            self::setAccessForGroup(new AccessProfile(ValidAccessProfiles::CATALOG_READ,
                                                        ValidAccessTypes::VIEW,
                                                        ValidAccessContexts::CATALOG,
                                                        ValidAccessLevels::BASIC_ACCESS),
                                    $accessgroup->get_keyValue());

            self::setUserInGroup($accessgroup->get_keyValue(), SYSTEM_USER_ID);

        }
        return $accessgroup;
    }

    public static function verifyAndGetUniqueGroup($accessgrouptype, $user_id = null, $forceAccessCheck = false)
    {

        if(
            $accessgrouptype != ValidAccessGroupTypes::EVERYONE &&
            $accessgrouptype != ValidAccessGroupTypes::NOBODY &&
            $accessgrouptype != ValidAccessGroupTypes::VERSIONED_MOSTRECENT &&
            $accessgrouptype != ValidAccessGroupTypes::GLOBAL_ADMIN
        )
        {
            throw new Exception("This function can only set up initial group");
        }

        $uac = new THOR_UserAccessDatabaseManager();
        $title = $accessgrouptype;

        $accessgrouptype = $uac->accessGroupTypeVerification($accessgrouptype);
        $accessgrouptype_id = $accessgrouptype->get_keyValue();

        $returnMe = array();

        $accessgroups = self::getGroupsOfType($accessgrouptype_id, $user_id);

        if(count($accessgroups) === 0)
        {
            if(isset($user_id)  && $user_id !== SYSTEM_USER_ID)
            {
                //self::verifyUser($user_id);
                $accessgroups = self::getGroupsOfType($accessgrouptype_id);
            }
            if(count($accessgroups) === 0)
            {
                $accessgroup = $uac->createAccessGroup($title, $accessgrouptype_id);
                $returnMe[1] = 1;
            }
            else
            {
                $accessgroup = array_pop($accessgroups);
            }
            if(isset($user_id)  && $user_id !== SYSTEM_USER_ID)
            {
                self::setUserInGroup($accessgroup->get_keyValue(), $user_id);
            }
        }
        else
        {
            $accessgroup = array_pop($accessgroups);
            $returnMe[1] = 0;
        }

        $returnMe[0] = $accessgroup;
        return $returnMe;
    }


    public static function verifyAndGetPersonalGroup($user_id, $forceAccessCheck = false)
    {
        $uac = new THOR_UserAccessDatabaseManager();
        $title = ValidAccessGroupTypes::PERSONAL;

        $accessgrouptype = $uac->accessGroupTypeVerification(ValidAccessGroupTypes::PERSONAL);
        $accessgrouptype_id = $accessgrouptype->get_keyValue();

        //$returnMe = array();
        $accessgroups = self::getGroupsOfType($accessgrouptype_id, $user_id);
        if(count($accessgroups) === 0 || $forceAccessCheck)
        {
            //self::verifyUser($user_id);
            if(count($accessgroups) === 0)
            {
                $accessgroup = $uac->createAccessGroup($title, $accessgrouptype_id);
            }
            else
            {
                $accessgroup = array_pop($accessgroups);
            }
            self::setAccessForGroup(new TC_DefaultAccessProfile(), $accessgroup->get_keyValue());
            self::setAccessForGroup(new AccessProfile(ValidAccessProfiles::DASHBOARD_REORDER,
                                                        ValidAccessTypes::REORDER,
                                                        ValidAccessContexts::DASHBOARD,
                                                        ValidAccessLevels::BASIC_ACCESS),
                                    $accessgroup->get_keyValue());
            self::setAccessForGroup(new AccessProfile(ValidAccessProfiles::DASHBOARD_READ,
                                                        ValidAccessTypes::VIEW,
                                                        ValidAccessContexts::DASHBOARD,
                                                        ValidAccessLevels::BASIC_ACCESS),
                                    $accessgroup->get_keyValue());
            self::setAccessForGroup(new AccessProfile(ValidAccessProfiles::DASHBOARD_EDIT,
                                                        ValidAccessTypes::EDIT,
                                                        ValidAccessContexts::DASHBOARD,
                                                        ValidAccessLevels::BASIC_ACCESS),
                                    $accessgroup->get_keyValue());
            self::setAccessForGroup(new AccessProfile(ValidAccessProfiles::DASHBOARD_RENAME,
                                                        ValidAccessTypes::RENAME,
                                                        ValidAccessContexts::DASHBOARD,
                                                        ValidAccessLevels::BASIC_ACCESS),
                                    $accessgroup->get_keyValue());
            self::setAccessForGroup(new AccessProfile(ValidAccessProfiles::DASHBOARD_PUBLISH,
                                                        ValidAccessTypes::PUBLISH,
                                                        ValidAccessContexts::DASHBOARD,
                                                        ValidAccessLevels::BASIC_ACCESS),
                                    $accessgroup->get_keyValue());
            self::setAccessForGroup(new AccessProfile(ValidAccessProfiles::DASHBOARD_DELETE,
                                                        ValidAccessTypes::DELETE,
                                                        ValidAccessContexts::DASHBOARD,
                                                        ValidAccessLevels::BASIC_ACCESS),
                                    $accessgroup->get_keyValue());
            self::setAccessForGroup(new AccessProfile(ValidAccessProfiles::DASHBOARD_CLONE,
                                                        ValidAccessTypes::_CLONE,
                                                        ValidAccessContexts::DASHBOARD,
                                                        ValidAccessLevels::BASIC_ACCESS),
                                    $accessgroup->get_keyValue());



            self::setUserInGroup($accessgroup->get_keyValue(), $user_id);



            //$returnMe[1] = 1;
        }
        else
        {
            $accessgroup = array_pop($accessgroups);
            //$returnMe[1] = 0;
        }
        return $accessgroup;
        //$returnMe[0] = $accessgroup;
        //return $returnMe;
    }

    public static function verifyAndGetManagedGroup()
    {

    }



    public static function verifyAndGetPersonalPublishedGroup($user_id, $forceAccessCheck = false)
    {
    	$uac = new THOR_UserAccessDatabaseManager();
    	$title = ValidAccessGroupTypes::PERSONAL_PUBLISHED;

    	$accessgrouptype = $uac->accessGroupTypeVerification(ValidAccessGroupTypes::PERSONAL_PUBLISHED);
    	$accessgrouptype_id = $accessgrouptype->get_keyValue();

    	//$returnMe = array();
    	$accessgroups = self::getGroupsOfType($accessgrouptype_id, $user_id);
    	if(count($accessgroups) === 0 || $forceAccessCheck)
    	{
    	    //self::verifyUser($user_id);
    	    if(count($accessgroups) === 0){
                $accessgroup = $uac->createAccessGroup($title, $accessgrouptype_id);
            }
            else{
                $accessgroup = array_pop($accessgroups);
            }

    	    self::setAccessForGroup(new AccessProfile(ValidAccessProfiles::VOID_VOID,
    	                                                ValidAccessTypes::VOID,
    	                                                ValidAccessContexts::VOID,
    	                                                ValidAccessLevels::BASIC_ACCESS),
    	                            $accessgroup->get_keyValue());


    	    self::setUserInGroup($accessgroup->get_keyValue(), $user_id);



    	    //$returnMe[1] = 1;
    	}
    	else
    	{
    	    $accessgroup = array_pop($accessgroups);
    	    //$returnMe[1] = 0;
    	}
    	return $accessgroup;
    }




    public static function verifyAndGetVersionedVersionReadGroup($user_id, $forceAccessCheck = false)
    {
    	$uac = new THOR_UserAccessDatabaseManager();
    	$title = ValidAccessGroupTypes::VERSIONED_VERSIONREAD;

    	$accessgrouptype = $uac->accessGroupTypeVerification(ValidAccessGroupTypes::VERSIONED_VERSIONREAD);
    	$accessgrouptype_id = $accessgrouptype->get_keyValue();

    	//$returnMe = array();
    	$accessgroups = self::getGroupsOfType($accessgrouptype_id, $user_id);
    	if(count($accessgroups) === 0 || $forceAccessCheck)
    	{
    	    //self::verifyUser($user_id);
    	    if(count($accessgroups) === 0)
            {
                $accessgroup = $uac->createAccessGroup($title, $accessgrouptype_id);
            }
            else
            {
                $accessgroup = array_pop($accessgroups);
            }
    	    self::setAccessForGroup(new TC_DefaultAccessProfile(), $accessgroup->get_keyValue());
    	    self::setAccessForGroup(new AccessProfile(ValidAccessProfiles::DASHBOARD_READ,
    	                                                ValidAccessTypes::VIEW,
    	                                                ValidAccessContexts::DASHBOARD,
    	                                                ValidAccessLevels::BASIC_ACCESS),
    	                            $accessgroup->get_keyValue());
    	    self::setAccessForGroup(new AccessProfile(ValidAccessProfiles::DASHBOARD_REORDER,
    	                                                ValidAccessTypes::REORDER,
    	                                                ValidAccessContexts::DASHBOARD,
    	                                                ValidAccessLevels::BASIC_ACCESS),
    	                            $accessgroup->get_keyValue());
    	    self::setAccessForGroup(new AccessProfile(ValidAccessProfiles::DASHBOARD_UNSUBSCRIBE,
    	                                                ValidAccessTypes::UNSUBSCRIBE,
    	                                                ValidAccessContexts::DASHBOARD,
    	                                                ValidAccessLevels::BASIC_ACCESS),
    	                            $accessgroup->get_keyValue());
    	    self::setAccessForGroup(new AccessProfile(ValidAccessProfiles::CATALOG_UNSUBSCRIBE,
    	                                                ValidAccessTypes::UNSUBSCRIBE,
    	                                                ValidAccessContexts::CATALOG,
    	                                                ValidAccessLevels::BASIC_ACCESS),
    	                            $accessgroup->get_keyValue());

    	    self::setUserInGroup($accessgroup->get_keyValue(), $user_id);



    	    //$returnMe[1] = 1;
    	}
    	else
    	{
    	    $accessgroup = array_pop($accessgroups);
    	    //$returnMe[1] = 0;
    	}
    	return $accessgroup;
    }


    public static function verifyAndGetManagedAdminGroup()
    {

    }






    public static function verifyAndGetTaxonomyTerm($term_id, $taxonomy_id, $is_active = 1)
    {
    		$termtax = new THOR_TERMS_TAXONOMIES_DataBoundSimplePersistable();
    		$termtax->term_id = $term_id;
    		$termtax->taxonomy_id = $taxonomy_id;
    		$termtax->is_active = $is_active;
    		if(!$termtax->isPersistableAlreadyRecorded(false, true, array('is_active')) || $termtax->is_active != $is_active)
    		{
    				$termtax->save();
    		}
    		return $termtax;
    }

    public static function verifyAndGetTag($tag_id, $is_active = 1)
    {
    		return self::verifyAndGetTaxonomyTerm($tag_id, self::verifyAndGetTheTagsTaxonomy()->get_keyValue(), $is_active);
    }


    public static function verifyAndGetTaxonomy($taxonomy){
    		$tax = new THOR_TAXONOMIES_DataBoundSimplePersistable();
    		$tax->name = $taxonomy;
    		if(!$tax->isPersistableAlreadyRecorded(false, true, array()))
    		{
    				$tax->save();
    		}
    		return $tax;
    }

    public static function verifyAndGetTheTagsTaxonomy(){
    		return self::verifyAndGetTaxonomy(ValidTaxonomies::TAGS);
    }

    public static function tagEntity($entity_id, $tag_id, $owner_id = SYSTEM_USER_ID, $is_active = 1)
    {
    		$termtaxonomy_id = self::verifyAndGetTag($tag_id)->get_keyValue();
    		$tte = new THOR_ENTITIES_TERMS_TAXONOMIES_DataBoundSimplePersistable();

    		$tte->entity_id = $entity_id;
    		$tte->termtaxonomy_id = $termtaxonomy_id;

    		if(!($tte->isPersistableAlreadyRecorded(false, true, array('is_active','created_date','last_edited','owner_id'))))
    		{

    				$tte->created_date = date('Y-m-d H:i:s');
    				$tte->last_edited = date('Y-m-d H:i:s');
    				$tte->owner_id = $owner_id;
    				$tte->is_active = $is_active;
    				$tte->save();

    				// var_dump($tte);
    		}
    		else {
    			// $tte = $tte->isPersistableAlreadyRecorded(false, true, array('is_active','created_date','last_edited','owner_id'));
    			// echo $tte->is_active;
    			// echo $tte->created_date;

    			if($tte->is_active != $is_active)
	    		{
	    				$tte->is_active = $is_active;
	    				$tte->last_edited = date('Y-m-d H:i:s');
	    				$tte->save();
	    		}
    		}
    		return $tte;
    }

    public static function getTermIdsForEntityInTaxonomy($entity_id, $taxonomy_id)
    {


    		$tte = new THOR_ENTITIES_TERMS_TAXONOMIES_DataBoundSimplePersistable();
    		$tte->entity_id = $entity_id;
    		$tte->is_active = 1;
    		$tteSet = $tte->produceSetFromPropertyMatches(false, array('created_date','last_edited','owner_id', 'termtaxonomy_id'));

    		$returnMe = array();

    		foreach($tteSet as $key => $value)
    		{
    				$termtax = new THOR_TERMS_TAXONOMIES_DataBoundSimplePersistable();
    				$termtax->populateFromKey($value->termtaxonomy_id);
    				if($termtax->taxonomy_id == $taxonomy_id && $termtax->is_active)
    				{
    						array_push($returnMe, $termtax->term_id);
    				}
    		}

    		return $returnMe;

    }

    public static function getTagIdsForEntity($entity_id)
    {
    		return self::getTermIdsForEntityInTaxonomy($entity_id, self::verifyAndGetTheTagsTaxonomy()->get_keyValue());
    }

    // public static function getTagIdListFromJSONString($jsonTagString)
    // {
    // 		$tags = json_decode($jsonTagString);
    // 		$cb = function($ob){
    // 				return $ob->{'id'};
    // 		};
    // 		return array_map($cb, $tags);
    // }

    public static function handleTagMerge($entity_id, $user_id, $oldTagIdArray, $newTagIdArray)
    {
    		// var_dump($newTagIdArray);
    		$toAdd = array_diff($newTagIdArray, $oldTagIdArray);
    		$toRemove = array_diff($oldTagIdArray, $newTagIdArray);

    		// var_dump($toAdd);
    		// var_dump($toRemove);
    		// echo '   add   ';
    		foreach($toAdd as $key => $value)
    		{
    				// echo $value . '-';
    				self::tagEntity($entity_id, $value, $user_id, 1);
    		}
    				// echo '   remove   ';
    		foreach($toRemove as $key => $value)
    		{
    				// echo $value . '-';
    				self::tagEntity($entity_id, $value, $user_id, 0);
    		}
    }

    public static function getTermTaxCount($termtaxonomy_id){
        $tte = new THOR_ENTITIES_TERMS_TAXONOMIES_DataBoundSimplePersistable();
        $tte->termtaxonomy_id = $termtaxonomy_id;
        $tte->is_active = 1;
        $tteSet = $tte->produceSetFromPropertyMatches(false, array('created_date','last_edited','owner_id','entity_id'));

        $accessprofileRead = new AccessProfile(ValidAccessProfiles::CATALOG_READ, ValidAccessTypes::VIEW, ValidAccessContexts::CATALOG, ValidAccessLevels::BASIC_ACCESS);
        $containerIdsMostRecentPublished = self::getPublishedPageIdsForCatalog(array('accessprofile' => $accessprofileRead));


        foreach($tteSet as $key => $item)
        {
            $entityIsPublished = false;
            if(in_array($item->entity_id, $containerIdsMostRecentPublished))
            {
                $entityIsPublished = true;
            }
            //if(getEntityFromRepoPool($item->entity_id, $containerIdsMostRecentPublished, 'get_entity_id'))
            if(!$entityIsPublished)
            {
                unset($tteSet[$key]);
            }
        }



        return count($tteSet);
    }

    public static function getTagCount($tag_id){
    	$termtaxonomy_id = self::verifyAndGetTag($tag_id)->get_keyValue();
        return self::getTermTaxCount($termtaxonomy_id);

    	// $tte = new THOR_ENTITIES_TERMS_TAXONOMIES_DataBoundSimplePersistable();
    	// $tte->termtaxonomy_id = $termtaxonomy_id;
    	// $tte->is_active = 1;
    	// $tteSet = $tte->produceSetFromPropertyMatches(false, array('created_date','last_edited','owner_id','entity_id'));

    	// return count($tteSet);


    	// $returnMe = array();

    	// foreach($tteSet as $key => $value)
    	// {
    	// 		$termtax = new THOR_TERMS_TAXONOMIES_DataBoundSimplePersistable();
    	// 		$termtax->populateFromKey($value->termtaxonomy_id);
    	// 		if($termtax->taxonomy_id == $taxonomy_id && $termtax->is_active)
    	// 		{
    	// 				array_push($returnMe, $termtax->term_id);
    	// 		}
    	// }

    	// return $returnMe;


    }

    public static function getTagCountArray($tag_ids){
    	$returnMe = array();
    	foreach($tag_ids as $tag){
    		$returnMe[$tag->id] = self::getTagCount($tag->id);
    	}
    	return $returnMe;
    }


    public static function getUsedTagCount($limit){

        $accessprofileRead = new AccessProfile(ValidAccessProfiles::CATALOG_READ, ValidAccessTypes::VIEW, ValidAccessContexts::CATALOG, ValidAccessLevels::BASIC_ACCESS);
        $containerIdsMostRecentPublished = self::getPublishedPageIdsForCatalog(array('accessprofile' => $accessprofileRead));
        // logError(var_export($containerIdsMostRecentPublished, true));
        $tte = new THOR_ENTITIES_TERMS_TAXONOMIES_DataBoundSimplePersistable();
        $tte->is_active = 1;
        $tteSet = $tte->produceSetFromPropertyMatches(false, array('created_date','last_edited','owner_id','entity_id','termtaxonomy_id'));
        // return array('4' => count($tteSet));
        // $addedKeys = array();
        $returnMe = array();
        $usedTermTaxIds = array();

        shuffle($tteSet);

        // foreach($tteSet as $item){
        //     $returnMe[] = $item->termtaxonomy_id;
        // }
        // logError($returnMe);
        // return $returnMe;

        foreach($tteSet as $item){
            // logError($item->termtaxonomy_id);
            // logError($item->entity_id);
            // logError($item->termtaxonomy_id . ' - ' . $item->entity_id);

            if(count($returnMe) >= $limit /* min(15, count($tteSet)) */ ){
                break;
            }
            if(in_array($item->termtaxonomy_id, $usedTermTaxIds) || !in_array($item->entity_id, $containerIdsMostRecentPublished)){
                continue;
            }
            // logError($item->termtaxonomy_id . ' - ' . $item->entity_id);

            // $returnMe[] = $item;
            $usedTermTaxIds[] = $item->termtaxonomy_id;
            $count = self::getTermTaxCount($item->termtaxonomy_id);
            // logError($count);
            $termtax = new THOR_TERMS_TAXONOMIES_DataBoundSimplePersistable();
            // $termtax->term_id = $term_id;

            $termtax->populateFromKey($item->termtaxonomy_id);
            // $termtax->taxonomy_id = self::verifyAndGetTheTagsTaxonomy()->get_keyValue();
            // $termtax->is_active = 1;
            // $tagSet = $termtax->produceSetFromPropertyMatches(true, array('term_id'));
            // logError(var_export($tagSet, true));
            // $tag = array_pop($tagSet);

            // logError(var_export($tag->get_keyValue(), true));

            if($termtax)
            {
                // $tagId = $termtax->get_keyValue();
                $tagId = $termtax->term_id;
                $returnMe[$tagId] = $count;//array('count' => $count, 'text' => $item);
            }

        }

        return $returnMe;


        // while(count($returnMe) < min(15, count($tteSet)) )
        // {

        // }


        // $randomKeys = array_rand($tteSet, min(15, count($tteSet)));
        // $randomKeys
        // var randomList = [];
                            // var randomResults = [];
                            // while(randomList.length < 15)
                            // {
                            //     var random = catalogSearchTermsArray[Math.floor(Math.random() * catalogSearchTermsArray.length)];
                            //     if(randomList.indexOf(random.id) == -1)
                            //     {
                            //         randomResults.push(random);
                            //         randomList.push(random.id);
                            //     }
                            // }


        // while(count($returnMe) < min(15, count($tteSet)) )
        // {
        //     $randomKey = array_pop(array_rand($tteSet, 1))
        //     $random = $tteSet[array_rand($tteSet, 1)];
        // }


    }

    // public static function updateTagsByJSONData($jsonTagString, $user_id, $entity_id)
    // {

    // 		$existingTermIds = self::getTermIdsForEntityInTaxonomy($entity_id);

    // 		$tags = json_decode($jsonTagString);

    // 		// add the new tags
    // 		foreach($tags as $key => $value)
    // 		{
    // 				if(!in_array($value->{'id'}, $existingTermIds))
    // 				{
    // 						self::tagEntity($entity_id, $value->{'id'}, $user_id, true);
    // 				}
    // 				else
    // 				{
    // 						$existingTermIds = array_diff($existingTermIds, array($value->{'id'}));
    // 				}
    // 				// echo $value->{'id'};
    // 				// echo $value->{'text'};
    // 		}
    // 		// delete removed tags
    // 		foreach($existingTermIds as $key => $value)
    // 		{
    // 				self::tagEntity($entity_id, $value, $user_id, false);
    // 		}

    // }




    public static function publishPage($user_id, $entity_id, $description = null, $newTags = array())
    {
    		$personalPublished = self::verifyAndGetPersonalPublishedGroup($user_id);
    		// todo fix this error below

    		$predata = self::preDataForGroups($user_id, $entity_id, ValidAccessGroupTypes::VERSIONED_PUBLISHER);


    	// 	echo 'hi hi hihi';
 				// echo count(self::getCatalogPageCount(array('accessGroupID' => $personalPublished->get_keyValue())));



    		// How to determine newly published page?
    		// 		Page will be in a VERSIONED_PUBLISHER group already
    		//		Kill existing priority metadata for entity
    			// logError($user_id);
    			// logError($personalPublished->get_keyValue());
    			// logError(self::getCatalogPageCount(array('user_id' => $user_id, 'accessprofile' => new AccessProfile(ValidAccessProfiles::CATALOG_READ, ValidAccessTypes::VIEW, ValidAccessContexts::CATALOG, ValidAccessLevels::BASIC_ACCESS))));
    			// logError(self::getCatalogPageCount(array('user_id' => $user_id,
    			// 		                                     'accessGroupID' => $personalPublished->get_keyValue())));
    			// logError(self::getCatalogPageCount(array('user_id' => $user_id, 'accessprofile' => new AccessProfile(ValidAccessProfiles::CATALOG_UNSUBSCRIBE, ValidAccessTypes::UNSUBSCRIBE, ValidAccessContexts::CATALOG, ValidAccessLevels::BASIC_ACCESS))));

    			// return;

    		if(!($versionedPublisherGroup = self::getVersionedPublisherGroupForUserAndEntity($user_id, $entity_id, $predata)))
    		{
	    			// Newly published page
	    			// 		Make VERSIONED_PUBLISHED group
	    			// 		Page will be cloned as Pub Page Version
	    			// 		Pub Page Version will need to be added to VERSIONED_MOSTRECENT




	    			if(self::getCatalogPageCount(array('user_id' => $user_id, 'accessGroupID' => $personalPublished->get_keyValue())) >= MAX_PUBLISHED_TABS_PER_USER)
	    			{
	    					return false;
	    			}


		    		$oldTags = self::getTagIdsForEntity($entity_id);

		    		self::handleTagMerge($entity_id, $user_id, $oldTags, $newTags);
		  			if(isset($description))
		  			{
		  	  			$entity = new THOR_ENTITIES_DataBoundSimplePersistable();
			    			$entity->populateFromKey($entity_id);

			    			$container = new TC_THOR_CONTAINERS_DataBoundSimplePersistable();
			    			$container->populateFromKey($entity->row_id);
								$container->description = $description;
								$container->save();
		  			}



    				// $numPubPagesForUser = self::getActiveContainerIDsForUser($user_id, new AccessProfile(ValidAccessProfiles::));

	    			$versionedMostRecent = self::verifyAndGetVersionedMostRecentGroup();

	    			$pubPageVersion = self::cloneDashboard(SYSTEM_USER_ID, $entity_id, $versionedMostRecent->get_keyValue());
	    			// add draft page to personal published group

	    			self::setEntityInGroup($personalPublished->get_keyValue(), $entity_id);
	    			// todo remove these comments once done debuggin
	    			self::handleTagMerge($pubPageVersion->get_entity_id(), $user_id, array(), $newTags);

	    			// metadataTypeVerification(ValidMetadataTypes::DASHBOARD_PRIORITY);
	    			$metMan = new THOR_MetadataAndTaxonomyDatabaseManager();
	    			$mettypes = $metMan->metadataTypeVerification(ValidMetadataTypes::DASHBOARD_PRIORITY);
	    			$priorityMetaId = $mettypes->get_keyValue();

	    			$meta = new THOR_METADATA_DataBoundSimplePersistable();
	    			$meta->owner_id = $user_id;
	    			$meta->entity_id = $pubPageVersion->get_entity_id();
	    			$meta->type_id = $priorityMetaId;
	    			$meta = array_pop($meta->produceSetFromPropertyMatches());
	    			if($meta)
	    			{
	    					$meta->data = DB_NULL;
	    					$meta->owner_id = SYSTEM_USER_ID;
	    					$meta->save();
	    			}
	    			// 		VERSIONED group will be created and Existing Draft Page will be added
	    			$versionedGroup = self::verifyAndGetVersionedGroupForEntity($entity_id);
	    			// 		Existing Draft Page will be removed from PERSONAL group
	    			$personalGroup = self::verifyAndGetPersonalGroup($user_id);
	    			self::setEntityInGroup($personalGroup->get_keyValue(), $entity_id, 0);
	    			// 		Pub Page Version will be added to VERSIONED group
	    			self::setEntityInGroup($versionedGroup->get_keyValue(), $pubPageVersion->get_entity_id());
	    			// 		VERSIONED_PUBLISHER group will be created and Existing Draft Page will be added
	    			// 		user will be added to VERSIONED_PUBLISHER group
	    			$versionedPublisherGroup = self::createVersionedPublisherGroupForUserAndEntity($user_id, $entity_id, $predata);

    		}
    		else
    		{
	    			// Draft publishing to existing version group
	    			// 		Old Pub Page must be identified as intersection of VERSIONED_MOSTRECENT and VERSIONED
	    			// 		Old Pub Page will be removed from VERSIONED_MOSTRECENT

		    		$oldTags = self::getTagIdsForEntity($entity_id);

		    		self::handleTagMerge($entity_id, $user_id, $oldTags, $newTags);
		  			if(isset($description))
		  			{
		  	  			$entity = new THOR_ENTITIES_DataBoundSimplePersistable();
			    			$entity->populateFromKey($entity_id);

			    			$container = new TC_THOR_CONTAINERS_DataBoundSimplePersistable();
			    			$container->populateFromKey($entity->row_id);

								$container->description = $description;
								$container->save();
		  			}

	    			$versionedGroup = self::verifyAndGetVersionedGroupForEntity($entity_id);
	    			$versionedMostRecent = self::verifyAndGetVersionedMostRecentGroup();
	    			self::removeExistingPublishedPage($versionedGroup->get_keyValue(), $versionedMostRecent->get_keyValue());
	    			// 		Page will be cloned as Pub Page Version
	    			// 		Pub Page Version will need to be added to VERSIONED_MOSTRECENT

	    			$pubPageVersion = self::cloneDashboard(SYSTEM_USER_ID, $entity_id, $versionedMostRecent->get_keyValue());
	    			// todo remove these comments once done debuggin
	    			self::handleTagMerge($pubPageVersion->get_entity_id(), $user_id, array(), $newTags);

	    			$metMan = new THOR_MetadataAndTaxonomyDatabaseManager();
	    			$mettypes = $metMan->metadataTypeVerification(ValidMetadataTypes::DASHBOARD_PRIORITY);
	    			$priorityMetaId = $mettypes->get_keyValue();

	    			$meta = new THOR_METADATA_DataBoundSimplePersistable();
	    			$meta->owner_id = $user_id;
	    			$meta->entity_id = $pubPageVersion->get_entity_id();
	    			$meta->type_id = $priorityMetaId;

	    			$meta = array_pop($meta->produceSetFromPropertyMatches());
	    			if($meta)
	    			{
	    					$meta->data = DB_NULL;
	    					$meta->owner_id = SYSTEM_USER_ID;
	    					$meta->save();
	    			}
	    			//    Pub Page Version will need to be added to VERSIONED group
	    			self::setEntityInGroup($versionedGroup->get_keyValue(), $pubPageVersion->get_entity_id());


    		}
    		return $pubPageVersion;
  			// is entity already in a versioned group?
  			// $versionedGroup = self::verifyAndGetVersionedGroupForEntity($entity_id);
  			// is entity a draft (versioned group already exists)? Then clone entity

  			// $latestVersionedGroup = self::verifyAndGetVersionedMostRecentGroup();

  			// 		if so,
  			// 				identify member in most recent version group
  			// 				remove that member
  			// 		if not,
  			// 				make the most recent versioned group
  			// 		add this entity to the most recent versioned group
  			//
  			//
  			//


  			// check to see if entity is already in versioned group
  			// 		if so, return it
  			// 		if not, is entity a draft in a versioned_publisher group?
  			// 				if so,
  			// 				if not, create new

  			// How to determine newly published page?
  			// 		Page will be in a VERSIONED_PUBLISHER group already
  			// Newly published page
  			// 		Page will be cloned as Pub Page Version
  			// 		Pub Page Version will need to be added to VERSIONED_MOSTRECENT
  			// 		VERSIONED group will be created and Pub Page Version will be added
  			// 		Existing Draft Page will be removed from PERSONAL group
  			// 		Existing Draft Page will be added to VERSIONED group
  			// 		VERSIONED_PUBLISHER group will be created and Existing Draft Page will be added
  			// 		user will be added to VERSIONED_PUBLISHER group
  			// Draft publishing to existing version group
  			// 		Page will be cloned as Pub Page Version
  			// 		Old Pub Page must be identified as intersection of VERSIONED_MOSTRECENT and VERSIONED
  			// 		Old Pub Page will be removed from VERSIONED_MOSTRECENT
  			// 		Pub Page Version will need to be added to VERSIONED_MOSTRECENT
  			//
  			//
    }

    public static function removeExistingPublishedPage($versionedGroup_id, $versionedMostRecentGroup_id)
    {
    	$strategy = new TC_RepositoryDashboardContainerStrategy();
    	$repo = new Repository($strategy);
    	$getPar = new THOR_GetParameterCapsule(array(),
    	                                        array(/*'user_id' => SYSTEM_USER_ID,*/
    	                                        			'accessGroupID' => $versionedGroup_id/*,
    	                                        			'accessprofile' => new AccessProfile(ValidAccessProfiles::VOID_VOID,
    		                                                ValidAccessTypes::VOID,
    		                                                ValidAccessContexts::VOID,
    		                                                ValidAccessLevels::BASIC_ACCESS)*/),
    	                                        array(),
    	                                        array());
    	$versionedTabs = $repo->get($getPar);
    	$strategy = new TC_RepositoryDashboardContainerStrategy();
    	$repo = new Repository($strategy);
    	$getPar = new THOR_GetParameterCapsule(array(),
    	                                        array(/*'user_id' => SYSTEM_USER_ID,*/
    	                                        			'accessGroupID' => $versionedMostRecentGroup_id/*,
    	                                        			'accessprofile' => new TC_DefaultAccessProfile()*/),
    	                                        array(),
    	                                        array());
    	$versionedMostRecentTabs = $repo->get($getPar);

    	$getEntId = function($entity){
    		return $entity->get_entity_id();
    	};

    	$vtIds = array_map($getEntId, $versionedTabs);
    	$vmrtIds = array_map($getEntId, $versionedMostRecentTabs);
    	// var_dump($versionedTabs);
    	// var_dump($versionedMostRecentTabs);
    	$currentId = array_pop(array_intersect($vtIds, $vmrtIds) ? array_intersect($vtIds, $vmrtIds) : array());
    	if(isset($currentId))
    	{
    			self::setEntityInGroup($versionedMostRecentGroup_id, $currentId, 0);
    	}
    	return $currentId;

    }

    public static function subscribeToPage($entity_id, $user_id, $is_active = 1)
    {
    		$versionedReadGroup = self::verifyAndGetVersionedVersionReadGroup($user_id);
    		// must add logic to find existing version of page you might be subscribed to and update it
    		$versionGroup = self::verifyAndGetVersionedGroupForEntity($entity_id);

    		$userPageIds = self::getActiveContainerIDsForUser($user_id, null, $versionedReadGroup->get_keyValue());
    		$versionPageIds = self::getActiveContainerIDsForUser(SYSTEM_USER_ID, null, $versionGroup->get_keyValue());

    		$idIntersect = array_intersect($userPageIds, $versionPageIds);
    		// logError(var_export($idIntersect,true));
    		if(count($idIntersect) > 0) //UPDATE rather than INSERT
    		{
    			foreach($idIntersect as $id){
    				self::setEntityInGroup($versionedReadGroup->get_keyValue(), $id, 0);

    				$followerCount = count(self::getFollowers($id));
    				$metMan = new THOR_MetadataAndTaxonomyDatabaseManager();
    				$mettypes = $metMan->metadataTypeVerification(ValidMetadataTypes::NUMBER_OF_FOLLOWERS);
    				$metaTypeId = $mettypes->get_keyValue();

    				$meta = new THOR_METADATA_DataBoundSimplePersistable();
    				$meta->owner_id = SYSTEM_USER_ID;
    				$meta->entity_id = $id;
    				$meta->type_id = $metaTypeId;
    				$meta->title = ValidMetadataTypes::NUMBER_OF_FOLLOWERS;
    				if(!$meta->isPersistableAlreadyRecorded(false, true, array('created_date', 'last_edited', 'is_active', 'title', 'description', 'data')))
    				{
    					$meta->title = ValidMetadataTypes::NUMBER_OF_FOLLOWERS;
    					$meta->created_date = date('Y-m-d H:i:s');
    				}
    				$meta->is_active = 1;
    				$meta->data = $followerCount;
    				$meta->last_edited = date('Y-m-d H:i:s');
    				// logError(var_export($meta, true));
    				$meta->save();


    			}
    		}

    		// TODO: add metadata for follower
    		if($is_active == 1 || $is_active == 2)
    		{
    				$ids = self::getActiveContainerIDsForUser($user_id, null, $versionedReadGroup->get_keyValue());
    				if(count($ids) >= MAX_SUBSCRIBED_TABS_PER_USER)
    				{return false;}

    				self::setEntityInGroup($versionedReadGroup->get_keyValue(), $entity_id, 1);

    				$followerCount = count(self::getFollowers($entity_id));
    				$metMan = new THOR_MetadataAndTaxonomyDatabaseManager();
    				$mettypes = $metMan->metadataTypeVerification(ValidMetadataTypes::NUMBER_OF_FOLLOWERS);
    				$metaTypeId = $mettypes->get_keyValue();

    				$meta = new THOR_METADATA_DataBoundSimplePersistable();
    				$meta->owner_id = SYSTEM_USER_ID;
    				$meta->entity_id = $entity_id;
    				$meta->type_id = $metaTypeId;
    				if(!$meta->isPersistableAlreadyRecorded(false, true, array('created_date', 'last_edited', 'is_active', 'title', 'description', 'data')))
    				{
    					$meta->title = ValidMetadataTypes::NUMBER_OF_FOLLOWERS;
    					$meta->created_date = date('Y-m-d H:i:s');
    				}
    				$meta->is_active = 1;
    				$meta->data = $followerCount;
    				$meta->last_edited = date('Y-m-d H:i:s');
    				// logError(var_export($meta, true));

    				$meta->save();
    		}




    		return true;
    }


public static function getFollowers($entity_id){
	$uac = new THOR_UserAccessDatabaseManager();
	$accessprofileUnsub = new AccessProfile(ValidAccessProfiles::CATALOG_UNSUBSCRIBE, ValidAccessTypes::UNSUBSCRIBE, ValidAccessContexts::CATALOG, ValidAccessLevels::BASIC_ACCESS);

	$verGroup = self::verifyAndGetVersionedGroupForEntity($entity_id);
	return $uac->getAllUsersAssociatedWithEntitiesInGroup($accessprofileUnsub, $verGroup->get_keyValue());
}


    /*
    //used publically
    public static function getGlobalGroupID($user_id = null)
    {
        //$strat = new TC_RepositoryDashboardContainerStrategy();

        //$uac = new THOR_UserAccessDatabaseManager();

        //$accessgrouptype = $uac->accessGroupTypeVerification(ValidAccessGroupTypes::EVERYONE);
        //$accessgroup_id = false;

        $litmus = self::verifyAndGetGlobalGroup();
        $accessgroup = $litmus[0];
        if($litmus[1] === 1)
        {
            self::verifyUser(DEFAULT_GLOBAL_ADMIN);
            self::verifyUser(SYSTEM_USER_ID);

            self::setAccessForGroup(new TC_DefaultAccessProfile(), $accessgroup->get_keyValue());
            self::setAccessForGroup(new AccessProfile(ValidAccessProfiles::DASHBOARD_REORDER, ValidAccessTypes::REORDER, ValidAccessContexts::DASHBOARD, ValidAccessLevels::BASIC_ACCESS), $accessgroup_id);

            self::setUserInGroup($accessgroup_id, SYSTEM_USER_ID);
            self::setUserInGroup($accessgroup_id, DEFAULT_GLOBAL_ADMIN);

            self::setRightsForUserInGroup($accessgroup_id, DEFAULT_GLOBAL_ADMIN, new AccessProfile(ValidAccessProfiles::DASHBOARD_EDIT, ValidAccessTypes::EDIT, ValidAccessContexts::DASHBOARD, 1));



        }
        return $accessgroup;



        if($accessgroup_array[1] === 1)
        {

            TC_PersistenceUtility::verifyUser(DEFAULT_GLOBAL_ADMIN);
            TC_PersistenceUtility::verifyUser(SYSTEM_USER_ID);

            TC_PersistenceUtility::setAccessForGroup(new TC_DefaultAccessProfile(), $accessgroup_id);
            TC_PersistenceUtility::setAccessForGroup(new AccessProfile(ValidAccessProfiles::DASHBOARD_REORDER, ValidAccessTypes::REORDER, ValidAccessContexts::DASHBOARD, ValidAccessLevels::BASIC_ACCESS), $accessgroup_id);

            TC_PersistenceUtility::setUserInGroup($accessgroup_id, SYSTEM_USER_ID);
            TC_PersistenceUtility::setUserInGroup($accessgroup_id, DEFAULT_GLOBAL_ADMIN);

            TC_PersistenceUtility::setRightsForUserInGroup($accessgroup_id, DEFAULT_GLOBAL_ADMIN, new AccessProfile(ValidAccessProfiles::DASHBOARD_EDIT, ValidAccessTypes::EDIT, ValidAccessContexts::DASHBOARD, 1));


        }
        if(isset($user_id) && $user_id !== DEFAULT_GLOBAL_ADMIN && $user_id !== SYSTEM_USER_ID)
        {
            TC_PersistenceUtility::verifyUser($user_id);
            TC_PersistenceUtility::setUserInGroup($accessgroup_id, $user_id);
        }
        return $accessgroup_id;
    }
    */


    public static function getDashboardUpdates($params = array())
    {
  				$user_id = array_key_exists('user_id', $params) ? $params['user_id'] : null;
  	    	// $accessGroupID = array_key_exists('accessGroupID', $params) ? $params['accessGroupID'] : null;


  	    	// $accessprofile = new AccessProfile(ValidAccessProfiles::DASHBOARD_REORDER, ValidAccessTypes::REORDER, ValidAccessContexts::DASHBOARD, ValidAccessLevels::BASIC_ACCESS);
  	    	// $accessprofile2 = new AccessProfile(ValidAccessProfiles::DASHBOARD_EDIT, ValidAccessTypes::EDIT, ValidAccessContexts::DASHBOARD, ValidAccessLevels::BASIC_ACCESS);

  	    	// $accessprofileDelete = new AccessProfile(ValidAccessProfiles::DASHBOARD_DELETE, ValidAccessTypes::DELETE, ValidAccessContexts::DASHBOARD, ValidAccessLevels::BASIC_ACCESS);
  	    	$accessprofileUnsub = new AccessProfile(ValidAccessProfiles::DASHBOARD_UNSUBSCRIBE, ValidAccessTypes::UNSUBSCRIBE, ValidAccessContexts::DASHBOARD, ValidAccessLevels::BASIC_ACCESS);
  	    	// $accessprofilePub = new AccessProfile(ValidAccessProfiles::DASHBOARD_PUBLISH, ValidAccessTypes::PUBLISH, ValidAccessContexts::DASHBOARD, ValidAccessLevels::BASIC_ACCESS);
  	    	// $accessprofileRename = new AccessProfile(ValidAccessProfiles::DASHBOARD_RENAME, ValidAccessTypes::RENAME, ValidAccessContexts::DASHBOARD, ValidAccessLevels::BASIC_ACCESS);


  	    	// $containers = TC_Utility::getActiveContainersForUser($user_id, $accessprofile);
  	    	// $containers2 = TC_Utility::getActiveContainersForUser($user_id, $accessprofile2);


  	    	// $containersDelete = TC_Utility::getActiveContainersForUser($user_id, $accessprofileDelete);
  	    	// $containersPub = TC_Utility::getActiveContainersForUser($user_id, $accessprofilePub);
  	    	$containersUnsub = TC_Utility::getActiveContainersForUser($user_id, $accessprofileUnsub);
  	    	// $containersRename = TC_Utility::getActiveContainersForUser($user_id, $accessprofileRename);

  	    	// $oldPublishedPages = array();
  	    	// $correspondingNewPubPages = array();
  	    	$returnMe = array();
  	    	$accessprofileRead = new AccessProfile(ValidAccessProfiles::CATALOG_READ, ValidAccessTypes::VIEW, ValidAccessContexts::CATALOG, ValidAccessLevels::BASIC_ACCESS);
  	    	$containersMostRecentPublished = self::getPublishedPagesForCatalog(array('accessprofile' => $accessprofileRead));
  	    	$getIds = function($ent){
  	    		return $ent->get_entity_id();
  	    	};
  	    	// logError(var_export(array_map($getIds, $containersMostRecentPublished), true));
  	    	// logError(var_export(array_map($getIds, $containersUnsub), true));
  	    	foreach($containersUnsub as $unsub)
  	    	{
  	    			if(!getEntityFromRepoPool($unsub->get_entity_id(), $containersMostRecentPublished, 'get_entity_id'))
  	    			{
  	    				// $oldPublishedPages[$unsub->get_entity_id()] = $unsub;
  	    				$versionGroup = self::verifyAndGetVersionedGroupForEntity($unsub->get_entity_id());
  	    				$versionPages = self::getActiveContainersForUser(SYSTEM_USER_ID, null, $versionGroup->get_keyValue());


  	    				// $mostRecentPubPage = getEntityFromRepoPool($verPageId, $containersMostRecentPublished, 'get_entity_id');
  	    				$mostRecentPubPage = false;
  	    				foreach($versionPages as $verPages)
  	    				{
  	    						if($mostRecentPubPage = getEntityFromRepoPool($verPages->get_entity_id(), $containersMostRecentPublished, 'get_entity_id'))
  	    						{
  	    							break;
  	    						}
  	    				}
  	    				$returnMe[$unsub->get_entity_id()] = array('old_page' => $unsub, 'new_page' => $mostRecentPubPage);

  	    			}
  	    	}

  	    	return $returnMe;

  	    	// foreach($oldPublishedPages as $oldPage)
  	    	// {
  	    	// 		$versionGroup = self::verifyAndGetVersionedGroupForEntity($oldPage->get_entity_id());
  	    	// 		$versionPageIds = self::getActiveContainerIDsForUser(SYSTEM_USER_ID, null, $versionGroup->get_keyValue());
  	    	// 		foreach($versionPageIds as $verPageId)
  	    	// 		{
  	    	// 				$mostRecentPubPage = getEntityFromRepoPool($verPageId, $containersMostRecentPublished, 'get_entity_id');
  	    	// 		}

  	    	// }
  	    	// return $oldPublishedPages;

    }

    public static function getCatalogPagesDataArray($params = array())
    {

  				$user_id = array_key_exists('user_id', $params) ? $params['user_id'] : null;
  				$entity_id = array_key_exists('entity_id', $params) ? $params['entity_id'] : null;
  	    	$tag_ids = array_key_exists('tag_ids', $params) ? $params['tag_ids'] : null;
  	    	$pageNum = array_key_exists('pageNum', $params) ? $params['pageNum'] : null;
  	    	$isPaged = array_key_exists('isPaged', $params) ? $params['isPaged'] : null;
  	    	$searchTerm = array_key_exists('searchTerm', $params) ? $params['searchTerm'] : null;
  	    	$orderBy = array_key_exists('orderBy', $params) ? $params['orderBy'] : null;
  	    	$accessprofile = array_key_exists('accessprofile', $params) ? $params['accessprofile'] : null;
  	    	$accessGroupID = array_key_exists('accessGroupID', $params) ? $params['accessGroupID'] : null;

    			if(!isset($user_id))
    	    {
    	        $user_id_array = TC_Authenticator::getUserIDAndInitialize();
    	        $user_id = $user_id_array[0];

    	    }
    			if(isset($user_id) && $user_id == SYSTEM_USER_ID)
    	    {
    	        throw new Exception("Cannot edit without Corridor authentication");
    	        return;
    	    }


  	    	$accessprofileRead = new AccessProfile(ValidAccessProfiles::CATALOG_READ, ValidAccessTypes::VIEW, ValidAccessContexts::CATALOG, ValidAccessLevels::BASIC_ACCESS);
  	    	$accessprofileUnsub = new AccessProfile(ValidAccessProfiles::CATALOG_UNSUBSCRIBE, ValidAccessTypes::UNSUBSCRIBE, ValidAccessContexts::CATALOG, ValidAccessLevels::BASIC_ACCESS);

  	    	$containersRead = self::getPublishedPagesForCatalog(array(
  																																			'user_id' => $user_id,
  																																			'entity_id' => $entity_id,
  																																			'tag_ids' => $tag_ids,
  																																			'pageNum' => $pageNum,
  																																			'isPaged' => $isPaged,
  																																			'searchTerm' => $searchTerm,
  																																			'orderBy' => $orderBy,
  																																			'accessprofile' => $accessprofileRead,
  																																			'accessGroupID' => $accessGroupID

  																																				));

  	    	$containersUnsub = self::getPublishedPagesForCatalog(array(
  																																			'user_id' => $user_id,
  																																			'entity_id' => $entity_id,
  																																			'tag_ids' => $tag_ids,
  																																			'pageNum' => $pageNum,
  																																			'isPaged' => false,
  																																			'searchTerm' => $searchTerm,
  																																			'orderBy' => $orderBy,
  																																			'accessprofile' => $accessprofileUnsub,
  																																			'accessGroupID' => $accessGroupID

  																																				));
  	    	// $versionedMostRecent = self::verifyAndGetVersionedMostRecentGroup();

  	    	// $mostRecentPages = self::getPublishedPagesForCatalog(array(
  						// 																													'user_id' => SYSTEM_USER_ID,
  						// 																													'isPaged' => false,
  						// 																													'accessGroupID' => $versionedMostRecent->get_keyValue()

  						// 																														));

  	    	$containersUpdate = array();


  	    	foreach($containersUnsub as $unsubPage)
  	    	{
  	    		if(!getEntityFromRepoPool($unsubPage->get_entity_id(), $containersRead, 'get_entity_id'))
  	    		{
  	    			$versionedGroup = self::verifyAndGetVersionedGroupForEntity($unsubPage->get_entity_id());
  	    			$versionedPages = self::getActiveContainersForUser(SYSTEM_USER_ID, null, $versionedGroup->get_keyValue());
  	    			foreach($versionedPages as $verPage)
  	    			{
  	    				if(getEntityFromRepoPool($verPage->get_entity_id(), $containersRead, 'get_entity_id') && $verPage->get_entity_id() != $unsubPage->get_entity_id())
  	    				{
  	    					$containersUpdate[$verPage->get_entity_id()] = $verPage;
  	    				}

  	    			}
  	    		}
  	    	}

  	    	// $versionedReadGroup = self::verifyAndGetVersionedVersionReadGroup($user_id);
  	    	// // must add logic to find existing version of page you might be subscribed to and update it

  	    	// $userPages = self::getActiveContainersForUser($user_id, null, $versionedReadGroup->get_keyValue());
  	    	// foreach($userPages as $page)
  	    	// {
  	    	// 	$versionedGroup = self::verifyAndGetVersionedGroupForEntity($page->get_entity_id());
  	    	// 	$versionedPages = self::getActiveContainersForUser(SYSTEM_USER_ID, null, $versionedGroup->get_keyValue());

  	    	// 	foreach($versionedPages as $verPage)
  	    	// 	{
  	    	// 		if(getEntityFromRepoPool($verPage->get_entity_id(), $containersRead, 'get_entity_id') && $verPage->get_entity_id() != $page->get_entity_id())
  	    	// 		{
  	    	// 			$containersUpdate[$verPage->get_entity_id()] = $verPage;
  	    	// 		}

  	    	// 	}




  	    	// 	// if(!getEntityFromRepoPool($page->get_entity_id(), $containersRead, 'get_entity_id'))
  	    	// 	// {
  	    	// 	// 	foreach($versionedPages as $verPage)
  	    	// 	// 	{
  	    	// 	// 		if(getEntityFromRepoPool($verPage->get_entity_id(), $containersRead, 'get_entity_id'))
  	    	// 	// 		{
  	    	// 	// 			$containersUpdate[$verPage->get_entity_id()] = $verPage;
  	    	// 	// 		}

  	    	// 	// 	}


  	    	// 	// 	// $pageIdToPush = getEntityFromRepoPool($page->get_entity_id(), $containersRead, 'get_entity_id')
  	    	// 	// 	// logError($page->get_entity_id());
  	    	// 	// 	// $containersUpdate[$page->get_entity_id()] = $page;
  	    	// 	// }


  	    	// }




  	    	$results = self::getCatalogPageCount(array(
  																																			'user_id' => $user_id,
  																																			'entity_id' => $entity_id,
  																																			'tag_ids' => $tag_ids,
  																																			'pageNum' => $pageNum,
  																																			'isPaged' => $isPaged,
  																																			'searchTerm' => $searchTerm,
  																																			'orderBy' => $orderBy,
  																																			'accessprofile' => $accessprofileRead,
  																																			'accessGroupID' => $accessGroupID

  																																				));



  	    	$pageCount = $results ? ceil($results / CATALOG_PAGE_SIZE) : 1;
  	    	// $pageCount = !($pageCount % CATALOG_PAGE_SIZE) &&  $pageCount ? $pageCount / CATALOG_PAGE_SIZE : $pageCount / CATALOG_PAGE_SIZE + 1;

  	    	// $pagesWithUpdates =

  	  		$json_url = SITE_DOMAIN . '/' . CORRIDOR_TAG_API_URL;
  	  		$data = file_get_contents($json_url);
  	  		// $data = json_decode($json);
  	  		// var_dump($data);

  	  		return array('user_id' =>$user_id,
  	  		            'entity_id' => $entity_id,
  	  		            'tag_ids' => $tag_ids,
  	  		            'pageNum' => $pageNum ? $pageNum : 1,
  	  		            'isPaged' => $isPaged ? $isPaged : true,
  	  		            'pageCount' => $pageCount,
  	  		            'results' => $results,
  	  		            // 'mostRecentPages' => $mostRecentPages,

  	  		            'searchTerm' => $searchTerm,
  	  		            'orderBy' => $orderBy ? $orderBy : ValidCatalogOrderTypes::RECENCY,
  	  		            'entity_read_set' => $containersRead,
  	  		            'entity_unsub_set' => $containersUnsub,
  	  		            'entity_update_set' => $containersUpdate,
  	  		            'tags' => $data

  	    							);





    }



    public static function initializeDefaultPersonalPageForUser($user_id, $accessgroup_id)
    {
        self::createPageForUser($user_id,
                                array($accessgroup_id => 1),
                                'My Page',
                                'Pre-seeded personal Page',
                                ValidDashboardTabViews::STANDARD);
        //TC_PersistenceUtility::createPageForUser($user_id, $accessgroup_id, 'My Page', 'Pre-seeded personal Page', ValidDashboardTabViews::STANDARD);


    }


    public function initializeGroups($forceAccessCheck = false)
    {

        $returnMe = array();

        $global = self::verifyAndGetGlobalGroup(null, $forceAccessCheck);
        $globalAdmin = self::verifyAndGetGlobalAdminGroup(null, $forceAccessCheck);
        $versionedMostRecent = self::verifyAndGetVersionedMostRecentGroup(null, $forceAccessCheck);
        $nobody = self::verifyAndGetSystemGroup($forceAccessCheck);

        $returnMe[ValidAccessGroupTypes::NOBODY] = $nobody;
        $returnMe[ValidAccessGroupTypes::EVERYONE] = $global;
        $returnMe[ValidAccessGroupTypes::VERSIONED_MOSTRECENT] = $versionedMostRecent;
        $returnMe[ValidAccessGroupTypes::GLOBAL_ADMIN] = $globalAdmin;


        return $returnMe;

    }



    public static function initializeTheCurrent()
    {
        //return false;
        $groups = self::initializeGroups();
        $universalGroupID = $groups[ValidAccessGroupTypes::EVERYONE]->get_keyValue();
        $universalAdminGroupID = $groups[ValidAccessGroupTypes::GLOBAL_ADMIN]->get_keyValue();
        //first remove all prior defaults, this will be like a reset
        $strat = new TC_RepositoryDashboardContainerStrategy();
        $repo = new Repository($strat);

        // $getParam = new THOR_GetParameterCapsule(array(), array('user_id'=> SYSTEM_USER_ID, 'accessprofile' => new TC_DefaultAccessProfile()), array(), array());
        // //self::verifyUser(SYSTEM_USER_ID);

        // $defaults = $repo->get($getParam);

        // foreach($defaults as $key => $value)
        // {

        //     //$value instanceof TC_DashboardTab_Entity;
        //     $value->set_is_active(false);

        // }

        // $setParam = new THOR_SetParameterCapsule(null, array('user_id' => SYSTEM_USER_ID), array());
        // $repo->save($setParam);
        //$strat = new TC_RepositoryStrategy();
        //$universalGroupID = TC_Utility::verifyAndGetGlobalGroup();
        //TC_PersistenceUtility::getGlobalGroupID(SYSTEM_USER_ID);



        $statefeedstab = new TC_DashboardTab('State Sources', 'Global State Feeds Tab', ValidDashboardTabViews::STANDARD);
        $statefeeds = new TC_DashboardTab_EntityModel(null, null, $statefeedstab, 1, date('Y-m-d H:i:s'), date('Y-m-d H:i:s'), SYSTEM_USER_ID, 1);
        $repo->loadEntity($statefeeds);

        $externalfeedstab = new TC_DashboardTab('News Sources', 'Global External Feeds Tab', ValidDashboardTabViews::STANDARD);
        $externalfeeds = new TC_DashboardTab_EntityModel(null, null, $externalfeedstab, 1, date('Y-m-d H:i:s'), date('Y-m-d H:i:s'), SYSTEM_USER_ID, 2);
        $repo->loadEntity($externalfeeds);

        $smfeedstab = new TC_DashboardTab('Social Media', 'Global Social Media Feeds Tab', ValidDashboardTabViews::STANDARD);
        $smfeeds = new TC_DashboardTab_EntityModel(null, null, $smfeedstab, 1, date('Y-m-d H:i:s'), date('Y-m-d H:i:s'), SYSTEM_USER_ID, 3);
        $repo->loadEntity($smfeeds);

        $pilotfeedstab = new TC_DashboardTab('The Current', 'Global The Current Feeds Tab', ValidDashboardTabViews::STANDARD);
        $pilotfeeds = new TC_DashboardTab_EntityModel(null, null, $pilotfeedstab, 1, date('Y-m-d H:i:s'), date('Y-m-d H:i:s'), SYSTEM_USER_ID, 4);
        $repo->loadEntity($pilotfeeds);

        $setParam = new THOR_SetParameterCapsule(null, array('user_id' => SYSTEM_USER_ID, 'accessGroup_IDs' => array($universalGroupID => 1, $universalAdminGroupID => 1)), array());
        $tabs1 = $repo->save($setParam);
        // var_dump($tabs1);
        $tabs = array();
        foreach($tabs1 as $ent)
        {
            $tabs[] = $ent->get_item()->get_entity_id();
        }

        $widStrat = new TC_RepositoryDashboardSourceStrategy();
        $repo->set_strategy($widStrat);


        //$source = new TC_BlankSource('ALDACS', 'ALDACS', 'SSALDACS_Default');
        //$sourceEntity = new TC_DashboardSource_EntityModel(null, null, $source, 1, date('Y-m-d H:i:s'), date('Y-m-d H:i:s'), SYSTEM_USER_ID, 1);
        //$repo->loadEntity($sourceEntity);

        $source = new TC_GenericRSSSource('Department Notices', 'Department Notices', 'JSServerDiverted_Default', 'http://mmsweb.a.state.gov/GpsWeb/RSS/TodaysNotices.aspx');
        $sourceEntity = new TC_DashboardSource_EntityModel(null, null, $source, 1, date('Y-m-d H:i:s'), date('Y-m-d H:i:s'), SYSTEM_USER_ID, 4);
        $repo->loadEntity($sourceEntity);

        $source = new TC_GenericRSSSource('Press Briefings', 'Press Briefings', 'JSServerDiverted_Default', 'http://www.state.gov/rss/channels/brief.xml');
        $sourceEntity = new TC_DashboardSource_EntityModel(null, null, $source, 1, date('Y-m-d H:i:s'), date('Y-m-d H:i:s'), SYSTEM_USER_ID, 5);
        $repo->loadEntity($sourceEntity);

        $source = new TC_GenericRSSSource('Press Releases', 'Press Releases', 'JSGoogleRSS_Default', 'http://www.state.gov/rss/channels/press.xml');
        $sourceEntity = new TC_DashboardSource_EntityModel(null, null, $source, 1, date('Y-m-d H:i:s'), date('Y-m-d H:i:s'), SYSTEM_USER_ID, 6);
        $repo->loadEntity($sourceEntity);

        $source = new TC_GenericRSSSource('Department Announcements', 'Department Announcements', 'JSServerDiverted_Default', 'http://mmsweb.a.state.gov/GpsWeb/RSS/TodaysAnnouncements.aspx');
        $sourceEntity = new TC_DashboardSource_EntityModel(null, null, $source, 1, date('Y-m-d H:i:s'), date('Y-m-d H:i:s'), SYSTEM_USER_ID, 7);
        $repo->loadEntity($sourceEntity);

        $source = new TC_MergedRSSSource('Communities @ State Global', 'Communities @ State Global', 'JSServerDiverted_CAS', 'link1=http://wordpress.state.gov/?wpmu-feed$$$full-feed&link2=http://cas.state.gov/?wpmu-feed$$$full-feed');
        $sourceEntity = new TC_DashboardSource_EntityModel(null, null, $source, 1, date('Y-m-d H:i:s'), date('Y-m-d H:i:s'), SYSTEM_USER_ID, 8);
        $repo->loadEntity($sourceEntity);

        $setParam = new THOR_SetParameterCapsule(null, array('container_id' => $tabs[0]), array());
        $repo->save($setParam);


        $source = new TC_GoogleRSSSource('Google News', 'Google News', 'JSGoogleNews_Default', 'news', '');
        $sourceEntity = new TC_DashboardSource_EntityModel(null, null, $source, 1, date('Y-m-d H:i:s'), date('Y-m-d H:i:s'), SYSTEM_USER_ID, 4);
        $repo->loadEntity($sourceEntity);

        $source = new TC_GenericRSSSource('AP - World News', 'AP - World News', 'JSGoogleRSS_Default', 'http://hosted.ap.org/lineups/WORLDHEADS-rss_2.0.xml?SITE=WVEC&SECTION=HOME');
        $sourceEntity = new TC_DashboardSource_EntityModel(null, null, $source, 1, date('Y-m-d H:i:s'), date('Y-m-d H:i:s'), SYSTEM_USER_ID, 5);
        $repo->loadEntity($sourceEntity);

        $source = new TC_GenericRSSSource('Washington Post - World', 'Washington Post - World', 'JSGoogleRSS_Default', 'http://feeds.washingtonpost.com/rss/world');
        $sourceEntity = new TC_DashboardSource_EntityModel(null, null, $source, 1, date('Y-m-d H:i:s'), date('Y-m-d H:i:s'), SYSTEM_USER_ID, 6);
        $repo->loadEntity($sourceEntity);

        $setParam = new THOR_SetParameterCapsule(null, array('container_id' => $tabs[1]), array());
        $repo->save($setParam);



        $source = new TC_GenericRSSSource('Flickr - DoS Channel', 'Flickr - DoS Channel', 'JSGoogleRSS_Default', 'http://api.flickr.com/services/feeds/photos_public.gne?lang=en-us&format=rss2&id=9364837@N06');
        $sourceEntity = new TC_DashboardSource_EntityModel(null, null, $source, 1, date('Y-m-d H:i:s'), date('Y-m-d H:i:s'), SYSTEM_USER_ID, 4);
        $repo->loadEntity($sourceEntity);

        $source = new TC_GenericRSSSource('State Youtube Channel', 'State Youtube Channel', 'JSGoogleRSS_Default', 'https://gdata.youtube.com/feeds/api/users/statevideo/uploads?alt=rss');
        $sourceEntity = new TC_DashboardSource_EntityModel(null, null, $source, 1, date('Y-m-d H:i:s'), date('Y-m-d H:i:s'), SYSTEM_USER_ID, 5);
        $repo->loadEntity($sourceEntity);

        $source = new TC_GenericRSSSource('Dipnote', 'Dipnote', 'JSGoogleRSS_Default', 'http://feeds.feedburner.com/dipnote');
        $sourceEntity = new TC_DashboardSource_EntityModel(null, null, $source, 1, date('Y-m-d H:i:s'), date('Y-m-d H:i:s'), SYSTEM_USER_ID, 6);
        $repo->loadEntity($sourceEntity);

        $setParam = new THOR_SetParameterCapsule(null, array('container_id' => $tabs[2]), array());
        $repo->save($setParam);



        $source = new TC_GenericRSSSource('The Current Discussion', 'The Current Discussion', 'JSServerDiverted_CAS', SITE_DOMAIN .'/'. DISCUSSION_PAGE_FOLDER. '/' . '?feed=rss2');
        $sourceEntity = new TC_DashboardSource_EntityModel(null, null, $source, 1, date('Y-m-d H:i:s'), date('Y-m-d H:i:s'), SYSTEM_USER_ID, 4);
        $repo->loadEntity($sourceEntity);

        $source = new TC_GenericRSSSource('The Current Buzz', 'The Current Buzz', 'JSServerDiverted_CAS', 'http://cas.state.gov/thecurrentbuzz/feed/');
        $sourceEntity = new TC_DashboardSource_EntityModel(null, null, $source, 1, date('Y-m-d H:i:s'), date('Y-m-d H:i:s'), SYSTEM_USER_ID, 5);
        $repo->loadEntity($sourceEntity);

        $source = new TC_GenericRSSSource('The Current Buzz', 'The Current - Feedback', 'JSServerDiverted_CAS', 'http://cas.state.gov/thecurrentbuzz/feedback/feed/');
        $sourceEntity = new TC_DashboardSource_EntityModel(null, null, $source, 1, date('Y-m-d H:i:s'), date('Y-m-d H:i:s'), SYSTEM_USER_ID, 6);
        $repo->loadEntity($sourceEntity);


        $setParam = new THOR_SetParameterCapsule(null, array('container_id' => $tabs[3]), array());
        $repo->save($setParam);

        //$strat = new TC_DashboardSourceRepoStrategy();
        //$repo->set_strategy($strategy);

        //SidebarGrabber::getExternalSidebarWidgets();

    }

    public static function initializeNewUser($user_id, $email = null, $login = null, $name = null)
    {
        $returnMe = false;

        //are you new here? No need to initialize otherwise
        if(self::verifyUser($user_id, $email, $login, $name) !== 0)
        {
            if($user_id != SYSTEM_USER_ID)
            {
                $returnMe = self::forceInitializeNewUser($user_id);
                // echo $returnMe->get_keyValue();
                self::initializeDefaultPersonalPageForUser($user_id, $returnMe->get_keyValue());
                // self::verifyAndGetGlobalGroup($user_id);
                // self::verifyAndGetVersionedMostRecentGroup($user_id);
                // $accessgroup = self::verifyAndGetPersonalGroup($user_id);
                // $returnMe = $accessgroup;
            }
            else
            {
                //self::initializeTheCurrent();
                // return false;
                // self::verifyAndGetVersionedMostRecentGroup();
                $accessgroup = self::verifyAndGetGlobalGroup();
                $returnMe = $accessgroup;
            }
        }
        else
        {
            if($user_id != SYSTEM_USER_ID)
            {
            		//self::verifyAndGetVersionedVersionReadGroup($user_id);
                $accessgroup = self::verifyAndGetPersonalGroup($user_id);
                $returnMe = $accessgroup;
            }
            else
            {
                $accessgroup = self::verifyAndGetGlobalGroup();
                $returnMe = $accessgroup;
            }
        }

        return $returnMe;
    }

    public static function forceInitializeNewUser($user_id, $forceAccessCheck = false)
    {
        if($user_id !== SYSTEM_USER_ID)
        {
            self::verifyAndGetGlobalGroup($user_id, $forceAccessCheck);
            self::verifyAndGetVersionedMostRecentGroup($user_id, $forceAccessCheck);
            self::verifyAndGetVersionedVersionReadGroup($user_id, $forceAccessCheck);
            self::verifyAndGetPersonalPublishedGroup($user_id, $forceAccessCheck);
            $accessgroup = self::verifyAndGetPersonalGroup($user_id, $forceAccessCheck);
            return $accessgroup;
        }
        return false;
    }



    /*
    public static function fixPagePriority($user_id,
                                            //$entitytype,
                                            //$metadatatype,
                                            //$entitiesEncounteredKeys,
                                            //$UAC_Filter,
                                            //$loadedContainersDV = null,
                                            $dataSource = null)
    {

        if(!isset($dataSource))
        {
            $dataSource = MySQLConfig::dsConnect();
        }
        $container_manager = new TC_THOR_ContainerDatabaseManager($dataSource);
        $uac_manager = new THOR_UserAccessDatabaseManager($dataSource);

        $containersDV = $container_manager->get_containersMasterQuery();

        $friendlies = $container_manager->get_containersMasterQuery()->get_friendlyNames();
        $persistables = $container_manager->get_containersMasterQuery()->get_persistableInputCollection();

        $entitytype = $container_manager->entityTypeVerification(ValidEntityTypes::TAB);
        $metadatatype = $container_manager->metadataTypeVerification(ValidMetadataTypes::DASHBOARD_PRIORITY);
        // UAC Stuff

        $entitiesEncounteredKeys = $uac_manager->getUACEntitiesFromGroupRightsIDs($user_id, new TC_DefaultAccessProfile(), $entitytype->get_keyValue());
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

        //$entitiesEncounteredKeys = array_keys($entitiesEncountered);
        //$entitiesEncounteredKeys = array_combine($entitiesEncounteredKeys, $entitiesEncounteredKeys);

        //return $UAC_Filter;

        $persistables[$friendlies['ENTITYTYPES']]->type = $entitytype->type;
        $persistables[$friendlies['METADATATYPES']]->type = $metadatatype->type;
        $persistables[$friendlies['METADATA']]->owner_id = $user_id;

        $containersDV->generateSQL(array(),
                                array($containersDV->encodeColumnForSQL($persistables[$friendlies['METADATA']], 'data') => 'ASC'
                                ),
                                null,
                                $UAC_Filter);


        $priorArr = array();
        $entitiesWithCurrentUserMetadata = array();

        $containersDV->execute();
        while($row = $containersDV->readObjectRow())
        {
            $priorArr[$row[$friendlies['METADATA']]->get_keyValue()] = $row[$friendlies['METADATA']];
            $entitiesWithCurrentUserMetadata[$row[$friendlies['ENTITIES']]->get_keyValue()] = $row[$friendlies['ENTITIES']]->get_keyValue();
        }

        $entitiesMissingCurrentUserMetadata = array_diff_assoc($entitiesEncounteredKeys, $entitiesWithCurrentUserMetadata);

        $priorArrDupe = $priorArr;

        $priorPriority = 0;
        $maxPriority = 0;
        foreach($priorArrDupe as $key => $value)
        {
            if($value->data != 1 + $priorPriority)
            {
                $value->data = 1 + $priorPriority;
            }
            $priorPriority++;
            $maxPriority = $value->data;
            $value->save();
        }
        foreach($entitiesMissingCurrentUserMetadata as $value)
        {
            //echo 'hi';
            $priorityMetadata = new THOR_METADATA_DataBoundSimplePersistable();
            $priorityMetadata->data = $maxPriority + 1;
            $priorityMetadata->entity_id = $value;
            $priorityMetadata->owner_id = $user_id;
            $priorityMetadata->created_date = date('Y-m-d H:i:s');
            $priorityMetadata->last_edited = date('Y-m-d H:i:s');
            $priorityMetadata->is_active = 1;
            $priorityMetadata->type_id = $metadatatype->get_keyValue();
            $priorityMetadata->title = ValidMetadataTypes::DASHBOARD_PRIORITY;

            $priorityMetadata->save();
            $maxPriority++;
            //$value->data =
        }
        return $maxPriority;




    }


    public static function swapPagePriority($user_id,
                                    $metadatarow_id,
                                    $newPriority,
                                    //$metadatatype,
                                    //$entitytype,
                                    //$condition,
                                    $dataSource = null)
    {

        if(!isset($dataSource))
        {
            $dataSource = MySQLConfig::dsConnect();
        }
        $container_manager = new TC_THOR_ContainerDatabaseManager($dataSource);
        $uac_manager = new THOR_UserAccessDatabaseManager($dataSource);

        $containersDV = $container_manager->get_containersMasterQuery();

        $friendlies = $container_manager->get_containersMasterQuery()->get_friendlyNames();
        $persistables = $container_manager->get_containersMasterQuery()->get_persistableInputCollection();

        $entitytype = $container_manager->entityTypeVerification(ValidEntityTypes::TAB);
        $metadatatype = $container_manager->metadataTypeVerification(ValidMetadataTypes::DASHBOARD_PRIORITY);


        $entitiesEncounteredKeys = $uac_manager->getUACEntitiesFromGroupRightsIDs($user_id, new TC_DefaultAccessProfile(), $entitytype->get_keyValue());
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



        $persistables[$friendlies['ENTITYTYPES']]->type = $entitytype->type;
        $persistables[$friendlies['METADATATYPES']]->type = $metadatatype->type;
        $persistables[$friendlies['METADATA']]->owner_id = $user_id;


        $containersDV->generateSQL(array(),
                                    array($containersDV->encodeColumnForSQL($persistables[$friendlies['METADATA']], 'data') => 'ASC'
                                    ),
                                    null,
                                    $UAC_Filter);

        $priorArr = array();
        $priorArrPriorities = array();

        $containersDV->execute();
        while($row = $containersDV->readObjectRow())
        {
            $priorArr[$row[$friendlies['METADATA']]->get_keyValue()] = $row[$friendlies['METADATA']];
            $priorArrPriorities[$row[$friendlies['METADATA']]->get_keyValue()] = $row[$friendlies['METADATA']]->data;
        }

        $priorArrDupe = $priorArr;
        $priorArrPrioritiesDupe = $priorArrPriorities;

        if(array_diff_assoc($priorArrPriorities, array_unique($priorArrPriorities)))
        {
            throw new Exception("must fix array first!");
        }
        $oldPriority = 1;
        if(!empty($priorArrPrioritiesDupe))
        {
            $oldPriority = $priorArrPrioritiesDupe[$metadatarow_id];
        }

        if($oldPriority == $newPriority)
        {
            return true;
        }
        if($oldPriority > $newPriority)
        {
            foreach($priorArrPrioritiesDupe as $key => $value)
            {
                if($value >= $newPriority && $value < $oldPriority && $key != $metadatarow_id)
                {
                    $priorArrPrioritiesDupe[$key] = $value + 1;
                }
            }
        }
        elseif($oldPriority < $newPriority)
        {
            foreach($priorArrPrioritiesDupe as $key => $value)
            {
                if($value <= $newPriority && $value > $oldPriority && $key != $metadatarow_id)
                {
                    $priorArrPrioritiesDupe[$key] = $value - 1;
                }
            }
        }

        $arrToUpdate = array_diff_assoc($priorArrPrioritiesDupe, $priorArrPriorities);
        if($arrToUpdate)
        {
            foreach($arrToUpdate AS $key => $value)
            {
                $priorArrDupe[$key]->data = $value;
                $priorArrDupe[$key]->last_edited = date('Y-m-d H:i:s');
                $priorArrDupe[$key]->save();
                //$this->updateMetadata($key, null, null, $value, null);

            }
        }
        $priorArrDupe[$metadatarow_id]->data = $newPriority;
        $priorArrDupe[$metadatarow_id]->last_edited = date('Y-m-d H:i:s');
        $priorArrDupe[$metadatarow_id]->save();

        //$this->updateMetadata($metadatarow_id, null, null, $newPriority, null);

        return true;


    }
    */



}

?>
