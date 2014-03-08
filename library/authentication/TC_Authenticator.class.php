<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TC_Authenticator
 *
 * @author kottkedp
 */
class TC_Authenticator {

    //private $userID;

    public function __construct() {


    }

    public static function getUserIDAndInitialize()
    {

        $userID = self::getUserID();
        //system user should be initialized in main current init
        // if($userID !== SYSTEM_USER_ID)
        // {
            $accessgroup = TC_Utility::initializeNewUser($userID);
            //TC_Authenticator::userInitialization($userID);
        // }
        $returnMe = array();
        $returnMe[0] = $userID;
        $returnMe[1] = $accessgroup->get_keyValue();
        return $returnMe;


    }

    public static function getUserID()
    {
        global $userID;
        //if(!array_key_exists('userID', $GLOBALS))
        if(!isset($userID) || $userID === SYSTEM_USER_ID)
        {

                try
                {
                    $userID = CorridorAuthClient::authenticateUser();
                }
                catch (Exception $e)
                {
                    $userID = SYSTEM_USER_ID;
                }

        }

        return $userID;
    }




}

?>
