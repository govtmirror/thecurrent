<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author KottkeDP
 */
abstract class SetStrategy implements ISetStrategy{
    
    //protected $auditStrategy;
    
    protected $dataSource;
    
    function __construct($dataSource = null) {
                
        $this->set_dataSource($dataSource);
            
    }
    public function get_dataSource() {
        return $this->dataSource;
    }

    public function set_dataSource($dataSource) {
        $this->dataSource = $dataSource;
    }

        /*
    function __construct($dataSource = null, AuditStrategy $auditStrategy = null) {
        if(isset($auditStrategy))
        {
            $this->auditStrategy = $auditStrategy;
        }
        parent::__construct($dataSource);
    }
    
    public function get_auditStrategy() {
        return $this->auditStrategy;
    }

    public function set_auditStrategy( AuditStrategy $auditStrategy) {
        $this->auditStrategy = $auditStrategy;
    }
    */
    /*
    public function save(Entity $entity, $caller = null, $accessGroup_id = null, $args = null)
    {
        
        
    }
    
    protected function performAudit($entity, $caller = null, $auditAction = null, $args = null)
    {
        //return false;
        if(isset($args))
        {
            extract($args);
        }
        if(!isset($caller))
        {
            $caller = SYSTEM_USER_ID;
        }
        //must be called after the entity is saved in the event of an entity's creation
        $auditStrat = $this->get_auditStrategy();
        if($auditStrat)
        {
            //$auditAction = $this->performAuditLogic($entity);
            return $auditStrat->save($entity, $caller, null, array('auditAction' => $auditAction));
        }
        return false;
    }
    
    protected function determineAuditActionType($entity)
    {
        $auditAction = ValidAuditActions::UNKNOWN;

        if(!$entity->get_host())
        {
            throw new Exception("no model provided for database entity.");
        }
        
        

        $id = $entity->get_host_id();

        
        if(!($entity->get_is_active()) && $id)
        {

            $auditAction = ValidAuditActions::DEACTIVATED;
            //return $this->delete($entity, $id, $args);
        }
        elseif(!($entity->get_is_active()) && !$id)
        {
            return $auditAction;
                        
        }
        elseif($entity->get_is_active() && !$id)
        {
            $auditAction = ValidAuditActions::CREATED;
            
        }
        else
        {
            $auditAction = ValidAuditActions::UPDATED;

        }
        
        return $auditAction;
    }
    */
    
    
    
    
    
}

?>
