<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of QueryAggregate
 *
 * @author KottkeDP
 */
abstract class QueryAggregate extends QueryOperation {
    
    //protected $isVerified;
    
    public function __construct(array $expressionKeys, array $parameterKeys) {
        $meta = new QuerySelectionTreeBranchMeta(array('is_aggregate' => true));
        parent::__construct($meta, $expressionKeys, $parameterKeys);
    }
    
    /*
    public function __construct($operation, array $expressions) {
        $this->set_expressions($expressions);
        parent::__construct($operation);
    }
    */
    
    /*
    public function set_operation($operation) {
        $this->isVerified = false;
        parent::set_operation($operation);
    }
     */

    

    /*    
    public function __set($name, $value) {
        //$this->isVerified = false;
        parent::__set($name, $value);
    }
    
    public function verify($param = null) {
        $refl = new ReflectionClass('ValidSQLAggregateOperations');
        $this->isVerified = in_array($this->get_operation(), $refl->getConstants());
        return $this->get_isVerified();
    }
    */
    
       
   /* 
    public function toSQL() {
        
        switch($this->get_operation())
        {
            case ValidSQLAggregateOperations::GROUP_CONCAT || ValidSQLAggregateOperations::GROUP_CONCAT_DISTINCT:
                $params = $this->get_parameters();
                
                $returnMe = implode(',', $this->get_expressions())." ";
                
                if(array_key_exists("ORDER BY", $params))
                {
                    if(!is_array($params))
                    {
                        throw new Exception("Order By expects array parameter");
                    }
                    $returnMe .= " ORDER BY ";
                    foreach($params["ORDER BY"] as $key => $value)
                    {
                        fa
                        $returnMe .= $key . " " . $value . ",";
                        
                    }
                    $returnMe = substr($returnMe, 0, -1);
                    
                    
                }
                if(array_key_exists("SEPARATOR", $params))
                {
                    $returnMe .= " SEPARATOR " . $params["SEPARATOR"];
                    
                    
                }
                break;
            default:
                $returnMe = implode(',', $this->get_parameters());
                break;
        }
        
        return $this->get_operation().$returnMe.")";
        
    }
    */
    
    
    

}

?>
