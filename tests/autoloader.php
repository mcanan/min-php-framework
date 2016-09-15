<?php
spl_autoload_register(function ($class) {
    $prefix = 'mcanan\\';
    $base_dir = __DIR__.'/../../';
    $len = strlen($prefix);
    $relative_class = substr($class, $len);
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';
    // if the file exists, require it
    if (file_exists($file)) {
        require $file;
    }
});
?>
