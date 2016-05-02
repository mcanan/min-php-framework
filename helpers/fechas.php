<?php
namespace mcanan\framework\helpers;

use \DateTime;
use \DateTimeZone;

// TODO: mejorar en gral estas funciones

function validateFechaEspanol($fecha)
{
    $d = DateTime::createFromFormat('d/m/Y', $fecha);
    return $d && $d->format('d/m/Y') === $fecha;
}

function getFechaMysql($fecha)
{
    $date = DateTime::createFromFormat('d/m/Y', $fecha);
    return $date->format('Y-m-d');
}

function getFechaEspanol($fecha)
{
    $date = DateTime::createFromFormat('Y-m-d', $fecha);
    return $date->format('d/m/Y');
}

function getAno($fecha)
{
    $date = DateTime::createFromFormat('d/m/Y', $fecha);
    return $date->format('Y');
}

function getFechaLargaEspanol($fecha)
{
    $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Setiembre","Octubre","Noviembre","Diciembre");
    $date = DateTime::createFromFormat('d/m/Y', $fecha);
    return $date->format('j')." de ".$meses[$date->format('n')-1]." de ".$date->format('Y');
}

function getFechaEspanolFromDatetime($fecha)
{
    $date = DateTime::createFromFormat('Y-m-d H:i:s', $fecha);
    return $date->format('d/m/Y');
}

function getFechaTimeMysql($strtotime)
{
    return strftime("%Y-%m-%d %H:%M:%S", strtotime($strtotime));
}

function getFechaTimeMysqlHourTruncated($strtotime)
{
    return strftime("%Y-%m-%d %H:00:00", strtotime($strtotime));
}

function getFechaTimeMysqlDayTruncated($strtotime)
{
    return strftime("%Y-%m-%d 00:00:00", strtotime($strtotime));
}

function getHoraEspanol($strtotime)
{
    return strftime("%H:%M", strtotime($strtotime));
}

function getFechaTimeEspanol($strtotime)
{
    return strftime("%d-%m-%Y %H:%M", strtotime($strtotime));
}

function getFechaTimeEspanolReducida($strtotime)
{
    return strftime("%d/%m %H:%M", strtotime($strtotime));
}

function getFechaEspanolReducida($strtotime)
{
    return strftime("%d/%m", strtotime($strtotime));
}

function modifyFechaMysql($strtotime, $modifyText)
{
    return strftime("%Y-%m-%d", strtotime($modifyText, $strtotime));
}

function modifyFechaTimeEspanol($strtotime, $modifyText)
{
    return strftime("%d-%m-%Y %H:%M", strtotime($modifyText, $strtotime));
}

function modifyFechaTimeMysql($strtotime, $modifyText)
{
    return strftime("%Y-%m-%d %H:%M:%S", strtotime($modifyText, $strtotime));
}
