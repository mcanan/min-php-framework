<?php
namespace mcanan\app\controllers;

class controllertest_security extends \mcanan\framework\BasicController
{
    public function __construct()
    {
        parent::__construct(getcwd()."/app/views/viewlayout_security.php");
    }

    public function index()
    {
        $this->render("./app/views/viewtest_security.php");
    }
}
