<?php 
require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../models/Usuario.php';

class UsuarioController extends Controller {
    private $usuarioModel;

    public function __construct() {
        $this->usuarioModel = new Usuario();
    }

    // Get All Users
    public function getAll() {
        $usuarios = $this->usuarioModel->getAllUsuarios();
        $this->json($usuarios);
    }

    // Get User by ID
    public function getById($id) {
        $usuario = $this->usuarioModel->getUsuarioById($id);
        if ($usuario) {
            $this->json($usuario);
        } else {
            $this->error("Usuario no encontrado", 404);
        }
    }

    // Create New User
    public function create($data) {
        if (isset($data['nombre']) && isset($data['email'])) {
            $newId = $this->usuarioModel->createUsuario($data['nombre'], $data['email']);
            if ($newId) {
                $this->json(["id" => $newId], 201);
            } else {
                $this->error("Error al crear usuario", 500);
            }
        } else {
            $this->error("Datos incompletos", 400);
        }
    }

    // Update Existing User
    public function update($id, $data) {
        if (isset($data['nombre']) && isset($data['email'])) {
            $updated = $this->usuarioModel->updateUsuario($id, $data['nombre'], $data['email']);
            if ($updated) {
                $this->json(["mensaje" => "Usuario actualizado"]);
            } else {
                $this->error("Error al actualizar usuario", 500);
            }
        } else {
            $this->error("Datos incompletos", 400);
        }
    }

    // Delete User
    public function delete($id) {
        $deleted = $this->usuarioModel->deleteUsuario($id);
        if ($deleted) {
            $this->json(["mensaje" => "Usuario eliminado"]);
        } else {
            $this->error("Error al eliminar usuario", 500);
        }
    }
}