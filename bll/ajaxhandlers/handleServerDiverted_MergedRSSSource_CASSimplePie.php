<?php

if(!isset($_SERVER['DOCUMENT_ROOT'])){ if(isset($_SERVER['SCRIPT_FILENAME'])){
$_SERVER['DOCUMENT_ROOT'] = str_replace( '\\', '/', substr($_SERVER['SCRIPT_FILENAME'], 0, 0-strlen($_SERVER['PHP_SELF'])));
}; };
if(!isset($_SERVER['DOCUMENT_ROOT'])){ if(isset($_SERVER['PATH_TRANSLATED'])){
$_SERVER['DOCUMENT_ROOT'] = str_replace( '\\', '/', substr(str_replace('\\\\', '\\', $_SERVER['PATH_TRANSLATED']), 0, 0-strlen($_SERVER['PHP_SELF'])));
}; };


require_once ($_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'library' . DIRECTORY_SEPARATOR . 'bootstrap.php');   

if(isset($_REQUEST["widgetEntity_ID"]) && is_numeric($_REQUEST["widgetEntity_ID"])) {$widgetEntity_ID = (int)$_REQUEST["widgetEntity_ID"];}

 render(WIDGET_VIEW_PATH,'TC_MergedRSSSource_SSSimplePie_CAS.php', array('widgetEntity_ID' => $widgetEntity_ID));
?>
