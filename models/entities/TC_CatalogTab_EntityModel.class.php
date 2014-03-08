<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TC_CatalogTab_EntityModel
 *
 * @author KottkeDP
 */
class TC_CatalogTab_EntityModel extends THOR_EntityModel{

    protected $tags;
    protected $followers;


    public function __construct($entity_id = null,
                                $host_id = null,
                                THOR_HostModel $host = null,
                                $is_active = null,
                                $created_date = null,
                                $last_edited = null,
                                $owner = null,
                                $tags = array(),
                                $number_of_followers = null,
                                TC_DashboardTab_EntityModel $priorVersion = null) {

        $validMetadataKeys = array(
            'rating',
            ValidMetadataTypes::NUMBER_OF_FOLLOWERS
        );

        $metadata = array();
        parent::__construct($entity_id, $host_id, ValidEntityTypes::TAB, $host, $is_active, $created_date, $last_edited, $owner, $validMetadataKeys, $metadata, $priorVersion);

        $this->set_tags($tags);
        $this->set_number_of_followers($number_of_followers);
    }

    public function get_followers($isCacheOK = true){
        $id = $this->get_entity_id();
        if(!$id)
        {
            return false;
        }
        if(!$isCacheOK || !isset($this->followers))
        {
            $this->followers = TC_Utility::getFollowers($id);
        }


        return $this->followers;
    }

    public function get_follower_count($isCacheOK = true){
        return count($this->get_followers($isCacheOK));
    }

    public function get_tags()
    {
        return $this->tags;
    }

    public function set_tags(array $tags)
    {
        $this->tags = $tags;
    }

    public function add_tag($tag){
        $this->tags[] = $tag;
    }

    public function set_number_of_followers($number){
        $pairs = $this->get_metadata();
        $pairs[ValidMetadataTypes::NUMBER_OF_FOLLOWERS] = $number;
        $this->set_metadata($pairs);
    }

    public function get_number_of_followers(){
        $pairs = $this->get_metadata();
        if(array_key_exists(ValidMetadataTypes::NUMBER_OF_FOLLOWERS, $pairs))
        {
            return $pairs[ValidMetadataTypes::NUMBER_OF_FOLLOWERS];
        }
        else
        {
            return false;
        }
    }



}

?>
