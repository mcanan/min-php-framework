<?php
namespace mcanan\framework;

class AuthController extends BasicController 
{
	function __construct($layout)
    {
        session_start();
        if (!$this->isAuthorized()){
            $this->logout();
        } else {
            parent::__construct($layout);
        }
    }

    protected function logout()
    {
        unset($_SESSION[CONF_AUTH_TOKEN]);
        if (defined('CONF_URL_BASE')){
            header('Location: /'.CONF_URL_BASE.'/login');
        } else {
            header('Location: /login');
        }
        exit();
    }

    protected function isAuthorized()
    {
        if (isset($_SESSION[CONF_AUTH_TOKEN])){
			return true;
		} else {
			return false;
		}
    }

    protected function getLoggedUser()
    {
        if (isset($_SESSION[CONF_AUTH_TOKEN])){
			return $_SESSION[CONF_AUTH_TOKEN];
		} else {
			return NULL;
		}
    }
}
?>
