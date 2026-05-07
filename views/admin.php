<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Verificar si el usuario es administrador
if (!isset($_SESSION['admin_logueado']) || $_SESSION['admin_logueado'] !== true) {
    header("Location: login.php");
    exit;
}

require_once __DIR__ . '/../config/db.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Verificar si es admin (por ahora simple - puedes mejorarlo después)
$esAdmin = isset($_GET['admin']) && $_GET['admin'] == 'true';
if (!$esAdmin) {
    header("Location: ../index.php");
    exit;
}

require_once __DIR__ . '/../config/db.php';

// Procesar actualización de producto
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['actualizar'])) {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];
    $estado = $_POST['estado'] ?? 'activo';
    
    $sql = "UPDATE productos SET nombre = :nombre, precio = :precio, stock = :stock, estado = :estado WHERE id = :id";
    $stmt = $conexion->prepare($sql);
    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':precio', $precio);
    $stmt->bindParam(':stock', $stock);
    $stmt->bindParam(':estado', $estado);
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    if (isset($_POST['reponer'])) {
    $stock = $_POST['stock'];
    $sql = "UPDATE productos SET stock = stock + :stock WHERE id = :id";
    $stmt = $conexion->prepare($sql);
    $stmt->bindParam(':stock', $stock);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $mensaje = "✅ Stock repuesto correctamente";
}
    
    $mensaje = "✅ Producto actualizado correctamente";
}

// OBTENER PRODUCTOS DIRECTAMENTE DE LA BD
$sql = "SELECT * FROM productos ORDER BY id";
$stmt = $conexion->prepare($sql);
$stmt->execute();
$productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Administrar Productos - Techstore</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 2rem;
        }
        .admin-card {
            background: white;
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        }
        .table img {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 10px;
        }
        .header-admin {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            padding: 1rem;
            border-radius: 15px;
            margin-bottom: 2rem;
        }
        .form-control-sm, .form-select-sm {
            font-size: 0.85rem;
        }
        .table th, .table td {
            vertical-align: middle;
        }
    </style>

    <div class="mb-3 d-flex gap-2 justify-content-between">
    <div>
        <a href="../index.php" class="btn btn-secondary">← Ver tienda</a>
        <button class="btn btn-primary" onclick="window.location.reload()">🔄 Refrescar</button>
    </div>
    <div>
        <span class="badge bg-info me-2">👤 <?php echo $_SESSION['admin_nombre'] ?? 'Admin'; ?></span>
        <a href="logout.php" class="btn btn-danger">🚪 Cerrar sesión</a>
    </div>
</div>
</head>
<body>
    <div class="container">
        <div class="admin-card">
            <div class="header-admin text-center">
                <h1>📦 Administrar Inventario</h1>
                <p>Gestión de productos y stock</p>
            </div>
            
            <?php if (isset($mensaje)): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?php echo $mensaje; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>
            
            <div class="mb-3 d-flex gap-2">
                <a href="../index.php" class="btn btn-secondary">← Ver tienda</a>
                <button class="btn btn-primary" onclick="window.location.reload()">🔄 Refrescar</button>
                <a href="?admin=true" class="btn btn-info">📊 Dashboard</a>
            </div>
            
            <?php if (empty($productos)): ?>
                <div class="alert alert-warning">
                    ⚠️ No hay productos en la base de datos. Agrega algunos productos desde phpMyAdmin.
                </div>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Imagen</th>
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>Precio ($)</th>
                                <th>Stock</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($productos as $p): ?>
                            <form method="POST">
                                <input type="hidden" name="id" value="<?php echo $p['id']; ?>">
                                <input type="hidden" name="actualizar" value="1">
                                <tr>
                                    <td><?php echo $p['id']; ?></td>
                                    <td>
                                        <img src="<?php echo htmlspecialchars($p['imagen']); ?>" alt="<?php echo htmlspecialchars($p['nombre']); ?>">
                                        <br>
                                        <small class="text-muted">
                                            <input type="text" name="imagen" value="<?php echo htmlspecialchars($p['imagen']); ?>" class="form-control form-control-sm mt-1" placeholder="img/producto.jpg">
                                        </small>
                                    </td>
                                    <td>
                                        <input type="text" name="nombre" value="<?php echo htmlspecialchars($p['nombre']); ?>" class="form-control form-control-sm" required>
                                    </td>
                                    <td>
                                        <textarea name="descripcion" class="form-control form-control-sm" rows="2"><?php echo htmlspecialchars($p['descripcion']); ?></textarea>
                                    </td>
                                    <td>
                                        <input type="number" name="precio" value="<?php echo $p['precio']; ?>" class="form-control form-control-sm" step="0.01" required>
                                    </td>
                                    <td>
                                        <input type="number" name="stock" value="<?php echo $p['stock']; ?>" class="form-control form-control-sm" required>
                                        <small class="text-muted">ID: <?php echo $p['id']; ?></small>
                                    </td>
                                    <td>
                                        <select name="estado" class="form-select form-select-sm">
                                            <option value="activo" <?php echo $p['estado'] == 'activo' ? 'selected' : ''; ?>>Activo</option>
                                            <option value="inactivo" <?php echo $p['estado'] == 'inactivo' ? 'selected' : ''; ?>>Inactivo</option>
                                        </select>
                                    </td>
                                    <td>
                                        <button type="submit" class="btn btn-primary btn-sm w-100">💾 Guardar</button>
                                    </td>
                                </tr>
                            </form>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                
                <hr>
                
                <h4>📊 Resumen de inventario</h4>
                <div class="row mt-3">
                    <div class="col-md-4">
                        <div class="card text-center bg-info text-white">
                            <div class="card-body">
                                <h3><?php echo count($productos); ?></h3>
                                <p>Total productos</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card text-center bg-success text-white">
                            <div class="card-body">
                                <h3>
                                    <?php 
                                    $stockTotal = 0;
                                    foreach ($productos as $p) {
                                        $stockTotal += $p['stock'];
                                    }
                                    echo $stockTotal;
                                    ?>
                                </h3>
                                <p>Unidades en stock</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card text-center bg-warning text-dark">
                            <div class="card-body">
                                <h3>
                                    <?php 
                                    $stockBajo = 0;
                                    foreach ($productos as $p) {
                                        if ($p['stock'] <= 5 && $p['stock'] > 0) $stockBajo++;
                                    }
                                    echo $stockBajo;
                                    ?>
                                </h3>
                                <p>Productos con stock bajo (≤5)</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row mt-3">
                    <div class="col-md-12">
                        <div class="card text-center bg-danger text-white">
                            <div class="card-body">
                                <h3>
                                    <?php 
                                    $agotados = 0;
                                    foreach ($productos as $p) {
                                        if ($p['stock'] == 0) $agotados++;
                                    }
                                    echo $agotados;
                                    ?>
                                </h3>
                                <p>Productos agotados</p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <td>
    <div class="d-flex gap-1">
        <input type="number" name="stock" value="<?php echo $p['stock']; ?>" class="form-control form-control-sm" style="width: 70px;">
        <button type="submit" name="reponer" value="1" class="btn btn-success btn-sm">+</button>
    </div>
</td>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>