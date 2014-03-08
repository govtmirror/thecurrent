<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of QueryTable
 *
 * @author Dan Kottke
 */
abstract class QueryTable extends QueryElementValue implements ISelectionInventory, ISingleSourceValue {
    
    //protected $name;
    //protected $database;
    
    //protected $isVerified;
    




    function __construct($name, $database, array $expressionKeys = null, array $parameterKeys = null) {
        
        $e_keys = array();
        $p_keys = array(ValidQueryTableParameters::NAME, ValidQueryTableParameters::DATABASE);
    
        $meta = new QueryElementMeta();
        parent::__construct($meta, array_merge($expressionKeys, $e_keys), array_merge($parameterKeys, $p_keys) );
        
        $this->set_name($name);
        $this->set_database($database);
        //$this->isVerified = false;
        
    }
    
    public function get_name() {
        return $this->get_parameter(ValidQueryTableParameters::NAME);
        //return $this->paremeters[ValidQueryTableParameters::NAME];
    }

    public function set_name($name = null) {
        $this->set_parameter(ValidQueryTableParameters::NAME, $name);
        //$this->paremeters[ValidQueryTableParameters::NAME] = $name;
    }

    public function get_database() {
        return $this->get_parameter(ValidQueryTableParameters::DATABASE);
        //return $this->paremeters[ValidQueryTableParameters::DATABASE];
    }

    public function set_database($database = null) {
        $this->set_parameter(ValidQueryTableParameters::DATABASE, $database);
        //$this->paremeters[ValidQueryTableParameters::DATABASE] = $database;
        
    }
    

    
    public function isTerminal($params = null) {
        return true;
    }
    
    public function getStandardToSQLOutput($region) {
        return $this->get_database().".".$this->get_name();
        
    }
    
    public function getToSQLProfileFromContext($region) {
        
        $returnMe = new QueryToSQLProfile($region);
        switch ($region)
        {
            case ValidQueryToSQLRegions::SOURCE :
                $returnMe->set_format(ValidQueryToSQLFormats::DEFINITION);
                $returnMe->set_hasParenthesis(false);
                break;
            case ValidQueryToSQLRegions::JOIN_ON :
                $returnMe->set_format(ValidQueryToSQLFormats::DEFINITION);
                $returnMe->set_hasParenthesis(false);
                break;
            case ValidQueryToSQLRegions::SET_OPERATION_EXP :
                $returnMe->set_format(ValidQueryToSQLFormats::STANDARD);
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

    
    

    

    
}

?>
