<?php

if(!isset($_SERVER['DOCUMENT_ROOT'])){ if(isset($_SERVER['SCRIPT_FILENAME'])){
$_SERVER['DOCUMENT_ROOT'] = str_replace( '\\', '/', substr($_SERVER['SCRIPT_FILENAME'], 0, 0-strlen($_SERVER['PHP_SELF'])));
}; };
if(!isset($_SERVER['DOCUMENT_ROOT'])){ if(isset($_SERVER['PATH_TRANSLATED'])){
$_SERVER['DOCUMENT_ROOT'] = str_replace( '\\', '/', substr(str_replace('\\\\', '\\', $_SERVER['PATH_TRANSLATED']), 0, 0-strlen($_SERVER['PHP_SELF'])));
}; };

        require_once ($_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'library' . DIRECTORY_SEPARATOR . 'bootstrap.php');

if(isset($_REQUEST["user_ID"]) && is_numeric($_REQUEST["user_ID"])) {$user_ID = (int)$_REQUEST["user_ID"];} else { $user_id = null;}
if(isset($_REQUEST["entity_ID"]) && is_numeric($_REQUEST["entity_ID"])) {$entity_ID = (int)$_REQUEST["entity_ID"];} else { $entity_ID = null;}
if(isset($_REQUEST["tags"])) {$tags = $_REQUEST["tags"];} else { $tags = null;}
if(isset($_REQUEST["description"])) {$description = addslashes($_REQUEST["description"]);} else { $description = null;}



if(!isset($user_ID))
{
    throw new Exception("cannot publish dashboard tab");
}
if(!isset($entity_ID))
{
    throw new Exception("cannot publish dashboard tab");
}
if(isset($tags))
{
		$tags = json_decode($tags);
}

// logError($description);
// $returnMe = '';

error_reporting(0);

// var_dump($tags);
if(!TC_Utility::publishPage($user_ID, $entity_ID, $description, $tags)){
		echo 'max';
		return;
}

echo 1 ;


?>