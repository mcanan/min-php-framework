<?php

function getLineChart($title, $series, $width=400, $length=150, $colors=NULL, $custom_parameter=""){
    $grafica = "http://chart.apis.google.com/chart?chs=".$width."x$length&cht=lc";
    
    $min = 9999;
    $max = -9999;

    if (! is_null($colors)) {
        $grafica .= "&chco=";
        foreach($colors as $k=>$c){
            if ($k>0) $grafica.=",";
            $grafica .= "$c";
        }
    }
    
    $grafica .= "&chd=t2:";
    foreach($series as $k1=>$s){
        if ($k1>0) $grafica.="|";
        foreach ($s as $k2=>$v){
            if ($k2>0) $grafica.=",";
            $grafica.="$v";
            if ($v>$max) $max=$v;
            if ($v<$min) $min=$v;
        }
    }
    $grafica .= "&chds=$min,$max&chxt=y";
    $grafica .= "&chxr=0,$min,$max&chtt=$title&$custom_parameter";
    return $grafica;
}

