<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MetadataManagerDatabaseStrategy
 *
 * @author KottkeDP
 */
class THOR_MetadataAndTaxonomyDatabaseManager extends THOR_EntityDatabaseManager{

    protected $metadata;
    protected $metadata_fields;
    protected $metadatatypes;
    protected $metadatafields;
    //protected $metadatavalues;

    protected $entities_terms_taxonomies;
    protected $taxonomies;
    protected $terms;
    protected $terms_taxonomies;
    //protected $taxonomytypes;
    //protected $taxonomies_taxonomygroups;
    //protected $taxonomygroups;

    protected $metadata_link;
    protected $metadatatypes_link;
    protected $metadata_fields_link;
    protected $metadatafields_link;
    //protected $metadatavalues_link;

    //protected $entities_taxonomies_link;
    //protected $taxonomies_link;
    //protected $terms_link;
    //protected $taxonomytypes_link;
    //protected $taxonomies_taxonomygroups_link;
    //protected $taxonomygroups_link;

    protected $metadataMasterQuery;
    protected $taxonomyMasterQuery;
    protected $metadataAndTaxonomyMasterQuery;

    public function __construct($dataSource = null) {
        parent::__construct($dataSource);
    }

     public function get_metadata() {
        if(!isset($this->metadata))
        {
            $this->metadata = new THOR_METADATA_DataBoundSimplePersistable();//unserialize(METADATA_DB_TABLEFIELDS);
            $this->metadata->is_active = 1;
        }
        return clone $this->metadata;
    }

    public function get_metadata_fields() {
        if(!isset($this->metadata_fields))
        {
            $this->metadata_fields = new THOR_METADATA_FIELDS_DataBoundSimplePersistable();//unserialize(METADATA_FIELDS_DB_TABLEFIELDS);
        }
        return clone $this->metadata_fields;
    }

    public function get_metadatatypes() {
        if(!isset($this->metadatatypes))
        {
            $this->metadatatypes = new THOR_METADATATYPES_DataBoundSimplePersistable();//unserialize(METADATATYPES_DB_TABLEFIELDS);
        }
        return clone $this->metadatatypes;
    }

    public function get_metadatafields() {
        if(!isset($this->metadatafields))
        {
            $this->metadatafields = new THOR_METADATAFIELDS_DataBoundSimplePersistable();//unserialize(METADATAFIELDS_DB_TABLEFIELDS);
        }
        return clone $this->metadatafields;
    }


    public function get_entities_terms_taxonomies() {
        if(!isset($this->entities_terms_taxonomies))
        {
            $this->entities_terms_taxonomies = new THOR_ENTITIES_TERMS_TAXONOMIES_DataBoundSimplePersistable();//unserialize(METADATA_DB_TABLEFIELDS);
            //$this->entities_terms_taxonomies->is_active = 1;
        }
        return clone $this->entities_terms_taxonomies;
        //return $this->taxonomies;
    }

    public function get_terms_taxonomies() {
        if(!isset($this->terms_taxonomies))
        {
            $this->terms_taxonomies = new THOR_TERMS_TAXONOMIES_DataBoundSimplePersistable();//unserialize(METADATA_DB_TABLEFIELDS);
            //$this->terms_taxonomies->is_active = 1;
        }
        return clone $this->terms_taxonomies;
        //return $this->taxonomies;
    }

    public function get_taxonomies() {
        if(!isset($this->taxonomies))
        {
            $this->taxonomies = new THOR_TAXONOMIES_DataBoundSimplePersistable();//unserialize(METADATA_DB_TABLEFIELDS);
            // $this->taxonomies->is_active = 1;
        }
        return clone $this->taxonomies;
        //return $this->taxonomies;
    }

    public function get_terms() {
        if(!isset($this->terms))
        {
            $this->terms = new THOR_TERMS_DataBoundSimplePersistable();//unserialize(METADATA_DB_TABLEFIELDS);
            //$this->terms->is_active = 1;
        }
        return clone $this->terms;
        //return $this->terms;
    }



    public function get_metadatatypes_link() {
        if(!isset($this->metadatatypes_link))
        {
            $this->metadatatypes_link = new DataViewKeyPair('type_id',
                                                            $this->get_metadata()->getUniqueReferenceKey(),
                                                            $this->get_metadatatypes()->get_keyName(),
                                                            $this->get_metadatatypes()->getUniqueReferenceKey(),
                                                            false);
        }
        return $this->metadatatypes_link;
    }

