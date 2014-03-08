<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SQLQueryGenerator
 *
 * @author Dan Kottke
 */
class SQLGen {
    
    
    public static function Query($databaseType, $defaultDB = null, QuerySource $source = null)
    {
        return new SQLQueryIgnition($databaseType, null, null, null, $source, $defaultDB);
    }
    
    public static function referenceSourceSelection(SQLQuery $query, $sourceAlias, $selectionName)
    {
        if($query instanceof SQLQueryCompletion)
        {
            $sourceList = $query->get_ignition()->get_sourceList();
        }
        elseif($query instanceof SQLQueryIgnition) 
        {
            $sourceList = $query->get_sourceList();
        }
        else
        {
            throw new Exception("whoops");
           
        }
        
        
        if(!$sourceList->offsetExists($sourceAlias))
        {
            throw new Exception("Must select from a loaded source");
        }
        
        //$source = $sourceList[$sourceAlias];
        
        $source = $sourceList->offsetGet($sourceAlias);
        
        $col = new QuerySourceBoundSingle($source, $selectionName);
        return $col;
        
    }
}

?>
