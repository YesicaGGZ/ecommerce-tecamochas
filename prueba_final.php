<?php
echo "<h1>Prueba - El archivo existe</h1>";
echo "<p>Si ves esto, el archivo está en el lugar correcto.</p>";

require_once 'config/db.php';

echo "<p>Conexión a BD: OK</p>";

$sql = "SELECT * FROM productos";
$stmt = $conexion->prepare($sql);
$stmt->execute();
$productos = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo "<h2>Productos en BD:</h2>";
echo "<ul>";
foreach($productos as $p) {
    echo "<li>" . $p['nombre'] . " - $" . $p['precio'] . "</li>";
}
echo "</ul>";
?>