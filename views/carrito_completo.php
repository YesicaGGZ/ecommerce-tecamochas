<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$carrito = $_SESSION['carrito'] ?? [];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Carrito - Techstore</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            padding: 2rem;
        }
        .cart-container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            border-radius: 30px;
            padding: 2rem;
            box-shadow: 0 20px 40px rgba(0,0,0,0.2);
        }
        .cart-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid #e9ecef;
        }
        .cart-header h1 {
            color: #333;
            margin: 0;
        }
        .btn-seguir {
            background: #667eea;
            color: white;
            padding: 10px 20px;
            border-radius: 25px;
            text-decoration: none;
            transition: all 0.3s;
        }
        .btn-seguir:hover {
            background: #5a67d8;
            color: white;
        }
        .btn-finalizar {
            background: #28a745;
            color: white;
            padding: 12px 30px;
            border-radius: 25px;
            text-decoration: none;
            font-weight: bold;
            transition: all 0.3s;
        }
        .btn-finalizar:hover {
            background: #218838;
            color: white;
        }
        .btn-vaciar {
            background: #dc3545;
            color: white;
            padding: 10px 20px;
            border-radius: 25px;
            text-decoration: none;
        }
        .producto-imagen {
            width: 80px;
            height: 80px;
            object-fit: contain;
            border-radius: 15px;
            background: #f5f5f5;
            padding: 5px;
        }
        table {
            width: 100%;
        }
        th, td {
            padding: 15px;
            text-align: center;
            vertical-align: middle;
            border-bottom: 1px solid #e9ecef;
        }
        th {
            background: #f8f9fa;
            color: #333;
        }
        .cantidad-control {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }
        .cantidad-control button {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            border: none;
            font-size: 1.2rem;
            cursor: pointer;
            transition: all 0.2s;
        }
        .btn-mas {
            background: #28a745;
            color: white;
        }
        .btn-menos {
            background: #dc3545;
            color: white;
        }
        .btn-mas:hover, .btn-menos:hover {
            transform: scale(1.05);
        }
        .cantidad-control span {
            font-size: 1.1rem;
            font-weight: bold;
            min-width: 30px;
            text-align: center;
        }
        .stock-info {
            font-size: 0.7rem;
            color: #6c757d;
        }
        .total-grande {
            font-size: 1.8rem;
            font-weight: bold;
            color: #28a745;
        }
        .cart-empty {
            text-align: center;
            padding: 60px;
        }
        .cart-empty i {
            font-size: 80px;
            color: #dee2e6;
            margin-bottom: 20px;
        }
        @media (max-width: 768px) {
            .cart-container {
                padding: 1rem;
            }
            th, td {
                padding: 8px;
            }
            .producto-imagen {
                width: 50px;
                height: 50px;
            }
        }
    </style>
</head>
<body>

<div class="cart-container">
    <div class="cart-header">
        <h1><i class="bi bi-cart-fill"></i> Mi Carrito</h1>
        <a href="index.php" class="btn-seguir"><i class="bi bi-arrow-left"></i> Seguir comprando</a>
    </div>

    <?php if (empty($carrito)): ?>
        <div class="cart-empty">
            <i class="bi bi-cart-x"></i>
            <h3>Tu carrito está vacío</h3>
            <p>¡Agrega productos desde nuestro catálogo!</p>
            <a href="index.php" class="btn-seguir mt-3">🛍️ Ir a la tienda</a>
        </div>
    <?php else: ?>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Subtotal</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $total = 0;
                    foreach ($carrito as $item): 
                        $subtotal = $item['precio'] * $item['cantidad'];
                        $total += $subtotal;
                    ?>
                    <tr id="producto-<?php echo $item['id']; ?>">
                        <td>
                            <div style="display: flex; align-items: center; gap: 15px;">
                                <img class="producto-imagen" src="<?php echo htmlspecialchars($item['imagen']); ?>" alt="<?php echo htmlspecialchars($item['nombre']); ?>">
                                <div style="text-align: left;">
                                    <strong><?php echo htmlspecialchars($item['nombre']); ?></strong>
                                    <div class="stock-info" id="stock-info-<?php echo $item['id']; ?>">
                                        <span class="badge bg-info">Cargando stock...</span>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>$<?php echo number_format($item['precio'], 2); ?></td>
                        <td>
                            <div class="cantidad-control">
                                <button class="btn-menos" onclick="cambiarCantidad(<?php echo $item['id']; ?>, -1)">-</button>
                                <span id="cantidad-<?php echo $item['id']; ?>"><?php echo $item['cantidad']; ?></span>
                                <button class="btn-mas" onclick="cambiarCantidad(<?php echo $item['id']; ?>, 1)">+</button>
                            </div>
                        </td>
                        <td class="subtotal" id="subtotal-<?php echo $item['id']; ?>">
                            $<?php echo number_format($subtotal, 2); ?>
                        </td>
                        <td>
                            <button class="btn btn-sm btn-danger" onclick="eliminarProducto(<?php echo $item['id']; ?>)">
                                <i class="bi bi-trash"></i> Eliminar
                            </button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3" class="text-end"><strong>Total:</strong></td>
                        <td colspan="2">
                            <span class="total-grande" id="total-carrito">$<?php echo number_format($total, 2); ?></span>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <div class="d-flex justify-content-between mt-4 pt-3 border-top">
            <a href="index.php?accion=vaciar_carrito" class="btn-vaciar" onclick="return confirm('¿Vaciar todo el carrito?')">
                <i class="bi bi-trash3"></i> Vaciar carrito
            </a>
            <a href="index.php?accion=finalizar_compra" class="btn-finalizar">
                <i class="bi bi-check-circle"></i> Finalizar compra
            </a>
        </div>
    <?php endif; ?>
