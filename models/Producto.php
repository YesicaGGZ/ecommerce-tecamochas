<?php
require_once __DIR__ . '/../config/db.php';

class Producto {
    public static function obtenerTodos() {
        global $conexion;
        $sql = "SELECT * FROM productos WHERE estado = 'activo'";
        $stmt = $conexion->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>