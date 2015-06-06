<?php
namespace mcanan\app\controllers;

class home extends \mcanan\framework\BasicController
{
    public function __construct()
    {
        parent::__construct(getcwd()."/app/views/viewlayout.php");
    }

    public function index()
    {
        $this->render(getcwd()."/app/views/viewhome.php");
    }

    public function action()
    {
        $this->render(getcwd()."/app/views/viewaction.php");
    }
}
