<?php
namespace mcanan\framework\tests\phpUnitTests;

require_once '../Autoloader.php';
require_once '../Common.php';

class ApplicationTest extends BaseTest
{
    public function testDefaultControllerDefaultAction()
    {
        $this->expectOutputString('<html><body>home</body></html>'.PHP_EOL);
        echo $this->getUrlHttp($this->url);
    }

    public function testDefaultController()
    {
        $this->expectOutputString('<html><body>action</body></html>'.PHP_EOL);
        echo $this->getUrlHttp($this->url."/home/action");
    }

    public function testDefaultController2()
    {
        $this->expectOutputString('<html><body>action</body></html>'.PHP_EOL);
        echo $this->getUrlHttp($this->url."/home/action/");
    }

    public function testControllerTest()
    {
        $this->expectOutputString('<html><body>test</body></html>'.PHP_EOL);
        echo $this->getUrlHttp($this->url."/controllertest/actionTest");
    }

    public function testControllerTestWithModel()
    {
        $this->expectOutputString('<html><body>Item2</body></html>'.PHP_EOL);
        echo $this->getUrlHttp($this->url."/controllertest/actionWithModelTest");
    }

    public function testBatchTestWithModel()
    {
        $this->expectOutputString('Item1');
        echo $this->getUrlHttp($this->url."/batchcontrollertest/batchTest");
    }

    // TODO : estos tests.
    /*
    public function testCache()
    {
    }

    public function testBenchmark()
    {
    }
    */
    // TODO :  Test de Cache, test de Benchmark y test de BasicRouter
}
