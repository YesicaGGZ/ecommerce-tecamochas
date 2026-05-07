<?php
// El carrito ya viene de $_SESSION['carrito'] en el controlador
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Carrito - Tecamochas 🍓</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Comic+Neue&family=DynaPuff&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            background: linear-gradient(135deg, #fff5e6 0%, #ffe4e1 100%);
            min-height: 100vh;
            padding: 2rem;
            font-family: 'Comic Neue', cursive;
        }
        
        .cart-container {
            max-width: 1200px;
            margin: 0 auto;
            background: #fffef7;
            border-radius: 30px;
            padding: 2rem;
            box-shadow: 0 20px 40px rgba(251, 168, 168, 0.15);
            border: 1px solid #fde2e4;
        }
        
        .cart-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid #fde2e4;
        }
        
        .cart-header h1 {
            color: #f472b6;
            font-family: 'DynaPuff', cursive;
            margin: 0;
        }
        
        .btn-seguir {
            background: linear-gradient(135deg, #fbbf24, #f59e0b);
            color: white;
            padding: 10px 20px;
            border-radius: 50px;
            text-decoration: none;
            transition: all 0.3s ease;
            font-weight: bold;
            display: inline-block;
        }
        
        .btn-seguir:hover {
            background: linear-gradient(135deg, #f59e0b, #ea580c);
            transform: scale(1.05);
            box-shadow: 0 5px 15px rgba(245, 158, 11, 0.3);
            color: white;
        }
        
        .btn-finalizar {
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
            padding: 12px 30px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: bold;
            transition: all 0.3s ease;
            display: inline-block;
        }
        
        .btn-finalizar:hover {
            background: linear-gradient(135deg, #059669, #047857);
            transform: scale(1.05);
            box-shadow: 0 5px 15px rgba(16, 185, 129, 0.3);
            color: white;
        }
        
        .btn-vaciar {
            background: linear-gradient(135deg, #fb7185, #e11d48);
            color: white;
            padding: 10px 20px;
            border-radius: 50px;
            text-decoration: none;
            transition: all 0.3s ease;
            font-weight: bold;
            display: inline-block;
        }
        
        .btn-vaciar:hover {
            background: linear-gradient(135deg, #e11d48, #be123c);
            transform: scale(1.05);
            box-shadow: 0 5px 15px rgba(251, 113, 133, 0.3);
            color: white;
        }
        
        .producto-imagen {
            width: 80px;
            height: 80px;
            object-fit: contain;
            border-radius: 20px;
            background: linear-gradient(135deg, #fef3c7, #fed7aa);
            padding: 8px;
            transition: transform 0.3s ease;
        }
        
        .producto-imagen:hover {
            transform: scale(1.1);
        }
        
        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
        }
        
        th, td {
            padding: 15px;
            text-align: center;
            vertical-align: middle;
            border-bottom: 1px solid #fde2e4;
        }
        
        th {
            background: linear-gradient(135deg, #fce7f3, #fef3c7);
            color: #db2777;
            font-family: 'DynaPuff', cursive;
            font-weight: bold;
            font-size: 1rem;
        }
        
        td {
            background-color: #fffef7;
            color: #4a5568;
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
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
        }
        
        .btn-menos {
            background: linear-gradient(135deg, #fb7185, #e11d48);
            color: white;
        }
        
        .btn-mas:hover, .btn-menos:hover {
            transform: scale(1.1);
        }
        
        .cantidad-control span {
            font-size: 1.1rem;
            font-weight: bold;
            min-width: 30px;
            text-align: center;
            color: #db2777;
        }
        
        .stock-info {
            font-size: 0.7rem;
            margin-top: 5px;
        }
        
        .total-grande {
            font-size: 1.8rem;
            font-weight: bold;
            background: linear-gradient(135deg, #10b981, #059669);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }
        
        .cart-empty {
            text-align: center;
            padding: 60px;
        }
        
        .cart-empty i {
            font-size: 80px;
            color: #fde2e4;
            margin-bottom: 20px;
        }
        
        .cart-empty h3 {
            color: #db2777;
            font-family: 'DynaPuff', cursive;
        }
        
        .cart-empty p {
            color: #4a5568;
        }
        
        /* Spinner de carga */
        .loading {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 2px solid #f3f3f3;
            border-top: 2px solid #f472b6;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }
        
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        @media (max-width: 768px) {
            body {
                padding: 1rem;
            }
            
            .cart-container {
                padding: 1rem;
            }
            
            .producto-imagen {
                width: 50px;
                height: 50px;
                border-radius: 12px;
            }
            
            th, td {
                padding: 8px;
                font-size: 0.85rem;
            }
            
            .cantidad-control button {
                width: 28px;
                height: 28px;
                font-size: 0.9rem;
            }
            
            .total-grande {
                font-size: 1.3rem;
            }
            
            .btn-seguir, .btn-vaciar {
                padding: 8px 15px;
                font-size: 0.85rem;
            }
            
            .btn-finalizar {
                padding: 10px 20px;
                font-size: 0.9rem;
            }
        }
        
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .cart-container {
            animation: fadeIn 0.5s ease-out;
        }
        
        /* Badges */
        .badge.bg-info {
            background: linear-gradient(135deg, #60a5fa, #3b82f6) !important;
        }
        
        .badge.bg-warning {
            background: linear-gradient(135deg, #fbbf24, #f59e0b) !important;
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
            <p>¡Agrega productos desde nuestro catálogo! 🍓🥭🍍</p>
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
                         </div>
                        <td>$<?php echo number_format($item['precio'], 2); ?> </div>
                        <td>
                            <div class="cantidad-control">
                                <button class="btn-menos" onclick="cambiarCantidad(<?php echo $item['id']; ?>, -1, <?php echo $item['precio']; ?>)">−</button>
                                <span id="cantidad-<?php echo $item['id']; ?>"><?php echo $item['cantidad']; ?></span>
                                <button class="btn-mas" onclick="cambiarCantidad(<?php echo $item['id']; ?>, 1, <?php echo $item['precio']; ?>)">+</button>
                            </div>
                         </div>
                        <td class="subtotal" id="subtotal-<?php echo $item['id']; ?>">
                            $<?php echo number_format($subtotal, 2); ?>
                         </div>
                        <td>
                            <button class="btn-eliminar" onclick="eliminarProducto(<?php echo $item['id']; ?>)">
                                🗑️ Eliminar
                            </button>
                         </div>
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
    function cambiarCantidad(id, cambio, precio) {
        let cantidadSpan = document.getElementById(`cantidad-${id}`);
        let cantidadActual = parseInt(cantidadSpan.innerText);
        let nuevaCantidad = cantidadActual + cambio;
        
        if (nuevaCantidad < 1) {
            eliminarProducto(id);
            return;
        }
        
        // Mostrar loading en el botón
        let boton = event.target;
        let textoOriginal = boton.innerHTML;
        boton.innerHTML = '<div class="loading"></div>';
        boton.disabled = true;
        
        // Obtener stock disponible desde tu archivo PHP
        fetch(`obtener_stock_ajax.php?id=${id}`)
            .then(response => response.json())
            .then(data => {
                if (nuevaCantidad > data.stock) {
                    alert(`❌ No hay suficiente stock. Disponible: ${data.stock} unidades`);
                    boton.innerHTML = textoOriginal;
                    boton.disabled = false;
                    return;
                }
                
                // Actualizar cantidad vía AJAX al controlador
                fetch(`index.php?accion=actualizar_cantidad_ajax&id=${id}&cantidad=${nuevaCantidad}`)
                    .then(() => {
                        cantidadSpan.innerText = nuevaCantidad;
                        let subtotal = nuevaCantidad * precio;
                        document.getElementById(`subtotal-${id}`).innerHTML = `$${subtotal.toFixed(2)}`;
                        
                        // Recalcular total
                        let total = 0;
                        document.querySelectorAll('.subtotal').forEach(el => {
                            let valor = parseFloat(el.innerText.replace('$', ''));
                            if (!isNaN(valor)) {
                                total += valor;
                            }
                        });
                        document.getElementById('total-carrito').innerHTML = `$${total.toFixed(2)}`;
                        
                        // Actualizar contador del carrito flotante
                        actualizarContadorGlobal();
                        
                        // Actualizar stock visual
                        let stockInfo = document.getElementById(`stock-info-${id}`);
                        if (stockInfo) {
                            let badgeClass = data.stock <= 5 ? 'bg-warning' : 'bg-info';
                            stockInfo.innerHTML = `<span class="badge ${badgeClass}">📦 Stock disponible: ${data.stock} unidades</span>`;
                        }
                        
                        boton.innerHTML = textoOriginal;
                        boton.disabled = false;
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Error al actualizar la cantidad');
                        boton.innerHTML = textoOriginal;
                        boton.disabled = false;
                    });
            })
            .catch(error => {
                console.error('Error al obtener stock:', error);
                alert('Error al verificar stock');
                boton.innerHTML = textoOriginal;
                boton.disabled = false;
            });
    }
    
    function eliminarProducto(id) {
        if (confirm('¿Eliminar este producto del carrito?')) {
            fetch(`index.php?accion=eliminar_carrito_ajax&id=${id}`)
                .then(() => {
                    let fila = document.getElementById(`producto-${id}`);
                    if (fila) {
                        fila.remove();
                    }
                    
                    // Recalcular total
                    let total = 0;
                    let subtotales = document.querySelectorAll('.subtotal');
                    subtotales.forEach(el => {
                        let valor = parseFloat(el.innerText.replace('$', ''));
                        if (!isNaN(valor)) {
                            total += valor;
                        }
                    });
                    
                    if (subtotales.length === 0) {
                        // Si no hay productos, recargar para mostrar mensaje de carrito vacío
                        location.reload();
                    } else {
                        document.getElementById('total-carrito').innerHTML = `$${total.toFixed(2)}`;
                        actualizarContadorGlobal();
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error al eliminar el producto');
                });
        }
    }
    
    function actualizarContadorGlobal() {
        fetch(`index.php?accion=contador_carrito`)
            .then(response => response.json())
            .then(data => {
                const fabCount = document.getElementById('fabCount');
                if (fabCount) {
                    fabCount.innerText = data.total;
                }
            })
            .catch(error => console.error('Error:', error));
    }
    
    // Cargar stock al iniciar
    <?php foreach ($carrito as $item): ?>
        fetch(`obtener_stock_ajax.php?id=<?php echo $item['id']; ?>`)
            .then(response => response.json())
            .then(data => {
                let stockInfo = document.getElementById(`stock-info-<?php echo $item['id']; ?>`);
                if (stockInfo) {
                    let badgeClass = data.stock <= 5 ? 'bg-warning' : 'bg-info';
                    stockInfo.innerHTML = `<span class="badge ${badgeClass}">📦 Stock disponible: ${data.stock} unidades</span>`;
                }
            })
            .catch(error => console.error('Error al cargar stock:', error));
    <?php endforeach; ?>
</script>

</body>
</html>