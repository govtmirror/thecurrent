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
class TC_THOR_GetContainersForUserDashboardView_GetRepo extends GetStrategy{

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

    public function get(IGetParameterModel $param) {

        $params = $param->get_parameters();
        $options = $param->get_options();
        //expected params
        // - user_id
        // - accessprofile

        //TODO: make these enums
        if(array_key_exists('user_id', $params))
        {
            $user_id = $params['user_id'];
        }
        else
        {
            $user_id = SYSTEM_USER_ID;
            $params['user_id'] = $user_id;
        }

        if(array_key_exists('accessprofile', $params))
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

        if(array_key_exists('overrideUAC', $options))
        {
            $overrideUAC = $options['overrideUAC'];
        }
        else
        {
            $overrideUAC = false;
        }
        if(array_key_exists('entity_id', $params))
        {
            $entity_id = $params['entity_id'];
        }
        else
        {
            $entity_id = null;
            //$user_id = SYSTEM_USER_ID;
        }
        //expect access group parameter option
        //get user access groups
        //


        $containersDV = $this->get_container_manager()->get_containersMasterQuery();

        $friendlies = $this->get_container_manager()->get_containersMasterQuery()->get_friendlyNames();
        $persistables = $this->get_container_manager()->get_containersMasterQuery()->get_persistableInputCollection();

        $entitytype = $this->get_container_manager()->entityTypeVerification(ValidEntityTypes::TAB);
        $metadatatype = $this->get_container_manager()->metadataTypeVerification(ValidMetadataTypes::DASHBOARD_PRIORITY);

        if(!$entity_id)
        {
            $condition = new QueryConditionComparison(ValidSQLComparisonOperations::EQUALS, 1, 1);
        }
        else
        {
            $condition = new QueryConditionComparison(ValidSQLComparisonOperations::EQUALS,
                                                    new QueryFreeFormConstant(DB_NAME."."."ENTITIES".".".$persistables[$friendlies['ENTITIES']]->get_keyName()),
                                                    new QueryFreeFormConstant($entity_id));
        }

        if(!$overrideUAC)
        {
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
            $persistables[$friendlies['METADATA']]->owner_id = $user_id;

            $this->fixPriority($user_id);
        }


        $persistables[$friendlies['METADATATYPES']]->type = $metadatatype->type;
        $persistables[$friendlies['ENTITYTYPES']]->type = $entitytype->type;




        $containersDV->generateSQL(array(),
                                    array($containersDV->encodeColumnForSQL($persistables[$friendlies['METADATA']], 'data') =>
                                        array('direction' => 'ASC', 'cast_type' => 'unsigned')
                                    ),
                                    null,
                                    $condition);
        // if(!isset($accessprofile)){
        // 		echo $containersDV->get_generatedSQL();
        // }

        // echo $containersDV->get_generatedSQL();
        //return;
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

        $containersDV->execute();
        while($row = $containersDV->read())
        {

            if(!in_array($row->$entity_id_key, $containerIDs))// && array_key_exists($row->entities_x_id, $uac_verified_entities) === true)
            {


                $entity = new TC_DashboardTab_EntityModel($row->$entity_id_key,
                                                        $row->$container_id_key,
                                                        null,
                                                        1,
                                                        $row->$entity_created_date_key,
                                                        $row->$entity_last_edited_key,
                                                        $row->$entity_owner_id_key,
                                                        $row->$metadata_data_key,
                                                        $row->$metadata_id_key);

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

            }
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


            }
        }
        foreach($containerObjects as $object)
        {
            $object->set_priorVersion(clone $object);

        }
        $param->set_outputCollection($containerObjects);
        $param->set_outputReferenceIDs($containerIDs);
        return $param;


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




