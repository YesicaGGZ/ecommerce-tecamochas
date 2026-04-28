<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mini E-commerce</title>
<link rel="stylesheet" href="/ecommerce/css/estilos.css">
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
        }
        .header {
            background: rgba(0,0,0,0.8);
            color: white;
            padding: 1rem 0;
            margin-bottom: 2rem;
        }
        .producto-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            margin-bottom: 25px;
            transition: transform 0.3s;
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }
        .producto-card:hover {
            transform: translateY(-10px);
        }
        .producto-img {
            width: 100%;
            height: 200px;
            object-fit: contain;
        }
        .producto-info {
            padding: 1.2rem;
            text-align: center;
        }
        .producto-titulo {
            font-size: 1.2rem;
            font-weight: bold;
            margin-bottom: 0.5rem;
        }
        .producto-precio {
            font-size: 1.8rem;
            font-weight: bold;
            color: #667eea;
            margin-bottom: 1rem;
        }
        .btn-agregar {
            background: linear-gradient(135deg, #667eea, #764ba2);
            border: none;
            color: white;
            padding: 10px 20px;
            border-radius: 25px;
            width: 100%;
            cursor: pointer;
        }
        .cart-sidebar {
            position: fixed;
            top: 0;
            right: 0;
            width: 380px;
            height: 100vh;
            background: white;
            transform: translateX(100%);
            transition: transform 0.3s;
            z-index: 1000;
            display: flex;
            flex-direction: column;
        }
        .cart-sidebar.open {
            transform: translateX(0);
        }
        .cart-header {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            padding: 1.2rem;
            display: flex;
            justify-content: space-between;
        }
        .cart-close {
            background: none;
            border: none;
            color: white;
            font-size: 1.8rem;
            cursor: pointer;
        }
        .cart-items {
            flex: 1;
            overflow-y: auto;
            padding: 1rem;
        }
        .cart-item {
            background: #f8f9fa;
            padding: 0.8rem;
            margin-bottom: 0.8rem;
            border-radius: 10px;
            display: flex;
            justify-content: space-between;
        }
        .btn-eliminar {
            background: #dc3545;
            color: white;
            border: none;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            cursor: pointer;
        }
        .cart-footer {
            padding: 1.2rem;
            border-top: 2px solid #e9ecef;
        }
        .cart-total {
            font-size: 1.2rem;
            font-weight: bold;
            margin-bottom: 1rem;
        }
        .cart-total span {
            color: #667eea;
            font-size: 1.5rem;
        }
        .btn-finalizar {
            background: #28a745;
            border: none;
            padding: 12px;
            border-radius: 25px;
            color: white;
            width: 100%;
            cursor: pointer;
        }
        .cart-fab {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 65px;
            height: 65px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea, #764ba2);
            border: none;
            color: white;
            font-size: 1.8rem;
            cursor: pointer;
            z-index: 99;
        }
        .cart-fab .badge {
            position: absolute;
            top: -8px;
            right: -8px;
            background: #dc3545;
            border-radius: 50%;
            width: 25px;
            height: 25px;
            font-size: 0.75rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .toast-notification {
            position: fixed;
            bottom: 110px;
            right: 30px;
            background: #28a745;
            color: white;
            padding: 12px 24px;
            border-radius: 10px;
            z-index: 1001;
        }
        footer {
            background: rgba(0,0,0,0.8);
            color: white;
            text-align: center;
            padding: 1.5rem;
            margin-top: 2rem;
        }
        h1, h2 {
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }
        .text-white {
            color: white;
        }
        .text-center {
            text-align: center;
        }
        .mb-4 {
            margin-bottom: 1rem;
        }
        .mb-3 {
            margin-bottom: 0.75rem;
        }
        .mt-3 {
            margin-top: 0.75rem;
        }
        .btn-light {
            background: white;
            border: none;
            padding: 8px 16px;
            border-radius: 5px;
            cursor: pointer;
        }
        .bg-danger {
            background: #dc3545;
            border-radius: 50%;
            padding: 2px 6px;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 15px;
        }
        .row {
            display: flex;
            flex-wrap: wrap;
        }
        .col-md-3 {
            width: 25%;
            padding: 0 10px;
        }
        .d-flex {
            display: flex;
        }
        .justify-content-between {
            justify-content: space-between;
        }
        .align-items-center {
            align-items: center;
        }
    </style>
</head>
<body>

<div class="header">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <h1>Mini E-commerce</h1>
            <button class="btn-light" onclick="toggleCart()">
                Carrito <span class="bg-danger" id="cartCount">0</span>
            </button>
        </div>
    </div>
</div>

<div class="container">
    <h2 class="text-center mb-4 text-white">Nuestros Productos</h2>
    <div class="row">
        <?php foreach ($productos as $producto): ?>
            <div class="col-md-3">
                <div class="producto-card">
                    <img class="producto-img" src="<?php echo $producto['imagen']; ?>" alt="<?php echo $producto['nombre']; ?>">
                    <div class="producto-info">
                        <h5 class="producto-titulo"><?php echo htmlspecialchars($producto['nombre']); ?></h5>
                        <p class="producto-precio">$<?php echo number_format($producto['precio'], 0); ?></p>
                        <button class="btn-agregar" onclick="agregarAlCarrito(<?php echo $producto['id']; ?>, '<?php echo addslashes($producto['nombre']); ?>', <?php echo $producto['precio']; ?>)">
                            Agregar al carrito
                        </button>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<div id="cartSidebar" class="cart-sidebar">
    <div class="cart-header">
        <h3>Mi Carrito</h3>
        <button class="cart-close" onclick="toggleCart()">X</button>
    </div>
    <div id="cartItems" class="cart-items">
        <p>Tu carrito esta vacio</p>
    </div>
    <div class="cart-footer">
        <div class="cart-total">
            Total: <span id="cartTotal">0</span>
        </div>
        <button class="btn-finalizar" onclick="finalizarCompra()">
            Finalizar compra
        </button>
    </div>
</div>

<button class="cart-fab" onclick="toggleCart()">
    <img src="/ecommerce/img/carrito.png" alt="Carrito" style="width: 35px; height: 35px; object-fit: contain;">
    <span class="badge" id="fabCount">0</span>
</button>

<script>
    var carrito = [];
    
    function agregarAlCarrito(id, nombre, precio) {
        var existe = false;
        for(var i = 0; i < carrito.length; i++) {
            if(carrito[i].id === id) {
                carrito[i].cantidad++;
                existe = true;
                break;
            }
        }
        
        if(!existe) {
            carrito.push({
                id: id,
                nombre: nombre,
                precio: precio,
                cantidad: 1
            });
        }
        
        actualizarCarrito();
        mostrarNotificacion(nombre + " agregado al carrito");
    }
    
    function eliminarDelCarrito(index) {
        var item = carrito[index];
        carrito.splice(index, 1);
        actualizarCarrito();
        mostrarNotificacion(item.nombre + " eliminado");
    }
    
    function actualizarCarrito() {
        var cartItemsDiv = document.getElementById('cartItems');
        var cartTotalSpan = document.getElementById('cartTotal');
        var cartCountSpan = document.getElementById('cartCount');
        var fabCountSpan = document.getElementById('fabCount');
        
        if(carrito.length === 0) {
            cartItemsDiv.innerHTML = '<p>Tu carrito esta vacio</p>';
            cartTotalSpan.innerText = '0';
            cartCountSpan.innerText = '0';
            fabCountSpan.innerText = '0';
            return;
        }
        
        var html = '';
        var total = 0;
        var totalItems = 0;
        
        for(var i = 0; i < carrito.length; i++) {
            var item = carrito[i];
            var subtotal = item.precio * item.cantidad;
            total += subtotal;
            totalItems += item.cantidad;
            
            html += '<div class="cart-item">' +
                        '<div>' +
                            '<strong>' + item.nombre + '</strong><br>' +
                            '$' + item.precio + ' x ' + item.cantidad + ' = $' + subtotal +
                        '</div>' +
                        '<button class="btn-eliminar" onclick="eliminarDelCarrito(' + i + ')">X</button>' +
                    '</div>';
        }
        
        cartItemsDiv.innerHTML = html;
        cartTotalSpan.innerText = total;
        cartCountSpan.innerText = totalItems;
        fabCountSpan.innerText = totalItems;
    }
    
    function toggleCart() {
        var sidebar = document.getElementById('cartSidebar');
        if(sidebar.classList.contains('open')) {
            sidebar.classList.remove('open');
        } else {
            sidebar.classList.add('open');
        }
    }
    
    function finalizarCompra() {
        if(carrito.length === 0) {
            alert('El carrito esta vacio');
            return;
        }
        
        var total = 0;
        for(var i = 0; i < carrito.length; i++) {
            total += carrito[i].precio * carrito[i].cantidad;
        }
        
        alert('Gracias por tu compra! Total: $' + total);
        carrito = [];
        actualizarCarrito();
        
        if(document.getElementById('cartSidebar').classList.contains('open')) {
            toggleCart();
        }
    }
    
    function mostrarNotificacion(mensaje) {
        var toast = document.createElement('div');
        toast.className = 'toast-notification';
        toast.innerHTML = mensaje;
        document.body.appendChild(toast);
        
        setTimeout(function() {
            if(toast && toast.remove) {
                toast.remove();
            }
        }, 2000);
    }
</script>

<footer>
    <p>Yesica Guadalupe Gutierrez Zarate - Negocios Electronicos II</p>
    <p>&copy; 2026 Mi Tienda Online - Todos los derechos reservados</p>
</footer>

</body>
</html>












