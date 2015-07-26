<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Routes Map
$partials = [
    'admin'
];

// Routes loop
foreach ($partials as $partial) {
    $file = __DIR__ . '/Routes/' . $partial . '.php';

    if (!file_exists($file)) {
        $msg = "Route partial [{$partial}] not found.";
        throw new \Illuminate\Contracts\Filesystem\FileNotFoundException($msg);
    }

    require_once $file;
}