<?php
require_once(getcwd().'/../Controller.php');

class BatchControllerTest extends Controller
{
	public function batchTest()
	{
		$this->loadBatch("BatchTest");	
		$this->BatchTest->run();
	}
}
?>
