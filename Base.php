<?php
/**
 * Abstract base class for all classes
 */
abstract class Base {

	protected function loadHelper($helperName){
		if (is_array($helperName))
		{
			foreach ($helperName as $h)	{
				$this->loadHelper($h);
			}

			return $this;
		}

		if (file_exists($_SERVER["DOCUMENT_ROOT"].'/app/helpers/'.strtolower($helperName).'.php')){
			require_once $_SERVER["DOCUMENT_ROOT"].'/app/helpers/'.strtolower($helperName).'.php';
		} else if (file_exists($_SERVER["DOCUMENT_ROOT"].'/framework/helpers/'.strtolower($helperName).'.php')){
			require_once $_SERVER["DOCUMENT_ROOT"].'/framework/helpers/'.strtolower($helperName).'.php';
		}
		return $this;
	}

	protected function loadLibrary($libraryName,$name=''){
		if (is_array($libraryName)){
			foreach ($libraryName as $l){
				$this->loadLibrary($l);
			}
			return $this;
		}

		if (empty($name)){
			$name = $libraryName;
		}

		if (file_exists($_SERVER["DOCUMENT_ROOT"].'/app/libraries/'.strtolower($libraryName).'.php')){
			require_once $_SERVER["DOCUMENT_ROOT"].'/app/libraries/'.strtolower($libraryName).'.php';
			$this->$name = new $libraryName();
		} else if (file_exists($_SERVER["DOCUMENT_ROOT"].'/framework/libraries/'.strtolower($libraryName).'.php')){
			require_once $_SERVER["DOCUMENT_ROOT"].'/framework/libraries/'.strtolower($libraryName).'.php';
			$this->$name = new $libraryName();
		}
		return $this;
	}
}
?>
