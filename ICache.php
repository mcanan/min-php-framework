<?php
namespace mcanan\framework;

interface ICache
{
    public function setUrl($controller, $action, $parameters, $time);
    public function exists($controller, $action, $parameters);
    public function getExpiration($controller, $action, $parameters);
    public function getFilename($controller, $action, $parameters);
}
