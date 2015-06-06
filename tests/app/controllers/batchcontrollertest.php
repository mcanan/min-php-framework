<?php
namespace mcanan\app\controllers;

class batchcontrollertest extends \mcanan\framework\Controller
{
    public function batchTest()
    {
        $this->loadBatch("BatchTest");
        $this->BatchTest->run();
    }
}
