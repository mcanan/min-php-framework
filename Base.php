<?php
namespace mcanan\framework;

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
            $libraryName = "\\mcanan\\app\\libraries\\".$libraryName;
            $this->$name = new $libraryName();
        } elseif (file_exists(__DIR__.'/libraries/'.strtolower($libraryName).'.php')) {
            require_once __DIR__.'/libraries/'.strtolower($libraryName).'.php';
            $libraryName = "\\mcanan\\framework\\libraries\\".$libraryName;
            $this->$name = new $libraryName();
        }

        return $this;
    }

    protected function getDocumentRoot()
    {
        if (defined("CONF_DOCUMENT_ROOT")) {
            return CONF_DOCUMENT_ROOT;
        } else {
            if (defined("CONF_URL_BASE")){
                return $_SERVER["DOCUMENT_ROOT"].'/'.CONF_URL_BASE;
            } else {
                return $_SERVER["DOCUMENT_ROOT"];
            }
        }
    }

    protected function getFullPath($url)
    {
        return getDocumentRoot().$url;
    }
}
