<?php
namespace mcanan\framework;

class Output
{
    private $escribirCache=false;
    private $archivo="";
    private $html="";

    public function setHtml($html)
    {
        $this->html = $html;
    }

    public function hasContent()
    {
        return ($this->html!="");
    }

    private function put($filename, $buffer)
    {
        $cachedir = './app/cache/';
        $tempfilename = $cachedir.$filename.getmypid();
        if (($fp = fopen($tempfilename, "w")) == false) {
            return false;
        }
        fwrite($fp, $buffer);
        fclose($fp);
        rename($tempfilename, $cachedir.$filename);

        return true;
    }

    private function get($filename, $expiration = false)
    {
        // $expiration es en segundos.
        $cachedir = './app/cache/';
        if ($expiration) {
            $stat = @stat($cachedir.$filename);
            if ($stat && isset($stat[9])) {
                $time = time();
                $benchmark =& getBenchmarkInstance();
                $benchmark->mark("cache_age: ".($time-$stat[9]));
                if ($time > $stat[9] + $expiration) {
                    @unlink($cachedir.$filename);
                    return false;
                }
            }
        }

        return @file_get_contents($cachedir.$filename);
    }

    public function display()
    {
        $benchmark =& getBenchmarkInstance();
        $benchmark->mark("display_start");
        if (!headers_sent()) {
            header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
            header("Cache-Control: post-check=0, pre-check=0", false);
            header("Pragma: no-cache");
            header('Content-Type: text/html; charset=utf-8');
        }
        if ($this->escribirCache) {
            $this->put($this->archivo, $this->html);
        }
        $benchmark->mark("display_end");
        echo str_replace("%BENCHMARK%", $benchmark->getTimestampsAsHtmlComment(), $this->html);
    }

    public function displayFromCache($archivo, $tiempo)
    {
        $benchmark =& getBenchmarkInstance();
        $benchmark->mark("displayFromCache_start");
        $retorno=false;
        $this->archivo = $archivo;
        if ($html=$this->get($archivo, $tiempo)) {
            if (!headers_sent()) {
                header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
                header("Cache-Control: post-check=0, pre-check=0", false);
                header("Pragma: no-cache");
                header('Content-Type: text/html; charset=utf-8');
            }
            $benchmark->mark("displayFromCache_end");
            echo str_replace("%BENCHMARK%", $benchmark->getTimestampsAsHtmlComment(), $html);
            $retorno=true;
        } else {
            $benchmark->mark("cache old");
            $this->escribirCache = true;
        }
        $benchmark->mark("displayFromCache_end");

        return $retorno;
    }
}
