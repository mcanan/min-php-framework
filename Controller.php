<?php
namespace mcanan\framework;

/**
* Abstract base class for a controller
*/
abstract class Controller extends Base
{
    private $db = null;
    private $showBenchmarks = false;
    private $benchmark;
    private $output;

    public function __construct()
    {
        $this->benchmark =& getBenchmarkInstance();
        $this->output =& getOutputInstance();
        $this->benchmark->mark("controller_construct");
        $this->db = new Db2();
    }

    protected function mark($m)
    {
        $this->benchmark->mark($m);
    }
    
    protected function getBenchmark()
    {
        return $this->benchmark;
    }

    protected function getOutput()
    {
        return $this->output;
    }

    protected function setShowBenchmarks($show)
    {
        $this->showBenchmarks = $show;
    }

    protected function isShowBenchmarks()
    {
        return $this->showBenchmarks;
    }

    protected function loadModel($modelName, $name = '')
    {
        if (is_array($modelName)) {
            foreach ($modelName as $m) {
                $this->loadModel($m);
            }
            return $this;
        }

        if (empty($name)) {
            $name = $modelName;
        }

        require_once $this->getDocumentRoot().'/app/models/'.strtolower($modelName).'.php';
        $modelName = "\\mcanan\\app\\models\\".$modelName;
        $this->$name = new $modelName($this->db);

        return $this;
    }

    protected function loadBatch($batchName, $name = '')
    {
        if (is_array($batchName)) {
            foreach ($batchName as $b) {
                $this->loadBatch($b);
            }
            return $this;
        }

        if (empty($name)) {
            $name = $batchName;
        }

        require_once $this->getDocumentRoot().'/app/batchs/'.strtolower($batchName).'.php';
        $batchName = "\\mcanan\\app\\batchs\\".$batchName;
        $this->$name = new $batchName($this->db);

        return $this;
    }

    protected function getRequestParameter($parameter, $default)
    {
        return isset($_REQUEST["$parameter"]) ? $_REQUEST["$parameter"] : $default;
    }

    protected function getRequestParameterOrSession($parameter, $default)
    {
        if (isset($_REQUEST["$parameter"])){
            $_SESSION["$parameter"] = $_REQUEST["$parameter"];
            return $_REQUEST["$parameter"];
        } else if(isset($_SESSION["$parameter"])){
            return $_SESSION["$parameter"];
        } else {
            return $default;    
        }
    }

    /* TODO: Ver si la uso o no */
    protected function getRequestParameterOrCookie($parameter, $default)
    {
        if (isset($_REQUEST["$parameter"])){
            setcookie($parameter,$_REQUEST["$parameter"]);
            return $_REQUEST["$parameter"];
        } else if(isset($_COOKIE["$parameter"])){
            return $_COOKIE["$parameter"];
        } else {
            return $default;    
        }
    }

    protected function recursiveRenderToString($viewsArray, $commonVariables=NULL)
    {
        $this->getBenchmark()->mark("controller_recursiveRenderToString_start");
        $anterior = NULL;
        foreach ($viewsArray as $view) {
            if (!is_null($anterior)){
                $view->contenido = $anterior->render();
                if (!is_null($commonVariables)){
                    foreach ($commonVariables as $v) {
                        if (isset($anterior->defined_vars["$v"])){
                            $view->$v = $anterior->defined_vars["$v"];
                        }
                    }
                }
            }
            $anterior = $view;
        }
        if ($this->isShowBenchmarks()) {
            $retorno = $anterior->render()."%BENCHMARK%";
        } else {
            $retorno = $anterior->render();
        }
        $this->getBenchmark()->mark("controller_recursiveRenderToString_end");
        return $retorno;
    }
    
    protected function recursiveRender($viewsArray, $commonVariables=NULL)
    {
        $this->getBenchmark()->mark("controller_recursiveRender_start");
        $html = $this->recursiveRenderToString($viewsArray, $commonVariables);
        $this->getOutput()->setHtml($html);
        $this->getBenchmark()->mark("controller_recursiveRender_end");
    }

    protected function redirect($url, $error=false, $message='')
    {
        $_SESSION['error']=$error;
        $_SESSION['message']=$message;
        header("Location: $url");
    }

    protected function getFullUrl($url)
    {
        if (defined("CONF_URL_BASE")){
            return '/'.CONF_URL_BASE.$url;
        } else {
            return $url;
        }
    }
}
