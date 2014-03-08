<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DatabaseStrategy
 *
 * @author Optimus
 */
class THOR_EntityDatabaseManager {
    
    protected $dataSource;
    
    protected $entities;
    protected $entitytypes;
    
    protected $entitytypes_link;
    
    protected $entitiesMasterQuery;
    
    function __construct($dataSource = null) {                
        if(isset($dataSource))
        {
            $this->dataSource = $dataSource;
        }        
    }
    
    
    public function get_dataSource() {
        return $this->dataSource;
    }
 
    public function set_dataSource($dataSource) {
        $this->dataSource = $dataSource;
    }

    public function get_entities() {
        if(!isset($this->entities))
        {
            $this->entities = new THOR_ENTITIES_DataBoundSimplePersistable();//unserialize(ENTITIES_DB_TABLEFIELDS);
            $this->entities->is_active = 1;
        }
        return clone $this->entities;
    }

    public function get_entitytypes() {
        if(!isset($this->entitytypes))
        {
            $this->entitytypes = new THOR_ENTITYTYPES_DataBoundSimplePersistable();//unserialize(ENTITYTYPES_DB_TABLEFIELDS);
        }
        return clone $this->entitytypes;
    }
    
    public function get_entitytypes_link() {
        if(!isset($this->entitytypes_link))
        {
            $this->entitytypes_link = new DataViewKeyPair('type_id', 
                                                            $this->get_entities()->getUniqueReferenceKey(), 
                                                            $this->get_entitytypes()->get_keyName(), 
                                                            $this->get_entitytypes()->getUniqueReferenceKey(), 
                                                            false);
        }
        return $this->entitytypes_link;
    }
        
    public function get_entitiesMasterQuery() {
        if(!isset($this->entitiesMasterQuery))
        {
            $view = new THOR_DataView();
        
            $view->startWeb($this->get_entities(), 'ENTITIES', array(), false);
            $view->addToWeb($this->get_entitytypes(), 'ENTITYTYPES', array($this->get_entitytypes_link()), ValidQueryJoinTypes::INNER, array(), false);
            
            $this->entitiesMasterQuery = $view;
        }
        return clone $this->entitiesMasterQuery;
        
    }
    
    public function entityTypeVerification($entityType)
    {   
        $type = $this->get_entitytypes();
        $type->type = $entityType;
        
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
            throw new Exception('entityTypeVerification failed on param insert');
        } 
        //generic entitytype verification and insertion/selection subroutine
        $query = "SELECT ".DB_NAME.".".pullIndex($this->get_entitytypes(), 'id').
        " FROM ".DB_NAME.".".ENTITYTYPES.
        " WHERE ".DB_NAME.".".pullIndex($this->get_entitytypes(), 'type')." = '".$params->type."'"                  
                ;
 
        $this->get_dataSource()->query($query); 
        $row = $this->get_dataSource()->fetch();

        if($row)
        {
            $returnMe = $row->id;
            //$params->set_keyValue($row->id);
        }
        else
        {     
            $returnMe = $this->insertEntityType($params);  
            //$params = $this->insertEntityType($params);            
        }
        return $returnMe;
        //return $params;
        
