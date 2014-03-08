<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AccessManager
 *
 * @author KottkeDP
 */
class THOR_UserAccessDatabaseManager extends THOR_EntityDatabaseManager {


    //in order of specificity, least to most
    protected $groupUACMasterQuery;
    //protected $userRoleInGroupUACMasterQuery;
    //protected $entityInGroupUACMasterQuery;
    //protected $entityForUserInGroupUACMasterQuery;



    protected $uac_verified_entities;

    protected $entities_accessgroups;
    protected $accessgroups;
    protected $accessgrouptypes;
    protected $users_accessgroups;
    //protected $users_accessgroups_accessprofiles;
    protected $accessgroups_accessprofiles;
    protected $accessgroups_accessgroupmetadatafields;
    protected $accessgroupmetadatafields;
    protected $accessprofiles;
    protected $accesstypes;
    protected $accesscontexts;
    protected $users;
    //protected $entities_accessgroups_accessprofiles;
    //protected $users_accessgroups_entities_accessgroups_accessprofiles;

    protected $entities_accessgroups_link;
    protected $accessgroups_link;
    protected $accessgrouptypes_link;
    protected $users_accessgroups_link;
    //protected $users_accessgroups_accessprofiles_link;
    protected $accessgroups_accessgroupmetadatafields_link;
    protected $accessgroupmetadatafield_link;
    protected $accessgroups_accessprofiles_link;
    protected $accesstypes_link;
    protected $accesscontexts_link;
    protected $users_link;

    protected $entities_accessgroups_from_group_link;
    //protected $entities_accessgroups_accessprofiles_link;

    protected $accessprofiles_link_to_groups;
    //protected $accessprofiles_link_to_members;
    //protected $accessprofiles_link_to_groupentities;
    //protected $accessprofiles_link_to_membergroupentities;

    //protected $users_accessgroups_entities_accessgroups_accessprofiles_link_to_members;
    //protected $users_accessgroups_entities_accessgroups_accessprofiles_link_to_groupentities;





    public function __construct($dataSource = null) {
        parent::__construct($dataSource);
    }



    public function get_entities_accessgroups() {
        if(!isset($this->entities_accessgroups))
        {
            $this->entities_accessgroups = new THOR_ENTITIES_ACCESSGROUPS_DataBoundSimplePersistable();//unserialize(ENTITIES_ACCESSGROUPS_DB_TABLEFIELDS);
            $this->entities_accessgroups->is_active = 1;

        }
        return clone $this->entities_accessgroups;
    }

    public function get_users_accessgroups() {
        if(!isset($this->users_accessgroups))
        {
            $this->users_accessgroups = new THOR_USERS_ACCESSGROUPS_DataBoundSimplePersistable();//unserialize(USERS_ACCESSGROUPS_DB_TABLEFIELDS);
            $this->users_accessgroups->is_active = 1;
        }
        return clone $this->users_accessgroups;
    }

    public function get_accessgroups_accessprofiles() {
        if(!isset($this->accessgroups_accessprofiles))
        {
            $this->accessgroups_accessprofiles = new THOR_ACCESSGROUPS_ACCESSPROFILES_DataBoundSimplePersistable();//unserialize(ACCESSGROUPS_ACCESSPROFILES_DB_TABLEFIELDS);
            $this->accessgroups_accessprofiles->is_active = 1;

        }
        return clone $this->accessgroups_accessprofiles;
    }



    public function get_accessgroups() {
        if(!isset($this->accessgroups))
        {
            $this->accessgroups = new THOR_ACCESSGROUPS_DataBoundSimplePersistable();//unserialize(ACCESSGROUPS_DB_TABLEFIELDS);
            $this->accessgroups->is_active = 1;
        }
        return clone $this->accessgroups;
    }

    public function get_accessgroups_accessgroupmetadatafields() {
        if(!isset($this->accessgroups_accessgroupmetadatafields))
        {
            $this->accessgroups_accessgroupmetadatafields = new THOR_ACCESSGROUPS_ACCESSGROUPMETADATAFIELDS_DataBoundSimplePersistable();//unserialize(ACCESSGROUPS_DB_TABLEFIELDS);
            //$this->accessgroups_accessgroupmetadatafields->is_active = 1;
        }
        return clone $this->accessgroups_accessgroupmetadatafields;
    }

    public function get_accessgroupmetadatafields() {
        if(!isset($this->accessgroupmetadatafields))
        {
            $this->accessgroupmetadatafields = new THOR_ACCESSGROUPMETADATAFIELDS_DataBoundSimplePersistable();//unserialize(ACCESSGROUPS_DB_TABLEFIELDS);
            //$this->accessgroupmetadatafields->is_active = 1;
        }
        return clone $this->accessgroupmetadatafields;
    }

    public function get_accessgrouptypes() {
        if(!isset($this->accessgrouptypes))
        {
            $this->accessgrouptypes = new THOR_ACCESSGROUPTYPES_DataBoundSimplePersistable();//unserialize(ACCESSGROUPTYPES_DB_TABLEFIELDS);
        }
        return clone $this->accessgrouptypes;
    }
    /*
    public function get_users_accessgroups_accessprofiles() {
        if(!isset($this->users_accessgroups_accessprofiles))
        {
            $this->users_accessgroups_accessprofiles = new THOR_USERS_ACCESSGROUPS_ACCESSPROFILES_DataBoundSimplePersistable(); //unserialize(USERS_ACCESSGROUPS_ACCESSPROFILES_DB_TABLEFIELDS);
            $this->users_accessgroups_accessprofiles->is_active = 1;
        }
        return clone $this->users_accessgroups_accessprofiles;
    }
    */
    public function get_accessprofiles() {
        if(!isset($this->accessprofiles))
        {
            $this->accessprofiles = new THOR_ACCESSPROFILES_DataBoundSimplePersistable();//unserialize(ACCESSPROFILES_DB_TABLEFIELDS);
            //$this->accessprofiles->is_active = 1;
        }
        return clone $this->accessprofiles;
    }

    public function get_accesstypes() {
        if(!isset($this->accesstypes))
        {
            $this->accesstypes = new THOR_ACCESSTYPES_DataBoundSimplePersistable();//unserialize(ACCESSTYPES_DB_TABLEFIELDS);
        }
        return clone $this->accesstypes;
    }

    public function get_accesscontexts() {
        if(!isset($this->accesscontexts))
        {
            $this->accesscontexts = new THOR_ACCESSCONTEXTS_DataBoundSimplePersistable();//unserialize(ACCESSCONTEXTS_DB_TABLEFIELDS);
        }
        return clone $this->accesscontexts;
    }

    public function get_users() {
        if(!isset($this->users))
        {
            $this->users = new THOR_USERS_DataBoundSimplePersistable();//unserialize(USERS_DB_TABLEFIELDS);
        }
        return clone $this->users;
    }
    /*
    public function get_entities_accessgroups_accessprofiles() {
        if(!isset($this->entities_accessgroups_accessprofiles))
        {
            $this->entities_accessgroups_accessprofiles = new THOR_ENTITIES_ACCESSGROUPS_ACCESSPROFILES_DataBoundSimplePersistable();//unserialize(ENTITIES_ACCESSGROUPS_ACCESSPROFILES_DB_TABLEFIELDS);
            $this->entities_accessgroups_accessprofiles->is_active = 1;
        }
        return clone $this->entities_accessgroups_accessprofiles;
    }
    */
    /*
    public function get_users_accessgroups_entities_accessgroups_accessprofiles() {
        if(!isset($this->users_accessgroups_entities_accessgroups_accessprofiles))
        {
            $this->users_accessgroups_entities_accessgroups_accessprofiles = new THOR_USERS_ACCESSGROUPS_ENTITIES_ACCESSGROUPS_ACCESSPROFILES_DataBoundSimplePersistable();//unserialize(USERS_ACCESSGROUPS_ENTITIES_ACCESSGROUPS_ACCESSPROFILES_DB_TABLEFIELDS);
            $this->users_accessgroups_entities_accessgroups_accessprofiles->is_active = 1;
        }
        return clone $this->users_accessgroups_entities_accessgroups_accessprofiles;
    }
    */

    public function get_entities_accessgroups_link() {
        if(!isset($this->entities_accessgroups_link))
        {
            $this->entities_accessgroups_link = new DataViewKeyPair('entity_id',
                                                            $this->get_entities_accessgroups()->getUniqueReferenceKey(),
                                                            $this->get_entities()->get_keyName(),
                                                            $this->get_entities()->getUniqueReferenceKey(),
                                                            false);
        }
        return clone $this->entities_accessgroups_link;
    }

    public function get_accessgroups_link() {
        if(!isset($this->accessgroups_link))
        {
            $this->accessgroups_link = new DataViewKeyPair('group_id',
                                                            $this->get_entities_accessgroups()->getUniqueReferenceKey(),
                                                            $this->get_accessgroups()->get_keyName(),
                                                            $this->get_accessgroups()->getUniqueReferenceKey(),
                                                            false);
        }
        return clone $this->accessgroups_link;
    }

    public function get_accessgroups_accessgroupmetadatafields_link() {
        if(!isset($this->accessgroups_accessgroupmetadatafields_link))
        {
            $this->accessgroups_accessgroupmetadatafields_link = new DataViewKeyPair('group_id',
                                                            $this->get_accessgroups_accessgroupmetadatafields()->getUniqueReferenceKey(),
                                                            $this->get_accessgroups()->get_keyName(),
                                                            $this->get_accessgroups()->getUniqueReferenceKey(),
                                                            false);
        }
        return clone $this->accessgroups_accessgroupmetadatafields_link;
    }

    public function get_accessgroupmetadatafields_link() {
        if(!isset($this->accessgroupmetadatafields_link))
        {
            $this->accessgroupmetadatafields_link = new DataViewKeyPair('field_id',
                                                            $this->get_accessgroups_accessgroupmetadatafields()->getUniqueReferenceKey(),
                                                            $this->get_accessgroupmetadatafields()->get_keyName(),
                                                            $this->get_accessgroupmetadatafields()->getUniqueReferenceKey(),
                                                            false);
        }
        return clone $this->accessgroupmetadatafields_link;
    }

