<?php
namespace mcanan\framework;

class BasicRouter implements IRouter
{
    private $url_controller = null;
    private $url_action = null;
    private $url_parameter_1 = null;
    private $url_parameter_2 = null;
    private $url_parameter_3 = null;
    private $url_original;
    private $default_controller = 'home';
    private $default_action = 'index';

    public function __construct()
    {
    }

    public function setDefaultController($default_controller)
    {
        $this->default_controller = $default_controller;
    }

    public function setDefaultAction($default_action)
    {
        $this->default_action = $default_action;
    }

    public function getController()
    {
        return $this->url_controller;
    }

    public function getAction()
    {
        return $this->url_action;
    }
    
    public function getParameters()
    {
        // TODO
        return null;
    }

    public function dispatch()
    {
        $url = './app/controllers/' . $this->url_controller . '.php';

        if (file_exists($url)) {
            require_once "$url";
            $controller = "\\mcanan\\app\\controllers\\".ucwords(strtolower($this->url_controller));
            $instance = new $controller();

            if (method_exists($instance, $this->url_action)) {
                if (isset($this->url_parameter_3)) {
                    $instance->{$this->url_action}(
                        $this->url_parameter_1,
                        $this->url_parameter_2,
                        $this->url_parameter_3
                    );
                } elseif (isset($this->url_parameter_2)) {
                    $instance->{$this->url_action}($this->url_parameter_1, $this->url_parameter_2);
                } elseif (isset($this->url_parameter_1)) {
                    $instance->{$this->url_action}($this->url_parameter_1);
                } else {
                    $instance->{$this->url_action}();
                }
            } else {
                if (method_exists($instance, $this->default_action)) {
                    $instance->{$this->default_action}();
                } else {
                    // Invalid URL
                    error_log("Invalid URL: ".$this->url_original);
                    require './app/controllers/'.$this->default_controller.'.php';
                    $controller = "\\mcanan\\app\\controllers\\".$this->default_controller;
                    $instance = new $controller;
                    $instance->{$this->default_action}();
                }
            }
        } else {
            if (defined("CONF_ERROR_404_DEFAULT_CONTROLLER") && CONF_ERROR_404_DEFAULT_CONTROLLER=='Y') {
                // Invalid URL
                error_log("Invalid URL: ".$this->url_original);
                require './app/controllers/'.$this->default_controller.'.php';
                $controller = "\\mcanan\\app\\controllers\\".$this->default_controller;
                $instance = new $controller;
                $instance->{$this->default_action}();
            } else {
                header("HTTP/1.1 404 Not Found");
            }
        }
    }

    public function setUrl($url)
    {
        if ($url!='') {
            $this->url_original = $url;
            $url = rtrim($this->url_original, '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);

            $this->url_controller = (isset($url[0]) ? strtolower($url[0]) : $this->default_controller);
            $this->url_action = (isset($url[1]) ? strtolower($url[1]) : $this->default_action);
            $this->url_parameter_1 = (isset($url[2]) ? $url[2] : null);
            $this->url_parameter_2 = (isset($url[3]) ? $url[3] : null);
            $this->url_parameter_3 = (isset($url[4]) ? $url[4] : null);
        } else {
            $this->url_original = '';
            $this->url_controller = $this->default_controller;
            $this->url_action = $this->default_action;
            $this->url_parameter_1 = null;
            $this->url_parameter_2 = null;
            $this->url_parameter_3 = null;
        }
    }
}
