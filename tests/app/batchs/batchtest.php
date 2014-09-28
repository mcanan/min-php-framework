<?php
require_once(getcwd().'/../BatchProcess.php');

class BatchTest extends BatchProcess
{
	function main()
	{
		$this->loadModel("ModelTest");		
		$items = $this->ModelTest->getItems();
		echo $items[0][1];
	}
}
?>