    public function get_accessgrouptypes_link() {
        if(!isset($this->accessgrouptypes_link))
        {
            $this->accessgrouptypes_link = new DataViewKeyPair('type_id',
                                                            $this->get_accessgroups()->getUniqueReferenceKey(),
                                                            $this->get_accessgrouptypes()->get_keyName(),
                                                            $this->get_accessgrouptypes()->getUniqueReferenceKey(),
                                                            false);
        }
        return clone $this->accessgrouptypes_link;
    }

    public function get_users_accessgroups_link() {
        if(!isset($this->users_accessgroups_link))
        {
            $this->users_accessgroups_link = new DataViewKeyPair('group_id',
                                                            $this->get_users_accessgroups()->getUniqueReferenceKey(),
                                                            $this->get_accessgroups()->get_keyName(),
                                                            $this->get_accessgroups()->getUniqueReferenceKey(),
                                                            false);
        }
        return clone $this->users_accessgroups_link;
    }
    /*
    public function get_users_accessgroups_accessprofiles_link() {
        if(!isset($this->users_accessgroups_accessprofiles_link))
        {
            $this->users_accessgroups_accessprofiles_link = new DataViewKeyPair('member_id',
                                                            $this->get_users_accessgroups_accessprofiles()->getUniqueReferenceKey(),
                                                            $this->get_users_accessgroups()->get_keyName(),
                                                            $this->get_users_accessgroups()->getUniqueReferenceKey(),
                                                            false);
        }
        return $this->users_accessgroups_accessprofiles_link;
    }
    */
    public function get_accessgroups_accessprofiles_link() {
        if(!isset($this->accessgroups_accessprofiles_link))
        {
            $this->accessgroups_accessprofiles_link = new DataViewKeyPair('group_id',
                                                            $this->get_accessgroups_accessprofiles()->getUniqueReferenceKey(),
                                                            $this->get_accessgroups()->get_keyName(),
                                                            $this->get_accessgroups()->getUniqueReferenceKey(),
                                                            false);
        }
        return clone $this->accessgroups_accessprofiles_link;
    }

    public function get_accesstypes_link() {
        if(!isset($this->accesstypes_link))
        {
            $this->accesstypes_link = new DataViewKeyPair('type_id',
                                                            $this->get_accessprofiles()->getUniqueReferenceKey(),
                                                            $this->get_accesstypes()->get_keyName(),
                                                            $this->get_accesstypes()->getUniqueReferenceKey(),
                                                            false);
        }
        return clone $this->accesstypes_link;
    }

    public function get_accesscontexts_link() {
        if(!isset($this->accesscontexts_link))
        {
            $this->accesscontexts_link = new DataViewKeyPair('context_id',
                                                            $this->get_accessprofiles()->getUniqueReferenceKey(),
                                                            $this->get_accesscontexts()->get_keyName(),
                                                            $this->get_accesscontexts()->getUniqueReferenceKey(),
                                                            false);
        }
        return clone $this->accesscontexts_link;
    }

    public function get_users_link() {
        if(!isset($this->users_link))
        {
            $this->users_link = new DataViewKeyPair('user_id',
                                                            $this->get_users_accessgroups()->getUniqueReferenceKey(),
                                                            $this->get_users()->get_keyName(),
                                                            $this->get_users()->getUniqueReferenceKey(),
                                                            false);
        }
        return clone $this->users_link;
    }
    /*
    public function get_entities_accessgroups_accessprofiles_link() {
        if(!isset($this->entities_accessgroups_accessprofiles_link))
        {
            $this->entities_accessgroups_accessprofiles_link = new DataViewKeyPair('groupentity_id',
                                                            $this->get_entities_accessgroups_accessprofiles()->getUniqueReferenceKey(),
                                                            $this->get_entities_accessgroups()->get_keyName(),
                                                            $this->get_entities_accessgroups()->getUniqueReferenceKey(),
                                                            false);
        }
        return $this->entities_accessgroups_accessprofiles_link;
    }
    */
    public function get_accessprofiles_link_to_groups() {
        if(!isset($this->accessprofiles_link_to_groups))
        {
            $this->accessprofiles_link_to_groups = new DataViewKeyPair('profile_id',
                                                            $this->get_accessgroups_accessprofiles()->getUniqueReferenceKey(),
                                                            $this->get_accessprofiles()->get_keyName(),
                                                            $this->get_accessprofiles()->getUniqueReferenceKey(),
                                                            false);
        }
        return clone $this->accessprofiles_link_to_groups;
    }


    // not used in master query
    public function get_entities_accessgroups_from_group_link() {
        if(!isset($this->entities_accessgroups_from_group_link))
        {
            $this->entities_accessgroups_from_group_link = new DataViewKeyPair('group_id',
                                                            $this->get_entities_accessgroups()->getUniqueReferenceKey(),
                                                            $this->get_accessgroups()->get_keyName(),
                                                            $this->get_accessgroups()->getUniqueReferenceKey(),
                                                            false);
        }
        return clone $this->entities_accessgroups_from_group_link;
    }

    /*
    public function get_accessprofiles_link_to_members() {
        if(!isset($this->accessprofiles_link_to_members))
        {
            $this->accessprofiles_link_to_members = new DataViewKeyPair('profile_id',
                                                            $this->get_users_accessgroups_accessprofiles()->getUniqueReferenceKey(),
                                                            $this->get_accessprofiles()->get_keyName(),
                                                            $this->get_accessprofiles()->getUniqueReferenceKey(),
                                                            false);
        }
        return $this->accessprofiles_link_to_members;
    }

    public function get_accessprofiles_link_to_groupentities() {
        if(!isset($this->accessprofiles_link_to_groupentities))
        {
            $this->accessprofiles_link_to_groupentities = new DataViewKeyPair('profile_id',
                                                            $this->get_entities_accessgroups_accessprofiles()->getUniqueReferenceKey(),
                                                            $this->get_accessprofiles()->get_keyName(),
                                                            $this->get_accessprofiles()->getUniqueReferenceKey(),
                                                            false);
        }
        return $this->accessprofiles_link_to_groupentities;
    }

    public function get_accessprofiles_link_to_membergroupentities() {
        if(!isset($this->accessprofiles_link_to_membergroupentities))
        {
            $this->accessprofiles_link_to_membergroupentities = new DataViewKeyPair('profile_id',
                                                            $this->get_users_accessgroups_entities_accessgroups_accessprofiles()->getUniqueReferenceKey(),
                                                            $this->get_accessprofiles()->get_keyName(),
                                                            $this->get_accessprofiles()->getUniqueReferenceKey(),
                                                            false);
        }
        return $this->accessprofiles_link_to_membergroupentities;
    }
    */
    /*
    public function get_users_accessgroups_entities_accessgroups_accessprofiles_link_to_members() {
        if(!isset($this->users_accessgroups_entities_accessgroups_accessprofiles_link_to_members))
        {
            $this->users_accessgroups_entities_accessgroups_accessprofiles_link_to_members = new DataViewKeyPair('member_id',
                                                            $this->get_users_accessgroups_entities_accessgroups_accessprofiles()->getUniqueReferenceKey(),
                                                            $this->get_users_accessgroups()->get_keyName(),
                                                            $this->get_users_accessgroups()->getUniqueReferenceKey(),
                                                            false);
        }
        return $this->users_accessgroups_entities_accessgroups_accessprofiles_link_to_members;
    }

    public function get_users_accessgroups_entities_accessgroups_accessprofiles_link_to_groupentities() {
        if(!isset($this->users_accessgroups_entities_accessgroups_accessprofiles_link_to_groupentities))
        {
            $this->users_accessgroups_entities_accessgroups_accessprofiles_link_to_groupentities = new DataViewKeyPair('groupentity_id',
                                                            $this->get_users_accessgroups_entities_accessgroups_accessprofiles()->getUniqueReferenceKey(),
                                                            $this->get_entities_accessgroups()->get_keyName(),
                                                            $this->get_entities_accessgroups()->getUniqueReferenceKey(),
                                                            false);
        }
        return $this->users_accessgroups_entities_accessgroups_accessprofiles_link_to_groupentities;
    }
    */



    /*
    public function get_uac_verified_entities($user_id, AccessProfile $accessProfile, $entitytype_id) {

       return $this->getUACEntityIDs($user_id, $accessProfile, $entitytype_id);

    }

    public function generate_uac_verified_entities($user_id, AccessProfile $accessProfile, $entitytype_id)
    {
        $temp = $user_id . "_" . serialize($accessProfile) . "_" . $entitytype_id;

        if(!isset($this->uac_verified_entities))
        {
            $this->uac_verified_entities = array();
        }

        $this->uac_verified_entities[$temp] = $this->getUACEntityIDs($user_id, $accessProfile, $entitytype_id);

        return $this->uac_verified_entities[$temp];
    }

    public function set_uac_verified_entities($uac_verified_entities, $user_id, AccessProfile $accessProfile, $entitytype_id) {
        $temp = $user_id . "_" . serialize($accessProfile) . "_" . $entitytype_id;
        $this->uac_verified_entities[$temp] = $uac_verified_entities;
    }

      */



