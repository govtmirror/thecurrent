<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of QueryColumn
 *
 * @author KottkeDP
 */
class QuerySingleSelection extends QueryElementValueAlias implements ISelectable {
    
    public function __construct(QueryElementValue $value, $alias = null) {
        parent::__construct($value, $alias);
    }
    
    public function set_value(ISingleSelectValue $value = null) {
        if(isset($value) && !$value instanceof ISingleSelectValue)
        {
            throw new Exception('Value must be type '.get_class("ISingleSelectValue"));
        }
        parent::set_value($value);
    }
    
    public function getReferenceKey()
    {
        if($this->get_alias())
        {
            return $this->get_alias();
        }
        else
        {
            if($this->get_value() instanceof ISingleSelectValue)
            {
                return $this->get_value()->getReferenceKey();
                
            }
            else
            {
                throw new Exception("Selection value must have reference key");
            }
        }
    }


    
    
    
}

?>
