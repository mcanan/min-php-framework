<?php
require_once (getcwd().'/../Controller.php');

class controllertest extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->layoutView->template = getcwd()."/app/views/viewlayout.php";
    }

    public function actionTest()
    {
        $this->render("./app/views/viewtest.php");
    }

    public function actionWithModelTest()
    {
        $this->loadModel("ModelTest");
        $this->contentView->items = $this->ModelTest->getItems();
        $this->render("./app/views/viewWithModel.php");
    }
}
