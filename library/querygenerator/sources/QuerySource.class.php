<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of QuerySource
 *
 * @author KottkeDP
 */
class QuerySource extends QueryElementValueAlias implements ISelectionInventory, ISourceable{
    
    public function __construct(QueryElementValue $value, $alias) {
        
        parent::__construct($value, $alias);
    }
    
    
    public function set_value(ISingleSourceValue $value = null) {
        if(isset($value) && $value instanceof ISingleSourceValue)
        {
            parent::set_value($value);
            
        }
        else
        {
            //throw new Exception('Value must be type '.get_class("ISingleSourceValue"));
        }
        
        
    }
    
    public function get_inventory($param = null) {
        if(!$this->get_value() instanceof ISelectionInventory)
        {
            throw new Exception('Value must be type '.get_class("ISelectionInventory"));
        }
        return $this->get_value()->get_inventory($param);
        
    }

    
    

    
    

    


}

?>
