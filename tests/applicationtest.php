<?php
require '../Application.php';

class ApplicationTest extends PHPUnit_Framework_TestCase
{
	public function setUp()
	{
		// Clean the singleton registry
		$benchmark =& getBenchmarkInstance();
		$output =& getOutputInstance();
		$output->setHtml("");
		$benchmark->reset();
	}

	public function testDefaultControllerDefaultAction()
	{
		$this->expectOutputString('<html><body>home</body></html>'.PHP_EOL);

		$app = new Application();
		$app->loadConfigurationFile("./app/conf/configTest.php");
		$app->init();
	}

	public function testDefaultController()
	{
		$this->expectOutputString('<html><body>action</body></html>'.PHP_EOL);

		$app = new Application();
		$app->loadConfigurationFile("./app/conf/configTest.php");
		$app->getRouter()->setDefaultAction("action");
		$app->init();
	}

	public function testControllerTest()
	{
		$this->expectOutputString('<html><body>test</body></html>'.PHP_EOL);

		$app = new Application();
		$app->loadConfigurationFile("./app/conf/configTest.php");
		$app->getRouter()->setDefaultController("controllertest");	
		$app->getRouter()->setDefaultAction("actionTest");
		$app->init();
	}
	
	public function testControllerTestWithModel()
	{
		$this->expectOutputString('<html><body>Item2</body></html>'.PHP_EOL);

		$app = new Application();
		$app->loadConfigurationFile("./app/conf/configTest.php");
		$app->getRouter()->setDefaultController("controllertest");	
		$app->getRouter()->setDefaultAction("actionWithModelTest");
		$app->init();
	}
	
	public function testBatchTestWithModel()
	{
		$this->expectOutputString('Inicio'.PHP_EOL.'Item1Fin'.PHP_EOL);

		$app = new Application();
		$app->loadConfigurationFile("./app/conf/configTest.php");
		$app->getRouter()->setDefaultController("batchcontrollertest");	
		$app->getRouter()->setDefaultAction("batchTest");
		$app->init();
	}	

	// TODO :  Test de Cache, test de Benchmark y test de BasicRouter
}
