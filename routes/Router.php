<?php
require_once __DIR__ . '/../controllers/UsuarioController.php';

class Router {

    public function run() {
        $method = $_SERVER['REQUEST_METHOD'];
        $uri = $_SERVER['REQUEST_URI'];

        // Limpiar y dividir la ruta
        $path = parse_url($uri, PHP_URL_PATH);
        $segments = explode('/', trim($path, '/'));

        // Esperamos rutas tipo /api/usuarios o /api/usuarios/{id}
        $resource = $segments[1] ?? null; // ← "usuarios"
        $id = $segments[2] ?? null;

        $controller = new UsuarioController();
        $input = json_decode(file_get_contents('php://input'), true) ?? [];

        if ($resource === 'usuarios') {
            switch ($method) {
                case 'GET':
                    if ($id) {
                        $controller->getById($id);
                    } else {
                        $controller->getAll();
                    }
                    break;
                case 'POST':
                    $controller->create($input);
                    break;
                case 'PUT':
                    if ($id) {
                        $controller->update($id, $input);
                    } else {
                        http_response_code(400);
                        echo json_encode(['error' => 'Falta el ID para actualizar']);
                    }
                    break;
                case 'DELETE':
                    if ($id) {
                        $controller->delete($id);
                    } else {
                        http_response_code(400);
                        echo json_encode(['error' => 'Falta el ID para eliminar']);
                    }
                    break;
                default:
                    http_response_code(405);
                    echo json_encode(['error' => 'Método no permitido']);
                    break;
            }
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'Recurso no encontrado']);
        }
    }
}
