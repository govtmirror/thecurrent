<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of QueryTable
 *
 * @author KottkeDP
 */
class QueryTable_MySQL extends QueryTable {
    
    public function __construct($name, $database) {
        
        $e_keys = array(ValidQueryMySQLTableExpressions::COLUMNS);
        $p_keys = array();
        parent::__construct($name, $database, $e_keys, $p_keys );
        
        
    }
    
    private function get_columns() {
        return $this->get_expression(ValidQueryMySQLTableExpressions::COLUMNS);
    }

    private function set_columns(QueryArrayOfSelections $columns = null) {
        $this->set_expression(ValidQueryMySQLTableExpressions::COLUMNS, $columns);
    }

        
    public function verify($param = null)
    {
        
        parent::verify($param);
        if(is_array($param) && array_key_exists(ValidSQLVerifyParams::CONNECTION, $param))
        {
            $param = $param[ValidSQLVerifyParams::CONNECTION];
        }
        if(!$param instanceof mysqli)
        {
            throw new Exception('expects mysqli');
        }
        $query = "SHOW TABLES FROM ".$this->get_database();
        $results = $param->query($query);
        while ($result = $results->fetch_object()) 
        {
            if($result === $this->get_name())
            {
                mysqli_free_result($result);
                //mysqli_close($connection);
                $this->isVerified = true && $this->isVerified;
                return 0;
            }
        }
        mysqli_free_result($result);
        $this->writeVerificationError($this);
        //mysqli_close($connection);
        return 0;
    }
    
    
    
    public function get_inventory($param = null) 
    {
        if(is_array($param) && array_key_exists(ValidSQLVerifyParams::CONNECTION, $param))
        {
            $param = $param[ValidSQLVerifyParams::CONNECTION];
        }
        
        if(!$param instanceof mysqli)
        {
            throw new Exception('expects mysqli');
        }
        
        if(!$this->get_columns() || !$this->get_isVerified())
        {
            $columns = new QueryArrayOfSelections();
            
            if(!$this->get_isVerified())
            {
                $this->verify($param);
                if(!$this->isVerified)
                {
                    return $this->get_columns();
                }
            }
            
            
            $param->query('SHOW COLUMNS FROM '.$this->get_database().'.'.$this->get_name());
            while($row = $param->fetch())
            {
                $colWrap = new QuerySource($this);
                $col = new QuerySourceBoundSingle($colWrap, $row->Field);
                $columns[] = $col;
                
                //$this->columns[$row->Field] = $this->get_name().'.'.$row->Field;
            }
        }
        
        $this->set_columns($columns);
        return $columns;
    }
    
    

    


    
}

?>
