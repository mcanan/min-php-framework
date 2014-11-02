<?php
require_once 'BasicController.php';

class AuthController extends BasicController 
{
	function __construct($layout)
    {
        session_start();
        error_log("authcontroller-constructor ".$_SESSION[CONF_AUTH_TOKEN]);
        if (!$this->isAuthorized()){
            $this->logout();
        } else {
            parent::__construct($layout);
        }
    }

	protected function logout(){
        unset($_SESSION[CONF_AUTH_TOKEN]);
        header('Location: /login');
        exit();
    }

	protected function isAuthorized(){
        if (isset($_SESSION[CONF_AUTH_TOKEN])){
			return true;
		} else {
			return false;
		}
	}
}
?>
