<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DatabaseInitializer
 *
 * @author Dan Kottke
 */
class DatabaseInitializer {


    public static function initialize()
    {

        $dStrat = new DashboardStrategy();

        $wStrat = new DashboardWidgetStrategy();

        $repo = new Repository();

        ///query default containers

        $filt = new QueryCondition('user_id', ValidSQLComparisons::EQUALS, 0);
        $filt2 = new QueryCondition('is_active', ValidSQLComparisons::EQUALS, 1);
        $filt = new QueryCondition($filt, ValidSQLComparisons::AND_, $filt2);
        $dStrat->setFilter($filt);

        $repo->setStrategy($dStrat);

        $existingDefaultsDB = $repo->get();
        $existingDefaults = array();

        foreach($existingDefaults as $key => $value)
        {
            $existingDefaults[$key] = $value->getHost();
        }






        ///add missing default containers

        ///query default widgets

        ///add missing default widgets
    }
}

?>
