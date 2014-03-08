<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TC_THOR_WidgetDatabaseManager
 *
 * @author KottkeDP
 */
class TC_THOR_WidgetDatabaseManager extends THOR_MetadataAndTaxonomyDatabaseManager{
    protected $widgets;
    protected $widgetmodeltypes;
    protected $widgetviewtypes;
    protected $widgets_paramfields;
    protected $widgetparamfields;

    protected $widgets_link;
    protected $widgetmodeltypes_link;
    protected $widgetviewtypes_link;
    protected $widgets_paramfields_link;
    protected $widgetparamfields_link;

    protected $widgetsMasterQuery;

    public function get_widgets() {
        if(!isset($this->widgets))
        {
            $this->widgets = new TC_THOR_WIDGETS_DataBoundSimplePersistable();//unserialize(METADATA_DB_TABLEFIELDS);

        }
        return clone $this->widgets;
    }

    public function get_widgetmodeltypes() {
        if(!isset($this->widgetmodeltypes))
        {
            $this->widgetmodeltypes = new TC_THOR_WIDGETMODELTYPES_DataBoundSimplePersistable();//unserialize(METADATA_DB_TABLEFIELDS);

        }
        return clone $this->widgetmodeltypes;
    }

    public function get_widgetviewtypes() {
        if(!isset($this->widgetviewtypes))
        {
            $this->widgetviewtypes = new TC_THOR_WIDGETVIEWTYPES_DataBoundSimplePersistable();//unserialize(METADATA_DB_TABLEFIELDS);

        }
        return clone $this->widgetviewtypes;
    }

    public function get_widgets_paramfields() {
        if(!isset($this->widgets_paramfields))
        {
            $this->widgets_paramfields = new TC_THOR_WIDGETS_PARAMFIELDS_DataBoundSimplePersistable();//unserialize(METADATA_DB_TABLEFIELDS);

        }
        return clone $this->widgets_paramfields;
    }

    public function get_widgetparamfields() {
        if(!isset($this->widgetparamfields))
        {
            $this->widgetparamfields = new TC_THOR_WIDGETPARAMFIELDS_DataBoundSimplePersistable();//unserialize(METADATA_DB_TABLEFIELDS);

        }
        return clone $this->widgetparamfields;
    }

    public function get_widgets_link() {
        if(!isset($this->widgets_link))
        {
            $this->widgets_link = new DataViewKeyPair('row_id',
                                                            $this->get_entities()->getUniqueReferenceKey(),
                                                            $this->get_widgets()->get_keyName(),
                                                            $this->get_widgets()->getUniqueReferenceKey(),
                                                            false);
        }
        return $this->widgets_link;
    }

    public function get_widgetmodeltypes_link() {
        if(!isset($this->widgetmodeltypes_link))
        {
            $this->widgetmodeltypes_link = new DataViewKeyPair('modeltype_id',
                                                            $this->get_widgets()->getUniqueReferenceKey(),
                                                            $this->get_widgetmodeltypes()->get_keyName(),
                                                            $this->get_widgetmodeltypes()->getUniqueReferenceKey(),
                                                            false);
        }
        return $this->widgetmodeltypes_link;
    }

    public function get_widgetviewtypes_link() {
        if(!isset($this->widgetviewtypes_link))
        {
            $this->widgetviewtypes_link = new DataViewKeyPair('viewtype_id',
                                                            $this->get_widgets()->getUniqueReferenceKey(),
                                                            $this->get_widgetviewtypes()->get_keyName(),
                                                            $this->get_widgetviewtypes()->getUniqueReferenceKey(),
                                                            false);
        }
        return $this->widgetviewtypes_link;
    }

    public function get_widgets_paramfields_link() {
        if(!isset($this->widgets_paramfields_link))
        {
            $this->widgets_paramfields_link = new DataViewKeyPair('widget_id',
                                                            $this->get_widgets_paramfields()->getUniqueReferenceKey(),
                                                            $this->get_widgets()->get_keyName(),
                                                            $this->get_widgets()->getUniqueReferenceKey(),
                                                            false);
        }
        return $this->widgets_paramfields_link;
    }

