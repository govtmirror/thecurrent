<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TC_THOR_ContainerDatabaseManager
 *
 * @author KottkeDP
 */
class TC_THOR_ContainerDatabaseManager extends THOR_MetadataAndTaxonomyDatabaseManager{
    protected $containers;
    protected $containermodeltypes;
    protected $containerviewtypes;
    protected $containers_paramfields;
    protected $containerparamfields;

    protected $containers_link;
    protected $containermodeltypes_link;
    protected $containerviewtypes_link;
    protected $containers_paramfields_link;
    protected $containerparamfields_link;

    protected $containersMasterQuery;

    public function get_containers() {
        if(!isset($this->containers))
        {
            $this->containers = new TC_THOR_CONTAINERS_DataBoundSimplePersistable();//unserialize(METADATA_DB_TABLEFIELDS);

        }
        return clone $this->containers;
    }

    public function get_containermodeltypes() {
        if(!isset($this->containermodeltypes))
        {
            $this->containermodeltypes = new TC_THOR_CONTAINERMODELTYPES_DataBoundSimplePersistable();//unserialize(METADATA_DB_TABLEFIELDS);

        }
        return clone $this->containermodeltypes;
    }

    public function get_containerviewtypes() {
        if(!isset($this->containerviewtypes))
        {
            $this->containerviewtypes = new TC_THOR_CONTAINERVIEWTYPES_DataBoundSimplePersistable();//unserialize(METADATA_DB_TABLEFIELDS);

        }
        return clone $this->containerviewtypes;
    }

    public function get_containers_paramfields() {
        if(!isset($this->containers_paramfields))
        {
            $this->containers_paramfields = new TC_THOR_CONTAINERS_PARAMFIELDS_DataBoundSimplePersistable();//unserialize(METADATA_DB_TABLEFIELDS);

        }
        return clone $this->containers_paramfields;
    }

    public function get_containerparamfields() {
        if(!isset($this->containerparamfields))
        {
            $this->containerparamfields = new TC_THOR_CONTAINERPARAMFIELDS_DataBoundSimplePersistable();//unserialize(METADATA_DB_TABLEFIELDS);

        }
        return clone $this->containerparamfields;
    }

    public function get_containers_link() {
        if(!isset($this->containers_link))
        {
            $this->containers_link = new DataViewKeyPair('row_id',
                                                            $this->get_entities()->getUniqueReferenceKey(),
                                                            $this->get_containers()->get_keyName(),
                                                            $this->get_containers()->getUniqueReferenceKey(),
                                                            false);
        }
        return $this->containers_link;
    }

    public function get_containermodeltypes_link() {
        if(!isset($this->containermodeltypes_link))
        {
            $this->containermodeltypes_link = new DataViewKeyPair('modeltype_id',
                                                            $this->get_containers()->getUniqueReferenceKey(),
                                                            $this->get_containermodeltypes()->get_keyName(),
                                                            $this->get_containermodeltypes()->getUniqueReferenceKey(),
                                                            false);
        }
        return $this->containermodeltypes_link;
    }

    public function get_containerviewtypes_link() {
        if(!isset($this->containerviewtypes_link))
        {
            $this->containerviewtypes_link = new DataViewKeyPair('viewtype_id',
                                                            $this->get_containers()->getUniqueReferenceKey(),
                                                            $this->get_containerviewtypes()->get_keyName(),
                                                            $this->get_containerviewtypes()->getUniqueReferenceKey(),
                                                            false);
        }
        return $this->containerviewtypes_link;
    }

    public function get_containers_paramfields_link() {
        if(!isset($this->containers_paramfields_link))
        {
            $this->containers_paramfields_link = new DataViewKeyPair('container_id',
                                                            $this->get_containers_paramfields()->getUniqueReferenceKey(),
                                                            $this->get_containers()->get_keyName(),
                                                            $this->get_containers()->getUniqueReferenceKey(),
                                                            false);
        }
        return $this->containers_paramfields_link;
    }

    public function get_containerparamfields_link() {
        if(!isset($this->containerparamfields_link))
        {
            $this->containerparamfields_link = new DataViewKeyPair('field_id',
                                                            $this->get_containers_paramfields()->getUniqueReferenceKey(),
                                                            $this->get_containerparamfields()->get_keyName(),
                                                            $this->get_containerparamfields()->getUniqueReferenceKey(),
                                                            false);
        }
        return $this->containerparamfields_link;
    }

