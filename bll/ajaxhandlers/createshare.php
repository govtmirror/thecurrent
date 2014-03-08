<?php

if(!isset($_SERVER['DOCUMENT_ROOT'])){ if(isset($_SERVER['SCRIPT_FILENAME'])){
$_SERVER['DOCUMENT_ROOT'] = str_replace( '\\', '/', substr($_SERVER['SCRIPT_FILENAME'], 0, 0-strlen($_SERVER['PHP_SELF'])));
}; };
if(!isset($_SERVER['DOCUMENT_ROOT'])){ if(isset($_SERVER['PATH_TRANSLATED'])){
$_SERVER['DOCUMENT_ROOT'] = str_replace( '\\', '/', substr(str_replace('\\\\', '\\', $_SERVER['PATH_TRANSLATED']), 0, 0-strlen($_SERVER['PHP_SELF'])));
}; };

        require_once ($_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'library' . DIRECTORY_SEPARATOR . 'bootstrap.php');     
        
if(isset($_REQUEST["user_ID"]) && is_numeric($_REQUEST["user_ID"])) {$user_ID = (int)$_REQUEST["user_ID"];}
if(isset($_REQUEST["entity_ID"]) && is_numeric($_REQUEST["entity_ID"])) {$entity_ID = (int)$_REQUEST["entity_ID"];}
//if(isset($_REQUEST["priority"]) && is_numeric($_REQUEST["priority"])) {$priority = (int)$_REQUEST["priority"];} 



if(!isset($user_ID))
{
    throw new Exception("cannot reorder dashboard tab");
}
if(!isset($entity_ID))
{
    throw new Exception("cannot reorder dashboard tab");
}


$returnMe = '';
        
error_reporting(0);
$accessgroup = TC_Utility::verifyAndGetSystemGroup();// getSystemGroupID();    
$returnMe = TC_Utility::cloneDashboard($user_ID, $entity_ID, $accessgroup->get_keyValue());
    
echo SITE_DOMAIN . '/' . SHAREPAGEPATH ."?entity_ID=". $returnMe->get_entity_id();
 

?>