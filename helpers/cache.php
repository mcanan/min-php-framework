<?php
namespace mcanan\framework\helpers;

function cache_remove($filename)
{
    $filename = "./app/cache/$filename";
    @unlink($filename);
}

function cache_put($filename, $buffer)
{
    $filename = "./app/cache/$filename";
    $tempfilename = $filename.getmypid();
    if (($fp = fopen($tempfilename, "w")) == false) {
        return false;
    }
    fwrite($fp, $buffer);
    fclose($fp);
    rename($tempfilename, $filename);
    return true;
}

function cache_get($filename, $expiration = false)
{
    $filename = "./app/cache/$filename";
    // $expiration es en segundos.
    if ($expiration) {
        $stat = @stat($filename);
        if ($stat[9]) {
            if (time() > $stat[9] + $expiration) {
                @unlink($filename);
                return false;
            }
        }
    }
    return @file_get_contents($cachedir.$filename);
}
?>
