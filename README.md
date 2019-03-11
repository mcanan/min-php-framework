min-php-framework
=================

Minimal PHP MVC framework

Developed to be the initial framework to all my Php projects.

The main features will be:

  * Only core functionality
  * Minimal code (always trying to remove innecesary code)
  * Performance (benchmarking and trying to improve speed)

The first concepts were taken from Codeigniter Framework and the book Pro PHP MVC.

Usage
------------

The easiest way to start a new project is creating a base skeleton with this command:

(replace [project-name] with the desired project name.)

```sh
php composer.phar create-project --stability=dev --repository='{"type":"vcs","url":"https://github.com/mcanan/min-php-framework-skeleton/"}' mcanan/framework-skeleton [project-name]
```

You can then run it with the PHP's built-in webserver:

```sh
cd [project-name]; php -S localhost:8000 utils/php_router.php
```
u/p: admin/admin

More documentation: https://github.com/mcanan/min-php-framework/wiki
