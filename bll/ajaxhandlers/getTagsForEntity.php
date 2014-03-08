<?php

if(!isset($_SERVER['DOCUMENT_ROOT'])){ if(isset($_SERVER['SCRIPT_FILENAME'])){
$_SERVER['DOCUMENT_ROOT'] = str_replace( '\\', '/', substr($_SERVER['SCRIPT_FILENAME'], 0, 0-strlen($_SERVER['PHP_SELF'])));
}; };
if(!isset($_SERVER['DOCUMENT_ROOT'])){ if(isset($_SERVER['PATH_TRANSLATED'])){
$_SERVER['DOCUMENT_ROOT'] = str_replace( '\\', '/', substr(str_replace('\\\\', '\\', $_SERVER['PATH_TRANSLATED']), 0, 0-strlen($_SERVER['PHP_SELF'])));
}; };

        require_once ($_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'library' . DIRECTORY_SEPARATOR . 'bootstrap.php');

if(isset($_REQUEST["entity_ID"]) && is_numeric($_REQUEST["entity_ID"])) {$entity_ID = (int)$_REQUEST["entity_ID"];} else { $entity_ID = null;}


if(!isset($entity_ID))
{
    throw new Exception("cannot publish dashboard tab");
}



//$returnMe = '{tagIds: [], description: ''}';
// $description = '';
// ini_set('display_errors',1);
// ini_set('display_startup_errors',1);
// error_reporting(-1);

$tagIds = '[' . implode(',', TC_Utility::getTagIdsForEntity($entity_ID)) . ']';
$description = '';
// $dv = new TC_THOR_ContainerDatabaseManager(MySQLConfig::dsConnect())->get_containersMasterQuery();


$dv = new THOR_DataView();

$ent = new THOR_ENTITIES_DataBoundSimplePersistable();
$ent->populateFromKey($entity_ID);
$cont = new TC_THOR_CONTAINERS_DataBoundSimplePersistable();
$contLink = new DataViewKeyPair(	'row_id',
	                                $ent->getUniqueReferenceKey(),
	                                $cont->get_keyName(),
	                                $cont->getUniqueReferenceKey(),
	                                false);



$dv->startWeb($ent, 'ENTITIES');
$dv->addToWeb($cont, 'CONTAINERS', array($contLink), ValidQueryJoinTypes::INNER, array(), false);

$friendlies = $dv->get_friendlyNames();
$memID = $friendlies['CONTAINERS'];

$persistables = $dv->get_persistableInputCollection();
// $returnMe = array();

$container_description_key = $dv->encodeColumnForSQL($persistables[$friendlies['CONTAINERS']],
                                  'description');


$dv->generateSQL();
$dv->execute();
while($row = $dv->read())
{

	$description = $row->$container_description_key;
}
// while($set = $dv->readObjectRow())
// {
// 		$description = $row->$container_description_key;
//     // $description = addslashes($set[$memID]->description) ; // ? $set[$memID]->description : '';
// }

// $description = $ent->description ? $ent->description : '';
$returnMe = json_encode(array('tagIds' => TC_Utility::getTagIdsForEntity($entity_ID), 'description' => $description));
// $returnMe = '{"tagIds": ' . $tagIds . ',' . '"description": "' . $description . '"}';
// logError($returnMe);
echo $returnMe;


?>