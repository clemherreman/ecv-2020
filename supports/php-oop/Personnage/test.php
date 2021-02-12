<?php


// Set a constant for the base Symfony directory, can be useful
define('ROOT_DIR', realpath(__DIR__ . '/../'));


require_once __DIR__ . '/../app/AppKernel.php';

// Initialize the application
$kernel = new AppKernel('prod');
$kernel->loadClassCache();

$request = Request::createFromGlobals();
$response = $kernel->handle($request);

$response->send();