    public function get_metadata_link() {
        if(!isset($this->metadata_link))
        {
            $this->metadata_link = new DataViewKeyPair('entity_id',
                                                            $this->get_metadata()->getUniqueReferenceKey(),
                                                            $this->get_entities()->get_keyName(),
                                                            $this->get_entities()->getUniqueReferenceKey(),
                                                            false);
        }
        return $this->metadata_link;
    }

    public function get_metadata_fields_link() {
        if(!isset($this->metadata_fields_link))
        {
            $this->metadata_fields_link = new DataViewKeyPair('metadata_id',
                                                            $this->get_metadata_fields()->getUniqueReferenceKey(),
                                                            $this->get_metadata()->get_keyName(),
                                                            $this->get_metadata()->getUniqueReferenceKey(),
                                                            false);
        }
        return $this->metadata_fields_link;
    }

    public function get_metadatafields_link() {
        if(!isset($this->metadatafields_link))
        {
            $this->metadatafields_link = new DataViewKeyPair('field_id',
                                                            $this->get_metadata_fields()->getUniqueReferenceKey(),
                                                            $this->get_metadatafields()->get_keyName(),
                                                            $this->get_metadatafields()->getUniqueReferenceKey(),
                                                            false);
        }
        return $this->metadatafields_link;
    }


    public function get_taxonomies_link() {
        if(!isset($this->taxonomies_link))
        {
            $this->taxonomies_link = new DataViewKeyPair('taxonomy_id',
                                                            $this->get_terms_taxonomies()->getUniqueReferenceKey(),
                                                            $this->get_taxonomies()->get_keyName(),
                                                            $this->get_taxonomies()->getUniqueReferenceKey(),
                                                            false);
        }
        return $this->taxonomies_link;
    }

    public function get_terms_link() {
        if(!isset($this->terms_link))
        {
            $this->terms_link = new DataViewKeyPair('term_id',
                                                            $this->get_terms_taxonomies()->getUniqueReferenceKey(),
                                                            $this->get_terms()->get_keyName(),
                                                            $this->get_terms()->getUniqueReferenceKey(),
                                                            false);
        }
        return $this->terms_link;
    }

    public function get_terms_taxonomies_link() {
        if(!isset($this->terms_taxonomies_link))
        {
            $this->terms_taxonomies_link = new DataViewKeyPair('termtaxonomy_id',
                                                            $this->get_entities_terms_taxonomies()->getUniqueReferenceKey(),
                                                            $this->get_terms_taxonomies()->get_keyName(),
                                                            $this->get_terms_taxonomies()->getUniqueReferenceKey(),
                                                            false);
        }
        return $this->terms_taxonomies_link;
    }

    public function get_entities_terms_taxonomies_link() {
        if(!isset($this->entities_terms_taxonomies_link))
        {
            $this->entities_terms_taxonomies_link = new DataViewKeyPair('entity_id',
                                                            $this->get_entities_terms_taxonomies()->getUniqueReferenceKey(),
                                                            $this->get_entities()->get_keyName(),
                                                            $this->get_entities()->getUniqueReferenceKey(),
                                                            false);
        }
        return $this->entities_terms_taxonomies_link;
    }






    public function get_metadataMasterQuery() {
        if(!isset($this->metadataMasterQuery))
        {
            $view = new THOR_DataView();

            $view->startWeb($this->get_entities(), 'ENTITIES', array(), false);

            $view->addToWeb($this->get_entitytypes(), 'ENTITYTYPES', array($this->get_entitytypes_link()), ValidQueryJoinTypes::INNER, array(), false);
            $view->addToWeb($this->get_metadata(), 'METADATA', array($this->get_metadata_link()), ValidQueryJoinTypes::LEFT, array(), false);

            $view->addToWeb($this->get_metadatatypes(), 'METADATATYPES', array($this->get_metadatatypes_link()), ValidQueryJoinTypes::INNER, array(), false);
            $view->addToWeb($this->get_metadata_fields(), 'METADATA_FIELDS', array($this->get_metadata_fields_link()), ValidQueryJoinTypes::LEFT, array(), false);
            $view->addToWeb($this->get_metadatafields(), 'METADATAFIELDS', array($this->get_metadatafields_link()), ValidQueryJoinTypes::LEFT, array(), false);

            //$view->addToWeb($this->get_entities_terms_taxonomies(), 'ENTITIES_TERMS_TAXONOMIES', array($this->get_entities_terms_taxonomies_link()), ValidQueryJoinTypes::LEFT, array(), false);
            //$view->addToWeb($this->get_terms_taxonomies(), 'TERMS_TAXONOMIES', array($this->get_terms_taxonomies_link()), ValidQueryJoinTypes::LEFT, array(), false);
            //$view->addToWeb($this->get_taxonomies(), 'TAXONOMIES', array($this->get_taxonomies_link()), ValidQueryJoinTypes::LEFT, array(), false);
            //$view->addToWeb($this->get_terms(), 'TERMS', array($this->get_terms_link()), ValidQueryJoinTypes::LEFT, array(), false);



            $this->metadataMasterQuery = $view;
        }
        return clone $this->metadataMasterQuery;

    }

