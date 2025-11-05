<?php
class Database{
    private $conn;

    // Funcion para conectar a la base de datos
    public function getConnection(){
        $host="localhost";
        $db="crud_api";
        $user="root";
        $password="";
        $dsn="mysql:host=$host;dbname=$db;charset=utf8mb4";

        try {
            $this->conn = new PDO($dsn, $user, $password, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]);
        } catch (PDOException $e) {
            echo json_encode(["error" => "Conexión fallida: " . $e->getMessage()]);
            exit;
        }
        return $this->conn;
    }
}