<?php

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Check for maintenance mode
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

// Register the Composer autoloader
require __DIR__.'/../vendor/autoload.php';

// Bootstrap the application
$app = require_once __DIR__.'/../bootstrap/app.php';

// Create HTTP kernel to handle incoming requests
$kernel = $app->make(Kernel::class);

// Capture the HTTP request
$request = Request::capture();

// Handle the request through the kernel, get response
$response = $kernel->handle($request);

// Send the response back to the client
$response->send();

// Terminate the kernel (perform shutdown tasks)
$kernel->terminate($request, $response);


