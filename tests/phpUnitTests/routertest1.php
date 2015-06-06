<?php
namespace mcanan\framework\tests\phpUnitTests;

require_once '../Autoloader.php';
require_once '../Common.php';

class RouterTest1 extends BaseTest
{
    public function testDefaultControllerDefaultAction()
    {
        $this->expectOutputString('<html><body>home</body></html>'.PHP_EOL);
        echo $this->getUrlHttp($this->url);
    }

    public function testControllerTest()
    {
        $this->expectOutputString('<html><body>Item2</body></html>'.PHP_EOL);
        echo $this->getUrlHttp($this->url."/controllerTest/actionWithModelTest");
    }

    public function testNonExistingGifInRoot()
    {
        $httpCode = $this->getUrlHttpCode($this->url."/noexiste.gif");
        $this->assertEquals(404, $httpCode);
    }

    public function testExistingGifInRoot()
    {
        $httpCode = $this->getUrlHttpCode($this->url."/test.gif");
        $this->assertEquals(200, $httpCode);
    }

    public function testNonExistingGifInPublic()
    {
        $httpCode = $this->getUrlHttpCode($this->url."/public/noexiste.gif");
        $this->assertEquals(404, $httpCode);
    }

    public function testExistingGifInPublic()
    {
        $httpCode = $this->getUrlHttpCode($this->url."/public/test.gif");
        $this->assertEquals(200, $httpCode);
    }

    public function testNonExistingControllerInPublic()
    {
        $httpCode = $this->getUrlHttpCode($this->url."/public/noexiste/noexiste");
        $this->assertEquals(200, $httpCode);
    }

    public function testNonExistingControllerInApp()
    {
        $httpCode = $this->getUrlHttpCode($this->url."/app/noexiste/noexiste");
        $this->assertEquals(200, $httpCode);
    }

    public function testNonExistingControllerInRoot()
    {
        $u = $this->url."/noexiste/noexiste";
        $httpCode = $this->getUrlHttpCode($u);
        $this->assertEquals(200, $httpCode);
    }
}
