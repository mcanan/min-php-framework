<?php
namespace mcanan\app\batchs;

class batchtest extends \mcanan\framework\BatchProcess
{
    public function main()
    {
        $this->loadModel("ModelTest");
        $items = $this->ModelTest->getItems();
        echo $items[0][1];
    }
}
