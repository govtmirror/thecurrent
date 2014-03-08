<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TC_THOR_SetContainersForUserDashboardView_SetRepo
 *
 * @author severus
 */
class TC_THOR_SetContainersForUserDashboardView_SetRepo extends SetStrategy{
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


    public function save(ISetParameterModel $param)
    {
        $params = $param->get_parameters();
        $options = $param->get_options();

        if(array_key_exists('user_id', $params))
        {
            $user_id = $params['user_id'];
        }
        else
        {
            $user_id = SYSTEM_USER_ID;
            $params['user_id'] = $user_id;
        }
        if(array_key_exists('accessGroup_IDs', $params))
        {
            $accessGroup_IDs = $params['accessGroup_IDs'];
        }
        else
        {
            $accessGroup_IDs = array();
            //throw new Exception('cannot save without access groups specified');
            //$accessprofile = new TC_DefaultAccessProfile();
        }

        if(!$param->get_item() || !($param->get_item() instanceof TC_DashboardTab_EntityModel))
        {
            throw new Exception("No item was included for save");
        }
        else
        {
            $changedEntity = $param->get_item();
        }

        //if(!$param->get_item()->get_priorVersion() || !($param->get_item()->get_priorVersion() instanceof TC_DashboardTab_EntityModel))
        //{
        //    return false;
        //}
        //else
        //{
            $originalEntity = $param->get_item()->get_priorVersion();
        //}

        $originalModel = $originalEntity->get_host();
        $changedModel = $changedEntity->get_host();

        if(!$originalModel && !($originalModel instanceof TC_Tab))
        {
            throw new Exception("no model provided for database entity.");
        }

        if(!$changedModel && !($changedModel instanceof TC_Tab))
        {
            throw new Exception("no model provided for database entity.");
        }

        $id = $changedEntity->get_entity_id();

        if(!$changedEntity->get_is_active() && $id)
        {
            $this->delete($id, $user_id);
        }
        elseif($changedEntity->get_is_active() && $id)
        {
            $param = $this->update($param);
            //update
        }
        elseif($changedEntity->get_is_active() && !$id)
        {
            $param = $this->create($param);
        }


        //$this->fixPriority($user_id);

        //return $returnMe;
        return $param;
    }

    public function delete($id, $user_id)
    {
        $entity = new THOR_ENTITIES_DataBoundSimplePersistable();
        $entity->set_keyValue($id);
        //$entity->populateFromKey($id);
        $entity->is_active = 0;
        $entity->last_edited = date('Y-m-d H:i:s');
        $entity->save();

        $this->fixPriority($user_id);
        //$this->performAudit($entity, $caller, ValidAuditActions::DEACTIVATED);
        return true;


    }

