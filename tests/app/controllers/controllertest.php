<?php
namespace mcanan\app\controllers;

class controllertest extends \mcanan\framework\BasicController
{
    public function __construct()
    {
        parent::__construct(getcwd()."/app/views/viewlayout.php");
    }

    public function actionTest()
    {
        $this->render("./app/views/viewtest.php");
    }

    public function actionCache()
    {
        $this->setShowBenchmarks(true);
        $this->render("./app/views/viewtest.php");
    }

    public function actionWithModelTest()
    {
        $this->loadModel("ModelTest");
        $this->set('items', $this->ModelTest->getItems());
        $this->render("./app/views/viewWithModel.php");
    }
}
