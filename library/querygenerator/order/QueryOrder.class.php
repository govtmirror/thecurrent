<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RepoStrategyOrder
 *
 * @author kottkedp
 */
class QueryOrder extends QueryElementValue{
    
    
    protected $e_keys = array(ValidQueryOrderExpressions::SELECTION);
    protected $p_keys = array(ValidQueryOrderParameters::DIRECTION,
                              ValidQueryOrderParameters::CAST_TYPE);
    
    public function __construct(QuerySingleSelection $selection, $direction, $cast_type = null) {
        $meta = new QueryElementMeta();
        parent::__construct($meta, $this->e_keys, $this->p_keys);
        
        $this->set_selection($selection);
        $this->set_direction($direction);
        $this->set_cast_type($cast_type);
    }
    
    public function get_selection() {
        return $this->get_expression(ValidQueryOrderExpressions::SELECTION);
        
    }

    public function set_selection(QuerySingleSelection $selection = null) {
        $this->set_expression(ValidQueryOrderExpressions::SELECTION, $selection);
    }

    
    public function get_direction() {
        return $this->get_parameter(ValidQueryOrderParameters::DIRECTION);
    }

    public function set_direction($direction = null) {
        if($direction == ValidQueryOrderDirections::ASC || $direction == ValidQueryOrderDirections::DESC)
        {
            $this->set_parameter(ValidQueryOrderParameters::DIRECTION, $direction);
        }
        else
        {
            $this->set_parameter(ValidQueryOrderParameters::DIRECTION, ValidQueryOrderParameters::ASC);
        }
    }
    
    public function get_cast_type()
    {
        return $this->get_parameter(ValidQueryOrderParameters::CAST_TYPE);
    }
    
    public function set_cast_type($cast_type = null)
    {
        $this->set_parameter(ValidQueryOrderParameters::CAST_TYPE, $cast_type);
    }
    
    public function isTerminal($params = null) {
        return false;
    }

    public function getStandardToSQLOutput($region) {
        //$sourceParams = new QueryToSQLProfile($params->get_region(), false );
        $ct = $this->get_cast_type();
        if(isset($ct))
        {
            $returnMe = " CAST(" . 
                            $this->get_selection()->toSQL($region) 
                        . " AS " . $this->get_cast_type() ." ) " . $this->get_direction();
        }
        else
        {
            $returnMe = $this->get_selection()->toSQL($region) . " " . $this->get_direction();
        }
        
        return $returnMe;
    }

    public function getToSQLProfileFromContext($region) {
        $returnMe = new QueryToSQLProfile($region);
        $returnMe->set_format(ValidQueryToSQLFormats::STANDARD);
        $returnMe->set_hasParenthesis(false);
        $returnMe->set_fragment($this->getStandardToSQLOutput($region));
        return $returnMe;
    }

       

    
    
    
    /*
    private $ordering;
    
    
    
    public function __construct(array $ordering = null) {
        
        $this->ordering = array();
        
        foreach($ordering as $key => $value)
        {

            if(!(is_string($key) ))
            {
                throw new Exception('Not a valid column!');
            }
            if(!($value === 1 || $value === 0))
            {
                throw new Exception('Not a valid direction!');
            }                              
            $this->ordering[$key] = $value;
        }
        //$this->ordering = $ordering;
      
        
    }
    
    
    // <editor-fold desc="getters/setters">
    
    
    public function getOrdering() 
    {
        return $this->ordering;
        
    }
    public function setOrdering(array $ordering)
    {
        
            foreach($ordering as $key => $value)
            {
               
               if(!(is_string($key) ) || array_key_exists($key, $this->ordering))
               {
                   throw new Exception('Not a valid column!');
               }
               if(!($value == 1 || $value == 0))
               {
                   throw new Exception('Not a valid direction!');
               }                              

            }
            $this->ordering = $ordering;    
            return true;
        
        
    }
    
    // </editor-fold>
    
    public function clearOrdering()
    {
        $this->ordering = array();
    }
    
    public function pushOrdering($column, $direction)
    {
        if(!(is_string($column) ) || array_key_exists($column, $this->ordering))
        {
            throw new Exception('Not a valid column!');
        }
        $this->ordering[$column] = $direction;
        
    }
    
    public function __toString()
    {
        return $this->toSQL($this->getOrdering());
    }
    
    private function toSQL(array $ordering)
    {
        $returnMe = '';
        
                
        $postFirst = false;
        foreach($ordering as $key => $value)
        {
            $dir = 'ASC';
            switch($value)
            {
                case 0:
                    $dir = 'DESC';
                    break;
                case 1:
                    $dir = 'ASC';
                    break;
                default:
                    break;
                    
            }
            if($postFirst)
            {
                $returnMe .= ', ';
            }
            
            $returnMe .= $key . ' ' . $dir;
            $postFirst = true;
        }
        
        
        return $returnMe;
    }
    */
    
}

?>