    public function create(ISetParameterModel $param)
    {
        $params = $param->get_parameters();
        $options = $param->get_options();

        $user_id = $params['user_id'];
        $accessGroup_IDs = $params['accessGroup_IDs'];

        $changedEntity = $param->get_item();
        $changedModel = $changedEntity->get_host();

        $entity = new THOR_ENTITIES_DataBoundSimplePersistable();
        $container = new TC_THOR_CONTAINERS_DataBoundSimplePersistable();

        $viewtype_id = $this->get_container_manager()->containerViewTypeVerification($changedModel->get_viewtype())->get_keyValue();
        $modeltype_id = $this->get_container_manager()->containerModelTypeVerification(get_class($changedModel))->get_keyValue();
        $entitytype = $this->get_container_manager()->entityTypeVerification(ValidEntityTypes::TAB);
        $entitytype_id = $entitytype->get_keyValue();
        $metadatatype = $this->get_container_manager()->metadataTypeVerification(ValidMetadataTypes::DASHBOARD_PRIORITY);
        $metadatatype_id = $metadatatype->get_keyValue();

        $owner_id = $changedEntity->get_owner();
        //$model = $entity->get_host();

        $maxPriority = $this->fixPriority($user_id);

        $accessGroupType = $this->get_uac_manager()->accessGroupTypeVerification(ValidAccessGroupTypes::PERSONAL);
        $accessGroupType_id = $accessGroupType->get_keyValue();

        if($user_id !== SYSTEM_USER_ID)
        {
            $personalAccessGroup = array_pop($this->get_uac_manager()->getAccessGroupsForUserOrEntity($user_id, $accessGroupType_id));
            $personalAccessGroup_id = $personalAccessGroup->get_keyValue();

            foreach ($accessGroup_IDs as $id => $status)
            {
                if($personalAccessGroup_id == $id && $status == 1)
                {
                    $maxPriorityInPersonalGroup = count($this->get_uac_manager()->getUACEntitiesFromGroupRightsIDs($user_id,
                                                                                            new TC_DefaultAccessProfile(),
                                                                                            $entitytype_id,
                                                                                            $id));
                    if(($maxPriorityInPersonalGroup >= MAX_DASHBOARD_TABS_PER_GROUP))
                    {return $param;}
                }
            }

        }

        //something is goofy with new priorities
        $currentPriority = $changedEntity->get_dashboard_priority();
        if(!$currentPriority)
        {
            $currentPriority = $maxPriority + 1;
            $changedEntity->set_dashboard_priority($currentPriority);
        }

        $description = addslashes($changedModel->get_description());
	$title = $this->get_dataSource()->escapeInput($changedModel->get_title());

        $container->modeltype_id = $modeltype_id;
        $container->viewtype_id = $viewtype_id;
        $container->title = $title;
        $container->description = $description;
        $container->save();

        $container_id = $container->get_keyValue();//$this->insertContainer($modeltype_id, $viewtype_id, $title, $description);
        $changedEntity->set_host_id($container_id);
        $changedEntity->set_host($changedModel);

        $entity->row_id = $container_id;
        $entity->type_id = $entitytype_id;
        $entity->owner_id = $owner_id;
        $entity->is_active = 1;
        $entity->created_date = date('Y-m-d H:i:s');
        $entity->last_edited = date('Y-m-d H:i:s');
        $entity->save();

        $entity_id = $entity->get_keyValue();//$this->insertEntity($entitytype_id, $caller, $entity->get_is_active(), $container_id);
        $changedEntity->set_entity_id($entity_id);
        $changedEntity->set_created_date($entity->created_date);
        $changedEntity->set_last_edited($entity->last_edited);
        //$entity->set_entity_id($entity_id);
        //$maxPriority++;
        $metadata = new THOR_METADATA_DataBoundSimplePersistable();
        $metadata->entity_id = $entity_id;
        $metadata->type_id = $metadatatype_id;
        $metadata->is_active = 1;
        $metadata->owner_id = $owner_id;
        $metadata->data = $maxPriority + 1;
        $metadata->title = $metadatatype->type;
        $metadata->description = "Allows one to order dashboard tabs";
        $metadata->created_date = date('Y-m-d H:i:s');
        $metadata->last_edited = date('Y-m-d H:i:s');

        $metadata->save();
        $metadata_id = $metadata->get_keyValue();

        $changedEntity->set_dashboard_priority($metadata->data);
        $changedEntity->set_dashboard_priority_metaID($metadata_id);
        //$uac = $this->get_uac_manager();
        //$uac instanceof THOR_UserAccessDatabaseManager;
        foreach($accessGroup_IDs as $id => $status)
        {
            $this->get_uac_manager()->setEntityToGroupUAC($id, $entity_id, $status);
        }

        if($currentPriority && $currentPriority != ($maxPriority + 1) )
        {
            //echo $currentPriority;
            //echo '-';
            //echo ($maxPriority + 1);
            //$this->swapPriority($user_id, $metadata_id, $currentPriority);
            $this->swapPriority($user_id,
                                    $metadata_id,
                                    $currentPriority);

        }
        $this->setExtraParams($changedEntity);
        //add params now


        //add UAC stuff too


        $param->set_item($changedEntity);
        //$param->set_ID($entity_id);
        //$this->performAudit($entity, $caller, ValidAuditActions::CREATED);
        return $param;


    }

