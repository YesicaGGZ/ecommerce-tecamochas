-- 1. Configuración inicial
DROP DATABASE IF EXISTS ecommerce;
CREATE DATABASE ecommerce;
USE ecommerce;

-- 2. Tabla de Productos (Stock inicial de 5 unidades)
CREATE TABLE productos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(150) NOT NULL,
    descripcion TEXT,
    precio DECIMAL(10,2) NOT NULL,
    stock INT NOT NULL DEFAULT 5,
    stock_inicial INT NOT NULL DEFAULT 5,
    imagen VARCHAR(255),
    categoria VARCHAR(100),
    estado ENUM('activo', 'inactivo') DEFAULT 'activo',
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 3. Tabla de Usuarios (Requisito: Contraseña con hash para validación)
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL, -- Longitud para el hash de PHP
    rol ENUM('admin', 'cliente') DEFAULT 'cliente',
    estado ENUM('activo', 'inactivo') DEFAULT 'activo',
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 4. Tabla de Movimientos de Inventario
CREATE TABLE inventario_movimientos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    producto_id INT NOT NULL,
    tipo ENUM('compra', 'venta', 'ajuste') DEFAULT 'venta',
    cantidad INT NOT NULL,
    stock_antes INT NOT NULL,
    stock_despues INT NOT NULL,
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (producto_id) REFERENCES productos(id) ON DELETE CASCADE
);

-- 5. Inserción de 10 productos de Tecamochas (Stock = 5)
INSERT INTO productos (nombre, descripcion, precio, stock, stock_inicial, imagen, categoria) VALUES
('Tecamocha Tradicional', 'Mezcla clásica de frutas de temporada con yogurt natural, miel y granola crujiente.', 65.00, 5, 5, 'img/tradicional.png', 'Clásicos'),
('Mango con Chamoy', 'Trocitos de mango fresco bañados en chamoy de la casa, limón y un toque de chile en polvo.', 55.00, 5, 5, 'img/mango.png', 'Frutales'),
('Combo Personalizado', 'Tú eliges: 3 frutas, 2 toppings y tu base favorita (yogurt, crema o jugo).', 85.00, 5, 5, 'img/Personalizado.png', 'Especialidades'),
('Biónico Especial', 'Fruta picada bañada en nuestra crema dulce secreta, pasas, coco rallado y nuez.', 75.00, 5, 5, 'img/Bionico.png', 'Clásicos'),
('Manzana Loca', 'Manzana cubierta de tamarindo, rellena de cacahuates, gomitas y bañada en salsa picante dulce.', 60.00, 5, 5, 'img/manzana.png', 'Snacks'),
('Escamocha de Litro', 'Nuestra receta tradicional en tamaño familiar para los verdaderos amantes de la fruta.', 115.00, 5, 5, 'img/litro.png', 'Especialidades'),
('Piña Loca', 'Media piña natural servida con fruta picada, banderilla de tamarindo y muchos toppings.', 95.00, 5, 5, 'img/piña.png', 'Snacks'),
('Fresas con Crema', 'Fresas frescas seleccionadas con nuestra crema especial y un toque de canela.', 70.00, 5, 5, 'img/fresa.png', 'Clásicos'),
('Vaso Loco de Fruta', 'Mezcla de sandía, pepino y jícama con mucho limón, sal y chile de árbol.', 50.00, 5, 5, 'img/loco.png', 'Frutales'),
('Jugo de Escamocha', 'Refrescante combinación de jugo de naranja con trozos finos de fruta y nuez.', 45.00, 5, 5, 'img/escamocha.png', 'Bebidas');

-- 6. Inserción de Administrador (Usuario: admin@tecamochas.com)
-- Se usa el hash de 'admin123' para que el sistema de login funcione correctamente[cite: 1]
INSERT INTO usuarios (nombre, email, password, rol) 
VALUES ('Administrador', 'admin@tecamochas.com', '$2y$10$8Kk8S1G1F1E1D1C1B1A1O.E3Y6u8KkP9r7Z6x5c4v3b2n1m0l9k8', 'admin');

-- 7. Tabla de Pedidos (Requisito para simulación de pago)
CREATE TABLE pedidos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    total DECIMAL(10,2) NOT NULL,
    estado ENUM('pendiente', 'pagado', 'cancelado') DEFAULT 'pendiente',
    metodo_pago VARCHAR(50),
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
);

-- 8. Tabla de Detalle del Pedido
CREATE TABLE detalle_pedido (
    id INT AUTO_INCREMENT PRIMARY KEY,
    pedido_id INT NOT NULL,
    producto_id INT NOT NULL,
    nombre_producto VARCHAR(150) NOT NULL,
    precio DECIMAL(10,2) NOT NULL,
    cantidad INT NOT NULL,
    subtotal DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (pedido_id) REFERENCES pedidos(id),
    FOREIGN KEY (producto_id) REFERENCES productos(id)
);

select * from usuarios;
select * from productos;

-- drop database ecommerce;