         * 
         */
    }
    
    
    // TODO: add validation methods
    /*
    public function insertEntity(THOR_ENTITIES_DataBoundSimplePersistable $params)
    {
        if(
                !isset($params->type_id) || 
                !isset($params->owner_id) ||
                !isset($params->is_active)                 
        )
        {
            throw new Exception('insertEntity failed on param insert');
        }        
        $query = "INSERT INTO ".DB_NAME.".".ENTITIES." (".
                DB_NAME.".".pullIndex($this->get_entities(), 'type_id').", ".
                DB_NAME.".".pullIndex($this->get_entities(), 'row_id').", ".
                DB_NAME.".".pullIndex($this->get_entities(), 'created_date').", ".
                DB_NAME.".".pullIndex($this->get_entities(), 'last_edited').", ".
                DB_NAME.".".pullIndex($this->get_entities(), 'owner_id').", ".
                DB_NAME.".".pullIndex($this->get_entities(), 'is_active')." ".                
                ") VALUES (".
                $params->type_id.", ".   
                (isset($params->row_id) ? "'".$params->row_id."'" : " NULL ").", ".      
                "'".date('Y-m-d H:i:s')."'".", ".
                "'".date('Y-m-d H:i:s')."'".", ".
                $params->owner_id.", ".
                $params->is_active." ".
                ") "
                ;
        
        $this->get_dataSource()->query($query); 
        $this->get_dataSource()->fetch();
        //$params->set_keyValue($this->get_dataSource()->getInsertID()) ;        
        return $this->get_dataSource()->getInsertID();
        //return $params;
    }
    
    public function updateEntity(THOR_ENTITIES_DataBoundSimplePersistable $params)
    {
        if(
                !isset($params->get_keyValue())              
        )
        {
            throw new Exception('updateEntity failed on param insert');
        } 
        $query = "UPDATE ".DB_NAME.".".ENTITIES." ".
                " SET ".             
                (isset($params->is_active) ? DB_NAME.".".pullIndex($this->get_entities(), 'is_active')." = ".$params->is_active."," : "").
                DB_NAME.".".pullIndex($this->get_entities(), 'last_edited')." = "."'".date('Y-m-d H:i:s')."'"." ".                
                " WHERE ".DB_NAME.".".pullIndex($this->get_entities(), 'id')." = ".$params->get_keyValue()             
                ;
        
        $this->get_dataSource()->query($query); 
        $this->get_dataSource()->fetch();
        //$entity_id = $this->get_dataSource()->getInsertID();
        
        return $params;
    }
    
    public function insertEntityType(THOR_ENTITYTYPES_DataBoundSimplePersistable $params)
    {
        if(
                !isset($params->type)              
        )
        {
            throw new Exception('insertEntityType failed on param insert');
        } 
        $query = "INSERT INTO ".DB_NAME.".".ENTITYTYPES." (".
            DB_NAME.".".pullIndex($this->get_entitytypes(), 'type').")".
            " VALUES ('".$$params->type."') "  
                ;
        $this->get_dataSource()->query($query); 
        $this->get_dataSource()->fetch();
        return $this->get_dataSource()->getInsertID();
        //$params->set_keyValue($this->get_dataSource()->getInsertID());
        //return $params;
    }
    
    public function updateEntityType(THOR_ENTITYTYPES_DataBoundSimplePersistable $params)
    {
        if(
                !isset($params->type)     ||         
                !isset($params->get_keyValue())
        )
        {
            throw new Exception('updateEntityType failed on param insert');
        } 
        $query = "UPDATE ".DB_NAME.".".ENTITYTYPES." ".
                " SET ".             
                DB_NAME.".".pullIndex($this->get_entitytypes(), 'type')." = ".$params->type.",".                              
                " WHERE ".DB_NAME.".".pullIndex($this->get_entitytypes(), 'id')." = ".$params->get_keyValue()             
                ;
        
        $this->get_dataSource()->query($query); 
        $this->get_dataSource()->fetch();
        //$entity_id = $this->get_dataSource()->getInsertID();
        
        return $params;
    }
    
    
    
    //used by subclasses only
    public function entityTypeVerification(THOR_ENTITYTYPES_DataBoundSimplePersistable $params)
    {   
        if(
                !isset($params->type)              
        )
        {
            throw new Exception('entityTypeVerification failed on param insert');
        } 
        //generic entitytype verification and insertion/selection subroutine
        $query = "SELECT ".DB_NAME.".".pullIndex($this->get_entitytypes(), 'id').
        " FROM ".DB_NAME.".".ENTITYTYPES.
        " WHERE ".DB_NAME.".".pullIndex($this->get_entitytypes(), 'type')." = '".$params->type."'"                  
                ;
 
        $this->get_dataSource()->query($query); 
        $row = $this->get_dataSource()->fetch();

        if($row)
        {
            $returnMe = $row->id;
            //$params->set_keyValue($row->id);
        }
        else
        {     
            $returnMe = $this->insertEntityType($params);  
            //$params = $this->insertEntityType($params);            
        }
        return $returnMe;
        //return $params;
        
    }
    
    
    */
    
    
   
    
}

?>