    public function update(ISetParameterModel $param)
    {
        $params = $param->get_parameters();
        $options = $param->get_options();

        $user_id = $params['user_id'];
        $accessGroup_IDs = $params['accessGroup_IDs'];

        $originalEntity = $param->get_item()->get_priorVersion();
        $changedEntity = $param->get_item();

        $originalModel = $originalEntity->get_host();
        $changedModel = $changedEntity->get_host();

        $entity_id = $changedEntity->get_entity_id();
        $container_id = $changedEntity->get_host_id();

        $entity = new THOR_ENTITIES_DataBoundSimplePersistable();
        $container = new TC_THOR_CONTAINERS_DataBoundSimplePersistable();

        $entity->set_keyValue($entity_id);
        $container->set_keyValue($container_id);

        $viewtype_id = $this->get_container_manager()->containerViewTypeVerification($changedModel->get_viewtype())->get_keyValue();

        $this->fixPriority($user_id);

        $currentPriority = $changedEntity->get_dashboard_priority();
        $description = addslashes($changedModel->get_description());
	$title = $this->get_dataSource()->escapeInput($changedModel->get_title());

        $container->title = $title;
        $container->description = $description;
        $container->viewtype_id = $viewtype_id;
        $container->save();

        //$entity->is_active = $changedEntity->get_is_active();
        $entity->last_edited = date('Y-m-d H:i:s');
        $entity->save();
        $changedEntity->set_last_edited($entity->last_edited);
        //$this->updateContainer($changedEntity->get_host_id(), $title, $description, $viewtype_id);

        foreach ($accessGroup_IDs as $id => $status)
        {
            $this->get_uac_manager()->setEntityToGroupUAC($id, $entity_id, $status);
        }


        $metadata_id = $changedEntity->get_dashboard_priority_metaID();
        if(!isset($metadata_id))
        {
            $metadata_id = $this->getMetadataIDForDashboardPriority($user_id, $entity_id);
        }
        if(isset($metadata_id))
        {
            // logError($user_id);
            // logError($metadata_id);
            // logError($currentPriority);
            // logError($entity_id);
            //$this->swapPriority($user_id, $metadata_id, $currentPriority);
            $this->swapPriority($user_id,
                                $metadata_id,
                                $currentPriority);
        }
        // logError(var_export($changedEntity, true));
        $changedEntity->set_dashboard_priority($currentPriority);
        //$changedEntity->set_dashboard_priority_metaID($metadata_id);
        $this->setExtraParams($changedEntity);
        //$this->performAudit($entity, $caller, ValidAuditActions::UPDATED);
        $param->set_item($changedEntity);
        return $param;


    }

    public function fixPriority($user_id)
    {

        //$containersDV = $this->get_container_manager()->get_containersMasterQuery();

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



        $tabStrat = new TC_THOR_GetContainersForUserDashboardView_GetRepo();

        return $tabStrat->fixPriority($user_id, $entitytype, $metadatatype, $entitiesEncounteredKeys, $UAC_Filter);

    }

    public function swapPriority($user_id,
                                    $metadatarow_id,
                                    $newPriority)
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


        $persistables[$friendlies['ENTITYTYPES']]->type = $entitytype->type;
        $persistables[$friendlies['METADATATYPES']]->type = $metadatatype->type;
        $persistables[$friendlies['METADATA']]->owner_id = $user_id;


        $containersDV->generateSQL(array(),
                                    array($containersDV->encodeColumnForSQL($persistables[$friendlies['METADATA']], 'data') =>
                                        array('direction' => 'ASC', 'cast_type' => 'unsigned')
                                    ),
                                    null,
                                    $UAC_Filter);
        //return $containersDV->get_generatedSQL();

        $entitiesToUpdate = array();
        $priorArr = array();
        $priorArrPriorities = array();

