<?php

if(!isset($_SERVER['DOCUMENT_ROOT'])){ if(isset($_SERVER['SCRIPT_FILENAME'])){
$_SERVER['DOCUMENT_ROOT'] = str_replace( '\\', '/', substr($_SERVER['SCRIPT_FILENAME'], 0, 0-strlen($_SERVER['PHP_SELF'])));
}; };
if(!isset($_SERVER['DOCUMENT_ROOT'])){ if(isset($_SERVER['PATH_TRANSLATED'])){
$_SERVER['DOCUMENT_ROOT'] = str_replace( '\\', '/', substr(str_replace('\\\\', '\\', $_SERVER['PATH_TRANSLATED']), 0, 0-strlen($_SERVER['PHP_SELF'])));
}; };

        require_once ($_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'library' . DIRECTORY_SEPARATOR . 'bootstrap.php');  
        
/*
include 'bll/persistence/querygenerator/QueryValueAlias.class.php';
include 'bll/persistence/querygenerator/IOutputsToSQL.class.php';
include 'bll/persistence/querygenerator/ITyped.class.php';
include 'bll/persistence/querygenerator/IVerifiable.class.php';
include 'bll/persistence/querygenerator/IFixedTypedInventory.class.php';
include 'bll/persistence/querygenerator/selectors/IQuerySelectable.class.php';
include 'bll/persistence/querygenerator/selectors/QuerySelection.class.php';
include 'bll/persistence/querygenerator/selectors/QueryAggregate.class.php';
include 'bll/persistence/querygenerator/selectors/QueryColumn.class.php';
include 'bll/persistence/querygenerator/selectors/ValidSQLSelectionTypes.class.php';

include 'bll/persistence/querygenerator/sources/IQuerySourceable.class.php';
include 'bll/persistence/querygenerator/sources/QuerySource.class.php';
include 'bll/persistence/querygenerator/sources/QueryTable.class.php';
include 'bll/persistence/querygenerator/sources/QueryMySQLTable.class.php';
include 'bll/persistence/querygenerator/sources/ValidSQLSourceTypes.class.php';

include 'library/arrayof/ArrayOf.php';
include 'library/arrayof/ArrayOfInterface.php';
include 'library/arrayof/arrayof/Exception.php'
*/
error_reporting(E_ALL & ~E_DEPRECATED & ~E_WARNING & ~E_STRICT & ~E_NOTICE);
        ini_set('display_errors','On');
$array = array(new QueryConstant(5), array(new QueryConstant(6)));        
        
$t = new QueryArrayOfSelectable(new QueryConstant(5));



?>