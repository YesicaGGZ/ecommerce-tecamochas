<?php
require_once __DIR__ . '/../models/Producto.php';

class CarritoController {

    private function iniciarSesionSegura() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function agregarAjax(int $id): void {
        $this->iniciarSesionSegura();
        header('Content-Type: application/json');
        
        $producto = Producto::obtenerPorId($id);
        if (!$producto) {
            echo json_encode(['success' => false, 'error' => 'Producto no encontrado']);
            exit;
        }
        
        if (!isset($_SESSION['carrito'])) { $_SESSION['carrito'] = []; }
        
        if (isset($_SESSION['carrito'][$id])) {
            $_SESSION['carrito'][$id]['cantidad']++;
        } else {
            $_SESSION['carrito'][$id] = [
                'id' => $producto['id'],
                'nombre' => $producto['nombre'],
                'precio' => $producto['precio'],
                'imagen' => $producto['imagen'],
                'cantidad' => 1
            ];
        }
        
        echo json_encode([
            'success' => true, 
            'total_carrito' => array_sum(array_column($_SESSION['carrito'], 'cantidad'))
        ]);
        exit;
    }

    public function verCarrito(): void {
        $this->iniciarSesionSegura();
        $carrito = $_SESSION['carrito'] ?? [];
        require __DIR__ . '/../views/carrito.php';
    }

    public function vaciar(): void {
        $this->iniciarSesionSegura();
        unset($_SESSION['carrito']);
        header("Location: index.php?accion=ver_carrito");
        exit;
    }

    public function eliminar(int $id): void {
        $this->iniciarSesionSegura();
        if (isset($_SESSION['carrito'][$id])) {
            unset($_SESSION['carrito'][$id]);
        }
        header("Location: index.php?accion=ver_carrito");
        exit;
    }

    // --- MÉTODOS PARA SIMULACIÓN DE PAGO ---

    public function finalizar(): void {
        $this->iniciarSesionSegura();
        if (empty($_SESSION['carrito'])) {
            header("Location: index.php");
            exit;
        }
        
        $total = 0;
        foreach ($_SESSION['carrito'] as $item) {
            $total += $item['precio'] * $item['cantidad'];
        }
        require __DIR__ . '/../views/checkout.php'; // Carga el formulario de pago
    }

    public function procesarPago(): void {
        $this->iniciarSesionSegura();
        
        $tarjeta = $_POST['tarjeta'] ?? '';
        $cvv = $_POST['cvv'] ?? '';

        // Validación  
        if ($tarjeta !== '1234567812345678' || $cvv !== '123') {
            echo "<script>alert('Pago rechazado, verifique los datos.'); window.history.back();</script>";
            exit;
        }

        // Si el pago es exitoso, descontar stock 
        $total = 0;
        foreach ($_SESSION['carrito'] as $item) {
            Producto::actualizarStock($item['id'], $item['cantidad']);
            $total += $item['precio'] * $item['cantidad'];
        }

        unset($_SESSION['carrito']); // Vaciar carrito [cite: 51]
        header("Location: index.php?accion=confirmacion&total=" . $total);
        exit;
    }

    public function confirmacion(): void {
        
        $total = $_GET['total'] ?? 0;
        require __DIR__ . '/../views/confirmacion.php';
    }

    public function contadorCarrito(): void {
        $this->iniciarSesionSegura();
        $total = array_sum(array_column($_SESSION['carrito'] ?? [], 'cantidad'));
        header('Content-Type: application/json');
        echo json_encode(['total' => $total]);
        exit;
    }

public function actualizarCantidadAjax(): void {
    $this->iniciarSesionSegura();
    header('Content-Type: application/json');
    
    $id = $_GET['id'] ?? 0;
    $cantidad = $_GET['cantidad'] ?? 1;
    
    if (isset($_SESSION['carrito'][$id])) {
        $_SESSION['carrito'][$id]['cantidad'] = max(1, (int)$cantidad);
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }
    exit;
}

public function eliminarCarritoAjax(): void {
    $this->iniciarSesionSegura();
    header('Content-Type: application/json');
    
    $id = $_GET['id'] ?? 0;
    
    if (isset($_SESSION['carrito'][$id])) {
        unset($_SESSION['carrito'][$id]);
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }
    exit;
}

}

