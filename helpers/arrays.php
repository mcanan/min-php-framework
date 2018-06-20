<?php
namespace mcanan\framework\helpers;

if(!function_exists("array_column"))
{
    /* 
    Devuelve una columna dada de un array multidimensional 
    */
    function array_column($array,$column_name)
    {
        return array_map(function($a) use($column_name) {
            return $a[$column_name];
        }, $array);
    }
}

/*
De un array multidimensional devuelve un array para ser usado 
en un select
*/
function getArrayToSelect($array, $label='descripcion', $value='id')
{
    return array_map(function($a) use($label, $value) {
        return array(
            'label' => $a["$label"],
            'value' => $a["$value"]
        );
    }, $array);
}
