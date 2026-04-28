<?php
try {
    $conexion = new PDO("mysql:host=localhost;dbname=ecommerce;charset=utf8mb4", "root", "");
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Ver productos actuales
    $stmt = $conexion->query("SELECT id, nombre FROM productos");
    $productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo "<h2>Productos antes de limpiar:</h2>";
    echo "<ul>";
    foreach($productos as $p) {
        echo "<li>ID: " . $p['id'] . " - " . $p['nombre'] . "</li>";
    }
    echo "</ul>";
    
    // Eliminar duplicados (id mayor a 4)
    $conexion->exec("DELETE FROM productos WHERE id > 4");
    $conexion->exec("ALTER TABLE productos AUTO_INCREMENT = 5");
    
    // Ver productos después
    $stmt = $conexion->query("SELECT id, nombre FROM productos");
    $productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo "<h2>Productos despuÃ©s de limpiar:</h2>";
    echo "<ul>";
    foreach($productos as $p) {
        echo "<li>ID: " . $p['id'] . " - " . $p['nombre'] . "</li>";
    }
    echo "</ul>";
    
    echo "<h3>✅ Listo! Ahora ve a <a href='index.php'>index.php</a></h3>";
    
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>