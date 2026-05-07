<?php
require_once 'config/db.php';

$id = $_GET['id'] ?? 0;

$sql = "SELECT stock FROM productos WHERE id = :id";
$stmt = $conexion->prepare($sql);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();
$stock = $stmt->fetchColumn();

header('Content-Type: application/json');
echo json_encode(['stock' => $stock]);
?>