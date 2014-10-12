<?php
require_once 'Base.php';
require_once 'Db2.php';
require_once 'View.php';
require_once 'Common.php';

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
        $this->$name = new $batchName($this->db);

        return $this;
    }

    protected function getRequestParameter($parameter, $default)
    {
        return isset($_REQUEST["$parameter"]) ? $_REQUEST["$parameter"] : $default;
    }
}
