<?php
namespace mcanan\framework\tests\phpUnitTests;

use \PHPUnit_Framework_TestCase;

class BaseTest extends PHPUnit_Framework_TestCase
{
    protected $url;

    public function setUp()
    {
        // Clean the singleton registry
        $benchmark =& \mcanan\framework\getBenchmarkInstance();
        $output =& \mcanan\framework\getOutputInstance();
        $output->setHtml("");
        $benchmark->reset();
        $this->url = 'http://'.WEB_SERVER_HOST.':'.WEB_SERVER_PORT;

        // Borro cache
        $files = glob('./app/cache/*');
        foreach ($files as $file) {
            if (is_file($file))
                unlink($file);
        }
    }

    protected function getUrlHttp($url)
    {
        $handle = curl_init($url);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($handle);
        curl_close($handle);

        return $response;
    }

    protected function getUrlHttpCode($url)
    {
        $handle = curl_init($url);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
        curl_exec($handle);
        $httpCode = curl_getinfo($handle, CURLINFO_HTTP_CODE);
        curl_close($handle);

        return $httpCode;
    }
}
