<?php
date_default_timezone_set('America/Montevideo');
$fch=strftime("%Y-%m-%d", time());
ini_set('display_errors', 'on');
ini_set('log_errors', 'on');
ini_set('error_log', 'salida.log');
ini_set('xdebug.auto_trace', '1');
ini_set('xdebug.trace_output_dir', '/tmp/');
ini_set('xdebug.show_mem_delta', '1');

require '../Application.php';
require 'autoloader.php';

//xdebug_start_trace('/tmp/1.xt');
$app = new mcanan\framework\Application();
$app->loadConfigurationFile(getenv("CONF_FILE"));
if (getenv("SECURITY")) {
    require '../BasicSecurity.php';
    $app->setSecurity(new mcanan\framework\BasicSecurity());
}
session_start();
if (getenv("AUTH")) {
    $_SESSION['bs']='USER';
}
$app->getCache()->setUrl('controllertest', 'actioncache', null, 10);
$app->init();
//xdebug_stop_trace();
