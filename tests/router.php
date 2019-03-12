<?php
if (file_exists(__DIR__ . '/' .$_SERVER['REQUEST_URI']) ||
    preg_match('/\.(?:png|jpg|jpeg|gif)$/', $_SERVER["REQUEST_URI"])) {
    return false;
} else {
    $_GET['url'] = ltrim($_SERVER['REQUEST_URI'], '/');
    include_once 'index.php';
}
