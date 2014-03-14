<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CorridorAuthClient
 *
 * @author kottkedp
 */
class CorridorAuthClient {


    public static function authenticateUser()
    {
//require_once ($_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'library' . DIRECTORY_SEPARATOR . 'bootstrap.php');
        if (STAGING_ENVIRONMENT == true)
        {
            return 32;
        }
        else
        {
            $sso = $_SERVER['AUTH_USER'];
            $client = new SoapClient($_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'library' . DIRECTORY_SEPARATOR .'authentication/'."validateUser.wsdl");
            $userID = $client->getUserID($sso);
            if($userID == -1)
            {
                    return 9999999;
            }
            return $userID;
        }




    }
    public static function getUserImage()
    {
//require_once ($_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'library' . DIRECTORY_SEPARATOR . 'bootstrap.php');

        $sso = stripslashes($_SERVER['AUTH_USER']);
        $client = new SoapClient("D:\LCTPSites\Webroot/thecurrent_staging/discussion/wp-content/themes/currentdiscussion/validateUser.wsdl");
        $imagelink = $client->getUserImage($sso);
	  return $imagelink;

        //return 2234;

    }
}

?>
