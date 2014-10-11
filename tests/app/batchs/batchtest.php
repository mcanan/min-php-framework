<?php
require_once (getcwd().'/../BatchProcess.php');

class batchtest extends BatchProcess
{
    public function main()
    {
        $this->loadModel("ModelTest");
        $items = $this->ModelTest->getItems();
        echo $items[0][1];
    }
}
