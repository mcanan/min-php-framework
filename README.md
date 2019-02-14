min-php-framework
=================

Minimal PHP MVC framework

Developed to be the initial framework to all my Php projects.

The main features will be:

  * Only core functionality
  * Minimal code (always trying to remove innecesary code)
  * Performance (benchmarking and trying to improve speed)

The first concepts was taken from Codeigniter Framework and the book Pro PHP MVC.

Usage
------------

To create a project skeleton as a base run this command:

```sh
composer.phar create-project --stability=dev --repository='{"type":"vcs","url":"https://github.com/mcanan/min-php-framework-skeleton/"}' mcanan/framework-skeleton [project-name]
```

Replace [project-name] with the desired project name.

You can then run it with PHP's built-in webserver:

```sh
cd [project-name]
php -S localhost:8000 utils/php_router.php
```

More documentation: https://github.com/mcanan/min-php-framework/wiki
