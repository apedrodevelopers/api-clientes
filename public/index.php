<?php

use Bramus\Router\Router;

require "../vendor/autoload.php";

$r = new Router;

// Configuracoes de CORS
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
// Responde ao Preflight e para aqui
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(204);
    exit();
}

$r->get("/api/clientes", "\App\Controllers\ClienteController@getAll");
$r->get("/api/clientes/{id}", "\App\Controllers\ClienteController@getById");
$r->post("/api/clientes", "\App\Controllers\ClienteController@create");
$r->put("/api/clientes/{id}", "\App\Controllers\ClienteController@update");
$r->delete("/api/clientes/{id}", "\App\Controllers\ClienteController@delete");

$r->run();
