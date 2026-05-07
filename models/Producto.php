<?php
require_once __DIR__ . '/../config/db.php';

class Producto {
    
    /**
     * Obtiene todos los productos activos
     * @return array Lista de productos
     */
    public static function obtenerTodos(): array {
        global $conexion;
        
        $sql = "SELECT * FROM productos WHERE estado = 'activo'";
        $stmt = $conexion->prepare($sql);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    /**
     * Obtiene un producto por su ID
     * @param int $id ID del producto
     * @return array|null Los datos del producto o null si no existe
     */
    public static function obtenerPorId(int $id): ?array {
        global $conexion;
        
        $sql = "SELECT * FROM productos WHERE id = :id AND estado = 'activo'";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        return $resultado ?: null;
    }
    
    /**
 * Actualiza el stock de un producto después de una venta
 * @param int $id ID del producto
 * @param int $cantidadVendida Cantidad vendida
 * @return bool True si se actualizó, false si no hay suficiente stock
 */
public static function actualizarStock(int $id, int $cantidadVendida): bool {
    global $conexion;
    
    // Obtener stock actual
    $producto = self::obtenerPorId($id);
    
    if (!$producto) {
        return false;
    }
    
    $stockActual = $producto['stock'];
    $nuevoStock = $stockActual - $cantidadVendida;
    
    if ($nuevoStock < 0) {
        return false;
    }
    
    // Actualizar stock en BD
    $sql = "UPDATE productos SET stock = :stock WHERE id = :id";
    $stmt = $conexion->prepare($sql);
    $stmt->bindParam(':stock', $nuevoStock, PDO::PARAM_INT);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    
    return true;
}
}
?>