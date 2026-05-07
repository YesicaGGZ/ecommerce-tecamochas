<?php
session_start();
header('Content-Type: application/json');

require_once 'config/db.php';
require_once 'models/Producto.php';

$data = json_decode(file_get_contents('php://input'), true);

if (!isset($data['carrito']) || empty($data['carrito'])) {
    echo json_encode(['success' => false, 'error' => 'Carrito vacío']);
    exit;
}

$carrito = $data['carrito'];
$errores = [];

// Verificar stock disponible
foreach ($carrito as $item) {
    $producto = Producto::obtenerPorId($item['id']);
    if (!$producto) {
        $errores[] = "Producto no encontrado: " . $item['nombre'];
    } elseif ($producto['stock'] < $item['cantidad']) {
        $errores[] = "No hay suficiente stock de: " . $producto['nombre'] . " (disponible: " . $producto['stock'] . ")";
    }
}

if (!empty($errores)) {
    echo json_encode(['success' => false, 'error' => implode(", ", $errores)]);
    exit;
}

// Actualizar stock
foreach ($carrito as $item) {
    $resultado = Producto::actualizarStock($item['id'], $item['cantidad']);
    if (!$resultado) {
        $errores[] = "Error al actualizar stock de: " . $item['nombre'];
    }
}

if (!empty($errores)) {
    echo json_encode(['success' => false, 'error' => implode(", ", $errores)]);
    exit;
}

// Registrar compra en sesión
$_SESSION['ultima_compra'] = [
    'productos' => $carrito,
    'total' => array_sum(array_map(function($item) { return $item['precio'] * $item['cantidad']; }, $carrito)),
    'fecha' => date('Y-m-d H:i:s')
];

echo json_encode(['success' => true]);
?>