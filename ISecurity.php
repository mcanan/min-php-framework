<?php
namespace mcanan\framework;

interface ISecurity
{
    public function isAuthorized($controller, $action, $parameters);
    public function getAccessDeniedUrl();
    public function login($user);
    public function getUser();
}
