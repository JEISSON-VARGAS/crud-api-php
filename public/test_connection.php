<?php
header('Content-Type: application/json; charset=utf-8');

require_once __DIR__ . '/../config/database.php';

$dbObj = new Database();
$conn = $dbObj->getConnection();

try {
    $stmt = $conn->query("SELECT * FROM usuarios ");
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    echo json_encode([
        "ok" => true,
        "mensaje" => "Conexión exitosa",
        "sample" => $row ?: "tabla vacía"
    ]);
} catch (PDOException $e) {
    echo json_encode([
        "ok" => false,
        "error" => $e->getMessage()
    ]);
}