    public function get_widgetparamfields_link() {
        if(!isset($this->widgetparamfields_link))
        {
            $this->widgetparamfields_link = new DataViewKeyPair('field_id',
                                                            $this->get_widgets_paramfields()->getUniqueReferenceKey(),
                                                            $this->get_widgetparamfields()->get_keyName(),
                                                            $this->get_widgetparamfields()->getUniqueReferenceKey(),
                                                            false);
        }
        return $this->widgetparamfields_link;
    }

    public function get_widgetsMasterQuery() {
        if(!isset($this->widgetsMasterQuery))
        {

            $view = $this->get_metadataMasterQuery();
            $view instanceof THOR_DataView;
            $entitytypes = $view->getFromPersistableInputCollectionFriendly('ENTITYTYPES');

            //$entitytypes = $this->get_entitytypes();
            $entitytypes->type = "widgets";
            // TODO : check if have to reset entitytypes to datalink here
            $view->addToWeb($this->get_widgets(), 'WIDGETS', array($this->get_widgets_link()), ValidQueryJoinTypes::INNER, array(), false);
            $view->addToWeb($this->get_widgetmodeltypes(), 'WIDGETMODELTYPES', array($this->get_widgetmodeltypes_link()), ValidQueryJoinTypes::INNER, array(), false);
            $view->addToWeb($this->get_widgetviewtypes(), 'WIDGETVIEWTYPES', array($this->get_widgetviewtypes_link()), ValidQueryJoinTypes::INNER, array(), false);
            $view->addToWeb($this->get_widgets_paramfields(), 'WIDGETS_PARAMFIELDS', array($this->get_widgets_paramfields_link()), ValidQueryJoinTypes::LEFT, array(), false);
            $view->addToWeb($this->get_widgetparamfields(), 'WIDGETPARAMFIELDS', array($this->get_widgetparamfields_link()), ValidQueryJoinTypes::LEFT, array(), false);

            /*
            $view->startWeb($this->get_entities(), 'ENTITIES', array(), false);

            $view->addToWeb($entitytypes, 'ENTITYTYPES', array($this->get_entitytypes_link()), ValidQueryJoinTypes::INNER, array(), false);
            $view->addToWeb($this->get_metadata(), 'METADATA', array($this->get_metadata_link()), ValidQueryJoinTypes::INNER, array(), false);

            $view->addToWeb($this->get_metadatatypes(), 'METADATA', array($this->get_metadata_link()), ValidQueryJoinTypes::INNER, array(), false);
            $view->addToWeb($this->get_metadata_fields(), 'METADATA_FIELDS', array($this->get_metadata_fields_link()), ValidQueryJoinTypes::INNER, array(), false);
            $view->addToWeb($this->get_metadatafields(), 'METADATAFIELDS', array($this->get_metadatafields_link()), ValidQueryJoinTypes::INNER, array(), false);
            $view->addToWeb($this->get_metadatavalues(), 'METADATAVALUES', array($this->get_metadatavalues_link()), ValidQueryJoinTypes::INNER, array(), false);
            */

            $this->widgetsMasterQuery = $view;
        }
        return clone $this->widgetsMasterQuery;
    }




    public function widgetModelTypeVerification($wtypeString)
    {
        $type = $this->get_widgetmodeltypes();
        $type->type = $wtypeString;

        if(!$type->isPersistableAlreadyRecorded(false, true))
        {
            $type->save();
        }
        return $type;

    }

    public function widgetViewTypeVerification($wtypeString)
    {
        $type = $this->get_widgetviewtypes();
        $type->type = $wtypeString;

        if(!$type->isPersistableAlreadyRecorded(false, true))
        {
            $type->save();
        }
        return $type;

    }

    public function widgetFieldVerification($wfieldString)
    {
        $field = $this->get_widgetparamfields();
        $field->field = $wfieldString;

        if(!$field->isPersistableAlreadyRecorded(false, true))
        {
            $field->save();
        }
        return $field;

    }
}

?>
