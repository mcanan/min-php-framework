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
		extract($this->vars);
		ob_start();
		include($this->template);
		return ob_get_clean();
	}
}
?>
