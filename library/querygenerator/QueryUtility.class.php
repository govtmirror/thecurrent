<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of QueryUtility
 *
 * @author KottkeDP
 */
class QueryUtility {
    
    public static function findAllNodes(ITreeElement $tree, array $params, $matchAny = false, $isDeep = false, $invert = false)
    {
        
        $returnMe = array();
        $ismatch = true;
        foreach($params as $key => $value)
        {
            if($tree->$key != $value)
            {
                $ismatch = false;
            }
        }
        
        if($ismatch != $invert)
        {
            $returnMe[] = $tree;
        }
        
        if((($isDeep && $ismatch) || !$ismatch) && !$tree->isTerminal())
        {
            foreach ($tree->get_children() as $key => $value) 
            {
                $returnMe = array_merge_recursive($returnMe, self::findAllNodes($value, $params, $isDeep));                
            }
        }
        
        return $returnMe;
        
    }
    
    
    
    
}

?>