    public function get_GroupUACMasterQuery() {
        if(!isset($this->groupUACMasterQuery))
        {
            $view = new THOR_DataView();

            $view->startWeb($this->get_entities(), 'ENTITIES', array(), false);
            $view->addToWeb($this->get_entitytypes(), 'ENTITYTYPES', array($this->get_entitytypes_link()) , ValidQueryJoinTypes::INNER, array(), false);

            $view->addToWeb($this->get_entities_accessgroups(), 'ENTITIES_ACCESSGROUPS', array($this->get_entities_accessgroups_link()) , ValidQueryJoinTypes::INNER, array(), false);
            $view->addToWeb($this->get_accessgroups(), 'ACCESSGROUPS', array($this->get_accessgroups_link()) , ValidQueryJoinTypes::INNER, array(), false);
            $view->addToWeb($this->get_accessgrouptypes(), 'ACCESSGROUPTYPES', array($this->get_accessgrouptypes_link()) , ValidQueryJoinTypes::INNER, array(), false);
            $view->addToWeb($this->get_users_accessgroups(), 'USERS_ACCESSGROUPS', array($this->get_users_accessgroups_link()) , ValidQueryJoinTypes::INNER, array(), false);
            $view->addToWeb($this->get_users(), 'USERS', array($this->get_users_link()) , ValidQueryJoinTypes::INNER, array(), false);
            $view->addToWeb($this->get_accessgroups_accessprofiles(), 'ACCESSGROUPS_ACCESSPROFILES', array($this->get_accessgroups_accessprofiles_link()) , ValidQueryJoinTypes::INNER, array(), false);
            $view->addToWeb($this->get_accessprofiles(), 'ACCESSPROFILES', array($this->get_accessprofiles_link_to_groups()) , ValidQueryJoinTypes::INNER, array(), false);
            $view->addToWeb($this->get_accesstypes(), 'ACCESSTYPES', array($this->get_accesstypes_link()) , ValidQueryJoinTypes::INNER, array(), false);
            $view->addToWeb($this->get_accesscontexts(), 'ACCESSCONTEXTS', array($this->get_accesscontexts_link()) , ValidQueryJoinTypes::INNER, array(), false);
            $view->addToWeb($this->get_accessgroups_accessgroupmetadatafields(), 'ACCESSGROUPS_ACCESSGROUPMETADATAFIELDS', array($this->get_accessgroups_accessgroupmetadatafields_link()) , ValidQueryJoinTypes::LEFT, array(), false);
            $view->addToWeb($this->get_accessgroupmetadatafields(), 'ACCESSGROUPMETADATAFIELDS', array($this->get_accessgroupmetadatafields_link()) , ValidQueryJoinTypes::LEFT, array(), false);

            $this->groupUACMasterQuery = $view;
        }
        return clone $this->groupUACMasterQuery;

    }
    /*
    public function get_UserRoleInGroupUACMasterQuery() {
        if(!isset($this->userRoleInGroupUACMasterQuery))
        {
            $view = new THOR_DataView();

            $view->startWeb($this->get_entities(), 'ENTITIES', array(), false);
            $view->addToWeb($this->get_entitytypes(), 'ENTITYTYPES', array($this->get_entitytypes_link()) , ValidQueryJoinTypes::INNER, array(), false);

            $view->addToWeb($this->get_entities_accessgroups(), 'ENTITIES_ACCESSGROUPS', array($this->get_entities_accessgroups_link()) , ValidQueryJoinTypes::INNER, array(), false);
            $view->addToWeb($this->get_accessgroups(), 'ACCESSGROUPS', array($this->get_accessgroups_link()) , ValidQueryJoinTypes::INNER, array(), false);
            $view->addToWeb($this->get_accessgrouptypes(), 'ACCESSGROUPTYPES', array($this->get_accessgrouptypes_link()) , ValidQueryJoinTypes::INNER, array(), false);
            $view->addToWeb($this->get_users_accessgroups(), 'USERS_ACCESSGROUPS', array($this->get_users_accessgroups_link()) , ValidQueryJoinTypes::INNER, array(), false);
            $view->addToWeb($this->get_users(), 'USERS', array($this->get_users_link()) , ValidQueryJoinTypes::INNER, array(), false);
            $view->addToWeb($this->get_users_accessgroups_accessprofiles(), 'USERS_ACCESSGROUPS_ACCESSPROFILES', array($this->get_users_accessgroups_accessprofiles_link()) , ValidQueryJoinTypes::INNER, array(), false);
            $view->addToWeb($this->get_accessprofiles(), 'ACCESSPROFILES', array($this->get_accessprofiles_link_to_members()) , ValidQueryJoinTypes::INNER, array(), false);
            $view->addToWeb($this->get_accesstypes(), 'ACCESSTYPES', array($this->get_accesstypes_link()) , ValidQueryJoinTypes::INNER, array(), false);
            $view->addToWeb($this->get_accesscontexts(), 'ACCESSCONTEXTS', array($this->get_accesscontexts_link()) , ValidQueryJoinTypes::INNER, array(), false);

            $this->userRoleInGroupUACMasterQuery = $view;
        }
        return clone $this->userRoleInGroupUACMasterQuery;
    }



    public function get_EntityInGroupUACMasterQuery()
    {
        if(!isset($this->entityInGroupUACMasterQuery))
        {
            $view = new THOR_DataView();

            $view->startWeb($this->get_entities(), 'ENTITIES', array(), false);
            $view->addToWeb($this->get_entitytypes(), 'ENTITYTYPES', array($this->get_entitytypes_link()) , ValidQueryJoinTypes::INNER, array(), false);

            $view->addToWeb($this->get_entities_accessgroups(), 'ENTITIES_ACCESSGROUPS', array($this->get_entities_accessgroups_link()) , ValidQueryJoinTypes::INNER, array(), false);
            $view->addToWeb($this->get_accessgroups(), 'ACCESSGROUPS', array($this->get_accessgroups_link()) , ValidQueryJoinTypes::INNER, array(), false);
            $view->addToWeb($this->get_accessgrouptypes(), 'ACCESSGROUPTYPES', array($this->get_accessgrouptypes_link()) , ValidQueryJoinTypes::INNER, array(), false);
            $view->addToWeb($this->get_users_accessgroups(), 'USERS_ACCESSGROUPS', array($this->get_users_accessgroups_link()) , ValidQueryJoinTypes::INNER, array(), false);
            $view->addToWeb($this->get_users(), 'USERS', array($this->get_users_link()) , ValidQueryJoinTypes::INNER, array(), false);
            $view->addToWeb($this->get_entities_accessgroups_accessprofiles(), 'ENTITIES_ACCESSGROUPS_ACCESSPROFILES', array($this->get_entities_accessgroups_accessprofiles_link()) , ValidQueryJoinTypes::INNER, array(), false);
            $view->addToWeb($this->get_accessprofiles(), 'ACCESSPROFILES', array($this->get_accessprofiles_link_to_groupentities()) , ValidQueryJoinTypes::INNER, array(), false);
            $view->addToWeb($this->get_accesstypes(), 'ACCESSTYPES', array($this->get_accesstypes_link()) , ValidQueryJoinTypes::INNER, array(), false);
            $view->addToWeb($this->get_accesscontexts(), 'ACCESSCONTEXTS', array($this->get_accesscontexts_link()) , ValidQueryJoinTypes::INNER, array(), false);

            $this->entityInGroupUACMasterQuery = $view;
        }
        return clone $this->entityInGroupUACMasterQuery;
    }

    public function get_EntityForUserInGroupUACMasterQuery()
    {
        if(!isset($this->entityForUserInGroupUACMasterQuery))
        {

            $view = new THOR_DataView();

            $view->startWeb($this->get_entities(), 'ENTITIES', array(), false);
            $view->addToWeb($this->get_entitytypes(), 'ENTITYTYPES', array($this->get_entitytypes_link()) , ValidQueryJoinTypes::INNER, array(), false);

            $view->addToWeb($this->get_entities_accessgroups(), 'ENTITIES_ACCESSGROUPS', array($this->get_entities_accessgroups_link()) , ValidQueryJoinTypes::INNER, array(), false);
            $view->addToWeb($this->get_accessgroups(), 'ACCESSGROUPS', array($this->get_accessgroups_link()) , ValidQueryJoinTypes::INNER, array(), false);
            $view->addToWeb($this->get_accessgrouptypes(), 'ACCESSGROUPTYPES', array($this->get_accessgrouptypes_link()) , ValidQueryJoinTypes::INNER, array(), false);
            $view->addToWeb($this->get_users_accessgroups(), 'USERS_ACCESSGROUPS', array($this->get_users_accessgroups_link()) , ValidQueryJoinTypes::INNER, array(), false);
            $view->addToWeb($this->get_users(), 'USERS', array($this->get_users_link()) , ValidQueryJoinTypes::INNER, array(), false);
            $view->addToWeb($this->get_users_accessgroups_entities_accessgroups_accessprofiles(), 'USERS_ACCESSGROUPS_ENTITIES_ACCESSGROUPS_ACCESSPROFILES', array($this->get_users_accessgroups_entities_accessgroups_accessprofiles_link_to_groupentities(), $this->get_users_accessgroups_entities_accessgroups_accessprofiles_link_to_members()) , ValidQueryJoinTypes::INNER, array(), false);
            $view->addToWeb($this->get_accessprofiles(), 'ACCESSPROFILES', array($this->get_accessprofiles_link_to_membergroupentities()) , ValidQueryJoinTypes::INNER, array(), false);
            $view->addToWeb($this->get_accesstypes(), 'ACCESSTYPES', array($this->get_accesstypes_link()) , ValidQueryJoinTypes::INNER, array(), false);
            $view->addToWeb($this->get_accesscontexts(), 'ACCESSCONTEXTS', array($this->get_accesscontexts_link()) , ValidQueryJoinTypes::INNER, array(), false);

            $this->entityForUserInGroupUACMasterQuery = $view;

        }
        return clone $this->entityForUserInGroupUACMasterQuery;
    }
    */






    //expects
    //  $id,
    //  $email,
    //  $user_login,
    //  $name

