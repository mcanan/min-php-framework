<?php
require_once('Base.php');
require_once('Db2.php');

/**
 * Abstract base class for a batch process
 */
abstract class BatchProcess extends Base {
	protected $db;
	protected $mensajeFinal;
	
	function __construct($db) {
		$this->db = $db;
		$this->loadModel("Log");
	}
		
	protected function setMensajeFinal($mensajeFinal){
		$this->mensajeFinal = $mensajeFinal;
	}
		
	protected abstract function main();
	
	protected function error($descripcion){
		$this->Log->insert('E', get_class($this), $descripcion);
	}
	
	protected function info($descripcion){
		$this->Log->insert('I', get_class($this), $descripcion);
	}
	
	protected function debug($descripcion){
		$this->Log->insert('D', get_class($this), $descripcion);
	}
	
	protected function preProcess(){}
	protected function postProcess(){}
	
	public function run(){
		echo "Inicio\n";
		$this->Log->insert("I",get_class($this),"Inicio");
		$this->preProcess();
		$this->main();
		$this->postProcess();
		$this->Log->insert("I",get_class($this),"Fin");
		echo "Fin\n";
	}
	
	protected function loadModel($modelName, $name=''){
		if (is_array($modelName)){
			foreach ($modelName as $m)	{
				$this->loadModel($m);
			}
			return $this;
		}
	
		if (empty($name)){
			$name = $modelName;
		}
	
		require_once './app/models/'.strtolower($modelName).'.php';
		$this->$name = new $modelName($this->db);
		return $this;
	}
}
?>