    public function get_taxonomyMasterQuery() {
        if(!isset($this->taxonomyMasterQuery))
        {
            $view = new THOR_DataView();

            $view->startWeb($this->get_entities(), 'ENTITIES', array(), false);

            $view->addToWeb($this->get_entitytypes(), 'ENTITYTYPES', array($this->get_entitytypes_link()), ValidQueryJoinTypes::INNER, array(), false);
            //$view->addToWeb($this->get_metadata(), 'METADATA', array($this->get_metadata_link()), ValidQueryJoinTypes::LEFT, array(), false);

            //$view->addToWeb($this->get_metadatatypes(), 'METADATATYPES', array($this->get_metadatatypes_link()), ValidQueryJoinTypes::INNER, array(), false);
            //$view->addToWeb($this->get_metadata_fields(), 'METADATA_FIELDS', array($this->get_metadata_fields_link()), ValidQueryJoinTypes::LEFT, array(), false);
            //$view->addToWeb($this->get_metadatafields(), 'METADATAFIELDS', array($this->get_metadatafields_link()), ValidQueryJoinTypes::LEFT, array(), false);

            $view->addToWeb($this->get_entities_terms_taxonomies(), 'ENTITIES_TERMS_TAXONOMIES', array($this->get_entities_terms_taxonomies_link()), ValidQueryJoinTypes::LEFT, array(), false);
            $view->addToWeb($this->get_terms_taxonomies(), 'TERMS_TAXONOMIES', array($this->get_terms_taxonomies_link()), ValidQueryJoinTypes::LEFT, array(), false);
            $view->addToWeb($this->get_taxonomies(), 'TAXONOMIES', array($this->get_taxonomies_link()), ValidQueryJoinTypes::LEFT, array(), false);
            $view->addToWeb($this->get_terms(), 'TERMS', array($this->get_terms_link()), ValidQueryJoinTypes::LEFT, array(), false);



            $this->taxonomyMasterQuery = $view;
        }
        return clone $this->taxonomyMasterQuery;

    }


    public function get_metadataAndTaxonomyMasterQuery() {
        if(!isset($this->metadataAndTaxonomyMasterQuery))
        {
            $view = new THOR_DataView();

            $view->startWeb($this->get_entities(), 'ENTITIES', array(), false);

            $view->addToWeb($this->get_entitytypes(), 'ENTITYTYPES', array($this->get_entitytypes_link()), ValidQueryJoinTypes::INNER, array(), false);
            $view->addToWeb($this->get_metadata(), 'METADATA', array($this->get_metadata_link()), ValidQueryJoinTypes::LEFT, array(), false);

            $view->addToWeb($this->get_metadatatypes(), 'METADATATYPES', array($this->get_metadatatypes_link()), ValidQueryJoinTypes::INNER, array(), false);
            $view->addToWeb($this->get_metadata_fields(), 'METADATA_FIELDS', array($this->get_metadata_fields_link()), ValidQueryJoinTypes::LEFT, array(), false);
            $view->addToWeb($this->get_metadatafields(), 'METADATAFIELDS', array($this->get_metadatafields_link()), ValidQueryJoinTypes::LEFT, array(), false);

            $view->addToWeb($this->get_entities_terms_taxonomies(), 'ENTITIES_TERMS_TAXONOMIES', array($this->get_entities_terms_taxonomies_link()), ValidQueryJoinTypes::LEFT, array(), false);
            $view->addToWeb($this->get_terms_taxonomies(), 'TERMS_TAXONOMIES', array($this->get_terms_taxonomies_link()), ValidQueryJoinTypes::LEFT, array(), false);
            $view->addToWeb($this->get_taxonomies(), 'TAXONOMIES', array($this->get_taxonomies_link()), ValidQueryJoinTypes::LEFT, array(), false);
            $view->addToWeb($this->get_terms(), 'TERMS', array($this->get_terms_link()), ValidQueryJoinTypes::LEFT, array(), false);



            $this->metadataAndTaxonomyMasterQuery = $view;
        }
        return clone $this->metadataAndTaxonomyMasterQuery;

    }