    /*
    public function insertUser($params)
    {
        extract($params);
        if(
                !isset($id) ||
                !isset($email) ||
                !isset($user_login) ||
                !isset($name)

        )
        {
            throw new Exception('insertUser failed on param insert');
        }
        $query = "INSERT INTO ".DB_NAME.".".USERS." (".
        DB_NAME.".".pullIndex($this->get_users(), 'id').", ".
        DB_NAME.".".pullIndex($this->get_users(), 'email').", ".
        DB_NAME.".".pullIndex($this->get_users(), 'user_login').", ".
        DB_NAME.".".pullIndex($this->get_users(), 'name').", ".
        DB_NAME.".".pullIndex($this->get_users(), 'created_date').") ".
        " VALUES (".
        "'".$id."'".", ".
        "'".$email."'".", ".
        "'".$user_login."'".", ".
        "'".$name."'".", ".
        "'".date('Y-m-d H:i:s')."'"." ".
        ") "
            ;
        $this->get_dataSource()->query($query);
        $this->get_dataSource()->fetch();
        $value_id = $this->get_dataSource()->getInsertID();
        return $value_id;
    }
    */
    ////////////////////////
    //need to set group UAC, havent done that yet
    //used by subclasses only
    //expects
    //  $accessgrouptype_id,
    //  $is_active,
    //  $title
    /*
    public function insertAccessGroup($params)
    {
        extract($params);
        if(
                !isset($accessgrouptype_id) ||
                !isset($is_active) ||
                !isset($title)

        )
        {
            throw new Exception('insertAccessGroup failed on param insert');
        }
        $query = "INSERT INTO ".DB_NAME.".".ACCESSGROUPS." (".
                DB_NAME.".".pullIndex($this->get_accessgroups(), 'type_id').", ".
                DB_NAME.".".pullIndex($this->get_accessgroups(), 'is_active').", ".
                DB_NAME.".".pullIndex($this->get_accessgroups(), 'title')." ".
                ") VALUES (".
                $accessgrouptype_id.", ".
                $is_active.", ".
                "'".$title."'"." ".
                ") "
                ;

        $this->get_dataSource()->query($query);
        $this->get_dataSource()->fetch();
        $accessgroup_id = $this->get_dataSource()->getInsertID();


        return $accessgroup_id;
    }
    */

    //used by subclasses only
    //expects
    //  $accessgroup_id,
    //  $is_active = null,
    //  $title = null
    /*
    public function updateAccessGroup($params)
    {
        extract($params);
        if(
                !isset($accessgroup_id)

        )
        {
            throw new Exception('updateAccessGroup failed on param insert');
        }
        if(!isset($is_active) && !isset($title))
        {
            return false;
        }
        $query = "UPDATE ".DB_NAME.".".ACCESSGROUPS." ".
                " SET ".
                (isset($title) ? DB_NAME.".".pullIndex($this->get_accessgroups(), 'title')." = "."'".$title."'" .",": "").
                (isset($is_active) ? DB_NAME.".".pullIndex($this->get_accessgroups(), 'is_active')." = ".$is_active."," : "")
                ;
        $query = substr($query, 0, strlen($query) -1);
        $query .= " WHERE ".DB_NAME.".".pullIndex($this->get_accessgroups(), 'id')." = ".$accessgroup_id;


        $this->get_dataSource()->query($query);
        $this->get_dataSource()->fetch();
        //$metadata_id = $this->get_dataSource()->getInsertID();

        return $accessgroup_id;
    }
    */

    /*
    //expects $accessContext
    public function insertAccessContext($accessContext)
    {

        //insert type row
            $query = "INSERT INTO ".DB_NAME.".".ACCESSCONTEXTS." (".
            DB_NAME.".".pullIndex($this->get_accesscontexts(), 'title').")".
            " VALUES ('".$accessContext."') "
                ;
            $this->get_dataSource()->query($query);
            $this->get_dataSource()->fetch();
            $accessContext_id = $this->get_dataSource()->getInsertID();
            return $accessContext_id;
    }
    */



    //used by this class only
    public function accessContextVerification(AccessProfile $accessProfile)
    {
        //generic accessContext verification and insertion/selection subroutine

        $context = $this->get_accesscontexts();
        $context->title = $accessProfile->get_accessContext();
        if(!$context->isPersistableAlreadyRecorded(false, true))
        {
            $context->save();
        }
        return $context;
    }

    /*
    //expects $accessType
    public function insertAccessType($accessType)
    {

        //insert type row
            $query = "INSERT INTO ".DB_NAME.".".ACCESSTYPES." (".
            DB_NAME.".".pullIndex($this->get_accesstypes(), 'type').")".
            " VALUES ('".$accessType."') "
                ;
            $this->get_dataSource()->query($query);
            $this->get_dataSource()->fetch();
            $accessType_id = $this->get_dataSource()->getInsertID();
            return $accessType_id;
    }
    */


    //used by this class only
    public function accessTypeVerification(AccessProfile $accessProfile)
    {
        //generic accessType verification and insertion/selection subroutine
        $type = $this->get_accesstypes();
        $type->type = $accessProfile->get_accessType();

        if(!$type->isPersistableAlreadyRecorded(false, true))
        {
            $type->save();
        }
        return $type;

    }

    //expects
    //  $title,
    //  $accessContext_id,
    //  $accessType_id,
    //  $level
    /*
    public function insertAccessProfile($params)
    {
        extract($params);
        if(
                !isset($title) ||
                !isset($accessContext_id) ||
                !isset($accessType_id) ||
                !isset($level)
        )
        {
            throw new Exception('insertAccessProfile failed on param insert');
        }
        //insert type row
        $query = "INSERT INTO ".DB_NAME.".".ACCESSPROFILES." (".
        DB_NAME.".".pullIndex($this->get_accessprofiles(), 'type_id').",".
        DB_NAME.".".pullIndex($this->get_accessprofiles(), 'context_id').",".
        DB_NAME.".".pullIndex($this->get_accessprofiles(), 'level').",".
        DB_NAME.".".pullIndex($this->get_accessprofiles(), 'title').")".
        " VALUES ('".$accessType_id."',".
        "'".$accessContext_id."',".
        $level.",".
        "'".$title."') "
        ;

        $this->get_dataSource()->query($query);
        $this->get_dataSource()->fetch();
        $accessProfile_id = $this->get_dataSource()->getInsertID();
        return $accessProfile_id;
    }
    */


    //used by this class only
    public function accessProfileVerification(AccessProfile $accessProfile)
    {

        $accessContext = $this->accessContextVerification($accessProfile);
        $accessType = $this->accessTypeVerification($accessProfile);

        $profile = $this->get_accessprofiles();
        $profile->type_id = $accessType->get_keyValue();
        $profile->context_id = $accessContext->get_keyValue();
        $profile->level = $accessProfile->get_accessLevel();
        //var_dump($profile);
        if(!$profile->isPersistableAlreadyRecorded(false, true, array('title')))
        {
            $profile->title = $accessProfile->get_title();
            $profile->save();
        }
        return $profile;

        /*
        $query = "SELECT ".DB_NAME.".".pullIndex($this->get_accessprofiles(), 'id').
        " FROM ".DB_NAME.".".ACCESSPROFILES.
        " WHERE ".DB_NAME.".".pullIndex($this->get_accessprofiles(), 'type_id')." = '".$accessType_id."'".
        " AND ".DB_NAME.".".pullIndex($this->get_accessprofiles(), 'context_id')." = '".$accessContext_id."'"
        ;
        $temp = "'".$accessProfile->get_accessLevel()."'";

        $query .= " AND ".DB_NAME.".".pullIndex($this->get_accessprofiles(), 'level')." = ".$temp;

        $this->get_dataSource()->query($query);
        $row = $this->get_dataSource()->fetch();

        if($row)
        {
            $accessProfile_id = $row->keyValue;
        }
        else
        {
            $accessProfile_id = $this->insertAccessProfile(array(
                                        'accessType_id' => $accessType_id,
                                        'title' => $accessProfile->get_title(),
                                        'accessContext_id' => $accessContext_id,
                                        'level' => $temp
                                ));
        }

        return $accessProfile_id;
         *
         */
    }


    /*
    public function insertAccessGroupType($accessgrouptype)
    {
        //insert type row
        $query = "INSERT INTO ".DB_NAME.".".ACCESSGROUPTYPES." (".
        DB_NAME.".".pullIndex($this->get_accessgrouptypes(), 'type').
        ") VALUES ('".$accessgrouptype."') "
            ;
        $this->get_dataSource()->query($query);
        $this->get_dataSource()->fetch();
        $accessgrouptype_id = $this->get_dataSource()->getInsertID();
        return $accessgrouptype_id;
    }
     *
     */
    //used by this class only
    public function accessGroupTypeVerification($accessgrouptype)
    {
        $accessGroupType = $this->get_accessgrouptypes();
        $accessGroupType->type = $accessgrouptype;
        if(!$accessGroupType->isPersistableAlreadyRecorded(false, true))
        {
            $accessGroupType->save();
        }
        return $accessGroupType;
        /*

        $query = "SELECT ".DB_NAME.".".pullIndex($this->get_accessgrouptypes(), 'id').
                " FROM ".DB_NAME.".".ACCESSGROUPTYPES.
                " WHERE ".DB_NAME.".".pullIndex($this->get_accessgrouptypes(), 'type').
                " = '" . $accessgrouptype . "' " ;//substr(get_class($model), 0, strpos(get_class($model), 'Tab'))."' " ;

        $this->get_dataSource()->query($query);
        $row = $this->get_dataSource()->fetch();
        if($row)
        {
            $accessgrouptype_id = $row->keyValue;
        }
        else
        {
            $accessgrouptype_id = $this->insertAccessGroupType($accessgrouptype);


        }
        return $accessgrouptype_id;
        */
    }

    public function accessGroupMetadataFieldVerification($accessgroupmetadatafield)
    {
        $accessGrouMetadataField = $this->get_accessgroupmetadatafields();
        $accessGrouMetadataField->field = $accessgroupmetadatafield;
        if(!$accessGrouMetadataField->isPersistableAlreadyRecorded(false, true))
        {
            $accessGrouMetadataField->save();
        }
        return $accessGrouMetadataField;

    }
    /*
    public function accessGroupMetadataVerification(THOR_AccessGroupMetadata $accessGroupMetadata)
    {
        $field = $accessGroupMetadata->get_field();
        $metadataField = $this->accessGroupMetadataFieldVerification($field);
        $ag_agm = $this->get_accessgroups_accessgroupmetadatafields();
        $ag_agm->field_id = $metadataField->get_keyValue();


        if(!$ag_agm->isPersistableAlreadyRecorded(false, true, array('value')))
        {
            $ag_agm->value = $accessGroupMetadata->get_value();
            $ag_agm->save();
        }
        return $ag_agm;
    }
    */

