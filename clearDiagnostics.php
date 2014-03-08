<?php
$sRoot = $_SERVER['DOCUMENT_ROOT'];
        $myFile = $sRoot."/tmp/logs/diagnostic.php";
        $f = @fopen($myFile, "r+");
        if ($f !== false) 
        {
            ftruncate($f, 0);
            fclose($f);
        }
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
