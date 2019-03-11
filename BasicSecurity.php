<?php
namespace mcanan\framework;

class BasicSecurity implements ISecurity
{
    const VARIABLE_NAME  = 'bs';

    public function isAuthorized($url, $controller, $action, $parameters)
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        if (isset($_SESSION[self::VARIABLE_NAME])) {
            return true;
        } else {
            return false;
        }
    }

    public function getAccessDeniedUrl()
    {
        return null;
    }

    public function login($user)
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        $_SESSION[self::VARIABLE_NAME] = $user;
    }

    public function logout()
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        unset($_SESSION[self::VARIABLE_NAME]);
    }

    public function getUser()
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        if (isset($_SESSION[self::VARIABLE_NAME])) {
            return $_SESSION[self::VARIABLE_NAME];
        } else {
            return null;
        }
    }
}