    public function userVerification($user_id, $email = null, $login = null, $name = null)
    {
        $user = $this->get_users();
        $user->set_keyValue($user_id);

        $match = $user->isPersistableAlreadyRecorded(true, false, array('email', 'user_login', 'name', 'created_date'));

        if(!$match)
        {
            $user->set_keyValue(null);
            $user->id = $user_id;
            $user->email = $email;
            $user->user_login = $login;
            $user->name = $name;
            $user->created_date = date('Y-m-d H:i:s');
            $user->save();
            return true;
        }
        return 0;
        // return $user;

        /*
        $user->email = $email;
        $user->login = $login;
        $user->name = $name;


        $query = "SELECT ".DB_NAME.".".pullIndex($this->get_users(), 'id').
                " FROM ".DB_NAME.".".USERS.
                " WHERE ".DB_NAME.".".pullIndex($this->get_users(), 'id').
                " = '" . $user_id . "' " ;//substr(get_class($model), 0, strpos(get_class($model), 'Tab'))."' " ;

        $this->get_dataSource()->query($query);
        $row = $this->get_dataSource()->fetch();
        if($row)
        {
            //$returnMe = true;
        }
        else
        {
            if(!isset($email))
            {
                $email = '';
            }
            if(!isset($login))
            {
                $login = '';
            }
            if(!isset($name))
            {
                $name = '';
            }
            $this->insertUser($user_id, $email, $login, $name);
            return true;

        }
        return 0;
         *
         */
    }

    /*
    public function getEntityTypeFilter($entityType)
    {

        //remove all use of this
        $entitytype_id = $this->entityTypeVerification($entityType);

        $entityFilter = new RepoStrategyFilter(DB_NAME.".".pullIndex($this->get_entitytypes(), 'id'), ValidSQLComparisons::EQUALS, $entitytype_id);
        return $entityFilter;

    }
    */



    /*
    //used by this class only
    //potentially needless, only really verifies that group is active. Group ID should already be known by this point
    public function accessGroupValidation($accessGroup_id)
    {

        $accessGroup = $this->get_accessgroups();
        $accessGroup->type = $accessgrouptype;
        if(!$accessGroup->isPersistableAlreadyRecorded(false, true))
        {
            $accessGroup->save();
        }
        return $accessGroup;


        $query = "SELECT ".DB_NAME.".".pullIndex($this->get_accessgroups(), 'id').
        " FROM ".DB_NAME.".".ACCESSGROUPS.
        " WHERE ".DB_NAME.".".pullIndex($this->get_accessgroups(), 'id')." = '".$accessGroup_id."'".
        " AND ".DB_NAME.".".pullIndex($this->get_accessgroups(), 'is_active')." = '1'"
        ;

        $this->get_dataSource()->query($query);
        $row = $this->get_dataSource()->fetch();

        if($row)
        {
            $accessGroup_id = $row->keyValue;
        }
        else
        {

            return false;
        }
        return $accessGroup_id;
    }
    */

    //used by this class only
    public function userAccessGroupValidation($user_id, $accessGroup_id)
    {
        $users_accessgroups = $this->get_users_accessgroups();
        $users_accessgroups->user_id = $user_id;
        $users_accessgroups->group_id = $accessGroup_id;

        return $this->uacRecurringSetLogic($users_accessgroups);
        /*
        $query = "SELECT ".DB_NAME.".".pullIndex($this->get_users_accessgroups(), 'id').
        " FROM ".DB_NAME.".".USERS_ACCESSGROUPS.
        " WHERE ".DB_NAME.".".pullIndex($this->get_users_accessgroups(), 'user_id')." = '".$user_id."'".
        " AND ".DB_NAME.".".pullIndex($this->get_users_accessgroups(), 'group_id')." = '".$accessGroup_id."'".
        " AND ".DB_NAME.".".pullIndex($this->get_users_accessgroups(), 'is_active')." = '1'"
        ;

        $this->get_dataSource()->query($query);
        $row = $this->get_dataSource()->fetch();

        if($row)
        {
            $member_id = $row->keyValue;
        }
        else
        {

            return false;
        }
        return $member_id;
        */


    }

    public function entityAccessGroupValidation($entity_id, $accessGroup_id)
    {
        $entities_accessgroups = $this->get_entities_accessgroups();
        $entities_accessgroups->entity_id = $entity_id;
        $entities_accessgroups->group_id = $accessGroup_id;

        return $this->uacRecurringSetLogic($entities_accessgroups);



    }
    /*
    public function userEntityAccessGroupValidation($member_id, $groupentity_id, $accessGroup_id)
    {

    }
    */





    protected function uacRecurringSetLogic(IPersistable $paramWithStatus, $additionalIgnoreParams = null)
    {
        if(!isset($additionalIgnoreParams))
        {
            $additionalIgnoreParams = array();
        }
        $priorStatus = $paramWithStatus->is_active;
        $ignoreParams = array_merge($additionalIgnoreParams, array('is_active'));
        $match = $paramWithStatus->isPersistableAlreadyRecorded(false, false, $ignoreParams);
        if($match)
        {
            foreach($additionalIgnoreParams as $param)
            {
                $match->$param = $paramWithStatus->$param;
            }
            if($match->is_active != $priorStatus)
            {
                $match->is_active = $priorStatus;
                //$match = $paramWithStatus;
                //$match->is_active = $paramWithStatus->is_active;
                $match->save();
            }
        }
        else
        {
            if($priorStatus == 1)
            {
                $match = $paramWithStatus;
                $match->save();
            }
        }
        return $match;
        /*
        $set = $paramWithStatus->produceSetFromPropertyMatches(false, array('is_active'));
        if(!empty($set))
        {
            $match = array_pop($set);
            if(!empty($set))
            {
                foreach($set as $bad)
                {
                    $bad->is_active = 0;
                    $bad->save();
                }
            }
            if($match->is_active != $paramWithStatus->is_active)
            {
                $match = $paramWithStatus;
                //$match->is_active = $paramWithStatus->is_active;
                $match->save();
            }
        }
        else
        {
            if($paramWithStatus->is_active == 1)
            {
                $match = $paramWithStatus;
                $match->save();
            }
        }
        return $match;
         *
         */
    }


    //used publically
    public function createAccessGroup($title, $accessgrouptype_id)
    {
        //$accessgrouptype_DB = $this->accessGroupTypeVerification($accessgrouptype);
        $ag = $this->get_accessgroups();
        $ag->title = $title;
        $ag->type_id = $accessgrouptype_id;
        $ag->save();
        return $ag;
        //return $this->insertAccessGroup($accessgrouptype_id, 1, $title);
    }


    //used by this class only
    public function setEntityToAccessGroup($entity_id, $accessGroup_id, $status)
    {
        $entities_accessgroup = $this->get_entities_accessgroups();// new THOR_ENTITIES_ACCESSGROUPS_DataBoundSimplePersistable();
        $entities_accessgroup->entity_id = $entity_id;
        $entities_accessgroup->group_id = $accessGroup_id;
        $entities_accessgroup->is_active = $status;

        return $this->uacRecurringSetLogic($entities_accessgroup);


    }


    //used by this class only
    public function setAccessGroupProfile($accessGroup_id, $accessProfile_id, $status)
    {
        $accessgroups_accessprofile = $this->get_accessgroups_accessprofiles();//new THOR_ACCESSGROUPS_ACCESSPROFILES_DataBoundSimplePersistable();
        $accessgroups_accessprofile->group_id = $accessGroup_id;
        $accessgroups_accessprofile->profile_id = $accessProfile_id;
        $accessgroups_accessprofile->is_active = $status;

        return $this->uacRecurringSetLogic($accessgroups_accessprofile);


    }



    //used by this class only
    public function setUserToAccessGroup($user_id, $accessGroup_id, $status)
    {
        $users_accessgroups = $this->get_users_accessgroups();//new THOR_USERS_ACCESSGROUPS_DataBoundSimplePersistable();
        $users_accessgroups->user_id = $user_id;
        $users_accessgroups->group_id = $accessGroup_id;
        $users_accessgroups->is_active = $status;

        return $this->uacRecurringSetLogic($users_accessgroups);




    }

    public function setAccessGroupMetadataFieldToAccessGroup($accessgroupmetadatafield_id, $accessGroup_id, $value, $status)
    {
        $ag_agmf = $this->get_accessgroups_accessgroupmetadatafields();// new THOR_ENTITIES_ACCESSGROUPS_DataBoundSimplePersistable();
        $ag_agmf->field_id = $accessgroupmetadatafield_id;
        $ag_agmf->group_id = $accessGroup_id;
        $ag_agmf->is_active = $status;
        $ag_agmf->value = $value;

        return $this->uacRecurringSetLogic($ag_agmf, array('value'));

    }

    /*
    //used by this class only
    public function setUserInAccessGroupProfile($member_id, $accessProfile_id, $status)
    {
        $users_accessgroups_accessprofile = $this->get_users_accessgroups_accessprofiles();//new THOR_USERS_ACCESSGROUPS_ACCESSPROFILES_DataBoundSimplePersistable();
        $users_accessgroups_accessprofile->member_id = $member_id;
        $users_accessgroups_accessprofile->profile_id = $accessProfile_id;
        $users_accessgroups_accessprofile->is_active = $status;

        return $this->uacRecurringSetLogic($users_accessgroups_accessprofile);



    }

    public function setEntityInGroupAccessGroupProfile($groupentity_id, $accessProfile_id, $status)
    {
        $entities_accessgroups_accessprofile = $this->get_entities_accessgroups_accessprofiles();//new THOR_ENTITIES_ACCESSGROUPS_ACCESSPROFILES_DataBoundSimplePersistable();
        $entities_accessgroups_accessprofile->groupentity_id = $groupentity_id;
        $entities_accessgroups_accessprofile->profile_id = $accessProfile_id;
        $entities_accessgroups_accessprofile->is_active = $status;

        return $this->uacRecurringSetLogic($entities_accessgroups_accessprofile);
    }

    public function setEntityInGroupForUserAccessGroupProfile($member_id, $groupentity_id, $accessProfile_id, $status)
    {
        $returnMe = $this->get_users_accessgroups_entities_accessgroups_accessprofiles();//new THOR_USERS_ACCESSGROUPS_ENTITIES_ACCESSGROUPS_ACCESSPROFILES_DataBoundSimplePersistable();
        $returnMe->member_id = $member_id;
        $returnMe->groupentity_id = $groupentity_id;
        $returnMe->profile_id = $accessProfile_id;
        $returnMe->is_active = $status;

        return $this->uacRecurringSetLogic($returnMe);
    }
    */



