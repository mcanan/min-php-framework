<?php
namespace mcanan\framework;

class BasicSecurity implements ISecurity
{
    function isAuthorized($controller, $action, $parameters)
    {
        if (isset($_SESSION[CONF_AUTH_TOKEN])){
			return true;
		} else {
			return false;
        }
    }

    function getAccessDeniedUrl()
    {
        return null;
    }
}
?>
