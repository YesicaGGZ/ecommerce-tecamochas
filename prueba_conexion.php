<?php
// prueba_conexion.php
require_once 'config/db.php';

echo "<h2>📦 Productos en la base de datos:</h2>";

$sql = "SELECT * FROM productos";
$stmt = $conexion->prepare($sql);
$stmt->execute();
$productos = $stmt->fetchAll(PDO::FETCH_ASSOC);

if(count($productos) > 0) {
    echo "<ul>";
    foreach($productos as $producto) {
        echo "<li>" . $producto['nombre'] . " - $" . $producto['precio'] . "</li>";
    }
    echo "</ul>";
} else {
    echo "No hay productos aún.";
}
?>