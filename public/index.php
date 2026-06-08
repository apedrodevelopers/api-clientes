<?php

use Bramus\Router\Router;

require "../vendor/autoload.php";

$r = new Router;

$r->get("/api/clientes", "\App\Controllers\ClienteController@getAll");
$r->get("/api/clientes/{id}", "\App\Controllers\ClienteController@getById");
$r->post("/api/clientes", "\App\Controllers\ClienteController@create");
$r->put("/api/clientes/{id}", "\App\Controllers\ClienteController@update");
$r->delete("/api/clientes/{id}", "\App\Controllers\ClienteController@delete");

$r->run();