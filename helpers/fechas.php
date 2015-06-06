<?php
namespace mcanan\framework\helpers;

use \DateTime;
use \DateTimeZone;

// TODO: mejorar en gral estas funciones

if (! function_exists('getFechaMysql')) {
    function getFechaMysql($fecha)
    {
        $date = DateTime::createFromFormat('d/m/Y', $fecha);
        return $date->format('Y-m-d');
    }
}

if (! function_exists('getFechaEspanol')) {
    function getFechaEspanol($fecha)
    {
        $date = DateTime::createFromFormat('Y-m-d', $fecha);
        return $date->format('d/m/Y');
    }
}

if (! function_exists('getFechaTimeMysql')) {
    function getFechaTimeMysql($strtotime)
    {
        return strftime("%Y-%m-%d %H:%M:%S", strtotime($strtotime));
    }
}

if (! function_exists('getFechaTimeMysqlHourTruncated')) {
    function getFechaTimeMysqlHourTruncated($strtotime)
    {
        return strftime("%Y-%m-%d %H:00:00", strtotime($strtotime));
    }
}

if (! function_exists('getFechaTimeMysqlDayTruncated')) {
    function getFechaTimeMysqlDayTruncated($strtotime)
    {
        return strftime("%Y-%m-%d 00:00:00", strtotime($strtotime));
    }
}

if (! function_exists('getHoraEspanol')) {
    function getHoraEspanol($strtotime)
    {
        return strftime("%H:%M", strtotime($strtotime));
    }
}

if (! function_exists('getFechaTimeEspanol')) {
    function getFechaTimeEspanol($strtotime)
    {
        return strftime("%d-%m-%Y %H:%M", strtotime($strtotime));
    }
}

if (! function_exists('getFechaTimeEspanolReducida')) {
    function getFechaTimeEspanolReducida($strtotime)
    {
        return strftime("%d/%m %H:%M", strtotime($strtotime));
    }
}

if (! function_exists('getFechaEspanolReducida')) {
    function getFechaEspanolReducida($strtotime)
    {
        return strftime("%d/%m", strtotime($strtotime));
    }
}

if (! function_exists('modifyFechaMysql')) {
    function modifyFechaMysql($strtotime, $modifyText)
    {
        return strftime("%Y-%m-%d", strtotime($modifyText, $strtotime));
    }
}

if (! function_exists('modifyFechaTimeEspanol')) {
    function modifyFechaTimeEspanol($strtotime, $modifyText)
    {
        return strftime("%d-%m-%Y %H:%M", strtotime($modifyText, $strtotime));
    }
}

if (! function_exists('modifyFechaTimeMysql')) {
    function modifyFechaTimeMysql($strtotime, $modifyText)
    {
        return strftime("%Y-%m-%d %H:%M:%S", strtotime($modifyText, $strtotime));
    }
}
