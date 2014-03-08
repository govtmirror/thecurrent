<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SQLQueryCompletion_INSERTSELECT
 *
 * @author KottkeDP
 */
class SQLQueryCompletion_INSERTSELECT extends SQLQueryCompletion {
    
    
    public function __construct( 
                                SQLQueryIgnition $queryIgnition,
                                QueryArrayOfSelections $selections = null,
                                SQLQueryCompletion_SELECT $sourceSelectQuery = null
            
            ) {
        
        $meta = new QueryElementMeta(array());
        
        $e_keys = array(ValidQueryExpressions::QUERY);
        
        $p_keys = array();
        
        parent::__construct($queryIgnition, $meta, $e_keys, $p_keys, $selections);
        
        if(isset($sourceSelectQuery))
        $this->set_query($sourceSelectQuery);
        
    }
    
    public function get_sourceSelectQuery() {
        return $this->get_expression(ValidQueryExpressions::QUERY);
    }

    protected function set_sourceSelectQuery(SQLQueryCompletion_SELECT $sourceSelectQuery = null) {
        $this->set_expression(ValidQueryExpressions::QUERY, $sourceSelectQuery);
    }
    
    public function clearSourceSelectQuery()
    {
        $this->set_sourceSelectQuery(null);
        return $this;
    }
    
    public function clearAll() {
        
        return parent::clearAll()->clearSourceSelectQuery();
    }
    
    public function limit($limit) {
        throw new Exception("Must set limit in select subquery instead");
    }
    
    public function setQuerySource(SQLQueryCompletion_SELECT $query)
    {
        $this->set_sourceSelectQuery($query);
        return $this;
    }

    public function getStandardToSQLOutput($region) {
        //$childrenToSQLProfile = new QueryToSQLProfile(ValidQueryToSQLRegions::SET_OPERATION_EXP);
        $returnMe = "INSERT INTO " ;//. $this->get_source()->toSQL($childrenToSQLProfile) . " ";
        $returnMe .= " ".$this->get_ignition()->toSQL(ValidQueryToSQLRegions::SOURCE)." ";
        $returnMe .= "(";
        
        $selectionArray = $this->get_selections();
        $temparr = array();
        foreach($selectionArray as $key => $value)
        {
            $temparr[$key] = $value->toSQL(ValidQueryToSQLRegions::INSERTSELECT);
            //$selectionArray->offsetSet($key, $value->toSQL(ValidQueryToSQLRegions::SELECTION));
            //$selectionArray[$key] = $value->toSQL(ValidQueryToSQLRegions::SELECTION);
        }
        $returnMe .= implode(",", $temparr) . " ";
        
        $returnMe .= ") ";
        
        //$childrenToSQLProfile->set_region(ValidQueryToSQLRegions::FULL);
        //echo '<br/>';
        //echo get_class();
        //echo '<br/>';
        $returnMe .= $this->get_sourceSelectQuery()->toSQL(ValidQueryToSQLRegions::INSERTSELECT);
        $returnMe .= $this->get_limit() ? " LIMIT " . $this->get_limit() : "";
        
        return $returnMe;
    }

    public function getToSQLProfileFromContext($region) {
        $returnMe = new QueryToSQLProfile($region);
        $returnMe->set_format(ValidQueryToSQLFormats::STANDARD);
        $returnMe->set_hasParenthesis(false);
        $returnMe->set_fragment($this->getStandardToSQLOutput($region));
        return $returnMe;
    }
    
}

?>
