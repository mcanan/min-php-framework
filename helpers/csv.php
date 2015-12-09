<?php
namespace mcanan\framework\helpers;

if (! function_exists('array_to_csv')) {
    function array_to_csv($array, $archivo)
    {
        header('Content-Type: application/csv');
        header('Content-Disposition: attachement; filename="'.$archivo.'"');
        ob_start();
        $f = fopen('php://output', 'w');
        $n = 0;
        foreach ($array as $line) {
            $n++;
            fputcsv($f, $line);
        }
        fclose($f);
        $str = ob_get_contents();
        ob_end_clean();
        echo $str;
    }
}
