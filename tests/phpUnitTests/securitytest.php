<?php
namespace mcanan\framework\tests\phpUnitTests;

require_once 'autoloader.php';
require_once '../Common.php';

class SecurityTest extends BaseTest
{
    public function testNotAuthenticated()
    {
        $httpCode = $this->getUrlHttpCode($this->url."/controllertest_security/index");
        $this->assertEquals(401, $httpCode);
    }
}
