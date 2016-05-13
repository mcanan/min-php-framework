<?php
namespace mcanan\framework;

class BasicCache implements ICache
{
    private $urls_cache = array();

    public function setUrl($controller, $action, $parameters, $time)
    {
        error_log("$controller $action");
        $this->urls_cache[$controller][$action]=$time;
    }

    public function exists($controller, $action, $parameters)
    {
        error_log("$controller $action");
        return isset($this->urls_cache[$controller][$action]);
    }

    public function getExpiration($controller, $action, $parameters)
    {
        return $this->urls_cache[$controller][$action];
    }
    
    public function getFilename($controller, $action, $parameters)
    {
        return $controller . "_" . $action;
    }
}
