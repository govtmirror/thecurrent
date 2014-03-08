<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ValidSQLFunctions
 *
 * @author KottkeDP
 */
class ValidSQLAggregateOperations {
    const AVG = 'AVG(';
    const AVG_DISTINCT = 'AVG(DISTINCT ';
    const COUNT = 'COUNT(';
    const COUNT_DISTINCT = 'COUNT(DISTINCT ';
    //const FIRST = 'FIRST';
    //const LAST = 'LAST';
    const MAX = 'MAX(';
    const MIN = 'MIN(';
    const SUM = 'SUM(';
    const SUM_DISTINCT = 'SUM(DISTINCT ';
    const STDDEV_POP = 'STDDEV_POP(';    
    const VAR_POP = 'VAR_POP(';
    const STDDEV_SAMP = 'STDDEV_SAMP(';
    const VAR_SAMP = 'VAR_SAMP(';
    
    const GROUP_CONCAT = 'GROUP_CONCAT(';
    const GROUP_CONCAT_DISTINCT = 'GROUP_CONCAT(DINSTINCT ';
}

?>
