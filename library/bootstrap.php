<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

if(!isset($bootstrapped))
{
?>

        
<?php

    require_once ($_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'config.php');
    require_once (ROOT . DS . 'library' . DS . 'functions.php');
    require_once (ROOT . DS . 'library' . DS . 'Autoloader.class.php');
    require_once (ROOT . DS . 'library' . DS . 'shared.php');
    
    //require_once (ROOT . DS . 'library' . DS . 'templatetags.php');
    
}




    


$bootstrapped = true;
?>