    public function taxonomyVerification($taxonomyName){
        $taxonomy = $this->get_taxonomies();
        $taxonomy->name = $taxonomyName;//ValidTaxonomies::TAGS;

        if(!$taxonomy->isPersistableAlreadyRecorded(false, true))
        {
            $taxonomy->save();
        }
        return $taxonomy;

    }

    public function tagTaxonomyVerification(){
        return $this->taxonomyVerification(ValidTaxonomies::TAGS);
    }

    public function termVerification($termName){
        $term = $this->get_terms();
        $term->name = $termName;
        if(!$term->isPersistableAlreadyRecorded(false, true))
        {
            $term->save();
        }
        return $term;
    }

    public function tagInTagTaxonomyVerification($tag){
        $taxonomy = $this->tagTaxonomyVerification();
        $term = $this->termVerification($tag);
        $termTaxonomy = $this->get_terms_taxonomies();
        $termTaxonomy->term_id = $term->get_keyValue();
        $termTaxonomy->taxonomy_id = $taxonomy->get_keyValue();
        if(!$termTaxonomy->isPersistableAlreadyRecorded(false, true))
        {
            $termTaxonomy->save();
        }
        return $termTaxonomy;

    }

    public function addTagToEntity($tag, $entityId, $ownerId = SYSTEM_USER_ID){
        $termTaxonomy = $this->tagInTagTaxonomyVerification($tag);
        $entityTermTaxonomy = $this->get_entities_terms_taxonomies();
        $entityTermTaxonomy->entity_id = $entityId;
        $entityTermTaxonomy->termtaxonomy_id = $termTaxonomy->get_keyValue();

        if(!$entityTermTaxonomy->isPersistableAlreadyRecorded(false, true))
        {
            $entityTermTaxonomy->created_date = date('Y-m-d H:i:s');
            $entityTermTaxonomy->last_edited = date('Y-m-d H:i:s');
            $entityTermTaxonomy->owner_id = $ownerId;
            $entityTermTaxonomy->save();
        }
        return $entityTermTaxonomy;

    }


