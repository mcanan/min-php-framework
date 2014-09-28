<?php
require_once('Base.php');

class View extends Base {
	protected $vars = array();

	public function __get($name) {
		return $this->vars[$name];
	}

	public function __set($name, $value) {
		$this->vars[$name] = $value;
	}

	public function render() {
		$contents = "";
		if(isset($this->vars['template']) && file_exists($this->vars['template'])){	
			extract($this->vars);
			ob_start();
			include($this->vars['template']);
			$contents = ob_get_contents();
			ob_end_clean();
		}
		return $contents;
	}
}
?>
