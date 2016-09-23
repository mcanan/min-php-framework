<?php
namespace mcanan\framework\tests\phpUnitTests;

require_once 'autoloader.php';
require_once '../Common.php';

class SecurityTest2 extends BaseTest
{
    public function testAuthenticated()
    {
        $httpCode = $this->getUrlHttpCode($this->url."/controllertest_security/index");
        $this->assertEquals(200, $httpCode);
        $this->expectOutputString('<html><body>test_security</body></html>'.PHP_EOL);
        echo $this->getUrlHttp($this->url."/controllertest_security/index");
    }
}
