<?php
namespace mcanan\framework;

function &get_registry()
{
    // This declaration is resolved in compilation time.
    // It runs only once.
    static $_registry = array();
    return $_registry;
}

function setSecurityInstance($instance)
{
    $registry = &get_registry();
    $registry['Security'] = $instance;
}

function &getSecurityInstance()
{
    $registry = &get_registry();
    if (!isset($registry['Security'])) {
        $null = NULL;
        return $null;
    }
    return $registry['Security'];
}

function &getBenchmarkInstance()
{
    $registry = &get_registry();
    if (!isset($registry['Benchmark'])) {
        require_once "Benchmark.php";
        $registry['Benchmark'] = new \mcanan\framework\Benchmark();
    }

    return $registry['Benchmark'];
}

function &getOutputInstance()
{
    $registry = &get_registry();
    if (!isset($registry['Output'])) {
        require_once "Output.php";
        $registry['Output'] = new \mcanan\framework\Output();
    }
    return $registry['Output'];
}
