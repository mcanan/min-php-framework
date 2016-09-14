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

    public function testCache()
    {
        $html = $this->getUrlHttp($this->url."/controllertest/actionCache");
        $this->assertRegexp('/display_start/', $html);
        $this->assertRegexp('/displayFromCache_start/', $html);
        $this->assertRegexp('/cache old/', $html);
        
        $html = $this->getUrlHttp($this->url."/controllertest/actionCache");
        $this->assertNotRegexp('/display_start/', $html);
        $this->assertRegexp('/displayFromCache_start/', $html);
    }
    
    public function testCommonVariables()
    {
        $this->expectOutputString('<html><title>titulo</title><body>test</body></html>'.PHP_EOL);
        echo $this->getUrlHttp($this->url."/controllertest_common_variables/actionTest");
    }
}