        $containersDV->execute();
        while($row = $containersDV->readObjectRow())
        {
            $priorArr[$row[$friendlies['METADATA']]->get_keyValue()] = $row[$friendlies['METADATA']];
            $priorArrPriorities[$row[$friendlies['METADATA']]->get_keyValue()] = $row[$friendlies['METADATA']]->data;
            $entitiesToUpdate[$row[$friendlies['METADATA']]->get_keyValue()] = $row[$friendlies['ENTITIES']];
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
                $entitiesToUpdate[$key]->last_edited = date('Y-m-d H:i:s');
                $entitiesToUpdate[$key]->save();
            }
        }
        // logError(var_export(array_keys($priorArrDupe), true));
        // logError($metadatarow_id);
        // logError($user_id);
        $priorArrDupe[$metadatarow_id]->data = $newPriority;
        $priorArrDupe[$metadatarow_id]->last_edited = date('Y-m-d H:i:s');
        $priorArrDupe[$metadatarow_id]->save();
        $entitiesToUpdate[$metadatarow_id]->last_edited = date('Y-m-d H:i:s');
        $entitiesToUpdate[$metadatarow_id]->save();

        //$this->updateMetadata($metadatarow_id, null, null, $newPriority, null);

        return true;


    }

    protected function setExtraParams(TC_DashboardTab_EntityModel $entity)
    {
        $model = $entity->get_host();
        $id = $entity->get_host_id();
        $model instanceof TC_THOR_HostModel;
        //add params now
        $params = $model->get_fieldValuePairs(); //$model->returnProperties();

        foreach($params as $key => $value)
        {

            /*not elegant and doesn't scale, should iterate through parent properties and discount
             * them when i figure out how or remove title/description entirely
            from main table*/



            //if($key != "description" && $key != "title" && $key != "sources" && $key != "viewtype")
            //{
                //check to see if param field exists, if not add it
                $field = $this->get_container_manager()->containerFieldVerification($key);
                $containers_paramfields = new TC_THOR_CONTAINERS_PARAMFIELDS_DataBoundSimplePersistable();
                $containers_paramfields->field_id = $field->get_keyValue();
                $containers_paramfields->container_id = $id;

                $containers_paramfields->isPersistableAlreadyRecorded(false, true, array('value'));

                $containers_paramfields->value = $value;
                $containers_paramfields->save();
                $entityDB = new THOR_ENTITIES_DataBoundSimplePersistable();
                $entityDB->set_keyValue($entity->get_entity_id());
                $entityDB->last_edited = date('Y-m-d H:i:s');
                $entityDB->save();

                /*
                //see if param value exists, then update, otherwise add param value
                $query = "SELECT ".DB_NAME.".".pullIndex($this->get_containers_paramfields(), 'id').
                " FROM ".DB_NAME.".".CONTAINERS_PARAMFIELDS.
                " WHERE ".DB_NAME.".".pullIndex($this->get_containers_paramfields(), 'field_id')." = ".$field->get_keyValue().
                " AND ".DB_NAME.".".pullIndex($this->get_containers_paramfields(), 'container_id')." = ".$id.
                " AND ".DB_NAME.".".pullIndex($this->get_containers_paramfields(), 'value')." = '".$value."'"
                ;
                $this->get_dataSource()->query($query);
                $row = $this->get_dataSource()->fetch();
                if($row && $value != $row->value)
                {
                    $value_id = $row->keyValue;
                    $this->updateContainerParam($value_id, $value);

                }
                elseif(!$row)
                {
                    $value_id = $this->insertContainerParam($id, $field_id, $value);

                }
                */

            //}
        }
        return true;
    }


    public function getMetadataIDForDashboardPriority($user_id, $entity_id)
    {


        $metadata = new THOR_METADATA_DataBoundSimplePersistable();
        $metadata->owner_id = $user_id;
        $metadata->entity_id = $entity_id;
        $metadata->is_active = 1;
        $metadatatype_id = $this->metadataTypeVerification(ValidMetadataTypes::DASHBOARD_PRIORITY);
        $metadata->type_id = $metadatatype_id;

        if($metadata->isPersistableAlreadyRecorded(false, true, array('data','title','last_edited','created_date','description')))
        {
            return $metadata->get_keyValue();
        }
        else
        {
            return false;
        }

        /*

        $entityFilter = new QueryCondition(DB_NAME.".".pullIndex($this->get_metadata(), 'entity_id'), ValidSQLComparisons::EQUALS, $entity_id);
        ////$this->getEntityTypeFilter(ValidEntityTypes::TAB);
        //$isActive_Filter = new RepoStrategyFilter(DB_NAME.".".pullIndex($this->get_entities(), 'is_active'), ValidSQLComparisons::EQUALS, 1);

        $metadataisActive_Filter = new QueryCondition(DB_NAME.".".pullIndex($this->get_metadata(), 'is_active'), ValidSQLComparisons::EQUALS, 1);
        $priorityFilter = new QueryCondition(DB_NAME.".".pullIndex($this->get_metadata(), 'type_id'), ValidSQLComparisons::EQUALS, $metadatatype_id);
        $userPriorityFilter = new QueryCondition(DB_NAME.".".pullIndex($this->get_metadata(), 'owner_id'), ValidSQLComparisons::EQUALS, $user_id);

        //$entityFilter->augmentFilter($isActive_Filter, ValidSQLComparisons::AND_);

        $entityFilter->augmentFilter($metadataisActive_Filter, ValidSQLComparisons::AND_);
        $entityFilter->augmentFilter($priorityFilter, ValidSQLComparisons::AND_);
        $entityFilter->augmentFilter($userPriorityFilter, ValidSQLComparisons::AND_);

        $query = "SELECT ".DB_NAME.".".pullIndex($this->get_metadata(), 'data')." AS priority".",".DB_NAME.".".pullIndex($this->get_metadata(), 'id')." AS id ".
        " FROM ".DB_NAME.".".METADATA
        ;

        $query .= " WHERE ";
        $query .= $entityFilter;


        $this->get_dataSource()->query($query);
        $row = $this->get_dataSource()->fetch();
        $returnMe = null;
        if($row)
        {
            $returnMe = $row->keyValue;
        }
        return $returnMe;
         *
         */
    }

}

?>