    //used publicly
    public function setEntityToGroupUAC($accessGroup_id, $entity_id, $status)
    {
        return $this->setEntityToAccessGroup($entity_id, $accessGroup_id, $status);
    }

    //used publicly
    //add/remove user to/from group
    public function setUserToGroupUAC($accessGroup_id, $user_id, $status)
    {
        return $this->setUserToAccessGroup($user_id, $accessGroup_id, $status);
    }

    //used publicly
    public function setGroupUAC(AccessProfile $accessProfile, $accessGroup_id, $status)
    {
        $accessProfile_DB = $this->accessProfileVerification($accessProfile);
        return $this->setAccessGroupProfile($accessGroup_id, $accessProfile_DB->get_keyValue(), $status);

    }

    public function setMetadataToGroupUAC($metadatafield_id, $accessGroup_id, $value, $status)
    {
        return $this->setAccessGroupMetadataFieldToAccessGroup($metadatafield_id, $accessGroup_id, $value, $status);
    }

    /*
    //used publicly
    //add/remove rights from user to group
    public function setUserRightsToGroupUAC($accessGroup_id, $user_id, $status, AccessProfile $accessProfile)
    {

        $member = $this->userAccessGroupValidation($user_id, $accessGroup_id);
        if(!$member)
        {
            return false;
        }
        $accessProfile_DB = $this->accessProfileVerification($accessProfile);
        return $this->setUserInAccessGroupProfile($member->get_keyValue(), $accessProfile_DB->get_keyValue(), $status);



    }

    public function setEntityRightsForGroupUAC($accessGroup_id, $entity_id, $status, AccessProfile $accessProfile)
    {
        $groupEntity = $this->entityAccessGroupValidation($entity_id, $accessGroup_id);
        if(!$groupEntity)
        {
            return false;
        }
        $accessProfile_DB = $this->accessProfileVerification($accessProfile);
        return $this->setEntityInGroupAccessGroupProfile($groupEntity->get_keyValue(), $accessProfile_DB->get_keyValue(), $status);
    }

    public function setMemberFightsForEntityInGroupUAC($accessGroup_id, $entity_id, $user_id, $status, AccessProfile $accessProfile)
    {
        $member = $this->userAccessGroupValidation($user_id, $accessGroup_id);
        if(!$member)
        {
            return false;
        }
        $groupEntity = $this->entityAccessGroupValidation($entity_id, $accessGroup_id);
        if(!$groupEntity)
        {
            return false;
        }
        $accessProfile_DB = $this->accessProfileVerification($accessProfile);
        return $this->setEntityInGroupForUserAccessGroupProfile($member->get_keyValue(), $groupEntity->get_keyValue(), $accessProfile_DB->get_keyValue(), $status);
    }
    */

    //get groups containing entity by group type


    public function getAllUsersAssociatedWithEntitiesInGroup(AccessProfile $accessProfile, $accessGroup_id){
        //find list of entities in access group
        //compile ID list of these entities


        // $dv = new THOR_DataView();

        // $users_accessgroups = $this->get_users_accessgroups();
        // $entities = $this->get_entities();
        // $entities_accessgroups = $this->get_entities_accessgroups();
        // $accessgroups = $this->get_accessgroups();
        // $agap = $this->get_accessgroups_accessprofiles();
        // $ap = $this->get_accessprofiles();


        // $dv->startWeb($users_accessgroups, 'USERS_ACCESSGROUPS');
        // $dv->addToWeb($accessgroups, 'ACCESSGROUPS', array($this->get_accessgroupsl()), ValidQueryJoinTypes::INNER, array(), false);
        // $dv->addToWeb($entities_accessgroups, 'ENTITIES_ACCESSGROUPS', array($this->get_users_accessgroups_link()), ValidQueryJoinTypes::INNER, array(), false);
        // $dv->addToWeb($entities, 'ENTITIES', array($this->get_users_accessgroups_link()), ValidQueryJoinTypes::INNER, array(), false);
        // $dv->addToWeb($agap, 'ACCESSGROUPS_ACCESSPROFILES', array($this->get_users_accessgroups_link()), ValidQueryJoinTypes::INNER, array(), false);
        // $dv->addToWeb($ap, 'ACCESSPROFILES', array($this->get_users_accessgroups_link()), ValidQueryJoinTypes::INNER, array(), false);


        $dvInner = $this->get_GroupUACMasterQuery();
        $persistablesInner = $dvInner->get_persistableInputCollection();
        $friendliesInner = $dvInner->get_friendlyNames();
        // $persistablesInner[$friendliesInner['ENTITIES_ACCESSGROUPS']]->group_id = $accessGroup_id;

        $conditionInner = new QueryConditionComparison(ValidSQLComparisonOperations::EQUALS,
                                                new QueryFreeFormConstant(DB_NAME."."."ACCESSGROUPS".".".$persistablesInner[$friendliesInner['ACCESSGROUPS']]->get_keyName()),
                                                new QueryFreeFormConstant($accessGroup_id));


        $entitiyIdList = array();
        // $memID = $friendliesInner['ENTITIES'];
        $entity_id_key = $dvInner->encodeColumnForSQL($persistablesInner[$friendliesInner['ENTITIES']],
                                          $persistablesInner[$friendliesInner['ENTITIES']]->get_keyName());
        $dvInner->generateSQL(array(), null, null, $conditionInner);

        $dvInner->execute();
        while($row = $dvInner->read())
        {
            if(!in_array($row->$entity_id_key, $entitiyIdList))
                $entitiyIdList[] = $row->$entity_id_key;
            // $entitiyIdList[] = $set[$memID];
        }

        $entityIdStringOuter = implode(',', $entitiyIdList);


        $accessProfile_DB = $this->accessProfileVerification($accessProfile);



        $userIdsArray = array();
        $dvOuter = $this->get_GroupUACMasterQuery();

        $persistablesOuter = $dvOuter->get_persistableInputCollection();
        $friendliesOuter = $dvOuter->get_friendlyNames();

        // $persistablesOuter[$friendliesOuter['ACCESSPROFILES']]->set_keyValue($accessProfile_DB->get_keyValue());



        $user_id_key = $dvOuter->encodeColumnForSQL($persistablesOuter[$friendliesOuter['USERS_ACCESSGROUPS']],
                                          'user_id');

        $conditionOuter = new QueryConditionComparison(ValidSQLComparisonOperations::EQUALS,
                                                new QueryFreeFormConstant(DB_NAME."."."ACCESSPROFILES".".".$persistablesOuter[$friendliesOuter['ACCESSPROFILES']]->get_keyName()),
                                                new QueryFreeFormConstant($accessProfile_DB->get_keyValue()));

        $conditionOuterIn = new QueryConditionComparison(ValidSQLComparisonOperations::EQUALS, 1, 1);
        if($entityIdStringOuter)
        {
        $conditionOuterIn = new QueryConditionComparison(ValidSQLComparisonOperations::IN,
                                                new QueryFreeFormConstant(DB_NAME."."."ENTITIES".".".$persistablesOuter[$friendliesOuter['ENTITIES']]->get_keyName()),
                                                new QueryFreeFormConstant("(".$entityIdStringOuter.")"));
        }
        $conditionOuter = new QueryConditionComparison(ValidSQLComparisonOperations::_AND,
                                                $conditionOuter,
                                                $conditionOuterIn);

        $dvOuter->generateSQL(array(), null, null, $conditionOuter);
        // return $dvOuter->get_generatedSQL();
        $dvOuter->execute();
        while($row = $dvOuter->read())
        {
            if(!in_array($row->$user_id_key, $userIdsArray))
                $userIdsArray[] = $row->$user_id_key;
        }

        return $userIdsArray;


        // SELECT DISTINCT u.id FROM the_current_revised_staging.users as u
        // INNER JOIN the_current_revised_staging.users_accessgroups as ua
        // ON ua.user_id = u.id
        // INNER JOIN the_current_revised_staging.accessgroups as ag
        // ON ag.id = ua.group_id
        // INNER JOIN the_current_revised_staging.entities_accessgroups as ea
        // ON ag.id = ea.group_id
        // INNER JOIN the_current_revised_staging.entities as e
        // ON e.id = ea.entity_id
        // INNER JOIN the_current_revised_staging.accessgroups_accessprofiles as agap
        // ON agap.group_id = ag.id
        // INNER JOIN the_current_revised_staging.accessprofiles as ap
        // ON ap.id = agap.profile_id

        // WHERE

        // e.is_active = 1
        // AND ua.is_active = 1
        // AND ag.is_active = 1
        // AND ea.is_active = 1
        // AND agap.is_active = 1

        // AND ap.id = 1

        // AND e.id IN (
        //     SELECT e1.id FROM the_current_revised_staging.entities as e1
        //     INNER JOIN the_current_revised_staging.entities_accessgroups as ea1
        //     ON e1.id = ea1.entity_id
        //     WHERE e1.is_active = 1
        //     AND ea1.is_active = 1
        //     AND ea1.group_id = 63
        // )

    }