    public function metadataTypeVerification($metadataType)//$metadataType)
    {

        $type = $this->get_metadatatypes();
        $type->type = $metadataType;

        if(!$type->isPersistableAlreadyRecorded(false, true))
        {
            $type->save();
        }
        return $type;

        /*
        if(
                !isset($params->type)
        )
        {
            throw new Exception('insertMetadata failed on param insert');
        }

        $query = "SELECT ".DB_NAME.".".pullIndex($this->get_metadatatypes(), 'id').
        " FROM ".DB_NAME.".".METADATATYPES.
        " WHERE ".DB_NAME.".".pullIndex($this->get_metadatatypes(), 'type')." = '".$params->type."'"
                ;

        $this->get_dataSource()->query($query);
        $row = $this->get_dataSource()->fetch();

        if($row)
        {
            $metadatatype_id = $row->id;
            //$metadatatype_id = $row->keyValue;
        }
        else
        {
            //insert type row
            $query = "INSERT INTO ".DB_NAME.".".METADATATYPES." (".
            DB_NAME.".".pullIndex($this->get_metadatatypes(), 'type').")".
            " VALUES ('".$metadataType."') "
                ;
            $this->get_dataSource()->query($query);
            $this->get_dataSource()->fetch();
            $metadatatype_id = $this->get_dataSource()->getInsertID();
        }

        return $metadatatype_id;
         *
         */
    }
    /*
    public function termVerification($termName)//$metadataType)
    {

        $term = $this->get_terms();
        $term->term = $termName;

        if(!$term->isPersistableAlreadyRecorded(false, true))
        {
            $term->save();
        }
        return $term;

    }

    public function taxonomyTypeVerification($type)//$metadataType)
    {

        $taxonomytype = $this->get_taxonomytypes();
        $taxonomytype->type = $type;

        if(!$taxonomytype->isPersistableAlreadyRecorded(false, true))
        {
            $taxonomytype->save();
        }
        return $taxonomytype;

    }
    */
    // TODO: add validation methods
    /*
    //used by subclasses only
    //  expects
    //      $entity_id,
    //      $metadatatype_id,
    //      $is_active,
    //      $owner_id,
    //      $title,
    //      $data = null,
    //      $description = null
    public function insertMetadata(THOR_METADATA_DataBoundSimplePersistable $params)
    {
        //extract($params);
        if(
                !isset($params->entity_id) ||
                !isset($params->type_id) ||
                !isset($params->is_active) ||
                !isset($params->owner_id) ||
                !isset($params->title)

        )
        {
            throw new Exception('insertMetadata failed on param insert');
        }
        $query = "INSERT INTO ".DB_NAME.".".METADATA." (".
                DB_NAME.".".pullIndex($this->get_metadata(), 'type_id').", ".
                DB_NAME.".".pullIndex($this->get_metadata(), 'entity_id').", ".
                DB_NAME.".".pullIndex($this->get_metadata(), 'created_date').", ".
                DB_NAME.".".pullIndex($this->get_metadata(), 'last_edited').", ".
                DB_NAME.".".pullIndex($this->get_metadata(), 'owner_id').", ".
                DB_NAME.".".pullIndex($this->get_metadata(), 'is_active').", ".
                DB_NAME.".".pullIndex($this->get_metadata(), 'data').", ".
                DB_NAME.".".pullIndex($this->get_metadata(), 'title').", ".
                DB_NAME.".".pullIndex($this->get_metadata(), 'description')." ".
                ") VALUES (".
                $params->type_id.", ".
                $params->entity_id.", ".
                "'".date('Y-m-d H:i:s')."'".", ".
                "'".date('Y-m-d H:i:s')."'".", ".
                $params->owner_id.", ".
                $params->is_active.", ".
                (isset($params->data) ? "'".$params->data."'" : " NULL ").", ".
                "'".$params->title."'".", ".
                (isset($params->description) ? "'".$params->description."'" : " NULL ")." ".
                ") "
                ;

        $this->get_dataSource()->query($query);
        $this->get_dataSource()->fetch();
        return $this->get_dataSource()->getInsertID();
        //$params->set_keyValue($this->get_dataSource()->getInsertID());
        //return $params;

        //$metadata_id = $this->get_dataSource()->getInsertID();


        //return $params->id;
    }

    //used by subclasses only
    //  expects
    //      $metadata_id,
    //      $is_active = null,
    //      $title = null,
    //      $data = null,
    //      $description = null

    public function updateMetadata(THOR_METADATA_DataBoundSimplePersistable $params)
    {
        //extract($params);
        if(
                !isset($params->get_keyValue())
        )
        {
            throw new Exception('updateMetadata failed on param insert');
        }
        $query = "UPDATE ".DB_NAME.".".METADATA." ".
                " SET ".
                (isset($params->data) ? DB_NAME.".".pullIndex($this->get_metadata(), 'data')." = "."'".$params->data."'".",": "").
                (isset($params->title) ? DB_NAME.".".pullIndex($this->get_metadata(), 'title')." = "."'".$params->title."'" .",": "").
                (isset($params->description) ? DB_NAME.".".pullIndex($this->get_metadata(), 'description')." = "."'".$params->description."'"."," : "").
                (isset($params->is_active) ? DB_NAME.".".pullIndex($this->get_metadata(), 'is_active')." = ".$params->is_active."," : "").
                DB_NAME.".".pullIndex($this->get_metadata(), 'last_edited')." = "."'".date('Y-m-d H:i:s')."'"."";
                ;
        //$query = substr($query, 0, strlen($query) -1);
        $query .= " WHERE ".DB_NAME.".".pullIndex($this->get_metadata(), 'id')." = ".$params->get_keyValue();


        $this->get_dataSource()->query($query);
        $this->get_dataSource()->fetch();
        //$metadata_id = $this->get_dataSource()->getInsertID();

        return $params;
    }


    //used by subclasses only
    public function insertMetadataParam(THOR_METADATA_FIELDS_DataBoundSimplePersistable $params )// $metadata_id, $field_id, $value)
    {
        if(
                !isset($params->metadata_id) ||
                !isset($params->field_id) ||
                !isset($params->value)

        )
        {
            throw new Exception('insertMetadata failed on param insert');
        }
        $query = "INSERT INTO ".DB_NAME.".".METADATA_FIELDS." (".
        DB_NAME.".".pullIndex($this->get_metadata_fields(), 'metadata_id').", ".
        DB_NAME.".".pullIndex($this->get_metadata_fields(), 'field_id').", ".
        DB_NAME.".".pullIndex($this->get_metadata_fields(), 'value').") ".
        " VALUES (".
        "'".$params->metadata_id."'".", ".
        "'".$params->field_id."'".", ".
        "'".$params->value."'"." ".
        ") "
            ;
        $this->get_dataSource()->query($query);
        $this->get_dataSource()->fetch();
        return $this->get_dataSource()->getInsertID();
        //$params->set_keyValue($this->get_dataSource()->getInsertID());
        //return $params;

        //$value_id = $this->get_dataSource()->getInsertID();
        //return $value_id;
    }

    //used by subclasses only
    public function updateMetadataParam(THOR_METADATA_FIELDS_DataBoundSimplePersistable $params)//$param_id, $value)
    {
        if(
                !isset($params->get_keyValue()) ||
                !isset($params->value)

        )
        {
            throw new Exception('insertMetadata failed on param insert');
        }

        //update value row
        $query = "UPDATE ".DB_NAME.".".METADATA_FIELDS." SET ".
        DB_NAME.".".pullIndex($this->get_metadata_fields(), 'value').
        " = '".$params->value."' ".
        " WHERE ".DB_NAME.".".pullIndex($this->get_metadata_fields(), 'id')." = ".$params->get_keyValue()
            ;
        $this->get_dataSource()->query($query);
        $this->get_dataSource()->fetch();
        return $params->get_keyValue();
    }

    public function insertMetadataType(THOR_METADATATYPE_DataBoundSimplePersistable $params)
    {
        if(
                !isset($params->type)
        )
        {
            throw new Exception('insertMetadata failed on param insert');
        }
    }

    //used by subclasses only
    public function metadataTypeVerification(THOR_METADATATYPES_DataBoundSimplePersistable $params)//$metadataType)
    {
        if(
                !isset($params->type)
        )
        {
            throw new Exception('insertMetadata failed on param insert');
        }

        $query = "SELECT ".DB_NAME.".".pullIndex($this->get_metadatatypes(), 'id').
        " FROM ".DB_NAME.".".METADATATYPES.
        " WHERE ".DB_NAME.".".pullIndex($this->get_metadatatypes(), 'type')." = '".$params->type."'"
                ;

        $this->get_dataSource()->query($query);
        $row = $this->get_dataSource()->fetch();

        if($row)
        {
            $metadatatype_id = $row->id;
            //$metadatatype_id = $row->keyValue;
        }
        else
        {
            //insert type row
            $query = "INSERT INTO ".DB_NAME.".".METADATATYPES." (".
            DB_NAME.".".pullIndex($this->get_metadatatypes(), 'type').")".
            " VALUES ('".$metadataType."') "
                ;
            $this->get_dataSource()->query($query);
            $this->get_dataSource()->fetch();
            $metadatatype_id = $this->get_dataSource()->getInsertID();
        }

        return $metadatatype_id;
    }






    public function addMetadataForEntity($entity_id, Metadata $metadata)
    {



    }

    public function updateMetadataForEntity($metadata_id, $metadata)
    {



    }

    public function getMetadataByID($metadata_id)
    {

    }

    public function getMetadataForEntity($entity_id, $metadatatype = null)
    {

    }
    */
            //Add metadata for entity (entity_id, metadata object) void
//Update metadata for entity (metadata_id, metadata object) void
//Return metadata (metadata_id) metadata object
//Return metadata for entity (entity_id, metadata type) array[metadata object]
//Return metadata ids for entity (entity_id, metadata type) array[int]

//Return entities via metadata query (entity modifiers, metadata modifiers, metadata param modifiers, existing entities array) array[entity object]
//Return entity ids via metadata query (entity modifiers, metadata modifiers, metadata param modifiers, existing entity ids array) array[int]


}

?>
