

        
<?php

    require_once ($_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'config.php');
    require_once (ROOT . DS . 'library' . DS . 'functions.php');
    require_once (ROOT . DS . 'library' . DS . 'Autoloader.class.php');
    require_once (ROOT . DS . 'library' . DS . 'shared.php');
    
    //require_once (ROOT . DS . 'library' . DS . 'templatetags.php');
    

/** Autoload any classes that are required **/
 
Autoloader::setCacheFilePath(ROOT . DS . 'tmp/autoloaderfiles/log.txt' );
Autoloader::setClassPaths(
        
            array
            (      
                ROOT . DS . 'library/',
               // ROOT . DS . 'bll/persistence/querygenerator/'
                ROOT . DS . 'thor/',
                ROOT . DS . 'persistence/auditstrategies/'//,
                //ROOT . DS . 'models/'
                
                
            )
        
        );
        //Autoloader::excludeFolderNamesMatchingRegex('/experimental/');
        spl_autoload_register(array('Autoloader', 'loadClass'));

        error_reporting(E_ALL & ~E_DEPRECATED & ~E_WARNING & ~E_STRICT & ~E_NOTICE);
        ini_set('display_errors','On');

        
       

    //echo sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
        //$UAC = new THOR_UserAccessDatabaseManager(MySQLAdapter::getInstance());
        //echo $UAC->get_EntityForUserInGroupUACMasterQuery();
        
        //$test = new THOR_ENTITIES_DataBoundSimplePersistable();
        /*
        $test = new THOR_ENTITYTYPES_DataBoundSimplePersistable();
        $test->type = "containers";
        var_dump( $test);
        $test->isPersistableAlreadyRecorded(false, true);
        var_dump( $test);
         * 
         */
        $test = new THOR_ENTITIES_DataBoundSimplePersistable();
        
        $test->set_keyValue(742);
        //$test->is_active = 1;
        //$test->save();
        
        $test->populateFromKey(742);
        
        //$test->type_id = 1;
        //$test->owner_id= 1234;
        //$test2 = new THOR_ENTITYTYPES_DataBoundSimplePersistable();
        //$test3 = new THOR_METADATA_DataBoundSimplePersistable();
        //$test2->type = 'containers';
        
        $ent = new THOR_EntityDatabaseManager();
        $met = new THOR_MetadataAndTaxonomyDatabaseManager();
        
        
        $uac = new THOR_UserAccessDatabaseManager();
        $wid = new TC_THOR_WidgetDatabaseManager();
        $con = new TC_THOR_ContainerDatabaseManager();
        //$uac->setEntityToGroupUAC(188, 951, 1);
        //$uac->setEntityRightsForGroupUAC(188, 951, 1, new TC_DefaultAccessProfile());        
        //$dv = $uac->getUACEntitiesFromGroupRights(0, new TC_DefaultAccessProfile(), 1);
        
        
        $dv1 = $ent->get_entitiesMasterQuery();
        $dv2 = $met->get_metadataMasterQuery();
        $dv3 = $con->get_containersMasterQuery();
        $dv4 = $wid->get_widgetsMasterQuery();
        //$dv = $wid->get_widgetsMasterQuery();
        
        $friendlies = $dv1->get_friendlyNames();
        
        $persistables = $dv1->get_persistableInputCollection();
        $persistables[$friendlies['ENTITIES']]->owner_id = 1234;
        
        $cond = new QueryConditionComparison(ValidSQLComparisonOperations::IN, new QueryFreeFormConstant(DB_NAME.'.ENTITIES.id'), new QueryFreeFormConstant('(743,744,745,746,747,748)'));
        
        //SQLGen::referenceSourceSelection($query, $sourceAlias, $selectionName)
        $cond = new QueryConditionComparison(ValidSQLComparisonOperations::EQUALS, 1, 0);
        
        $dv1->generateSQL(array(), array(), null, $cond);
        $dv2->generateSQL();
        $dv3->generateSQL();
        $dv4->generateSQL();
        
        $list = $uac->getUACEntitiesFromGroupRightsIDs(1234, new TC_DefaultAccessProfile());
        //var_dump($list);
        $tabRepo = new TC_THOR_GetContainersForUserDashboardView_GetRepo();
        $getPar = new THOR_GetParameterCapsule(array(), array('user_id' => 1234, 'accessprofile' => new TC_DefaultAccessProfile()), array(), array());
        //echo $tabRepo->fixPriority(32);
        $resultarr = $tabRepo->get($getPar)->get_outputCollection();
        $result = $resultarr[891];
        //var_dump($resultarr);
        $result2 = clone $result;
        $result2->set_entity_id(null);
        $result2->set_host_id(null);
        $result2->set_dashboard_priority(null);
        $result2->set_dashboard_priority_metaID(null);
        //$result2->get_host()->set_title("buckets of aids");// = 0;
        $setPar = new THOR_SetParameterCapsule(null, $result2, array('user_id' => 1234, 'accessGroup_IDs' => array(2 => 1)), array(), null);
        $tabRepo = new TC_THOR_SetContainersForUserDashboardView_SetRepo();
        
        $sourceRepo = new TC_THOR_GetSourcesForUserDashboardView_GetRepo();
        $getPar = new THOR_GetParameterCapsule(array(), array('container_id' => 157), array(), array());
        $resultarr = $sourceRepo->get($getPar)->get_outputCollection();
        
        $sourceRepo = new TC_THOR_SetSourcesForUserDashboardView_SetRepo();
        $sourceRepo->swapPriority(157, 1218, 1);
        
        
        //var_dump($resultarr);
