<?php
namespace mcanan\framework;

require_once 'Common.php';

class Application
{
    private $router = null;
    private $cache = null;
    private $security = null;

    public function setCacheUrl($controller, $action, $time)
    {
        $this->getCache()->setUrl($controller, $action, NULL, $time);
    }

    public function setRouter($router)
    {
        $this->router = $router;
    }

    public function setCache($cache)
    {
        $this->cache = $cache;
    }

    public function setSecurity($security)
    {
        $this->security = $security;
    }

    public function getRouter()
    {
        if ($this->router==null) {
            require_once 'BasicRouter.php';
            $this->router = new BasicRouter();
        }

        return $this->router;
    }

    public function getCache()
    {
        if ($this->cache==null) {
            require_once 'BasicCache.php';
            $this->cache = new BasicCache();
        }

        return $this->cache;
    }

    public function getSecurity()
    {
        return $this->security;
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
        $parameters = $this->getRouter()->getParameters();
        
        // Verifico que este autorizado
        if (is_null($this->getSecurity()) || $this->getSecurity()->isAuthorized($controller, $action, $parameters) ) {
            // Verifico cache
            if ($this->getCache()->exists($controller, $action, $parameters)) {
                $time = $this->getCache()->getExpiration($controller, $action, $parameters);
                $fileName = $this->getCache()->getFilename($controller, $action, $parameters);
                if ($output->displayFromCache($fileName, $time)) {
                    // Imprimo desde cache y salgo
                    exit;
                }
            }
                
            $benchmark->mark("controller_start c:$controller a:$action");
            $this->getRouter()->dispatch();            $benchmark->mark("controller_end");
            $benchmark->mark("controller_end");
            $benchmark->mark("application_end");
            if ($output->hasContent()) {
                $output->display();
            }
        } else {
            $url = $this->getSecurity()->getAccessDeniedUrl();
            if (!is_null($url)){
                header('Location: '.$url);
            } else {
                header("HTTP/1.1 401 Unauthorized");
            }
            exit;
        }
    }
}
