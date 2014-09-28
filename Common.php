<?php
if ( ! function_exists('load_class')) {
	// Registro de clases singleton
	function &load_class_from_registry($class,$ruta)
	{
		// Esta declaración es resulta en tiempo de compilacion
		// Se ejecuta solamente una vez.
		static $_classes = array();
		
		if (isset($_classes[$class])){
			return $_classes[$class];
		}
		require_once "$ruta";
		$_classes[$class] = new $class();
		return $_classes[$class];
	}
}

if ( ! function_exists('getBenchmarkInstance')) {	
	function &getBenchmarkInstance(){
		return load_class_from_registry("Benchmark", "Benchmark.php");
	}
}

if ( ! function_exists('getOutputInstance')) {
	function &getOutputInstance(){
		return load_class_from_registry("Output", "Output.php");
	}
}

?>
