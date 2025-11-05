<?php
// Habilita los encabezados para respuestas JSON
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *'); // opcional, para pruebas en local o front separado
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

// Permite responder correctamente a solicitudes OPTIONS (CORS preflight)
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(204);
    exit;
}

// Carga el router principal
require_once __DIR__ . '/../routes/Router.php';

// Ejecuta la aplicación
$router = new Router();
$router->run();