    // TODO : Rename this and refactor
    public function get_containersMasterQuery() {
        if(!isset($this->containersMasterQuery))
        {

            $view = $this->get_metadataMasterQuery();
            $view instanceof THOR_DataView;
            $entitytypes = $view->getFromPersistableInputCollectionFriendly('ENTITYTYPES');

            //$entitytypes = $this->get_entitytypes();
            $entitytypes->type = "containers";
            // TODO : check if have to reset entitytypes to datalink here
            $view->addToWeb($this->get_containers(), 'CONTAINERS', array($this->get_containers_link()), ValidQueryJoinTypes::INNER, array(), false);
            $view->addToWeb($this->get_containermodeltypes(), 'CONTAINERMODELTYPES', array($this->get_containermodeltypes_link()), ValidQueryJoinTypes::INNER, array(), false);
            $view->addToWeb($this->get_containerviewtypes(), 'CONTAINERVIEWTYPES', array($this->get_containerviewtypes_link()), ValidQueryJoinTypes::INNER, array(), false);
            $view->addToWeb($this->get_containers_paramfields(), 'CONTAINERS_PARAMFIELDS', array($this->get_containers_paramfields_link()), ValidQueryJoinTypes::LEFT, array(), false);
            $view->addToWeb($this->get_containerparamfields(), 'CONTAINERPARAMFIELDS', array($this->get_containerparamfields_link()), ValidQueryJoinTypes::LEFT, array(), false);

            /*
            $view->startWeb($this->get_entities(), 'ENTITIES', array(), false);

            $view->addToWeb($entitytypes, 'ENTITYTYPES', array($this->get_entitytypes_link()), ValidQueryJoinTypes::INNER, array(), false);
            $view->addToWeb($this->get_metadata(), 'METADATA', array($this->get_metadata_link()), ValidQueryJoinTypes::INNER, array(), false);

            $view->addToWeb($this->get_metadatatypes(), 'METADATA', array($this->get_metadata_link()), ValidQueryJoinTypes::INNER, array(), false);
            $view->addToWeb($this->get_metadata_fields(), 'METADATA_FIELDS', array($this->get_metadata_fields_link()), ValidQueryJoinTypes::INNER, array(), false);
            $view->addToWeb($this->get_metadatafields(), 'METADATAFIELDS', array($this->get_metadatafields_link()), ValidQueryJoinTypes::INNER, array(), false);
            $view->addToWeb($this->get_metadatavalues(), 'METADATAVALUES', array($this->get_metadatavalues_link()), ValidQueryJoinTypes::INNER, array(), false);
            */

            $this->containersMasterQuery = $view;
        }
        return clone $this->containersMasterQuery;
    }



    public function get_containersMetaAndTaxMasterQuery() {
        if(!isset($this->containersMetaAndTaxMasterQuery))
        {

            $view = $this->get_metadataAndTaxonomyMasterQuery();
            $view instanceof THOR_DataView;
            $entitytypes = $view->getFromPersistableInputCollectionFriendly('ENTITYTYPES');

            //$entitytypes = $this->get_entitytypes();
            $entitytypes->type = "containers";
            // TODO : check if have to reset entitytypes to datalink here
            $view->addToWeb($this->get_containers(), 'CONTAINERS', array($this->get_containers_link()), ValidQueryJoinTypes::INNER, array(), false);
            $view->addToWeb($this->get_containermodeltypes(), 'CONTAINERMODELTYPES', array($this->get_containermodeltypes_link()), ValidQueryJoinTypes::INNER, array(), false);
            $view->addToWeb($this->get_containerviewtypes(), 'CONTAINERVIEWTYPES', array($this->get_containerviewtypes_link()), ValidQueryJoinTypes::INNER, array(), false);
            $view->addToWeb($this->get_containers_paramfields(), 'CONTAINERS_PARAMFIELDS', array($this->get_containers_paramfields_link()), ValidQueryJoinTypes::LEFT, array(), false);
            $view->addToWeb($this->get_containerparamfields(), 'CONTAINERPARAMFIELDS', array($this->get_containerparamfields_link()), ValidQueryJoinTypes::LEFT, array(), false);

            /*
            $view->startWeb($this->get_entities(), 'ENTITIES', array(), false);

            $view->addToWeb($entitytypes, 'ENTITYTYPES', array($this->get_entitytypes_link()), ValidQueryJoinTypes::INNER, array(), false);
            $view->addToWeb($this->get_metadata(), 'METADATA', array($this->get_metadata_link()), ValidQueryJoinTypes::INNER, array(), false);

            $view->addToWeb($this->get_metadatatypes(), 'METADATA', array($this->get_metadata_link()), ValidQueryJoinTypes::INNER, array(), false);
            $view->addToWeb($this->get_metadata_fields(), 'METADATA_FIELDS', array($this->get_metadata_fields_link()), ValidQueryJoinTypes::INNER, array(), false);
            $view->addToWeb($this->get_metadatafields(), 'METADATAFIELDS', array($this->get_metadatafields_link()), ValidQueryJoinTypes::INNER, array(), false);
            $view->addToWeb($this->get_metadatavalues(), 'METADATAVALUES', array($this->get_metadatavalues_link()), ValidQueryJoinTypes::INNER, array(), false);
            */

            $this->containersMetaAndTaxMasterQuery = $view;
        }
        return clone $this->containersMetaAndTaxMasterQuery;
    }


    public function containerModelTypeVerification($ctypeString)
    {
        $type = $this->get_containermodeltypes();
        $type->type = $ctypeString;

        if(!$type->isPersistableAlreadyRecorded(false, true))
        {
            $type->save();
        }
        return $type;

    }

    public function containerViewTypeVerification($ctypeString)
    {
        $type = $this->get_containerviewtypes();
        $type->type = $ctypeString;

        if(!$type->isPersistableAlreadyRecorded(false, true))
        {
            $type->save();
        }
        return $type;

    }

    public function containerFieldVerification($cfieldString)
    {
        $field = $this->get_containerparamfields();
        $field->field = $cfieldString;

        if(!$field->isPersistableAlreadyRecorded(false, true))
        {
            $field->save();
        }
        return $field;

    }



}

?>