    //used publicly
    public function getAccessGroupsForUserOrEntity($user_id = null, $accessgrouptype_id = null, $entity_id = null, $metadataFieldValuePair = null)
    {
        if(!isset($metadataFieldValuePair))
        {
            $metadataFieldValuePair = array();
        }
        $dv = new THOR_DataView();

        $users_accessgroups = $this->get_users_accessgroups();
        $entities = $this->get_entities();
        $entities_accessgroups = $this->get_entities_accessgroups();
        $accessgroups = $this->get_accessgroups();
        $ag_agmf = $this->get_accessgroups_accessgroupmetadatafields();
        //$accessgrouptypes = clone $this->get_accessgrouptypes();


        if(isset($accessgrouptype_id))
        {
            $accessgroups->type_id = $accessgrouptype_id;
        }
        $dv->startWeb($accessgroups, 'ACCESSGROUPS');
        if(isset($user_id))
        {
            $users_accessgroups->user_id = $user_id;
            $dv->addToWeb($users_accessgroups, 'USERS_ACCESSGROUPS', array($this->get_users_accessgroups_link()), ValidQueryJoinTypes::INNER, array(), false);
        }
        if(isset($entity_id))
        {

            $entities_accessgroups->entity_id = $entity_id;
            $dv->addToWeb($entities_accessgroups, 'ENTITIES_ACCESSGROUPS', array($this->get_entities_accessgroups_from_group_link()), ValidQueryJoinTypes::INNER, array(), false);
        }
        if(!empty($metadataFieldValuePair))
        {
            foreach($metadataFieldValuePair as $field => $value)
            {
                $metadatafield = $this->accessGroupMetadataFieldVerification($field);
                //$ag_agmf->group_id = $accessGroup_id;
                $ag_agmf->field_id = $metadatafield->get_keyValue();
                $ag_agmf->value = $value;
            }
            $dv->addToWeb($ag_agmf, 'ACCESSGROUPS_ACCESSGROUPMETADATAFIELDS', array($this->get_accessgroups_accessgroupmetadatafields_link()) , ValidQueryJoinTypes::INNER, array(), false);
        }
        //$users_accessgroups->is_active = 1;
        //$accessgroups->is_active = 1;




        //$dv->addToWeb($users_accessgroups, 'ACCESSGROUPTYPES', array($this->get_users_accessgroups_link()), ValidQueryJoinTypes::INNER);
        $friendlies = $dv->get_friendlyNames();
        $memID = $friendlies['ACCESSGROUPS'];
        $returnMe = array();

        $dv->generateSQL();
        $dv->execute();
        while($set = $dv->readObjectRow())
        {
            $returnMe[] = $set[$memID];
        }
        return $returnMe;
        /*
        $dv->generate();
        $returnMe = array();
        foreach($dv->get_resultSet() as $set)
        {
            $friendlies = $dv->get_friendlyNames();
            $memID = $friendlies['ACCESSGROUPS'];
            $returnMe[] = $set[$memID];
        }
        return $returnMe;
        */
        /*
        $query = "SELECT ".DB_NAME.".".pullIndex($this->get_users_accessgroups(), 'group_id').
        " FROM ".DB_NAME.".".USERS_ACCESSGROUPS.
        " INNER JOIN ".DB_NAME.".".ACCESSGROUPS.
        " ON ".DB_NAME.".".pullIndex($this->get_users_accessgroups(), 'group_id')." = '".DB_NAME.".".pullIndex($this->get_accessgroups(), 'id').
        " WHERE ".DB_NAME.".".pullIndex($this->get_users_accessgroups(), 'user_id')." = '".$user_id."'".
        " AND ".DB_NAME.".".pullIndex($this->get_users_accessgroups(), 'is_active')." = '1'".
        " AND ".DB_NAME.".".pullIndex($this->get_accessgroups(), 'is_active')." = '1'"
        ;
        $returnMe = array();
        $this->get_dataSource()->query($query);
        while($row = $this->get_dataSource()->fetch())
        {
            $returnMe[$row->group_id] = $row->group_id;
        }

        return $returnMe;
         *
         */
    }
    /*
    public function getCountOfUACEntitiesByGroup($caller, $accessGroup_id, $entitytype_id = null)
    {

    }
    */

    protected function recurringGetLogic($dv,
                                        $user_id,
                                        AccessProfile $accessProfile = null,
                                        $entitytype_id = null,
                                        $accessGroup_id = null,
                                        $entity_id = null //,
                                        //$metadataFieldValuePairs = array()
                                        )
    {
        $persistables = $dv->get_persistableInputCollection();
        $friendlies = $dv->get_friendlyNames();

        $persistables[$friendlies['USERS']]->set_keyValue($user_id);

        if(isset($accessProfile))
        {
            $accessProfile_DB = $this->accessProfileVerification($accessProfile);
            $persistables[$friendlies['ACCESSPROFILES']]->context_id = $accessProfile_DB->context_id;
            $persistables[$friendlies['ACCESSPROFILES']]->type_id = $accessProfile_DB->type_id;
        }
        if(isset($entitytype_id))
        {
            $persistables[$friendlies['ENTITIES']]->type_id = $entitytype_id;
        }
        if(isset($accessGroup_id))
        {
            $persistables[$friendlies['ACCESSGROUPS']]->set_keyValue($accessGroup_id);
            /*
            foreach($metadataFieldValuePairs as $field => $value)
            {
                $metadatafield = $this->accessGroupMetadataFieldVerification($field);
                $persistables[$friendlies['ACCESSGROUPS_ACCESSGROUPMETADATAFIELDS']]->group_id = $accessGroup_id;
                $persistables[$friendlies['ACCESSGROUPS_ACCESSGROUPMETADATAFIELDS']]->field_id = $metadatafield->get_keyValue();
                $persistables[$friendlies['ACCESSGROUPS_ACCESSGROUPMETADATAFIELDS']]->value = $value;
            }
             *
             */
        }
        if(isset($entity_id))
        {
            $persistables[$friendlies['ENTITIES']]->set_keyValue($entity_id);
        }


        return $dv;
    }

    public function getUACEntitiesFromGroupRights($user_id,
                                                AccessProfile $accessProfile = null,
                                                $entitytype_id = null,
                                                $accessGroup_id = null //,
                                                //$metadataFieldValuePairs = array()
                                                )
    {
        $dv = $this->get_GroupUACMasterQuery();
        return $this->recurringGetLogic($dv, $user_id, $accessProfile, $entitytype_id, $accessGroup_id /*, $metadataFieldValuePairs*/ );
    }
    /*
    public function getUACEntitiesFromUserInGroupRights($user_id, AccessProfile $accessProfile, $entitytype_id = null, $accessGroup_id = null)
    {
        $dv = $this->get_UserRoleInGroupUACMasterQuery();
        return $this->recurringGetLogic($dv, $user_id, $accessProfile, $entitytype_id, $accessGroup_id);
    }
    public function getUACEntitiesFromEntityInGroupRights($user_id, AccessProfile $accessProfile, $entity_id = null, $entitytype_id = null, $accessGroup_id = null)
    {
        $dv = $this->get_EntityInGroupUACMasterQuery();
        return $this->recurringGetLogic($dv, $user_id, $accessProfile, $entitytype_id, $accessGroup_id, $entity_id);
    }
    public function getUACEntitiesFromEntityForUserInGroupRights($user_id, AccessProfile $accessProfile, $entity_id = null, $entitytype_id = null, $accessGroup_id = null)
    {
        $dv = $this->get_EntityForUserInGroupUACMasterQuery();
        return $this->recurringGetLogic($dv, $user_id, $accessProfile, $entitytype_id, $accessGroup_id, $entity_id);
    }
    */
    public function getUACEntitiesFromGroupRightsIDs($user_id,
                                                    AccessProfile $accessProfile = null,
                                                    $entitytype_id = null,
                                                    $accessGroup_id = null //,
                                                    //$metadataFieldValuePairs = array()
                                                    )
    {
        $groupUAC = $this->getUACEntitiesFromGroupRights($user_id, $accessProfile, $entitytype_id, $accessGroup_id  /*, $metadataFieldValuePairs*/ );
        $groupUAC->generateSQL();
        // echo $groupUAC->get_generatedSQL();
        return $groupUAC->generateSelectionCollection($groupUAC->encodeColumnForSQL($this->get_entities(), $this->get_entities()->get_keyName()));
    }
    /*
    public function getUACEntitiesFromUserInGroupRightsIDs($user_id, AccessProfile $accessProfile, $entitytype_id = null, $accessGroup_id = null)
    {
        $userUAC = $this->getUACEntitiesFromUserInGroupRights($user_id, $accessProfile, $entitytype_id, $accessGroup_id);
        $userUAC->generateSQL();
        return $userUAC->generateSelectionCollection($userUAC->encodeColumnForSQL($this->get_entities(), $this->get_entities()->get_keyName()));
    }
    public function getUACEntitiesFromEntityInGroupRightsIDs($user_id, AccessProfile $accessProfile, $entity_id = null, $entitytype_id = null, $accessGroup_id = null)
    {
        $entityUAC = $this->getUACEntitiesFromEntityInGroupRights($user_id, $accessProfile, $entity_id, $entitytype_id, $accessGroup_id);
        $entityUAC->generateSQL();
        return $entityUAC->generateSelectionCollection($entityUAC->encodeColumnForSQL($this->get_entities(), $this->get_entities()->get_keyName()));
    }
    public function getUACEntitiesFromEntityForUserInGroupRightsIDs($user_id, AccessProfile $accessProfile, $entity_id = null, $entitytype_id = null, $accessGroup_id = null)
    {
        $userEntityUAC = $this->getUACEntitiesFromEntityForUserInGroupRights($user_id, $accessProfile, $entity_id, $entitytype_id, $accessGroup_id);
        $userEntityUAC->generateSQL();
        return $userEntityUAC->generateSelectionCollection($userEntityUAC->encodeColumnForSQL($this->get_entities(), $this->get_entities()->get_keyName()));
    }
    */
    /*
    public function getUACGlobalIDs($user_id,
                                    AccessProfile $accessProfile,
                                    $entity_id = null,
                                    $entitytype_id = null,
                                    $accessGroup_id = null)
    {

        $massArray = array_merge($this->getUACEntitiesFromGroupRightsIDs($user_id, $accessProfile, $entitytype_id, $accessGroup_id),
                                $this->getUACEntitiesFromUserInGroupRightsIDs($user_id, $accessProfile, $entitytype_id, $accessGroup_id),
                                $this->getUACEntitiesFromEntityInGroupRightsIDs($user_id, $accessProfile, $entity_id, $entitytype_id, $accessGroup_id),
                                $this->getUACEntitiesFromEntityForUserInGroupRightsIDs($user_id, $accessProfile, $entity_id, $entitytype_id, $accessGroup_id));
        $shortenedArray = array_keys(array_flip(
            $massArray
        ));
        $shortenedArray = array_combine($shortenedArray, $shortenedArray);

        return $shortenedArray;

    }
    */