//echo $tabRepo->fixPriority(1234);
        //echo 'hi';;
        //$tabRepo->swapPriority(1234, 1531, 1);
        //$tabRepo->create($setPar);
        //$tabRepo->delete(956, 1234);
        
        /*
        $met = new THOR_METADATA_DataBoundSimplePersistable();
        $met->populateFromKey(1217);
        var_dump($met);
        */
        
        //var_dump($tabRepo->get($getPar));
        //var_dump($list);
        //$dv1->generateDataRows();
        
        
        //var_dump($dv1->generateSelectionCollection($dv1->encodeColumnForSQL($persistables[$friendlies['ENTITIES']],'id')));
        //$dv = $uac->get_EntityInGroupUACMasterQuery();
        //$dv->generate();
        //echo $dv1->get_generatedSQL();
        
        //$dv = new THOR_DataView();
        //$dv->startWeb($test, 'entities' );
        //var_dump($dv);
        //$dv->generate();
        //echo $dv->get_generatedSQL();
        
        
        
        $lobby = new THOR_TEST_LOBBY_DataBoundSimplePersistable();
        $b1 = new THOR_TEST_B1_DataBoundSimplePersistable();
        $b2 = new THOR_TEST_B2_DataBoundSimplePersistable();
        $b3 = new THOR_TEST_B3_DataBoundSimplePersistable();
        $secretbasement1 = new THOR_TEST_SECRETBASEMENT1_DataBoundSimplePersistable();
        $secretbasement2 = new THOR_TEST_SECRETBASEMENT2_DataBoundSimplePersistable();
        $f1 = new THOR_TEST_1_DataBoundSimplePersistable();
        $f2 = new THOR_TEST_2_DataBoundSimplePersistable();
        $alt1 = new THOR_TEST_ALT1_DataBoundSimplePersistable();
        
        $data = new DataView();
        
        $data->startWeb($lobby, 'lobby', array(), false);
        
        $b1_link = new DataViewKeyPair('b1key', $lobby->getUniqueReferenceKey(), $b1->get_keyName(), $b1->getUniqueReferenceKey(), false);
        //$b2_link = new DataViewKeyPair('b2key', $b1->getUniqueReferenceKey(), $b2->get_keyName(), $b2->getUniqueReferenceKey(), false);
        //$b3_link = new DataViewKeyPair('b3key', $b2->getUniqueReferenceKey(), $b3->get_keyName(), $b3->getUniqueReferenceKey(), false);
        
        $f1_link = new DataViewKeyPair('lobbykey', $f1->getUniqueReferenceKey(), $lobby->get_keyName(), $lobby->getUniqueReferenceKey(), false);
        //$alt1_link = new DataViewKeyPair('lobbykey', $alt1->getUniqueReferenceKey(), $lobby->get_keyName(), $lobby->getUniqueReferenceKey(), false);
        //$f2_link = new DataViewKeyPair('1key', $f2->getUniqueReferenceKey(), $f1->get_keyName(), $f1->getUniqueReferenceKey(), false);
        //$secretbasement1_link = new DataViewKeyPair('b2key', $secretbasement1->getUniqueReferenceKey(), $b2->get_keyName(), $b2->getUniqueReferenceKey(), false);
        //$secretbasement2_link = new DataViewKeyPair('b2key', $secretbasement2->getUniqueReferenceKey(), $b2->get_keyName(), $b2->getUniqueReferenceKey(), false);
        
        $data->addToWeb($b1, 'b1', array($b1_link) , ValidQueryJoinTypes::INNER, array(), false);
        //$data->addToWeb($b2, 'b2', array($b2_link) , ValidQueryJoinTypes::LEFT, array(), false);
        //$data->addToWeb($b3, 'b3', array($b3_link) , ValidQueryJoinTypes::LEFT, array(), false);
        
        $data->addToWeb($f1, 'f1', array($f1_link) , ValidQueryJoinTypes::INNER, array(), false);
        //$data->addToWeb($alt1, 'alt1', array($alt1_link) , ValidQueryJoinTypes::LEFT, array(), false);
        //$data->addToWeb($f2, 'f2', array($f2_link) , ValidQueryJoinTypes::LEFT, array(), false);
        //$data->addToWeb($secretbasement1, 'secretbasement1', array($secretbasement1_link) , ValidQueryJoinTypes::LEFT, array(), false);
        //$data->addToWeb($secretbasement2, 'secretbasement2', array($secretbasement2_link) , ValidQueryJoinTypes::LEFT, array(), false);
        
        //$data->generate();
        
        //var_dump($data->get_resultSet());
        //echo $data->get_generatedSQL();
        //$friends = $data->get_friendlyNames();
        //var_dump($data->transformResultSet($friends['lobby']));
        
        //var_dump($data->generate());
        
        
        
        
        //var_dump($data->get_sqlResultSet());
        //$test = new THOR_ENTITIES_DataBoundComplexPersistable($test);
        
        //$test->populateFromKey(2);
        
        //$test->populatePropertyFromFK('type_id');
        
        //$test->type_id->type = 'containers';
        //var_dump($test->type_id);
        
        //$matches = $test->produceSetFromPropertyMatches(false, array('created_date', 'last_edited'));
        //foreach($matches as $key => $value)
        //{
        //    echo $value->get_keyValue() . " - ";
        //}
        //var_dump($test->type_id);
        //var_dump($test);
        /*
        $test->type_id = 1;
        //$test->type_id = new THOR_ENTITYTYPES_DataBoundComplexPersistable(new THOR_ENTITYTYPES_DataBoundSimplePersistable());
        //$test->type_id = new THOR_ENTITYTYPES_DataBoundSimplePersistable();
        
        $test->is_active = 0;
        $test->owner_id = 0;
        $test->row_id = 1;
        //var_dump($test);
        //$test->get_isDirty();
        $test->populatePropertyFromFK('type_id');
        
        //$test->get_isDirty();
        //var_dump($test->type_id);
        //var_dump($test);
        $test->type_id->type = 'dogs';
        //var_dump($test);
        $test->created_date = '2013-08-30 17:21:08';
        $test->last_edited = '2013-08-30 17:21:05';
        //var_dump($test);
        //$test->fixFKConnection('type_id');
        //var_dump($test);
        //var_dump($test->type_id);
        //$test->type_id->set_keyValue(null);
        //$test->type_id->type = 'containers';
        //$test->updateListener('type_id');
        //var_dump($test);
        //echo '<br/>';
        //$test->get_coreSimplePersistable()->get_connection()->setAutoCommit(false);
        
        $adapt = new THOR_LogicModelAdapter();
        $adapt->set_underlyingPersistable($test);
        $adapt->created_date = '2013-08-30 17:21:09';
        
        $test->save();
        */
        //$test->populateExtendedValues();
        //var_dump($test->get_extendedValues());
         
        //$test->get_coreSimplePersistable()->get_connection()->commit();
        //var_dump($test);
        
        //var_dump($test);
        /*
        var_dump($test);
        echo '<br/>';
        $test->populateFromKey(1);
        
        var_dump($test);
        echo '<br/>';
        $test->populatePropertyFromFK('type_id');
        
        var_dump($test);
        echo '<br/>';
        
        echo $test->type_id->type;
        */
        
        
        /*
        
        
        
        $array = array('duck' => new QueryNumericConstant(5), 'goose' => array(new QueryNumericConstant(6)));        
        
        $g = new QueryTable_MySQL('green', 'red');
        $g2 = new QueryTable_MySQL('blue', 'yellow');
        $f = new QuerySource($g, 'green');
        $f2  = new QuerySource($g2, 'blue');
        
        
        //echo $f2->toSQL(ValidQueryToSQLRegions::SELECTION);
        //echo '<br/>';
        
        $t = new QueryArrayOfSelections($array);
        $t[] = new QueryNumericConstant(6);
        foreach($t as $key => $value)
        {
            //echo $key;
            //
            //var_dump($value);
        }
        //var_dump($t[0]);
        
        //echo $f->get_value()->get_parameter(ValidQuerySourceBoundParameters::NAME);
        
        
        $query = SQLGen::Query(ValidQueryDatabaseFormats::MYSQL, DB_NAME);
        
        //$query->set_expression(ValidQueryExpressions::SOURCE, $f );
        //var_dump($query->get_expression(ValidQueryExpressions::SOURCE));
        
        //$query->set_parameter(ValidQueryParameters::DATABASE_TYPE, 6);
        //echo $query->get_parameter(ValidQueryParameters::DATABASE_TYPE);
        //var_dump($f);
        //
        //var_dump($query->get_sourceList());
        //echo var_dump($query->get_expression(ValidQueryExpressions::SOURCELIST));
         $sel = $query->fromTable('table', 't1');
         //echo 1;
         //$sel->set_defaultDB('pink');
         //echo $sel->get_defaultDB();
         //$sel->set_defaultDB('red');
         //echo $sel->get_defaultDB();      
         
         foreach($sel->get_sourceList() as $key => $value)
         {
             //echo $value->toSQL();
         }
         //$sel->set_source($f2);
         //echo $sel->get_source()->get_value()->get_name();
         foreach($sel->get_sourceList() as $key => $value)
         {
             //echo $value->toSQL();
         }
         //$sel->set_source($f);
         //echo $sel->get_source()->get_value()->get_name();
         foreach($sel->get_sourceList() as $key => $value)
         {
             //echo $value->toSQL();
         }
         //echo $sel->getStandardToSQLOutput()
         $sourcetab1 = new QueryTable_MySQL('tablename1', 'db1');
         $source1 = new QuerySource($sourcetab1, 'tabAlias1');
         
         $selcol1 = new QuerySourceBoundSingle($source1, 'colname1');
         $sel1 = new QuerySingleSelection($selcol1, 'red');
         
         
         $sourcetab2 = new QueryTable_MySQL('tablename2', 'db2');
         $source2 = new QuerySource($sourcetab2, 'tabAlias2');
         
         $selcol2 = new QuerySourceBoundSingle($source2, 'colname2');
         $sel2 = new QuerySingleSelection($selcol2, 'red');
         
         $bigCond = new QueryConditionComparison(ValidSQLComparisonOperations::GREATER_THAN_OR_EQUALS, 
                 $selcol1, 
                 $selcol2);
         $bigCond = new QueryConditionComparison(ValidSQLComparisonOperations::_OR, $bigCond, $bigCond);
         
         $query = SQLGen::Query(ValidQueryDatabaseFormats::MYSQL, DB_NAME);
         
         //$query->insertValues()->setNumConst($sourceAlias, $selectionName, $value)
        
         $sel = $query->fromTable('table', 't1')->
                 select()
                 ->select('dog', 't1', 'dog')->
                 select('cat', 't1', 'cat')->
                 
                 where(SQLGen::referenceSourceSelection($sel, 't1', 'dog'), 
                         
                         
                         " jghhuhu ", 
                         'spot');
        
         echo $sel;
        
         //2 word selections don't delimit properly
        
        
               $sel = $query->fromTable('table', 't1')->
                 join()->
                 joinTable(ValidQueryJoinTypes::INNER, 'foo', 'foo1', 'foocol', 't1', 't1col')->
                 joinTable(ValidQueryJoinTypes::INNER, 'yoo', 'yoo1', 'youcol', 'foo1', 'foocol')->
                 select()->select('shoop', 't1', 'woop')->
                 select('poop', 't1', 'doop')->
                 selectSourceStar('t1')->
                 selectStar()->
                 selectNumConst(5, 'num')->
                 selectStringConst('lame' , 'string')->
                 selectFreeForm('chicken', 'freedom')->
                 selectCountStar('starry', true)->
                 selectCount('poop', 't1', '$alias',  true)->
                 where( $selcol1, ValidSQLComparisonOperations::EQUALS, $selcol2)->
                 where_and($selcol1, ValidSQLComparisonOperations::EQUALS, $bigCond)->
                 orderBy('num', ValidQueryOrderDirections::ASC)->
                 orderBy('string', ValidQueryOrderDirections::ASC)->
                 limit(3)->
                 
                 having_complex($selcol1, ValidSQLComparisonOperations::EQUALS, $selcol2)->
                 having_complex($selcol2, ValidSQLComparisonOperations::EQUALS, $selcol1)->
                 groupBy('freedom')->
                 groupBy('doop')->
                 into('some file, dude');
         
         echo $sel;
         //echo $sel->getStandardToSQLOutput();
         //$first = new QuerySingleSelection(new QuerySourceBoundSingle($f2, 'hi'));
         
         $query = SQLGen::Query(ValidQueryDatabaseFormats::MYSQL, DB_NAME);
         $upd = $query->fromTable('rags', 'ragoo')->
                 //join()->
                 //joinTable(ValidQueryJoinTypes::INNER, 'foo', 'foo1', 'foocol', 'ragoo', 't1col')->
                 insertSelect();
         $upd->select('shoop', 'ragoo', 'woop');
         $upd = $upd->setQuerySource($sel);
         */
         
         
         //echo $upd;
         //$upd = $upd->setNumConst('ragoo', 'lasagna', 3);
         //$upd = $upd->setStringConst('ragoo', 'spaghetti', 'child');
         //$upd = $upd->setToSelection('ragoo', 'prego', 'foo1', 'fetuccini');
         //$upd = $upd->where( $selcol1, ValidSQLComparisonOperations::EQUALS, $selcol2);
         //echo $upd->getStandardToSQLOutput();
         /*
         $sourcetab1 = new QueryTable_MySQL('tablename1', 'db1');
         $source1 = new QuerySource($sourcetab1, 'tabAlias1');
         
         $selcol1 = new QuerySourceBoundSingle($source1, 'colname1');
         $sel1 = new QuerySingleSelection($selcol1, 'red');
         
         
         $sourcetab2 = new QueryTable_MySQL('tablename2', 'db2');
         $source2 = new QuerySource($sourcetab2, 'tabAlias2');
         
         $selcol2 = new QuerySourceBoundSingle($source2, 'colname2');
         $sel2 = new QuerySingleSelection($selcol2, 'red');
         */
         //echo $source1->toSQL(ValidQueryToSQLRegions::SELECTION);
         
         /*
         $join = new QueryJoin($source1, $sel2, $sel1, ValidJoinTypes::INNER_JOIN);
         
         $arr = new QueryArrayOfQueryJoins();
         $arr[] = $join;
         
         foreach($arr as $key => $value)
         {
             //echo 'hi';
         }
          */
         //var_dump($sel->get_joinedSources());
         
         //var_dump($sel->get_sourceList());
         
        //var_dump($sel->get_sourceList());
        
        //$sel instanceof SQLQueryCompletion_SELECT;
        //$sel->select('col', 'col1');
        //echo $sel->toSQL(new QueryToSQLProfile(ValidQueryToSQLRegions::SELECTION));
    
?>
