<?php
namespace mcanan\framework;

class BasicSecurity implements ISecurity
{
    const VARIABLE_NAME  = 'bs';

    function isAuthorized($url, $controller, $action, $parameters)
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

    function login($user)
    {
        if (!isset($_SESSION)){
            session_start();
        }
        $_SESSION[self::VARIABLE_NAME] = $user;
    }

    function logout()
    {
        if (!isset($_SESSION)){
            session_start();
        }
        unset($_SESSION[self::VARIABLE_NAME]);
    }

    function getUser()
    {
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
