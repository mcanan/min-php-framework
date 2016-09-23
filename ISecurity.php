<?php
namespace mcanan\framework;

interface ISecurity
{
    public function isAuthorized($controller, $action, $parameters);
    public function getAccessDeniedUrl();
}
