<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

// This is the front controller used when executing the application in the
// development environment ('dev'). See:
//   * http://symfony.com/doc/current/cookbook/configuration/front_controllers_and_kernel.html
//   * http://symfony.com/doc/current/cookbook/configuration/environments.html

use Symfony\Component\Debug\Debug;
use Symfony\Component\HttpFoundation\Request;

// If you don't want to setup permissions the proper way, just uncomment the
// following PHP line. See:
// http://symfony.com/doc/current/book/installation.html#configuration-and-setup for more information
//umask(0000);

/** @var Composer\Autoload\ClassLoader $loader */
$loader = require __DIR__.'/../app/autoload.php';
Debug::enable();

$kernel = new AppKernel('dev', true);
if (PHP_VERSION_ID < 70000) {
    $kernel->loadClassCache();
}
$request = Request::createFromGlobals();
$response = $kernel->handle($request);
$response->send();
$kernel->terminate($request, $response);
