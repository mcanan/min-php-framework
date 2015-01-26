<?php
require_once 'Base.php';
require_once 'Db2.php';

/**
* Abstract base class for a batch process
*/
abstract class BatchProcess extends Base
{
    protected $db;
    protected $mensajeFinal;

    public function __construct($db)
    {
        $this->db = $db;
        $this->loadModel("Log"); // Requiere tener creado un modelo Log.
    }

    protected function setMensajeFinal($mensajeFinal)
    {
        $this->mensajeFinal = $mensajeFinal;
    }

    abstract protected function main();

    protected function error($descripcion)
    {
        if (isset($this->Log)) {
            $this->Log->insert('E', get_class($this), $descripcion);
        } else {
            if (!defined('CONFIG_TEST_ENVIRONMENT')) {
                error_log("LOG: E - ".get_class($this)." $descripcion");
            }
        }
    }

    protected function info($descripcion)
    {
        if (isset($this->Log)) {
            $this->Log->insert('I', get_class($this), $descripcion);
        } else {
            if (!defined('CONFIG_TEST_ENVIRONMENT')) {
                error_log("LOG: I - ".get_class($this)." $descripcion");
            }
        }
    }

    protected function debug($descripcion)
    {
        if (isset($this->Log)) {
            $this->Log->insert('D', get_class($this), $descripcion);
        } else {
            if (!defined('CONFIG_TEST_ENVIRONMENT')) {
                error_log("LOG: D - ".get_class($this)." $descripcion");
            }
        }
    }

    protected function preProcess()
    {
    }
    
    protected function postProcess()
    {
    }

    public function run()
    {
        $this->info("Inicio");
        $this->preProcess();
        $this->main();
        $this->postProcess();
        $this->info("Fin");
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

        if (file_exists($this->getDocumentRoot().'/app/models/'.strtolower($modelName).'.php')) {
            require_once $this->getDocumentRoot().'/app/models/'.strtolower($modelName).'.php';
            $this->$name = new $modelName($this->db);
        }

        return $this;
    }
}
