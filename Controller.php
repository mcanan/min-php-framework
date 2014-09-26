<?php
require_once 'Base.php';
require_once 'Db2.php';
require_once 'View.php';
require_once 'Common.php';

/**
 * Abstract base class for a controller
 */
abstract class Controller extends Base {
	private $db = null;
	protected $layoutView;
	protected $contentView;
	protected $showBenchmarks=false;
	protected $benchmark;
	protected $output;

	function __construct()	{
		$this->benchmark =& getBenchmarkInstance();
		$this->output =& getOutputInstance();
		$this->benchmark->mark("controller_construct");	
		$this->db = new Db2();
		$this->layoutView = new View();
		$this->contentView = new View();
	}

	protected function render($contentTemplateName){
		$this->benchmark->mark("controller_render_start");
		$this->contentView->template = $contentTemplateName;
		$this->layoutView->contenido = $this->contentView->render();

		if ($this->showBenchmarks){
			$this->output->setHtml($this->layoutView->render()."%BENCHMARK%");
		} else {
			$this->output->setHtml($this->layoutView->render());
		}
		$this->benchmark->mark("controller_render_end");
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

		require_once $_SERVER["DOCUMENT_ROOT"].'/app/models/'.strtolower($modelName).'.php';
		$this->$name = new $modelName($this->db);
		return $this;
	}

	protected function loadBatch($batchName, $name=''){
		if (is_array($batchName)){
			foreach ($batchName as $b)	{
				$this->loadBatch($b);
			}
			return $this;
		}

		if (empty($name)){
			$name = $batchName;
		}

		require_once $_SERVER["DOCUMENT_ROOT"].'/app/batchs/'.strtolower($batchName).'.php';
		$this->$name = new $batchName($this->db);
		return $this;
	}

	protected function setMensaje($error,$mensaje){
		$this->contentView->error = $error;
		$this->contentView->mensaje = $mensaje;
	}
}
?>
