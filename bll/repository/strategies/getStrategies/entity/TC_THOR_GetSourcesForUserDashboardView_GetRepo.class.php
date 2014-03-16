<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TC_THOR_GetSourcesForUserDashboardView_GetRepo
 *
 * @author Dan Kottke
 */
class TC_THOR_GetSourcesForUserDashboardView_GetRepo extends GetStrategy{

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

    public function get(IGetParameterModel $param) {

        $params = $param->get_parameters();
        $options = $param->get_options();
        //expected params
        // - user_id
        // - accessprofile

        //TODO: make these enums
        if(array_key_exists('container_id', $params))
        {
            $container_id = $params['container_id'];
        }
        else
        {
            $container_id = null;
            //throw new Exception("container id is required");
            //$user_id = SYSTEM_USER_ID;
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

        $widgetsDV = $this->get_widget_manager()->get_widgetsMasterQuery();

        $friendlies = $this->get_widget_manager()->get_widgetsMasterQuery()->get_friendlyNames();
        $persistables = $this->get_widget_manager()->get_widgetsMasterQuery()->get_persistableInputCollection();

        $entitytype = $this->get_widget_manager()->entityTypeVerification(ValidEntityTypes::SOURCE);
        $metadatatype = $this->get_widget_manager()->metadataTypeVerification(ValidMetadataTypes::DASHBOARDSOURCE_PRIORITY);

        $persistables[$friendlies['ENTITYTYPES']]->type = $entitytype->type;
        $persistables[$friendlies['METADATATYPES']]->type = $metadatatype->type;
        if(isset($container_id))
        {
            $persistables[$friendlies['WIDGETS']]->container_id = $container_id;
        }
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

        $widgetsDV->generateSQL(array(),
                                    array($widgetsDV->encodeColumnForSQL($persistables[$friendlies['METADATA']], 'data') =>
                                        array('direction' => 'ASC', 'cast_type' => 'unsigned')
                                    ),
                                    null,
                                    $condition
                                    );
        // echo $widgetsDV->get_generatedSQL();
        if(isset($container_id))
        {
            $this->fixPriority($container_id, $entitytype, $metadatatype);
        }
        $widgetObjects = array();
        $widgetIDs = array();

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


        $widgetsDV->execute();

        while($row = $widgetsDV->read())
        {
            if(!in_array($row->$entity_id_key, $widgetIDs))// && array_key_exists($row->entities_x_id, $uac_verified_entities) === true)
            {
                $entity = new TC_DashboardSource_EntityModel($row->$entity_id_key,
                                                            $row->$widget_id_key,
                                                            null,
                                                            1,
                                                            $row->$entity_created_date_key,
                                                            $row->$entity_last_edited_key,
                                                            $row->$entity_owner_id_key,
                                                            $row->$metadata_data_key,
                                                            $row->$metadata_id_key);
                $classType = trim($row->$widget_modeltype_key);
                //$classType .= "_Source";
                $widget = new $classType(trim($row->$widget_title_key));
                if($row->$widget_description_key)
                {
                    $widget->set_description(trim($row->$widget_description_key));
                }
                if($row->$widget_viewtype_key)
                {
                    $widget->set_viewtype(trim($row->$widget_viewtype_key));
                }
                $entity->set_host($widget);

                $widgetIDs[$row->$entity_id_key] = $row->$entity_id_key;
                $widgetObjects[$row->$entity_id_key] = $entity;
            }
            $widget = $widgetObjects[$row->$entity_id_key]->get_host();
            if(in_array( trim($row->$widgetparamfields_field_key), $widget->get_validFields())   )
            {
                $tf = trim($row->$widgetparamfields_field_key);
                $tt = trim($row->$widgetparamfields_value_key);
                $temp = "set_$tf";
                if(method_exists($widget,$temp))
                {
                    $widget->$temp($tt);
                }

            }

        }
        foreach($widgetObjects as $object)
        {
            $object->set_priorVersion(clone $object);

        }
        $param->set_outputCollection($widgetObjects);
        $param->set_outputReferenceIDs($widgetIDs);
        return $param;

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


    public function fixPriority($container_id, $entitytype, $metadatatype)
    {
        $widgetsDV = $this->get_widget_manager()->get_widgetsMasterQuery();

        $friendlies = $this->get_widget_manager()->get_widgetsMasterQuery()->get_friendlyNames();
        $persistables = $this->get_widget_manager()->get_widgetsMasterQuery()->get_persistableInputCollection();


        $persistables[$friendlies['ENTITYTYPES']]->type = $entitytype->type;
        $persistables[$friendlies['METADATATYPES']]->type = $metadatatype->type;
        $persistables[$friendlies['WIDGETS']]->container_id = $container_id;

        $widgetsDV->generateSQL(array(),
                                    array($widgetsDV->encodeColumnForSQL($persistables[$friendlies['METADATA']], 'data') =>
                                        array('direction' => 'ASC', 'cast_type' => 'unsigned')
                                    ),
                                    null
                                    );



        $priorArr = array();
        $entityMetaLink = array();

        $entity_id_key = $widgetsDV->encodeColumnForSQL($persistables[$friendlies['ENTITIES']],
                                          $persistables[$friendlies['ENTITIES']]->get_keyName());
        $metadata_id_key = $widgetsDV->encodeColumnForSQL($persistables[$friendlies['METADATA']],
                                          $persistables[$friendlies['METADATA']]->get_keyName());
        $metadata_data_key = $widgetsDV->encodeColumnForSQL($persistables[$friendlies['METADATA']],
                                          'data');

        $widgetsDV->execute();
        while($row = $widgetsDV->read() )
        {
            $priorArr[$row->$metadata_id_key] = $row->$metadata_data_key;
            $entityMetaLink[$row->$metadata_id_key] = $row->$entity_id_key;
        }

        $priorArrDupe = $priorArr;
        $priorPriority = 0;
        $maxPriority = 0;
        $firstMissingPriority = 1;
        $checkFirstMissing = true;


        $emptySlots = array();
        for($i = 1; $i <= MAX_DASHBOARD_WIDGETS_PER_TAB; $i++)
        {
            if(!in_array($i, $priorArrDupe))
            {
                array_push($emptySlots, $i);
            }
        }

        $unique = array_unique($priorArrDupe);
        $botchedJobs = array_diff_assoc($priorArrDupe, $unique);

        foreach($unique as $key => $value)
        {
            if($value > MAX_DASHBOARD_WIDGETS_PER_TAB || $value < 1)
            {
                $botchedJobs[$key] = $value;
            }
        }

        $arrToUpdate = array();
        foreach($botchedJobs as $key => $value)
        {
            $slot = array_pop($emptySlots);
            if($slot)
            {
                $arrToUpdate[$key] = $slot;
                unset($botchedJobs[$key]);
            }
        }
        if(!empty($arrToUpdate))
        {
            foreach($arrToUpdate AS $key => $value)
            {
                $priorityMetadata = new THOR_METADATA_DataBoundSimplePersistable();

                $priorityMetadata->set_keyValue($key);
                $priorityMetadata->data = $value;
                /*
                $priorityMetadata->data = $maxPriority + 1;
                $priorityMetadata->entity_id = $value;
                $priorityMetadata->owner_id = $user_id;
                $priorityMetadata->created_date = date('Y-m-d H:i:s');
                $priorityMetadata->last_edited = date('Y-m-d H:i:s');
                $priorityMetadata->is_active = 1;
                $priorityMetadata->type_id = $metadatatype->get_keyValue();
                $priorityMetadata->title = ValidMetadataTypes::DASHBOARD_PRIORITY;
                */
                $priorityMetadata->save();
                //$maxPriority++;
                //$value->data =
                $entity = new THOR_ENTITIES_DataBoundSimplePersistable();
                $entity->set_keyValue($entityMetaLink[$key]);
                $entity->last_edited = date('Y-m-d H:i:s');
                $entity->save();

                //$this->updateMetadata($key, null, null, $value, null);

            }
        }
        if(!empty($botchedJobs))
        {
            foreach($botchedJobs AS $key => $value)
            {
                $entity = new THOR_ENTITIES_DataBoundSimplePersistable();
                $entity->set_keyValue($entityMetaLink[$key]);
                $entity->last_edited = date('Y-m-d H:i:s');
                $entity->is_active = 0;
                $entity->save();
                //$this->updateEntity($entityMetaLink[$key], 0);

            }
        }

        $firstMissingPriority = array_pop($emptySlots);
        if(!($firstMissingPriority))
        {
            $firstMissingPriority = MAX_DASHBOARD_WIDGETS_PER_TAB + 1;
        }
        return $firstMissingPriority;

    }

}

?>