    public function getUACEntitiesFromGroupRightsEntities($user_id,
                                        AccessProfile $accessProfile = null,
                                        $entitytype_id = null,
                                        $accessGroup_id = null //,
                                        //$metadataFieldValuePairs = array()
                                        )
    {
        $groupUAC = $this->getUACEntitiesFromGroupRights($user_id, $accessProfile, $entitytype_id, $accessGroup_id /*, $metadataFieldValuePairs*/ );
        $groupUAC->generateSQL();
        return $groupUAC->generateObjectCollection($groupUAC->getMemIDFromFriendly('ENTITIES'));
        //return $groupUAC->generateSelectionCollection($groupUAC->encodeColumnForSQL($this->get_entities(), $this->get_entities()->get_keyName()));
    }
    /*
    public function getUACEntitiesFromUserInGroupRightsEntities($user_id, AccessProfile $accessProfile, $entitytype_id = null, $accessGroup_id = null)
    {
        $userUAC = $this->getUACEntitiesFromUserInGroupRights($user_id, $accessProfile, $entitytype_id, $accessGroup_id);
        $userUAC->generateSQL();
        return $userUAC->generateObjectCollection($userUAC->getMemIDFromFriendly('ENTITIES'));
        //return $userUAC->generateSelectionCollection($userUAC->encodeColumnForSQL($this->get_entities(), $this->get_entities()->get_keyName()));
    }
    public function getUACEntitiesFromEntityInGroupRightsEntities($user_id, AccessProfile $accessProfile, $entity_id = null, $entitytype_id = null, $accessGroup_id = null)
    {
        $entityUAC = $this->getUACEntitiesFromEntityInGroupRights($user_id, $accessProfile, $entity_id, $entitytype_id, $accessGroup_id);
        $entityUAC->generateSQL();
        return $entityUAC->generateObjectCollection($entityUAC->getMemIDFromFriendly('ENTITIES'));
        //return $entityUAC->generateSelectionCollection($entityUAC->encodeColumnForSQL($this->get_entities(), $this->get_entities()->get_keyName()));
    }
    public function getUACEntitiesFromEntityForUserInGroupRightsEntities($user_id, AccessProfile $accessProfile, $entity_id = null, $entitytype_id = null, $accessGroup_id = null)
    {
        $userEntityUAC = $this->getUACEntitiesFromEntityForUserInGroupRights($user_id, $accessProfile, $entity_id, $entitytype_id, $accessGroup_id);
        $userEntityUAC->generateSQL();
        return $userEntityUAC->generateObjectCollection($userEntityUAC->getMemIDFromFriendly('ENTITIES'));
        //return $userEntityUAC->generateSelectionCollection($userEntityUAC->encodeColumnForSQL($this->get_entities(), $this->get_entities()->get_keyName()));
    }
    */
    /*
    public function getUACGlobalEntities($user_id, AccessProfile $accessProfile, $entity_id = null, $entitytype_id = null, $accessGroup_id = null)
    {
        $massArray = $this->getUACEntitiesFromGroupRightsEntities($user_id, $accessProfile, $entitytype_id, $accessGroup_id) +
                                $this->getUACEntitiesFromUserInGroupRightsEntities($user_id, $accessProfile, $entitytype_id, $accessGroup_id) +
                                $this->getUACEntitiesFromEntityInGroupRightsEntities($user_id, $accessProfile, $entity_id, $entitytype_id, $accessGroup_id) +
                                $this->getUACEntitiesFromEntityForUserInGroupRightsEntities($user_id, $accessProfile, $entity_id, $entitytype_id, $accessGroup_id);

        return $massArray;
    }
    */
    /*
    //used by this class only
    public function getUACEntitiesFilter($caller, AccessProfile $accessProfile, $entitytype_id = null, $accessGroup_id = null, $args = null)
    {
        if(isset($args))
        {
            extract($args);
        }

        $accessProfile_id = $this->accessProfileVerification($accessProfile);

        //generic isActive
        $isActive_Filter = new QueryCondition(DB_NAME.".".pullIndex($this->get_entities(), 'is_active'), ValidSQLComparisons::EQUALS, 1);
        $accessProfile_Filter = new QueryCondition(DB_NAME.".".pullIndex($this->get_accessprofiles(), 'id'), ValidSQLComparisons::EQUALS, $accessProfile_id);
        $user_group_Join = new QueryCondition(DB_NAME.".".pullIndex($this->get_users_accessgroups(), 'user_id'), ValidSQLComparisons::EQUALS, $caller);

        $uacFilter = new QueryCondition($isActive_Filter, ValidSQLComparisons::AND_, $accessProfile_Filter);
        $uacFilter->augmentFilter($user_group_Join, ValidSQLComparisons::AND_);

        if(isset($entitytype_id))
        {
            //$entityType_id = $this->entityTypeVerification($entityType);
            $entityTypeFilter = new QueryCondition(DB_NAME.".".pullIndex($this->get_entities(), 'type_id'), ValidSQLComparisons::EQUALS, $entitytype_id);
            $uacFilter->augmentFilter($entityTypeFilter, ValidSQLComparisons::AND_);
        }

        if(isset($accessGroup_id))
        {
            $group_Filter = new QueryCondition(DB_NAME.".".pullIndex($this->get_accessgroups(), 'id'), ValidSQLComparisons::EQUALS, $accessGroup_id);
            $uacFilter->augmentFilter($group_Filter, ValidSQLComparisons::AND_);
        }

        $entitiesAccessgroups_Filter = new QueryCondition(DB_NAME.".".pullIndex($this->get_entities_accessgroups(), 'is_active'), ValidSQLComparisons::EQUALS, 1);
        $accessgroups_Filter = new QueryCondition(DB_NAME.".".pullIndex($this->get_accessgroups(), 'is_active'), ValidSQLComparisons::EQUALS, 1);
        $usersAccessgroups_Filter = new QueryCondition(DB_NAME.".".pullIndex($this->get_users_accessgroups(), 'is_active'), ValidSQLComparisons::EQUALS, 1);

        $uacFilter->augmentFilter($entitiesAccessgroups_Filter, ValidSQLComparisons::AND_);
        $uacFilter->augmentFilter($accessgroups_Filter, ValidSQLComparisons::AND_);
        $uacFilter->augmentFilter($usersAccessgroups_Filter, ValidSQLComparisons::AND_);

        return $uacFilter;

    }

    //used publically
    public function getUACEntities($caller, AccessProfile $accessProfile, $entitytype_id = null, $accessGroup_id = null, $args = null)
    {
        if(isset($args))
        {
            extract($args);
        }
        //Generic UAC controls
        $uac_verified_entities = array();

        $uacFilter = $this->getUACEntitiesFilter($caller, $accessProfile, $entitytype_id, $accessGroup_id, $args);

        $accessgroupsAccessprofiles_Filter = new QueryCondition(DB_NAME.".".pullIndex($this->get_accessgroups_accessprofiles(), 'is_active'), ValidSQLComparisons::EQUALS, 1);
        $usersAccessgroupsAccessprofiles_Filter = new QueryCondition(DB_NAME.".".pullIndex($this->get_users_accessgroups_accessprofiles(), 'is_active'), ValidSQLComparisons::EQUALS, 1);


        $finalFilter = new QueryCondition($uacFilter, ValidSQLComparisons::AND_, $accessgroupsAccessprofiles_Filter);
        $query = $this->get_GroupUACMasterQuery() . ' WHERE ' . $finalFilter;
        $this->get_dataSource()->query($query);
        while($row = $this->get_dataSource()->fetch())
        {
            $uac_verified_entities[$row->entities_x_id] = $row->entities_x_row_id .'/'. $row->entities_x_type_id;
        }
        $finalFilter = new QueryCondition($uacFilter, ValidSQLComparisons::AND_, $usersAccessgroupsAccessprofiles_Filter);
        $query = $this->get_UserRoleInGroupUACMasterQuery() . ' WHERE ' . $finalFilter;
        $this->get_dataSource()->query($query);
        while($row = $this->get_dataSource()->fetch())
        {
            $uac_verified_entities[$row->entities_x_id] = $row->entities_x_row_id .'/'. $row->entities_x_type_id;
        }

        return $uac_verified_entities;
    }

    //used publically
    public function getUACEntityIDs($caller, AccessProfile $accessProfile, $entitytype_id = null, $accessGroup_id = null, $args = null)
    {
        if(isset($args))
        {
            extract($args);
        }
        //Generic UAC controls
        $uac_verified_entities = array();

        $uacFilter = $this->getUACEntitiesFilter($caller, $accessProfile, $entitytype_id, $accessGroup_id, $args);
        //logError($uacFilter);
        $accessgroupsAccessprofiles_Filter = new QueryCondition(DB_NAME.".".pullIndex($this->get_accessgroups_accessprofiles(), 'is_active'), ValidSQLComparisons::EQUALS, 1);
        $usersAccessgroupsAccessprofiles_Filter = new QueryCondition(DB_NAME.".".pullIndex($this->get_users_accessgroups_accessprofiles(), 'is_active'), ValidSQLComparisons::EQUALS, 1);


        $finalFilter = new QueryCondition($uacFilter, ValidSQLComparisons::AND_, $accessgroupsAccessprofiles_Filter);
        $query = $this->get_GroupUACMasterQuery() . ' WHERE ' . $finalFilter;
        //logError($query);
        $this->get_dataSource()->query($query);
        while($row = $this->get_dataSource()->fetch())
        {
            //logError($row->entities_x_id);
            $uac_verified_entities[$row->entities_x_id] = $row->entities_x_id;
        }
        $finalFilter = new QueryCondition($uacFilter, ValidSQLComparisons::AND_, $usersAccessgroupsAccessprofiles_Filter);
        $query = $this->get_UserRoleInGroupUACMasterQuery() . ' WHERE ' . $finalFilter;
        $this->get_dataSource()->query($query);
        while($row = $this->get_dataSource()->fetch())
        {
            $uac_verified_entities[$row->entities_x_id] = $row->entities_x_id;
        }

        return $uac_verified_entities;
    }
    */


}

?>
