<?php if (!(preg_match("/chrome/i", $_SERVER['HTTP_USER_AGENT']))) { ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php } ?>
<?php

        /*below goes on every page if you want it to work!*/

    if(!isset($_SERVER['DOCUMENT_ROOT'])){ if(isset($_SERVER['SCRIPT_FILENAME'])){
$_SERVER['DOCUMENT_ROOT'] = str_replace( '\\', '/', substr($_SERVER['SCRIPT_FILENAME'], 0, 0-strlen($_SERVER['PHP_SELF'])));
}; };
if(!isset($_SERVER['DOCUMENT_ROOT'])){ if(isset($_SERVER['PATH_TRANSLATED'])){
$_SERVER['DOCUMENT_ROOT'] = str_replace( '\\', '/', substr(str_replace('\\\\', '\\', $_SERVER['PATH_TRANSLATED']), 0, 0-strlen($_SERVER['PHP_SELF'])));
}; };


        require_once ($_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'library' . DIRECTORY_SEPARATOR . 'bootstrap.php');

        $groups = TC_Utility::initializeGroups();
        $universalGroupID = $groups[ValidAccessGroupTypes::EVERYONE]->get_keyValue();
        $universalAdminGroupID = $groups[ValidAccessGroupTypes::GLOBAL_ADMIN]->get_keyValue();

        //Fix data integrity problem that crept in at some point
        $containersDM = new TC_THOR_ContainerDatabaseManager();
        $viewtype_id = $containersDM->containerViewTypeVerification(ValidDashboardTabViews::STANDARD)->get_keyValue();

        $query = $query = SQLGen::Query(ValidQueryDatabaseFormats::MYSQL, DB_NAME)->
                fromTable(CONTAINERS, CONTAINERS)->update()->setNumConst(CONTAINERS, 'viewtype_id', $viewtype_id);
        $ds = MySQLConfig::dsConnect();
        $ds->query($query->toSQL());
        $ds->fetch();

        //echo $universalAdminGroupID;
        //echo '<br />';
        //echo $universalGroupID;

        //Correct group rights for existing users

        $users = new THOR_USERS_DataBoundSimplePersistable();
        $userSet = $users->produceSetFromPropertyMatches(false);

        foreach ($userSet as $key => $value) {
            TC_Utility::forceInitializeNewUser($value->get_keyValue());
        }



        // Correct the UAC group structure
        $strategy = new TC_RepositoryDashboardContainerStrategy();

        $getPar = new THOR_GetParameterCapsule(array(),
                                            array('user_id' => SYSTEM_USER_ID,
                                                'accessprofile' => new TC_DefaultAccessProfile(),
                                                'accessGroupID' => $universalGroupID ),
                                            array(),
                                            array());

        $repo = new Repository($strategy);

        $groupsToChange = $repo->getIDs($getPar);

        foreach ($groupsToChange as $groupID) {
            TC_Utility::setEntityInGroup($universalAdminGroupID, $groupID, 1);
        }



        // $containersDV->generateSQL(array(),
        //                             array($containersDV->encodeColumnForSQL($persistables[$friendlies['METADATA']], 'data') =>
        //                                 array('direction' => 'ASC', 'cast_type' => 'unsigned')
        //                             ),
        //                             null,
        //                             $condition);
        // $containersDV->execute();



?>




