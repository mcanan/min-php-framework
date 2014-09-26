<?php
require_once 'Common.php';
require_once 'IRouter.php';
require_once 'BasicRouter.php';

class Application
{
	private $urls_cache = array();
	private $router = null;

	public function __construct(){
	}

	public function setRouter($router){
		$this->router = $router;
	}

	public function setCacheUrl($controller,$action,$time){
		$this->urls_cache[$controller][$action]=$time;
	}

	public function setDefaultController($default_controller){
		$this->router->setDefaultController($default_controller);
	}

	public function setDefaultAction($default_action){
		$this->router->setDefaultAction($default_action);
	}

	public function loadConfigurationFile($file){
		require_once($file);
	}
	
	public function init(){
		$benchmark =& getBenchmarkInstance();
		$benchmark->mark("application_start");
		$output =& getOutputInstance();

		if ($this->router==null){
			// Si no tengo router definido, le asigno el basico
			$this->router = new BasicRouter();
		}

		$url = isset($_GET['url']) ? $_GET['url'] : '';
		$this->router->setUrl($url);

		$controller = $this->router->getController();
		$action = $this->router->getAction();

		// Verifico cache
		if ( isset($this->urls_cache[$controller][$action])) {
			$time = $this->urls_cache[$controller][$action];
			if ($output->displayFromCache($controller,$action,$time)){
				// Imprimo desde cache y salgo
				exit;
			}
		}

		$benchmark->mark("controller_start c:$controller a:$action");
		$this->router->dispatch();
		$benchmark->mark("controller_end");
		$benchmark->mark("application_end");
		$output->display($controller,$action);
	}
}
?>
