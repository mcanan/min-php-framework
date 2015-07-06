<?php
namespace mcanan\framework;

require 'Autoloader.php';
require_once 'Common.php';

class Application
{
    private $urls_cache = array();
    private $router        = null;

    public function __construct()
    {
    }

    public function setRouter($router)
    {
        $this->router = $router;
    }

    public function getRouter()
    {
        if ($this->router==null) {
            require_once 'BasicRouter.php';
            $this->router = new BasicRouter();
        }

        return $this->router;
    }

    public function setCacheUrl($controller, $action, $time)
    {
        $this->urls_cache[$controller][$action]=$time;
    }

    public function loadConfigurationFile($file)
    {
        require_once $file;
    }

    public function init()
    {
        $benchmark =& getBenchmarkInstance();
        $benchmark->mark("application_start");
        $output =& getOutputInstance();

        $url = isset($_GET['url']) ? $_GET['url'] : '';
        $this->getRouter()->setUrl($url);

        $controller = $this->getRouter()->getController();
        $action = $this->getRouter()->getAction();

        // Verifico cache
        // TODO: Arreglar cache en url con parametros
        if (isset($this->urls_cache[$controller][$action])) {
            $time = $this->urls_cache[$controller][$action];
            if ($output->displayFromCache($controller, $action, $time)) {
                // Imprimo desde cache y salgo
                exit;
            }
        }

        $benchmark->mark("controller_start c:$controller a:$action");
        $this->getRouter()->dispatch();
        $benchmark->mark("controller_end");
        $benchmark->mark("application_end");
        if ($output->hasContent()) {
            $output->display($controller, $action);
        }
    }
}
