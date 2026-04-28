<?php
require_once __DIR__ . '/../models/Producto.php';

class ProductoController {
    public function mostrarCatalogo() {
        $productos = Producto::obtenerTodos();
        require __DIR__ . '/../views/catalogo.php';
    }
}
?>