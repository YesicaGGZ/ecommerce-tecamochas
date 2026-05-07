<?php
// 1. Iniciamos sesión al principio para persistencia en todo el sitio
session_start(); 

// Cargamos la conexión y los controladores
require_once 'config/db.php'; 
require_once 'controllers/ProductoController.php';
require_once 'controllers/CarritoController.php';
require_once 'controllers/AuthController.php'; 

$accion = $_GET['accion'] ?? 'catalogo';

switch ($accion) {
    case 'catalogo':
        $controller = new ProductoController();
        $controller->mostrarCatalogo();
        break;

    // --- AUTENTICACIÓN (Requisitos del PDF) ---
    case 'registro':
        $auth = new AuthController($conexion);
        $auth->registro();
        break;

    case 'login':
        $auth = new AuthController($conexion);
        $auth->login();
        break;

    case 'logout':
        $auth = new AuthController($conexion);
        $auth->logout();
        break;

    // --- CARRITO Y AJAX ---
    case 'agregar_carrito_ajax':
        if (!isset($_SESSION['usuario_id'])) {
            echo json_encode(['error' => 'Inicia sesión para comprar']);
            exit();
        }
        $controller = new CarritoController();
        $controller->agregarAjax((int)$_GET['id']);
        break;

    case 'ver_carrito':
        $controller = new CarritoController();
        $controller->verCarrito();
        break;

    case 'vaciar_carrito':
        $controller = new CarritoController();
        $controller->vaciar();
        break;

    case 'eliminar_carrito':
        $id = $_GET['id'] ?? null;
        if ($id) {
            $controller = new CarritoController();
            $controller->eliminar((int)$id);
        }
        break;

    case 'contador_carrito':
        $controller = new CarritoController();
        $controller->contadorCarrito();
        break;

    // --- FLUJO DE PAGO ---
    case 'finalizar_compra':
        $controller = new CarritoController();
        $controller->finalizar(); // Muestra el formulario de tarjeta
        break;
    
    case 'procesar_pago':
        $controller = new CarritoController();
        $controller->procesarPago(); // Valida tarjeta y descuenta stock
        break;
    
    case 'confirmacion':
        $controller = new CarritoController();
        $controller->confirmacion(); // Muestra el éxito (Soluciona Fatal Error)
        break;
        

    default:
        $controller = new ProductoController();
        $controller->mostrarCatalogo();
        break;


}
?>
