<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TC_THOR_SetSourcesForUserDashboardView_SetRepo
 *
 * @author KottkeDP
 */
class TC_THOR_SetSourcesForUserDashboardView_SetRepo extends SetStrategy{

    protected $widget_manager;
    protected $uac_manager;

    public function __construct($dataSource = null) {
        if(!isset($dataSource))
        {
            $dataSource = MySQLConfig::dsConnect();
        }
        $widget_manager = new TC_THOR_WidgetDatabaseManager($dataSource);
        $this->set_widget_manager($widget_manager);
        $uac_manager = new THOR_UserAccessDatabaseManager($dataSource);
        $this->set_uac_manager($uac_manager);

        parent::__construct($dataSource);
    }

    public function get_widget_manager() {
        return $this->widget_manager;
    }

    public function set_widget_manager($widget_manager) {
        $this->widget_manager = $widget_manager;
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

        if(array_key_exists('container_id', $params))
        {
            $container_id = $params['container_id'];
        }
        else
        {
            throw new Exception("container id is required");
        }
        $changedEntity = $param->get_item();
        if(!isset($changedEntity) || !($changedEntity instanceof TC_DashboardSource_EntityModel))
        {
            throw new Exception("No item was included for save");
        }


        //if(!$param->get_item()->get_priorVersion() || !($param->get_item()->get_priorVersion() instanceof TC_DashboardSource_EntityModel))
        //{
        //    return false;
        //}
        //else
        //{
            $originalEntity = $param->get_item()->get_priorVersion();
        //}

        $originalModel = $originalEntity->get_host();
        $changedModel = $changedEntity->get_host();

        if(!$originalModel && !($originalModel instanceof TC_Source))
        {
            throw new Exception("no model provided for database entity.");
        }

        if(!$changedModel && !($changedModel instanceof TC_Source))
        {
            throw new Exception("no model provided for database entity.");
        }

        $id = $changedEntity->get_entity_id();

        if(!$changedEntity->get_is_active() && $id)
        {
            $this->delete($id);
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


    public function delete($id)
    {
        $entity = new THOR_ENTITIES_DataBoundSimplePersistable();
        $entity->set_keyValue($id);
        //$entity->populateFromKey($id);
        $entity->is_active = 0;
        $entity->last_edited = date('Y-m-d H:i:s');
        $entity->save();
        //$this->performAudit($entity, $caller, ValidAuditActions::DEACTIVATED);
        return true;
    }

    public function create(ISetParameterModel $param)
    {
        $params = $param->get_parameters();
        $options = $param->get_options();

        $container_id = $params['container_id'];


        $changedEntity = $param->get_item();
        $changedModel = $changedEntity->get_host();

        $entity = new THOR_ENTITIES_DataBoundSimplePersistable();
        $widget = new TC_THOR_WIDGETS_DataBoundSimplePersistable();

        $viewtype_id = $this->get_widget_manager()->widgetViewTypeVerification($changedModel->get_viewtype())->get_keyValue();
        $modeltype_id = $this->get_widget_manager()->widgetModelTypeVerification(get_class($changedModel))->get_keyValue();
        $entitytype = $this->get_widget_manager()->entityTypeVerification(ValidEntityTypes::SOURCE);
        $entitytype_id = $entitytype->get_keyValue();
        $metadatatype = $this->get_widget_manager()->metadataTypeVerification(ValidMetadataTypes::DASHBOARDSOURCE_PRIORITY);
        $metadatatype_id = $metadatatype->get_keyValue();

        $owner_id = $changedEntity->get_owner();
        //$model = $entity->get_host();

        $firstMissingPriority = $this->fixPriority($container_id);
        if($firstMissingPriority > MAX_DASHBOARD_WIDGETS_PER_TAB)
        {return $param;}

        //something is goofy with new priorities
        //$changedEntity instanceof TC_DashboardSource_EntityModel;
        $currentPriority = $changedEntity->get_dashboard_priority();
        if(!$currentPriority)
        {
            $currentPriority = $firstMissingPriority;
            $changedEntity->set_dashboard_priority($currentPriority);
        }

        $description = $changedModel->get_description();
        $title = $this->get_dataSource()->escapeInput($changedModel->get_title());

        $widget->modeltype_id = $modeltype_id;
        $widget->viewtype_id = $viewtype_id;
        $widget->title = $title;
        $widget->description = $description;
        $widget->container_id = $container_id;
        $widget->save();

        $widget_id = $widget->get_keyValue();//$this->insertContainer($modeltype_id, $viewtype_id, $title, $description);
        $changedEntity->set_host_id($widget_id);
        $changedEntity->set_host($changedModel);

        $entity->row_id = $widget_id;
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
        $metadata->data = $firstMissingPriority;
        $metadata->title = $metadatatype->type;
        $metadata->description = "Allows one to order dashboard sources";
        $metadata->created_date = date('Y-m-d H:i:s');
        $metadata->last_edited = date('Y-m-d H:i:s');

        $metadata->save();
        $metadata_id = $metadata->get_keyValue();

        $changedEntity->set_dashboard_priority($metadata->data);
        $changedEntity->set_dashboard_priority_metaID($metadata_id);
        //$uac = $this->get_uac_manager();
        //$uac instanceof THOR_UserAccessDatabaseManager;


        if($currentPriority && $currentPriority != $firstMissingPriority)
        {
            //echo $currentPriority;
            //echo '-';
            //echo ($maxPriority + 1);
            //$this->swapPriority($user_id, $metadata_id, $currentPriority);
            $this->swapPriority($container_id,
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

        $container_id = $params['container_id'];


        $originalEntity = $param->get_item()->get_priorVersion();
        $changedEntity = $param->get_item();

        $originalModel = $originalEntity->get_host();
        $changedModel = $changedEntity->get_host();

        $entity_id = $changedEntity->get_entity_id();
        $widget_id = $changedEntity->get_host_id();

        $entity = new THOR_ENTITIES_DataBoundSimplePersistable();
        $widget = new TC_THOR_WIDGETS_DataBoundSimplePersistable();

        $entity->set_keyValue($entity_id);
        $widget->set_keyValue($widget_id);

        $viewtype_id = $this->get_widget_manager()->widgetViewTypeVerification($changedModel->get_viewtype())->get_keyValue();

        $firstMissingPriority = $this->fixPriority($container_id);

        $currentPriority = $changedEntity->get_dashboard_priority();
        $description = $changedModel->get_description();
        $title = $this->get_dataSource()->escapeInput($changedModel->get_title());

        $widget->title = $title;
        $widget->description = $description;
        $widget->viewtype_id = $viewtype_id;
        //$widget->container_id = $container_id;
        $widget->save();

        //$entity->is_active = $changedEntity->get_is_active();
        $entity->last_edited = date('Y-m-d H:i:s');
        $entity->save();
        $changedEntity->set_last_edited($entity->last_edited);
        //$this->updateWidget($changedEntity->get_host_id(), $title, $description, $viewtype_id);



        $metadata_id = $changedEntity->get_dashboard_priority_metaID();
        if(!isset($metadata_id))
        {
            $metadata_id = $this->getMetadataIDForDashboardSourcePriority($entity_id);
        }
        if(isset($metadata_id))
        {
            //$this->swapPriority($user_id, $metadata_id, $currentPriority);
            $this->swapPriority($container_id,
                                $metadata_id,
                                $currentPriority);
        }
        $changedEntity->set_dashboard_priority($currentPriority);
        //$changedEntity->set_dashboardsource_priority_metaID($metadata_id);
        $this->setExtraParams($changedEntity);
        //$this->performAudit($entity, $caller, ValidAuditActions::UPDATED);
        $param->set_item($changedEntity);
        return $param;
    }

    public function fixPriority($container_id)
    {

        $entitytype = $this->get_widget_manager()->entityTypeVerification(ValidEntityTypes::SOURCE);
        $metadatatype = $this->get_widget_manager()->metadataTypeVerification(ValidMetadataTypes::DASHBOARDSOURCE_PRIORITY);

        $strat = new TC_THOR_GetSourcesForUserDashboardView_GetRepo();
        return $strat->fixPriority($container_id, $entitytype, $metadatatype);

    }

    public function swapPriority($container_id,
                                    $metadatarow_id,
                                    $newPriority)
    {
        if(!(is_numeric($container_id) && is_numeric($metadatarow_id) && is_numeric($newPriority)))
        {
            throw new Exception("ints only for swapping priority");
        }

        if($newPriority > MAX_DASHBOARD_WIDGETS_PER_TAB)
        {
            throw new Exception("priority set too high for widget");
        }



        $widgetsDV = $this->get_widget_manager()->get_widgetsMasterQuery();

        $friendlies = $this->get_widget_manager()->get_widgetsMasterQuery()->get_friendlyNames();
        $persistables = $this->get_widget_manager()->get_widgetsMasterQuery()->get_persistableInputCollection();

        $entitytype = $this->get_widget_manager()->entityTypeVerification(ValidEntityTypes::SOURCE);
        $metadatatype = $this->get_widget_manager()->metadataTypeVerification(ValidMetadataTypes::DASHBOARDSOURCE_PRIORITY);

        $persistables[$friendlies['ENTITYTYPES']]->type = $entitytype->type;
        $persistables[$friendlies['METADATATYPES']]->type = $metadatatype->type;
        $persistables[$friendlies['WIDGETS']]->container_id = $container_id;

        $widgetsDV->generateSQL(array(),
                                    array($widgetsDV->encodeColumnForSQL($persistables[$friendlies['METADATA']], 'data') =>
                                        array('direction' => 'ASC', 'cast_type' => 'unsigned')
                                    ),
                                    null
                                    );




        $entity_id_key = $widgetsDV->encodeColumnForSQL($persistables[$friendlies['ENTITIES']],
                                          $persistables[$friendlies['ENTITIES']]->get_keyName());
        $widget_id_key = $widgetsDV->encodeColumnForSQL($persistables[$friendlies['WIDGETS']],
                                          $persistables[$friendlies['WIDGETS']]->get_keyName());
        $metadata_id_key = $widgetsDV->encodeColumnForSQL($persistables[$friendlies['METADATA']],
                                          $persistables[$friendlies['METADATA']]->get_keyName());
        $widget_title_key = $widgetsDV->encodeColumnForSQL($persistables[$friendlies['WIDGETS']],
                                          'title');
        $widget_description_key = $widgetsDV->encodeColumnForSQL($persistables[$friendlies['WIDGETS']],
                                          'description');
        $widget_modeltype_key = $widgetsDV->encodeColumnForSQL($persistables[$friendlies['WIDGETMODELTYPES']],
                                          'type');
        $widget_viewtype_key = $widgetsDV->encodeColumnForSQL($persistables[$friendlies['WIDGETVIEWTYPES']],
                                          'type');
        $widgetparamfields_field_key = $widgetsDV->encodeColumnForSQL($persistables[$friendlies['WIDGETPARAMFIELDS']],
                                          'field');
        $widgetparamfields_value_key = $widgetsDV->encodeColumnForSQL($persistables[$friendlies['WIDGETS_PARAMFIELDS']],
                                          'value');
        $entity_created_date_key = $widgetsDV->encodeColumnForSQL($persistables[$friendlies['ENTITIES']],
                                          'created_date');
        $entity_last_edited_key = $widgetsDV->encodeColumnForSQL($persistables[$friendlies['ENTITIES']],
                                          'last_edited');
        $entity_owner_id_key = $widgetsDV->encodeColumnForSQL($persistables[$friendlies['ENTITIES']],
                                          'owner_id');
        $metadata_data_key = $widgetsDV->encodeColumnForSQL($persistables[$friendlies['METADATA']],
                                          'data');

        $priorArr = array();
        $entityMetaLink = array();
        $widgetsDV->execute();
        while($row = $widgetsDV->read() )
        {
            //$priorArr[$row[$friendlies['METADATA']]->get_keyValue()] = $row[$friendlies['METADATA']]->data;
            $priorArr[$row->$metadata_id_key] = $row->$metadata_data_key;
            $entityMetaLink[$row->$metadata_id_key] = $row->$entity_id_key;
        }


        if(in_array($newPriority, $priorArr))
        {
            $priorArrDupe = $priorArr;
            if(array_diff_assoc($priorArr, array_unique($priorArr)))
            {
                throw new Exception("must fix array first!");
            }
            $oldPriority = $priorArrDupe[$metadatarow_id];
            if($oldPriority > $newPriority)
            {
                foreach($priorArrDupe as $key => $value)
                {
                    if($value >= $newPriority && $value < $oldPriority && $key != $metadatarow_id)
                    {
                        $priorArrDupe[$key] = $value + 1;
                    }
                }
            }
            elseif($oldPriority < $newPriority)
            {
                foreach($priorArrDupe as $key => $value)
                {
                    if($value <= $newPriority && $value > $oldPriority && $key != $metadatarow_id)
                    {
                        $priorArrDupe[$key] = $value - 1;
                    }
                }
            }

            $arrToUpdate = array_diff_assoc($priorArrDupe, $priorArr);
            if($arrToUpdate)
            {
                foreach($arrToUpdate AS $key => $value)
                {

                    $priorityMetadata = new THOR_METADATA_DataBoundSimplePersistable();
                    $priorityMetadata->set_keyValue($key);
                    $priorityMetadata->data = $value;
                    $priorityMetadata->save();
                    $entity = new THOR_ENTITIES_DataBoundSimplePersistable();
                    $entity->set_keyValue($entityMetaLink[$key]);
                    $entity->last_edited = date('Y-m-d H:i:s');
                    $entity->save();

                    //$this->updateMetadata($key, null, null, $value, null);
                }
            }

        }
        $priorityMetadata = new THOR_METADATA_DataBoundSimplePersistable();
        $priorityMetadata->set_keyValue($metadatarow_id);
        $priorityMetadata->data = $newPriority;
        $priorityMetadata->save();
        // $entity = new THOR_ENTITIES_DataBoundSimplePersistable();
        // $entity->set_keyValue($entityMetaLink[$metadatarow_id]);
        // $entity->last_edited = date('Y-m-d H:i:s');
        // $entity->save();
        //$this->updateMetadata($metadatarow_id, null, null, $newPriority, null);

        return true;
    }

    protected function setExtraParams(TC_DashboardSource_EntityModel $entity)
    {

        $model = $entity->get_host();
        $id = $entity->get_host_id();
        $model instanceof TC_THOR_HostModel;
        //add params now
        $params = $model->get_fieldValuePairs();


        foreach($params as $key => $value)
        {

            $field = $this->get_widget_manager()->widgetFieldVerification($key);
            $widgets_paramfields = new TC_THOR_WIDGETS_PARAMFIELDS_DataBoundSimplePersistable();
            $widgets_paramfields->field_id = $field->get_keyValue();
            $widgets_paramfields->widget_id = $id;

            $widgets_paramfields->isPersistableAlreadyRecorded(false, true, array('value'));

            $widgets_paramfields->value = $value;
            $widgets_paramfields->save();

            $entityDB = new THOR_ENTITIES_DataBoundSimplePersistable();
            $entityDB->set_keyValue($entity->get_entity_id());
            $entityDB->last_edited = date('Y-m-d H:i:s');
            $entityDB->save();

        }
        return true;
    }

    public function getMetadataIDForDashboardSourcePriority($entity_id)
    {
        $metadata = new THOR_METADATA_DataBoundSimplePersistable();
        //$metadata->owner_id = $user_id;
        $metadata->entity_id = $entity_id;
        $metadata->is_active = 1;
        $metadatatype_id = $this->metadataTypeVerification(ValidMetadataTypes::DASHBOARDSOURCE_PRIORITY);
        $metadata->type_id = $metadatatype_id;

        if($metadata->isPersistableAlreadyRecorded(false, true, array('data','title','last_edited','created_date','description','owner_id')))
        {
            return $metadata->get_keyValue();
        }
        else
        {
            return false;
        }
        /*
        $metadatatype_id = $this->metadataTypeVerification(ValidMetadataTypes::DASHBOARDSOURCE_PRIORITY);

        $entityFilter = new QueryCondition(DB_NAME.".".pullIndex($this->get_metadata(), 'entity_id'), ValidSQLComparisons::EQUALS, $entity_id);
        ////$this->getEntityTypeFilter(ValidEntityTypes::TAB);
        //$isActive_Filter = new RepoStrategyFilter(DB_NAME.".".pullIndex($this->get_entities(), 'is_active'), ValidSQLComparisons::EQUALS, 1);

        $metadataisActive_Filter = new QueryCondition(DB_NAME.".".pullIndex($this->get_metadata(), 'is_active'), ValidSQLComparisons::EQUALS, 1);
        $priorityFilter = new QueryCondition(DB_NAME.".".pullIndex($this->get_metadata(), 'type_id'), ValidSQLComparisons::EQUALS, $metadatatype_id);
        //$userPriorityFilter = new RepoStrategyFilter(DB_NAME.".".pullIndex($this->get_metadata(), 'owner_id'), ValidSQLComparisons::EQUALS, $caller);

        //$entityFilter->augmentFilter($isActive_Filter, ValidSQLComparisons::AND_);

        $entityFilter->augmentFilter($metadataisActive_Filter, ValidSQLComparisons::AND_);
        $entityFilter->augmentFilter($priorityFilter, ValidSQLComparisons::AND_);
        //$entityFilter->augmentFilter($userPriorityFilter, ValidSQLComparisons::AND_);

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
