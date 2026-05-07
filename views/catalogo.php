<?php
/**
 * Vista del catálogo de productos - Tecamochas
 * Muestra la página principal con productos, carrito, equipo y más
 * 
 * @package Views
 * @author Tecamochas
 */
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="tecamochas, escamochadas, snacks saludables, cocteltec, tec pachuca fruta">
    <title>Tecamochas</title>
    <link href="https://fonts.googleapis.com/css2?family=Comic+Neue&family=DynaPuff&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* ============================================================
           ESTILOS PRINCIPALES - TECAMOCHAS
           Colores pastel, diseño divertido y frutas flotantes
        ============================================================ */
        
        /* Base */
        body {
            background-color: #fffbe7 !important;
            font-family: 'Comic Neue', cursive;
            background-image: none !important;
        }

        .dynapuff {
            font-family: 'DynaPuff', cursive;
        }

        /* ===== FRUTAS FLOTANTES DE FONDO ===== */
        .floating-fruit {
            position: absolute;
            font-size: 2rem;
            animation: floatFruit linear infinite;
            pointer-events: none;
            z-index: 0;
        }

        @keyframes floatFruit {
            0% {
                transform: translateY(100vh) rotate(0deg);
                opacity: 0;
            }
            10% {
                opacity: 1;
            }
            90% {
                opacity: 1;
            }
            100% {
                transform: translateY(-20vh) rotate(360deg);
                opacity: 0;
            }
        }

        /* ===== HEADER OVALADO ===== */
        .nav-menu-ovalado {
            display: flex;
            gap: 1.5rem;
            flex-wrap: wrap;
            justify-content: center;
        }

        .nav-link-ovalado {
            padding: 10px 25px;
            background: #fde68a;
            border-radius: 50px;
            color: #333;
            font-weight: bold;
            transition: all 0.3s ease;
            font-size: 0.9rem;
            text-decoration: none;
            display: inline-block;
        }

        .nav-link-ovalado:hover {
            transform: scale(1.05);
            background: #fbbf24;
        }

        .nav-link-cta-ovalado {
            background: linear-gradient(135deg, #f59e0b, #ea580c);
            color: white !important;
        }

        .nav-link-cta-ovalado:hover {
            background: linear-gradient(135deg, #ea580c, #c2410c);
        }

        /* ===== HERO ANIMACIONES ===== */
        @keyframes floatLogo {
            0%, 100% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-20px);
            }
        }

        .animate-float {
            animation: floatLogo 3s ease-in-out infinite;
        }

        .hero-logo {
            max-width: 300px;
            width: 80%;
            filter: drop-shadow(0 20px 25px rgba(0, 0, 0, 0.15));
        }

        .hero-subtitle {
            display: inline-block;
            backdrop-filter: blur(8px);
        }

        /* ===== TARJETAS DE PRODUCTOS ===== */
        .card-verde {
            background-color: #e7fcec !important;
        }

        .card-azul {
            background-color: #eceefd !important;
        }

        .card-amarillo {
            background-color: #fef3c7 !important;
        }

        .producto-card {
            border-radius: 30px !important;
            border: none !important;
            transition: all 0.3s ease;
            overflow: hidden;
        }

        .producto-card:hover {
            transform: translateY(-10px) rotate(1deg);
        }

        /* ===== BOTÓN FLOTANTE DEL CARRITO ===== */
        .cart-fab {
            position: fixed;
            bottom: 100px;
            right: 20px;
            width: 70px;
            height: 70px;
            border-radius: 50%;
            background: linear-gradient(135deg, #3b82f6, #60a5fa);
            color: white;
            font-size: 2rem;
            z-index: 999;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 8px 25px rgba(59, 130, 246, 0.4);
            cursor: pointer;
            border: none;
            transition: all 0.3s ease;
        }

        .cart-fab:hover {
            transform: scale(1.1);
            box-shadow: 0 12px 30px rgba(59, 130, 246, 0.6);
        }

        .cart-fab .badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background: #f43f5e;
            border-radius: 50%;
            padding: 2px 8px;
            font-size: 0.8rem;
            border: 2px solid white;
        }

        /* ===== MARQUESINA (BANNER DESLIZANTE) ===== */
        .marquee-container {
            overflow: hidden;
            white-space: nowrap;
            background-color: #fed7aa;
            padding: 2rem 0;
            position: relative;
        }

        .marquee-content {
            display: inline-block;
            animation: marquee 20s linear infinite;
            white-space: nowrap;
        }

        .marquee-content span {
            display: inline-block;
            padding: 0 2rem;
            font-size: 1.5rem;
            font-weight: bold;
            color: #9a3412;
        }

        @keyframes marquee {
            0% {
                transform: translateX(0%);
            }
            100% {
                transform: translateX(-50%);
            }
        }

        .marquee-container:hover .marquee-content {
            animation-play-state: paused;
        }

        /* ===== WHATSAPP FLOTANTE ===== */
        .whatsapp-float {
            transition: all 0.3s ease;
        }

        .whatsapp-float:hover {
            transform: scale(1.1);
        }

        /* ===== SECCIÓN ACERCA DE (Misión, Visión, Valores) ===== */
        .seccion-acerca {
            background-color: #fef3c7;
            padding: 4rem 1.5rem;
            text-align: center;
            color: #374151;
        }

        .titulo-seccion {
            font-size: 2.5rem;
            font-family: 'Dynapuff', cursive;
            color: #ea580c;
            margin-bottom: 2rem;
        }

        /* ===== EQUIPO (Círculos con fotos) ===== */
        .team-section-circle {
            padding: 2rem 1rem;
            background-color: #fdffed;
            text-align: center;
        }

        .team-title-circle {
            font-family: 'DynaPuff', cursive;
            font-size: 2.5rem;
            color: #fd9800;
            margin-bottom: 4rem;
        }

        .team-container-circle {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 4rem;
            max-width: 2000px;
            margin: 0 auto;
            padding: 0 1rem;
        }

        .team-member-circle {
            display: flex;
            flex-direction: column;
            align-items: center;
            transition: all 0.3s ease;
        }

        .img-container-circle {
            position: relative;
            width: 12rem;
            height: 12rem;
            border-radius: 50%;
            transition: all 0.3s ease;
        }

        .team-img-circle {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
            border: 4px solid;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .team-name-circle {
            font-weight: 700;
            margin-top: 1rem;
            font-size: 1.25rem;
            transition: color 0.3s ease;
        }

        /* Efectos hover */
        .team-member-circle:hover .img-container-circle {
            transform: scale(1.1);
        }

        /* Alonso1 (José A) */
        .alonso1-img {
            background-color: rgba(191, 219, 254, 0.3);
        }
        .alonso1-img .team-img-circle {
            border-color: #93c5fd;
        }
        .alonso1-name {
            color: #2563eb;
        }

        /* Yesica */
        .yesica-img {
            background-color: rgba(252, 231, 243, 0.3);
        }
        .yesica-img .team-img-circle {
            border-color: #f9a8d4;
        }
        .yesica-name {
            color: #db2777;
        }

        /* Alonso2 */
        .alonso2-img {
            background-color: rgba(254, 243, 199, 0.3);
        }
        .alonso2-img .team-img-circle {
            border-color: #fcd34d;
        }
        .alonso2-name {
            color: #d97706;
        }

        /* Valores - Burbujas */
        .valores-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 1rem;
        }

        .valor-bubble {
            display: inline-block;
            background: #ffdce0;
            border-radius: 50%;
            padding: 1rem 1.5rem;
            margin: 0.5rem;
            cursor: pointer;
            position: relative;
            font-weight: 600;
            user-select: none;
            transition: background-color 0.3s ease;
            color: #b8325e;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        .valor-bubble:hover {
            background-color: #fcb1c3;
        }

        .descripcion-valor {
            display: none;
            position: absolute;
            bottom: 120%;
            left: 50%;
            transform: translateX(-50%);
            width: 220px;
            background-color: #fff9f9;
            color: #b8325e;
            padding: 0.8rem 1rem;
            border-radius: 0.8rem;
            box-shadow: 0 2px 10px rgba(184, 50, 94, 0.3);
            font-weight: 400;
            font-size: 0.9rem;
            z-index: 10;
        }

        .valor-bubble.active .descripcion-valor {
            display: block;
        }

        /* ===== MODAL AVISO DE PRIVACIDAD ===== */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            backdrop-filter: blur(5px);
            animation: fadeInModal 0.3s ease-in-out;
        }

        @keyframes fadeInModal {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .modal-contenido {
            background: linear-gradient(135deg, #fffbe7 0%, #fff5e6 100%);
            margin: 3% auto;
            padding: 0;
            border-radius: 30px;
            width: 90%;
            max-width: 800px;
            max-height: 85vh;
            overflow-y: auto;
            position: relative;
            animation: slideDown 0.4s ease-out;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            border: 2px solid #f472b6;
        }

        @keyframes slideDown {
            from {
                transform: translateY(-50px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .modal-header {
            position: sticky;
            top: 0;
            background: linear-gradient(135deg, #f472b6 0%, #ec4899 100%);
            padding: 1.5rem;
            border-radius: 28px 28px 0 0;
            border-bottom: 3px solid #fbbf24;
            z-index: 10;
        }

        .close-modal {
            position: absolute;
            right: 1.5rem;
            top: 1rem;
            color: white;
            font-size: 2rem;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            width: 35px;
            height: 35px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.2);
        }

        .close-modal:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: rotate(90deg);
        }

        .titulo-modal {
            font-family: 'DynaPuff', cursive;
            font-size: 1.5rem;
            text-align: center;
            color: white;
            margin: 0;
            filter: drop-shadow(2px 2px 4px rgba(0, 0, 0, 0.2));
        }

        .texto-modal {
            padding: 1.5rem 2rem;
            font-family: 'Comic Neue', cursive;
            font-size: 0.95rem;
            line-height: 1.6;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .modal-contenido { margin: 5% auto; }
            .titulo-modal { font-size: 1.2rem; }
            .texto-modal { padding: 1rem; }
        }
    </style>
</head>

<body class="text-gray-700">

    <!-- ============================================================
         FRUTAS FLOTANTES DE FONDO (JavaScript genera emojs animados)
    ============================================================ -->
    <div id="frutas-container" class="fixed inset-0 pointer-events-none z-0 overflow-hidden"></div>

    <!-- ============================================================
         BOTÓN FLOTANTE DEL CARRITO
         Muestra el contador de productos y redirige al carrito
    ============================================================ -->
    <button class="cart-fab" onclick="window.location.href='index.php?accion=ver_carrito'">
        🛒 <span class="badge" id="fabCount">0</span>
    </button>

    <!-- ============================================================
         HEADER - BARRA DE NAVEGACIÓN OVALADA
         Enlaces: INICIO, PRODUCTOS, ¡PIDE YA!
    ============================================================ -->
    <header class="bg-[#fffbe7] shadow-md sticky top-0 z-50">
        <div class="container mx-auto flex flex-col md:flex-row items-center justify-between px-6 py-4 gap-4">
            <a href="#inicio">
                <img src="img/logo.png" alt="Logo Tecamochas" class="h-12 hover:opacity-80 transition duration-200">
            </a>
            <nav class="nav-menu-ovalado">
                <a href="index.php" class="nav-link-ovalado">INICIO</a>
                <a href="#productos" class="nav-link-ovalado">PRODUCTOS</a>
                <a href="index.php?accion=login" class="nav-link-ovalado nav-link-cta-ovalado">¡PIDE YA!</a>
            </nav>
        </div>
    </header>

    <!-- ============================================================
         HERO SECTION - PANTALLA DE BIENVENIDA
         Logo con animación flotante y botón para ver catálogo
    ============================================================ -->
    <section id="inicio" style="background-color: #fffbe7" class="relative h-screen flex flex-col justify-center items-center text-center px-6 overflow-hidden">
        <div class="absolute inset-0 z-0" id="frutas-container-hero"></div>
        <div class="relative z-10">
            <img src="img/logo.png" alt="TECAMOCHAS" class="hero-logo mx-auto animate-float">
            <div class="mt-8">
                <a href="#productos" class="inline-block border-2 border-orange-500 text-orange-600 px-8 py-3 rounded-full bg-white hover:bg-orange-50 transition-all hover:scale-105 font-bold shadow-lg">
                    Ver Catálogo 🍓
                </a>
            </div>
        </div>
    </section>

    <!-- ============================================================
         SECCIÓN DE VIDEO PROMOCIONAL
         Video de fondo con mensaje superpuesto
    ============================================================ -->
    <section class="relative w-full h-[60vh] md:h-[80vh] overflow-hidden">
        <video autoplay muted loop playsinline class="absolute top-0 left-0 w-full h-full object-cover z-0">
            <source src="img/video1.mp4" type="video/mp4">
            Tu navegador no soporta video HTML5.
        </video>
        <div class="absolute inset-0 bg-black bg-opacity-30 z-10"></div>
        <div class="relative z-20 flex items-center justify-center h-full text-center text-white px-4">
            <h1 class="text-3xl md:text-5xl font-bold drop-shadow-lg">¡Disfruta en cualquier momento!</h1>
        </div>
    </section>

    <!-- ============================================================
         MARQUESINA 1 - BANNER DESLIZANTE (Primer mensaje)
    ============================================================ -->
    <section class="marquee-container">
        <div class="marquee-content">
            <span>🍌 No sabemos si te va a pelar, pero va a sonreír</span>
            <span>❤️ Tareas, estrés y... ¡una Tecamocha, por favor!</span>
            <span>🥭 ¿Quién necesita hombres cuando hay fruta con chilito?</span>
            <span>🍌 No sabemos si te va a pelar, pero va a sonreír</span>
            <span>❤️ Tareas, estrés y... ¡una Tecamocha, por favor!</span>
            <span>🥭 ¿Quién necesita hombres cuando hay fruta con chilito?</span>
        </div>
    </section>

    <!-- ============================================================
         PRODUCTOS - SECCIÓN "TUS FAVORITOS"
         Muestra los productos en tarjetas con colores pastel
         Los datos vienen de $productos (enviado desde controlador)
    ============================================================ -->
    <main class="container mx-auto py-16 px-6 relative z-10" id="productos">
        <h2 class="dynapuff text-center text-pink-500 text-5xl mb-12">¡Tus favoritos!</h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
            <?php 
            // Array de colores alternados para las tarjetas
            $colores = ['card-verde', 'card-azul', 'card-amarillo'];
            foreach ($productos as $index => $p): 
                $fondo = $colores[$index % 3];
            ?>
                <div class="producto-card p-6 shadow-lg <?= $fondo ?>">
                    <div class="relative">
                        <img src="<?= $p['imagen'] ?>" class="w-full h-64 object-contain rounded-2xl mb-4" alt="<?= htmlspecialchars($p['nombre']) ?>">
                        <?php if ($p['stock'] <= 5 && $p['stock'] > 0): ?>
                            <span class="absolute top-2 left-2 bg-orange-500 text-white text-xs px-3 py-1 rounded-full font-bold">⚠️ Últimas!</span>
                        <?php endif; ?>
                    </div>

                    <h3 class="dynapuff text-2xl mb-2" style="color: #db2777;"><?= htmlspecialchars($p['nombre']) ?></h3>
                    <p class="text-gray-600 text-sm mb-4"><?= htmlspecialchars(substr($p['descripcion'], 0, 60)) ?>...</p>

                    <div class="flex justify-between items-center mb-6">
                        <span class="text-3xl font-black text-blue-600">$<?= number_format($p['precio'], 0) ?></span>
                        <span class="text-xs font-bold text-gray-500">Stock: <?= $p['stock'] ?></span>
                    </div>

                    <!-- Botón Agregar (solo si usuario logueado) -->
                    <?php if(isset($_SESSION['usuario_id'])): ?>
                        <button class="w-full bg-pink-500 text-white py-3 rounded-full dynapuff text-lg shadow-md hover:bg-pink-600 transition"
                                onclick="agregarAlCarrito(this, <?= $p['id'] ?>, '<?= addslashes($p['nombre']) ?>')">
                            + Agregar
                        </button>
                    <?php else: ?>
                        <a href="index.php?accion=login" class="block w-full bg-gray-200 text-gray-500 py-3 rounded-full text-center text-sm italic">
                            Inicia sesión para pedir
                        </a>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- ============================================================
             MARQUESINA 2 - BANNER DESLIZANTE (Segundo mensaje)
        ============================================================ -->
        <section class="marquee-container">
            <div class="marquee-content">
                <span class="text-xl md:text-2xl lg:text-3xl text-pink-700 font-semibold">
                    ¡Tenemos algo especial para ti!🥰 - Haz tu pedido en segundos🤩 - Recoge o te lo llevamos hasta tu aula🫡
                </span>
                <span class="text-xl md:text-2xl lg:text-3xl text-pink-700 font-semibold">
                    ¡Tenemos algo especial para ti!🥰 - Haz tu pedido en segundos🤩 - Recoge o te lo llevamos hasta tu aula🫡
                </span>
            </div>
        </section>

        <!-- ============================================================
             SECCIÓN "¿QUIÉNES SOMOS?" - MISIÓN, VISIÓN Y VALORES
             Los valores son interactivos (click para mostrar descripción)
        ============================================================ -->
        <script>
            function toggleDescripcion(element) {
                element.classList.toggle('active');
            }
        </script>
        
        <section id="acerca" class="bg-blue-100 py-16 px-6 text-center rounded-2xl my-8">
            <h2 class="text-4xl dynapuff text-orange-600 mb-12">¿Quiénes somos?</h2>

            <div class="max-w-4xl mx-auto space-y-10 text-gray-700">
                <!-- Misión -->
                <div>
                    <h3 class="text-2xl font-bold text-pink-500 mb-4">Misión</h3>
                    <p>
                        Brindar a estudiantes universitarios momentos de alivio y sabor a través de escamochas y cocteles frutales que
                        rescaten su energía y ánimo.
                    </p>
                </div>

                <!-- Visión -->
                <div>
                    <h3 class="text-2xl font-bold text-blue-500 mb-4">Visión</h3>
                    <p>
                        Ser la marca número uno de snacks frutales dentro del Tec de Pachuca, y expandirse a otras universidades.
                    </p>
                </div>

                <!-- Valores (burbujas interactivas) -->
                <div>
                    <h3 class="text-2xl font-bold text-green-500 mb-6">Valores</h3>
                    <div class="valores-container">
                        <div class="valor-bubble" onclick="toggleDescripcion(this)">
                            😊 Bienestar
                            <div class="descripcion-valor">
                                Promover una alimentación más natural, ligera y que recargue la energía del estudiante.
                            </div>
                        </div>
                        <div class="valor-bubble" onclick="toggleDescripcion(this)">
                            🍉 Frescura
                            <div class="descripcion-valor">
                                No solo por los ingredientes, sino por la actitud joven, actual y relajada que debe reflejar la marca.
                            </div>
                        </div>
                        <div class="valor-bubble" onclick="toggleDescripcion(this)">
                            💛 Empatía
                            <div class="descripcion-valor">
                                Entender las necesidades reales del estudiante: cansancio, estrés, falta de tiempo y deseo de apapacho.
                            </div>
                        </div>
                        <div class="valor-bubble" onclick="toggleDescripcion(this)">
                            🎉 Diversión
                            <div class="descripcion-valor">
                                Convertir un simple snack en una experiencia divertida, creativa y con estilo propio.
                            </div>
                        </div>
                        <div class="valor-bubble" onclick="toggleDescripcion(this)">
                            📚 Cercanía
                            <div class="descripcion-valor">
                                Llegar directo a su aula, estar donde ellos están, generar comunidad.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ============================================================
             SECCIÓN "NUESTRO EQUIPO"
             Miembros: Alonso1 (José A), Yesica, Alonso2
             Los nombres han sido cambiados de Álvaro → Alonso1 y Fernando → Alonso2
        ============================================================ -->
        <section id="nosotros" class="team-section-circle">
            <h2 class="team-title-circle">Nuestro equipo</h2>

            <div class="team-container-circle">
                <!-- Alonso1 (anteriormente Álvaro) -->
                <div class="team-member-circle" onclick="toggleMemberDescription('alonso1')">
                    <div class="img-container-circle alonso1-img">
                        <img src="img/Alonso1.png" class="team-img-circle" alt="Alonso1 - José A">
                    </div>
                    <h3 class="team-name-circle alonso1-name">José A</h3>
                </div>

                <!-- Yesica -->
                <div class="team-member-circle" onclick="toggleMemberDescription('yesica')">
                    <div class="img-container-circle yesica-img">
                        <img src="img/yesica.png" class="team-img-circle" alt="Yesica">
                    </div>
                    <h3 class="team-name-circle yesica-name">Yesica</h3>
                </div>

                <!-- Alonso2 (anteriormente Fernando) -->
                <div class="team-member-circle" onclick="toggleMemberDescription('alonso2')">
                    <div class="img-container-circle alonso2-img">
                        <img src="img/Alonso2.png" class="team-img-circle" alt="Alonso2 - Alonso">
                    </div>
                    <h3 class="team-name-circle alonso2-name">Alonso</h3>
                </div>
            </div>
        </section>

        <!-- ============================================================
             SECCIÓN "SÍGUENOS" - REDES SOCIALES
        ============================================================ -->
        <section class="bg-pink-100 py-10 text-center rounded-2xl my-8">
            <h2 class="text-3xl dynapuff text-pink-600 mb-4">Síguenos en nuestras redes sociales</h2>
            <div class="flex justify-center gap-6">
                <a href="#" class="text-blue-600 text-xl hover:scale-110 transition">Facebook</a>
                <a href="#" class="text-pink-500 text-xl hover:scale-110 transition">Instagram</a>
                <a href="#" class="text-black-500 text-xl hover:scale-110 transition">TikTok</a>
            </div>
        </section>

        <!-- ============================================================
             AVISO DE PRIVACIDAD (MODAL)
             Botón que abre modal con el texto completo del aviso
        ============================================================ -->
        <div class="bg-gradient-to-r from-blue-100 to-blue-200 py-16 text-center rounded-2xl my-8 shadow-lg">
            <h1 class="text-3xl md:text-4xl dynapuff text-blue-600 mb-6 mt-4">¡Tus datos están seguros con nosotros!</h1>
            <p class="text-gray-600 mb-8 max-w-md mx-auto">Lee nuestro aviso de privacidad y conoce cómo protegemos tu información.</p>
            <button onclick="mostrarModal()" 
                class="bg-blue-600 text-white py-3 px-8 rounded-full hover:bg-blue-700 transition-all duration-300 transform hover:scale-105 shadow-lg font-semibold text-lg">
                Ver aviso de Privacidad ✅
            </button>
        </div>

        <!-- Modal del aviso de privacidad (inicialmente oculto) -->
        <div id="modalAviso" class="modal" style="display: none;">
            <div class="modal-contenido">
                <div class="modal-header">
                    <span class="close-modal" onclick="cerrarModal()">&times;</span>
                    <h1 class="titulo-modal">
                        <span class="inline-block animate-pulse">🍓</span> 
                        Aviso de Privacidad - Tecamochas 
                        <span class="inline-block animate-pulse">🥭</span>
                    </h1>
                </div>
                
                <div class="texto-modal">
                    <p class="text-gray-700 leading-relaxed">En <strong class="text-blue-600">Tecamochas</strong>, con domicilio en <strong>Venta Prieta, Pachuca de Soto, Hgo.</strong> estamos
                    comprometidos con la protección de tus datos personales...</p>
                    
                    <div class="mt-6 p-4 bg-blue-50 rounded-lg">
                        <p class="font-bold text-blue-700 text-lg mb-2">📋 Datos recopilados:</p>
                        <p class="text-gray-700">Nombre, correo, teléfono, dirección, datos de pago (protegidos), navegación (cookies), preferencias y pedidos.</p>
                    </div>
                    
                    <div class="mt-4 p-4 bg-green-50 rounded-lg">
                        <p class="font-bold text-green-700 text-lg mb-2">🎯 Finalidades:</p>
                        <ul class="list-disc list-inside text-gray-700 space-y-1">
                            <li><strong>Primarias:</strong> Procesar pedidos, confirmar compras, atención al cliente.</li>
                            <li><strong>Secundarias:</strong> Promociones y análisis del uso web (previo consentimiento).</li>
                        </ul>
                    </div>
                    
                    <div class="mt-4 p-4 bg-purple-50 rounded-lg">
                        <p class="font-bold text-purple-700 text-lg mb-2">🔄 Transferencia de datos:</p>
                        <p class="text-gray-700">Solo a plataformas de pago y entrega, o por requerimiento legal.</p>
                    </div>
                    
                    <div class="mt-4 p-4 bg-yellow-50 rounded-lg">
                        <p class="font-bold text-yellow-700 text-lg mb-2">🔒 Seguridad:</p>
                        <p class="text-gray-700">Usamos conexiones seguras (SSL) y protección de datos físicos y digitales.</p>
                    </div>
                    
                    <div class="mt-4 p-4 bg-red-50 rounded-lg">
                        <p class="font-bold text-red-700 text-lg mb-2">✍️ Derechos ARCO:</p>
                        <p class="text-gray-700">Puedes solicitar acceso, rectificación, cancelación u oposición escribiendo a 
                        <a href="mailto:tecamochas@gmail.com" class="text-blue-600 hover:text-blue-800 underline">tecamochas@gmail.com</a> 
                        o al <strong>771 501 5000</strong>.</p>
                    </div>
                    
                    <div class="mt-4 p-4 bg-gray-100 rounded-lg">
                        <p class="font-bold text-gray-700 text-lg mb-2">🍪 Cookies:</p>
                        <p class="text-gray-700">Utilizamos cookies para mejorar tu experiencia. Puedes gestionarlas desde tu navegador.</p>
                    </div>
                    
                    <div class="mt-4 p-4 bg-indigo-50 rounded-lg">
                        <p class="font-bold text-indigo-700 text-lg mb-2">📢 Actualizaciones:</p>
                        <p class="text-gray-700">Cualquier cambio será publicado en nuestra página web.</p>
                    </div>
                    
                    <div class="mt-6 text-center p-4 bg-gradient-to-r from-blue-500 to-purple-600 rounded-lg text-white">
                        <p class="font-bold text-lg">❓ ¿Dudas? Contáctanos en:</p>
                        <p class="text-sm">📧 tecamochas@gmail.com | 📞 771-501-5000</p>
                    </div>
                    
                    <p class="text-center mt-6 text-lg font-bold text-pink-600">🎉 ¡Gracias por confiar en nosotros para disfrutar de los mejores cócteles de frutas y escamochas! 🎉</p>
                </div>
                
                <div class="text-center mt-8">
                    <button onclick="cerrarModal()" 
                        class="bg-gradient-to-r from-blue-600 to-purple-600 text-white py-3 px-8 rounded-full hover:from-blue-700 hover:to-purple-700 transition-all duration-300 transform hover:scale-105 font-bold text-lg shadow-xl">
                        Aceptar 🍍
                    </button>
                </div>
            </div>
        </div>
    </main>

    <!-- ============================================================
         WHATSAPP FLOTANTE
         Botón que redirige a WhatsApp para contacto directo
    ============================================================ -->
    <a class="whatsapp-float fixed left-6 bottom-6 bg-[#25D366] w-16 h-16 rounded-full flex items-center justify-center shadow-2xl z-50 transition hover:scale-110" 
       href="https://wa.me/527715015000" target="_blank">
        <svg width="35" height="35" fill="white" viewBox="0 0 24 24">
            <path d="M20.52 3.48A11.93 11.93 0 0 0 12 0C5.37 0 0 5.37 0 12c0 2.12.56 4.18 1.62 6.01L0 24l6.19-1.62A11.94 11.94 0 0 0 12 24c6.63 0 12-5.37 12-12 0-3.2-1.24-6.27-3.48-8.52zM12 21.67c-1.92 0-3.78-.53-5.39-1.52l-1.39.96-.56-1.8a9.64 9.64 0 0 1-1.39-5.4c0-5.33 4.34-9.67 9.67-9.67 2.58 0 5.01 1 6.84 2.83A9.64 9.64 0 0 1 21.67 12c0 5.33-4.34 9.67-9.67 9.67zm5.13-7.72c-.28-.14-1.64-.81-1.89-.9-.26-.1-.44-.14-.63.14-.18.28-.72.9-.88 1.09-.16.18-.32.2-.6.07-.28-.14-1.18-.44-2.25-1.39-.83-.74-1.39-1.66-1.55-1.94-.16-.28-.02-.43.12-.57.13-.13.28-.33.42-.5.14-.16.19-.28.28-.47.09-.19.05-.36-.02-.5-.07-.14-.63-1.54-.87-2.11-.23-.54-.46-.46-.63-.46-.16 0-.35-.02-.53-.02-.19 0-.48.07-.73.35-.25.28-.97.94-.97 2.3 0 1.36.99 2.67 1.13 2.86.14.19 1.94 2.95 4.68 4.14 2.74 1.19 2.74.79 3.23.74.49-.05 1.58-.64 1.8-1.27.22-.63.22-1.17.15-1.27-.07-.09-.26-.14-.54-.23z"/>
        </svg>
    </a>

    <!-- ============================================================
         FOOTER - PIE DE PÁGINA
    ============================================================ -->
    <footer class="bg-pink-300 text-center py-4 text-white">
        <p>&copy; 2025 Tecamochas. Todos los derechos reservados.</p>
    </footer>

    <!-- ============================================================
         SCRIPTS PRINCIPALES
         - Frutas flotantes en segundo plano
         - Carrito de compras (agregar, contador)
         - Smooth scroll para anclas
         - Modal de privacidad
    ============================================================ -->
    <script>
        /**
         * Genera frutas flotantes animadas en el fondo
         * @param {string} containerId - ID del contenedor donde se añadirán
         * @param {number} cantidad - Número de frutas a generar
         */
        function crearFrutasFlotantes(containerId, cantidad = 15) {
            const container = document.getElementById(containerId);
            if (!container) return;
            
            const frutas = ['🍓', '🍌', '🥭', '🍍', '🍊', '🍎', '🍉', '🥝', '🍒', '🍑', '🍋', '🥥'];
            
            for (let i = 0; i < cantidad; i++) {
                const fruta = document.createElement('div');
                fruta.className = 'floating-fruit';
                fruta.textContent = frutas[Math.floor(Math.random() * frutas.length)];
                
                const size = Math.random() * 2 + 1;
                const left = Math.random() * 100;
                const duration = Math.random() * 8 + 5;
                const delay = Math.random() * 10;
                const rotation = Math.random() * 360;
                
                fruta.style.cssText = `
                    left: ${left}%;
                    font-size: ${size}rem;
                    animation-duration: ${duration}s;
                    animation-delay: -${delay}s;
                    transform: rotate(${rotation}deg);
                `;
                
                container.appendChild(fruta);
            }
        }

        /**
         * Agrega un producto al carrito vía AJAX
         * @param {HTMLElement} boton - El botón que se clickeó
         * @param {number} id - ID del producto
         * @param {string} nombre - Nombre del producto
         */
        function agregarAlCarrito(boton, id, nombre) {
            boton.innerHTML = '⏳...';
            boton.disabled = true;

            fetch(`index.php?accion=agregar_carrito_ajax&id=${id}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        actualizarContadorCarrito();
                        boton.innerHTML = '¡Listo! ✅';
                        setTimeout(() => { 
                            boton.innerHTML = '+ Agregar'; 
                            boton.disabled = false; 
                        }, 1500);
                    } else {
                        alert(data.error || 'Error');
                        boton.innerHTML = '+ Agregar';
                        boton.disabled = false;
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error al agregar al carrito');
                    boton.innerHTML = '+ Agregar';
                    boton.disabled = false;
                });
        }

        /**
         * Actualiza el contador del carrito en el botón flotante
         */
        function actualizarContadorCarrito() {
            fetch('index.php?accion=contador_carrito')
                .then(response => response.json())
                .then(data => {
                    const badge = document.getElementById('fabCount');
                    if (badge) {
                        badge.innerText = data.total || 0;
                    }
                })
                .catch(error => console.error('Error:', error));
        }

        /**
         * Smooth scroll para enlaces internos (#productos, #inicio)
         */
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                const href = this.getAttribute('href');
                if (href === '#productos' || href === '#inicio') {
                    e.preventDefault();
                    const target = document.querySelector(href);
                    if (target) {
                        target.scrollIntoView({ behavior: 'smooth' });
                    }
                }
            });
        });

        /**
         * Muestra el modal de aviso de privacidad
         */
        function mostrarModal() {
            document.getElementById('modalAviso').style.display = 'block';
            document.body.style.overflow = 'hidden';
        }
        
        /**
         * Cierra el modal de aviso de privacidad
         */
        function cerrarModal() {
            document.getElementById('modalAviso').style.display = 'none';
            document.body.style.overflow = 'auto';
        }
        
        // Cerrar modal al hacer clic fuera del contenido
        window.onclick = function(event) {
            const modal = document.getElementById('modalAviso');
            if (event.target === modal) {
                cerrarModal();
            }
        }
        
        // Cerrar modal con tecla ESC
        document.addEventListener('keydown', function(event) {
            const modal = document.getElementById('modalAviso');
            if (event.key === 'Escape' && modal.style.display === 'block') {
                cerrarModal();
            }
        });

        // Inicialización al cargar la página
        document.addEventListener('DOMContentLoaded', () => {
            crearFrutasFlotantes('frutas-container', 20);
            crearFrutasFlotantes('frutas-container-hero', 15);
            actualizarContadorCarrito();
        });
    </script>
</body>

</html>