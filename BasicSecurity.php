<?php
namespace mcanan\framework;

class BasicSecurity implements ISecurity
{
    const VARIABLE_NAME  = 'bs';

    function isAuthorized($controller, $action, $parameters)
    {
        if (!isset($_SESSION)){
            session_start();
        }
        if (isset($_SESSION[self::VARIABLE_NAME])){
			return true;
		} else {
			return false;
        }
    }

    function getAccessDeniedUrl()
    {
        return null;
    }
    
    function login($user){
        if (!isset($_SESSION)){
            session_start();
        }
        $_SESSION[self::VARIABLE_NAME] = $user;
    }
    
    function getUser(){
        if (!isset($_SESSION)){
            session_start();
        }
        if (isset($_SESSION[self::VARIABLE_NAME])){
			return $_SESSION[self::VARIABLE_NAME];
		} else {
			return NULL;
        }
    }
}
?>