</div>

<script>
    function cambiarCantidad(id, cambio) {
        let cantidadSpan = document.getElementById(`cantidad-${id}`);
        let cantidadActual = parseInt(cantidadSpan.innerText);
        let nuevaCantidad = cantidadActual + cambio;
        
        if (nuevaCantidad < 1) {
            eliminarProducto(id);
            return;
        }
        
        // Obtener stock disponible
        fetch(`obtener_stock.php?id=${id}`)
            .then(response => response.json())
            .then(data => {
                if (nuevaCantidad > data.stock) {
                    alert(`❌ No hay suficiente stock. Disponible: ${data.stock}`);
                    return;
                }
                
                // Actualizar cantidad
                fetch(`actualizar_cantidad.php?id=${id}&cantidad=${nuevaCantidad}`)
                    .then(() => {
                        cantidadSpan.innerText = nuevaCantidad;
                        let subtotal = nuevaCantidad * data.precio;
                        document.getElementById(`subtotal-${id}`).innerHTML = `$${subtotal.toFixed(2)}`;
                        
                        // Recalcular total
                        let total = 0;
                        document.querySelectorAll('.subtotal').forEach(el => {
                            total += parseFloat(el.innerText.replace('$', ''));
                        });
                        document.getElementById('total-carrito').innerHTML = `$${total.toFixed(2)}`;
                        
                        // Actualizar stock visual
                        document.getElementById(`stock-info-${id}`).innerHTML = 
                            `<span class="badge ${data.stock <= 5 ? 'bg-warning' : 'bg-info'}">Stock: ${data.stock} unidades</span>`;
                    });
            });
    }
    
    function eliminarProducto(id) {
        if (confirm('¿Eliminar este producto del carrito?')) {
            fetch(`eliminar_del_carrito.php?id=${id}`)
                .then(() => {
                    let fila = document.getElementById(`producto-${id}`);
                    fila.remove();
                    
                    // Recalcular total
                    let total = 0;
                    document.querySelectorAll('.subtotal').forEach(el => {
                        total += parseFloat(el.innerText.replace('$', ''));
                    });
                    document.getElementById('total-carrito').innerHTML = `$${total.toFixed(2)}`;
                    
                    if (document.querySelectorAll('#carrito tbody tr').length === 0) {
                        location.reload();
                    }
                });
        }
    }
    
    // Cargar stock al iniciar
    <?php foreach ($carrito as $item): ?>
        fetch(`obtener_stock.php?id=<?php echo $item['id']; ?>`)
            .then(response => response.json())
            .then(data => {
                let stockInfo = document.getElementById(`stock-info-<?php echo $item['id']; ?>`);
                if (stockInfo) {
                    stockInfo.innerHTML = `<span class="badge ${data.stock <= 5 ? 'bg-warning' : 'bg-info'}">📦 Stock: ${data.stock} unidades</span>`;
                }
            });
    <?php endforeach; ?>
</script>

</body>
</html>