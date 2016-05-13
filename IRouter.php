<?php
namespace mcanan\framework;

interface IRouter
{
    public function setUrl($url);
    public function dispatch();
    public function setDefaultController($default_controller);
    public function setDefaultAction($default_action);
    public function getController();
    public function getAction();
    public function getParameters();
}