    public function fixPriority($user_id)
    {
        $containersDV = $this->get_container_manager()->get_containersMasterQuery();

        $friendlies = $this->get_container_manager()->get_containersMasterQuery()->get_friendlyNames();
        $persistables = $this->get_container_manager()->get_containersMasterQuery()->get_persistableInputCollection();


        $entitytype = $this->get_container_manager()->entityTypeVerification(ValidEntityTypes::TAB);
        // UAC Stuff

        $entitiesEncounteredKeys = $this->get_uac_manager()->getUACEntitiesFromGroupRightsIDs($user_id, new TC_DefaultAccessProfile(), $entitytype->get_keyValue());
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

        //$persistables[$friendlies['ENTITYTYPES']]->type = $entitytype->type;

        $metadatatype = $this->get_container_manager()->metadataTypeVerification(ValidMetadataTypes::DASHBOARD_PRIORITY);






        //$entitytype = $this->get_container_manager()->entityTypeVerification(ValidEntityTypes::TAB);
        // UAC Stuff
        /*
        $entitiesEncounteredKeys = $this->get_uac_manager()->getUACGlobalIDs($user_id, new TC_DefaultAccessProfile(), null, $entitytype->get_keyValue());
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
        */
        //$entitiesEncounteredKeys = array_keys($entitiesEncountered);
        //$entitiesEncounteredKeys = array_combine($entitiesEncounteredKeys, $entitiesEncounteredKeys);

        //return $UAC_Filter;

        $persistables[$friendlies['ENTITYTYPES']]->type = $entitytype->type;

        //$metadatatype = $this->get_container_manager()->metadataTypeVerification(ValidMetadataTypes::DASHBOARD_PRIORITY);
        $persistables[$friendlies['METADATATYPES']]->type = $metadatatype->type;
        $persistables[$friendlies['METADATA']]->owner_id = $user_id;

        //echo $containersDV->encodeColumnForSQL($persistables[$friendlies['METADATA']], 'data') ;

        // if(!isset($loadedContainersDV))
        // {
            $containersDV->generateSQL(array(),
                                    array($containersDV->encodeColumnForSQL($persistables[$friendlies['METADATA']], 'data') =>
                                        array('direction' => 'ASC', 'cast_type' => 'unsigned')
                                    ),
                                    null,
                                    $UAC_Filter);
        // }
        // else
        // {
        //     $containersDV = $loadedContainersDV;
        // }

        $priorArr = array();
        $entitiesWithCurrentUserMetadata = array();
        $entitiesToUpdate = array();
        /*
        $meta_id_key = $containersDV->encodeColumnForSQL($persistables[$friendlies['METADATA']],
                                          $persistables[$friendlies['METADATA']]->get_keyName());
        $data_key = $containersDV->encodeColumnForSQL($persistables[$friendlies['METADATA']],
                                          $persistables[$friendlies['METADATA']]->data);
        $entity_id_key = $row->$containersDV->encodeColumnForSQL($persistables[$friendlies['ENTITIES']],
                                          $persistables[$friendlies['ENTITIES']]->get_keyName());
        */

        $containersDV->execute();
        while($row = $containersDV->readObjectRow())
        {
            $priorArr[$row[$friendlies['METADATA']]->get_keyValue()] = $row[$friendlies['METADATA']];
            //$priorArr[$row->$meta_id_key] = $row->$data_key;
            $entitiesWithCurrentUserMetadata[$row[$friendlies['ENTITIES']]->get_keyValue()] = $row[$friendlies['ENTITIES']]->get_keyValue();
            $entitiesToUpdate[$row[$friendlies['METADATA']]->get_keyValue()] = $row[$friendlies['ENTITIES']];
            //$entitiesWithCurrentUserMetadata[$row->$entity_id_key] = $row->$entity_id_key;
        }
        /*
        $entitiesEncounteredKeys = array_keys($entitiesEncountered);
        $entitiesWithCurrentUserMetadataKeys = array_keys($entitiesWithCurrentUserMetadata);

        $entitiesMissingCurrentUserMetadataKeys = array_diff($entitiesEncounteredKeys, $entitiesWithCurrentUserMetadataKeys);

        foreach($entitiesMissingCurrentUserMetadataKeys as $key)
        {
            $entitiesMissingCurrentUserMetadata[$key] = $entitiesEncountered[$key];
        }
        */
        $entitiesMissingCurrentUserMetadata = array_diff_assoc($entitiesEncounteredKeys, $entitiesWithCurrentUserMetadata);

        $priorArrDupe = $priorArr;

        $priorPriority = 0;
        $maxPriority = 0;
        foreach($priorArrDupe as $key => $value)
        {
            if($value->data != 1 + $priorPriority)
            {
                $value->data = 1 + $priorPriority;
                //$priorArrDupe[$key]->data = 1 + $priorPriority;
                //$maxPriority = $value->data;
                $value->last_edited = date('Y-m-d H:i:s');
                $value->save();

                // $entitiesToUpdate[$key]->last_edited = date('Y-m-d H:i:s');
                // $entitiesToUpdate[$key]->save();

            }
            $priorPriority++;
            $maxPriority = $value->data;
        }
        /*
        foreach($priorArrayDupe as $key => $value)
        {
            /// TODO: ensure that is_dirty is correctly false for unchanged values here
            $value->save();
        }
         *
         */

        foreach($entitiesMissingCurrentUserMetadata as $value)
        {
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

            $entity = new THOR_ENTITIES_DataBoundSimplePersistable();
            $entity->set_keyValue($value);
            $entity->last_edited = date('Y-m-d H:i:s');
            $entity->save();
        }
        return $maxPriority;

        /*
        $priorArrDupeKeys = array_keys($priorArrDupe);
        $priorArrKeys = array_keys($priorArr);

        $arrToUpdateKeys = array_diff($priorArrDupeKeys, $priorArrKeys);

        foreach($arrToUpdateKeys as $key)
        {
            $arrToUpdate[$key] = $priorArrKeys[$key];
        }





        $arrToUpdate = array_diff_assoc($priorArrDupe, $priorArr);

        if($arrToUpdate)
        {
            foreach($arrToUpdate AS $key => $value)
            {

                $this->updateMetadata($key, null, null, $value, null);


            }
        }


        foreach($entitiesMissingCurrentUserMetadata as $key => $value)
        {
            $tangent = logTiming('insert meta start', 'tangent start', 0, null, true);
            //assume max checks against MAX_DASHBOARD_TABS_PER_GROUP have been made upon entity insert
            //logTiming('insert metadata start', '', 0, $logID);
            $this->insertMetadata($value,
                                        $metadatatype_id,
                                        1,
                                        $user_id,
                                        ValidMetadataTypes::DASHBOARD_PRIORITY,
                                        $maxPriority + 1,
                                        "Allows one to order dashboard tabs");
            $maxPriority++;
            //logTiming('insert metadata end', '', 0, $logID);
            logTiming('insert meta end', '', 1, $tangent);
        }


        return $maxPriority;
        */
        /*
        $containersDV->generateSQL(array(),
                                    array(),
                                    null,
                                    $UAC_Filter);

        $entityIDs = $containersDV->generateSelectionCollection($containersDV->encodeColumnForSQL($persistables[$friendlies['ENTITIES']],
                                                                    $persistables[$friendlies['ENTITIES']]->get_keyName()));
        */







        //$containerDV = $this->get_container_manager()->get_containersMasterQuery();
        //$containerDV->getFromPersistableInputCollectionFriendly('ENTITYTYPES');





        /*
        $this->get_container_manager()->execute();
        while($row = $this->get_container_manager()->read())
        {

        }
        */

        /*



        $entitytype_id = $this->entityTypeVerification(ValidEntityTypes::TAB);
        $uac_verified_entities = implode(',', $this->get_uac_verified_entities($user_id, new TC_DefaultAccessProfile(), $entitytype_id));

        //$uac_verified_entities = $this->getUACEntityIDs($user_id, new TC_DefaultAccessProfile(), ValidEntityTypes::TAB);
        //$uac_verified_entities = implode(',', $uac_verified_entities);

        $metadatatype_id = $this->metadataTypeVerification(ValidMetadataTypes::DASHBOARD_PRIORITY);
        //logTiming('verification end', '', 0, $logID);


        $entityFilter = new QueryCondition(DB_NAME.".".pullIndex($this->get_entities(), 'type_id'), ValidSQLComparisons::EQUALS, $entitytype_id);
        $isActive_Filter = new QueryCondition(DB_NAME.".".pullIndex($this->get_entities(), 'is_active'), ValidSQLComparisons::EQUALS, 1);
        if(!$uac_verified_entities)
        {
            $UAC_Filter = new QueryCondition('0', ValidSQLComparisons::EQUALS, '1');
        }
        else
        {
            $UAC_Filter = new QueryCondition(DB_NAME.".".pullIndex($this->get_entities(), 'id'), ValidSQLComparisons::IN, $uac_verified_entities);
        }

        //$metadatatypeFilter = new RepoStrategyFilter(DB_NAME.".".pullIndex($this->get_metadata(), 'type_id'), ValidSQLComparisons::EQUALS, $metadatatype_id);

        //$metadataisActive_Filter = new RepoStrategyFilter(DB_NAME.".".pullIndex($this->get_metadata(), 'is_active'), ValidSQLComparisons::EQUALS, 1);
        //$priorityFilter = new RepoStrategyFilter(DB_NAME.".".pullIndex($this->get_metadata(), 'type_id'), ValidSQLComparisons::EQUALS, $metadatatype_id);
        //$userPriorityFilter = new RepoStrategyFilter(DB_NAME.".".pullIndex($this->get_metadata(), 'owner_id'), ValidSQLComparisons::EQUALS, $user_id);

        $entityFilter->augmentFilter($isActive_Filter, ValidSQLComparisons::AND_);
        $entityFilter->augmentFilter($UAC_Filter, ValidSQLComparisons::AND_);
        //$entityFilter->augmentFilter($metadatatypeFilter, ValidSQLComparisons::AND_);

        //$entityFilter->augmentFilter($metadataisActive_Filter, ValidSQLComparisons::AND_);
        //$entityFilter->augmentFilter($priorityFilter, ValidSQLComparisons::AND_);
        //$entityFilter->augmentFilter($userPriorityFilter, ValidSQLComparisons::AND_);
        $query = "SELECT DISTINCT ".DB_NAME.".".pullIndex($this->get_entities(), 'id')." as entity_id ".

        " FROM ".DB_NAME.".".ENTITIES
        //" INNER JOIN ".DB_NAME.".".ENTITYTYPES.
        //" ON ".DB_NAME.".".pullIndex($this->get_entities(), 'type_id')." = ".DB_NAME.".".pullIndex($this->get_entitytypes(), 'id').


        ;
        $query .= " WHERE ";
        $query .= $entityFilter;
        $this->get_dataSource()->query($query);



        $entitiesEncountered = array();
        while($row = $this->get_dataSource()->fetch() )
        {
            if(!array_key_exists($row->entity_id, $entitiesEncountered))
            {
                $entitiesEncountered[$row->entity_id] = $row->entity_id;
            }

        }







        $order = new QueryOrder(array("CAST(". DB_NAME.".".pullIndex($this->get_metadata(), 'data')  . " as SIGNED INTEGER)" => 1));




        $metadataisActive_Filter = new QueryCondition(DB_NAME.".".pullIndex($this->get_metadata(), 'is_active'), ValidSQLComparisons::EQUALS, 1);
        $priorityFilter = new QueryCondition(DB_NAME.".".pullIndex($this->get_metadata(), 'type_id'), ValidSQLComparisons::EQUALS, $metadatatype_id);
        $userPriorityFilter = new QueryCondition(DB_NAME.".".pullIndex($this->get_metadata(), 'owner_id'), ValidSQLComparisons::EQUALS, $user_id);

        $metadataisActive_Filter->augmentFilter($priorityFilter, ValidSQLComparisons::AND_);
        $metadataisActive_Filter->augmentFilter($userPriorityFilter, ValidSQLComparisons::AND_);

        $entityFilter->augmentFilter($metadataisActive_Filter, ValidSQLComparisons::AND_);




        $query = "SELECT ".DB_NAME.".".pullIndex($this->get_entities(), 'id')." as entity_id ".",".
        DB_NAME.".".pullIndex($this->get_metadata(), 'data')." AS priority".",".
        DB_NAME.".".pullIndex($this->get_metadata(), 'id')." AS meta_id ".",".
        DB_NAME.".".pullIndex($this->get_metadata(), 'owner_id')." AS owner_id ".",".
        DB_NAME.".".pullIndex($this->get_metadata(), 'type_id')." AS type_id ".",".
        DB_NAME.".".pullIndex($this->get_metadata(), 'is_active')." AS is_active ".
        " FROM ".DB_NAME.".".ENTITIES.
        //" INNER JOIN ".DB_NAME.".".ENTITYTYPES.
        //" ON ".DB_NAME.".".pullIndex($this->get_entities(), 'type_id')." = ".DB_NAME.".".pullIndex($this->get_entitytypes(), 'id').
        " INNER JOIN ".DB_NAME.".".METADATA.
        " ON ".DB_NAME.".".pullIndex($this->get_metadata(), 'entity_id')." = ".DB_NAME.".".pullIndex($this->get_entities(), 'id')


        ;

        $query .= " WHERE ";
        $query .= $entityFilter;

        $query .= " ORDER BY ";
        $query .= $order;

        logTiming('get start', '', 0, $logID);
        logTiming($query, '', 0, $logID);
        $this->get_dataSource()->query($query);
        logTiming('get end', '', 1, $logID);

        $priorArr = array();
        $entitiesMissingCurrentUserMetadata = array();
        $entitiesWithCurrentUserMetadata = array();
        //$entitiesEncountered = array();
        while($row = $this->get_dataSource()->fetch() )
        {
            //if(!array_key_exists($row->entity_id, $entitiesEncountered))
            //{
            //    $entitiesEncountered[$row->entity_id] = $row->entity_id;
            //}
            //if($row->type_id == $metadatatype_id && $row->owner_id == $user_id && $row->is_active == 1)
            //{
                $priorArr[$row->meta_id] = $row->priority;
                $entitiesWithCurrentUserMetadata[$row->entity_id] = $row->entity_id;
            //}

        }
        $entitiesMissingCurrentUserMetadata = array_diff_assoc($entitiesEncountered, $entitiesWithCurrentUserMetadata);

        $priorArrDupe = $priorArr;

        $priorPriority = 0;
        $maxPriority = 0;
        foreach($priorArrDupe as $key => $value)
        {
            if($value != 1 + $priorPriority)
            {
                $priorArrDupe[$key] = 1 + $priorPriority;
            }
            $priorPriority++;
            $maxPriority = $priorArrDupe[$key];
        }

        $arrToUpdate = array_diff_assoc($priorArrDupe, $priorArr);

        if($arrToUpdate)
        {
            $tangent = logTiming('update meta start', 'tangent start', 0, null, true);
            foreach($arrToUpdate AS $key => $value)
            {

                $this->updateMetadata($key, null, null, $value, null);


            }
            logTiming('update meta end', '', 1, $tangent);
        }


        foreach($entitiesMissingCurrentUserMetadata as $key => $value)
        {
            $tangent = logTiming('insert meta start', 'tangent start', 0, null, true);
            //assume max checks against MAX_DASHBOARD_TABS_PER_GROUP have been made upon entity insert
            //logTiming('insert metadata start', '', 0, $logID);
            $this->insertMetadata($value,
                                        $metadatatype_id,
                                        1,
                                        $user_id,
                                        ValidMetadataTypes::DASHBOARD_PRIORITY,
                                        $maxPriority + 1,
                                        "Allows one to order dashboard tabs");
            $maxPriority++;
            //logTiming('insert metadata end', '', 0, $logID);
            logTiming('insert meta end', '', 1, $tangent);
        }


        return $maxPriority;
      */
    }

}

?>
