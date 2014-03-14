<?php

if(!isset($_SERVER['DOCUMENT_ROOT'])){ if(isset($_SERVER['SCRIPT_FILENAME'])){
$_SERVER['DOCUMENT_ROOT'] = str_replace( '\\', '/', substr($_SERVER['SCRIPT_FILENAME'], 0, 0-strlen($_SERVER['PHP_SELF'])));
}; };
if(!isset($_SERVER['DOCUMENT_ROOT'])){ if(isset($_SERVER['PATH_TRANSLATED'])){
$_SERVER['DOCUMENT_ROOT'] = str_replace( '\\', '/', substr(str_replace('\\\\', '\\', $_SERVER['PATH_TRANSLATED']), 0, 0-strlen($_SERVER['PHP_SELF'])));
}; };

        require_once ($_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'library' . DIRECTORY_SEPARATOR . 'bootstrap.php');

if(isset($_REQUEST["tag_ids"])) {$tag_ids = $_REQUEST["tag_ids"];} else { $tag_ids = null;}

// echo var_export(json_decode($tag_ids), true);
if(isset($tag_ids))
{
		$tag_ids = json_decode($tag_ids);
}

// $countArr = TC_Utility::getTagCountArray($tag_ids);
$countArr = TC_Utility::getUsedTagCount(15);

echo json_encode($countArr);


?>