<?php
/**
* Abstract base class for all classes
*/
abstract class Base
{
    protected function loadHelper($helperName)
    {
        if (is_array($helperName)) {
            foreach ($helperName as $h) {
                $this->loadHelper($h);
            }

            return $this;
        }

        if (file_exists($this->getDocumentRoot().'/app/helpers/'.strtolower($helperName).'.php')) {
            require_once $this->getDocumentRoot().'/app/helpers/'.strtolower($helperName).'.php';
        } elseif (file_exists($this->getDocumentRoot().'/framework/helpers/'.strtolower($helperName).'.php')) {
            require_once $this->getDocumentRoot().'/framework/helpers/'.strtolower($helperName).'.php';
        }

        return $this;
    }

    protected function loadLibrary($libraryName, $name = '')
    {
        if (is_array($libraryName)) {
            foreach ($libraryName as $l) {
                $this->loadLibrary($l);
            }

            return $this;
        }

        if (empty($name)) {
            $name = $libraryName;
        }

        if (file_exists($this->getDocumentRoot().'/app/libraries/'.strtolower($libraryName).'.php')) {
            require_once $this->getDocumentRoot().'/app/libraries/'.strtolower($libraryName).'.php';
            $this->$name = new $libraryName();
        } elseif (file_exists($this->getDocumentRoot().'/framework/libraries/'.strtolower($libraryName).'.php')) {
            require_once $this->getDocumentRoot().'/framework/libraries/'.strtolower($libraryName).'.php';
            $this->$name = new $libraryName();
        }

        return $this;
    }

    protected function getDocumentRoot()
    {
        if (defined("CONFIG_DOCUMENT_ROOT")) {
            return CONFIG_DOCUMENT_ROOT;
        } else {
            if (defined("CONF_URL_BASE")){
                return $_SERVER["DOCUMENT_ROOT"].'/'.CONF_URL_BASE;
            } else {
                return $_SERVER["DOCUMENT_ROOT"];
            }
        }
    }
}
