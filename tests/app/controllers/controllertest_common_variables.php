<?php
namespace mcanan\app\controllers;

class controllertest_common_variables extends \mcanan\framework\BasicController
{
    public function __construct()
    {
        parent::__construct(getcwd()."/app/views/viewlayout_common_variables.php");
    }

    public function actionTest()
    {
        $this->render("./app/views/viewtest_common_variables.php", ['titulo']);
    }
}
