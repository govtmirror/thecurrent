<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TC_DashboardTab_Entity
 *
 * @author KottkeDP
 */
class TC_DashboardTab_EntityModel extends THOR_EntityModel{

    public function __construct($entity_id = null,
                                $host_id = null,
                                THOR_HostModel $host = null,
                                $is_active = null,
                                $created_date = null,
                                $last_edited = null,
                                $owner = null,
                                $dashboard_priority = null,
                                $dashboard_priority_metaID = null,
                                TC_DashboardTab_EntityModel $priorVersion = null) {

        $validMetadataKeys = array(
            'dashboard_priority',
            'dashboard_priority_metaID'

        );

        $metadata = array();
        parent::__construct($entity_id, $host_id, ValidEntityTypes::TAB, $host, $is_active, $created_date, $last_edited, $owner, $validMetadataKeys, $metadata, $priorVersion);

        $this->set_dashboard_priority($dashboard_priority);
        $this->set_dashboard_priority_metaID($dashboard_priority_metaID);
    }

    public function get_dashboard_priority()
    {
        $pairs = $this->get_metadata();
        if(array_key_exists('dashboard_priority', $pairs))
        {
            return $pairs['dashboard_priority'];
        }
        else
        {
            return false;
        }
    }

    public function set_dashboard_priority($dashboard_priority)
    {
        $pairs = $this->get_metadata();
        $pairs['dashboard_priority'] = $dashboard_priority;
        $this->set_metadata($pairs);
    }

    public function get_dashboard_priority_metaID()
    {
        $pairs = $this->get_metadata();
        if(array_key_exists('dashboard_priority_metaID', $pairs))
        {
            return $pairs['dashboard_priority_metaID'];
        }
        else
        {
            return false;
        }
    }

    public function set_dashboard_priority_metaID($dashboard_priority_metaID)
    {
        $pairs = $this->get_metadata();
        $pairs['dashboard_priority_metaID'] = $dashboard_priority_metaID;
        $this->set_metadata($pairs);
    }


}

?>
