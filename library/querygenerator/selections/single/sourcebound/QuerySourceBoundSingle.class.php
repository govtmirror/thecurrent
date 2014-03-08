<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of QueryTableColumn
 *
 * @author KottkeDP
 */
class QuerySourceBoundSingle extends QuerySourceBound implements ISingleSelectValue{
    public function __construct(QuerySource $source, $name) {
        
        $meta = new QuerySelectionTreeLeafMeta(array('is_tableBound' => true , 'is_star' => false ));
        parent::__construct($meta, $source, $name);
    }
    
    public function getToSQLProfileFromContext($region) {
        $returnMe = new QueryToSQLProfile($region);
        switch ($region)
        {
            case ValidQueryToSQLRegions::SELECTION :
                $returnMe->set_format(ValidQueryToSQLFormats::DEFINITION);
                $returnMe->set_hasParenthesis(false);
                break;
            case ValidQueryToSQLRegions::SET_OPERATION_EXP :
                $returnMe->set_format(ValidQueryToSQLFormats::STANDARD);
                $returnMe->set_hasParenthesis(false);
                break;
            case ValidQueryToSQLRegions::INSERTSELECT :
                $returnMe->set_format(ValidQueryToSQLFormats::ALIAS);
                $returnMe->set_hasParenthesis(false);
                break;
            default :
                $returnMe->set_format(ValidQueryToSQLFormats::STANDARD);
                $returnMe->set_hasParenthesis(false);
                break;
                
        }
        $returnMe->set_fragment($this->getStandardToSQLOutput($region));
        return $returnMe;
    }
    
    public function verify($param = null)
    {
        parent::verify($param);
        
        
        if($this->get_source() instanceof ISelectionInventory)
        {
            $cols = $this->get_source()->get_inventory($param);
            foreach($cols as $key => $value)
            {
                $cols[$key] = $value->get_name();
            }
            
            if(in_array($this->get_name(), $cols) || array_key_exists($this->get_name(), $cols))
            {
                $this->isVerified = true && $this->isVerified;
            }
            else
            {
                $this->isVerified = false;
                $this->writeVerificationError($this);
            }
        }
    }
}

?>
