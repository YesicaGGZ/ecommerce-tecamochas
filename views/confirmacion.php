<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$total = $_GET['total'] ?? 0;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>¡Compra Exitosa! - Tecamochas 🍓</title>
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
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Comic Neue', cursive;
            padding: 1rem;
            position: relative;
            overflow-x: hidden;
        }
        
        /* Frutas flotantes de fondo */
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
                opacity: 0.3;
            }
            90% {
                opacity: 0.3;
            }
            100% {
                transform: translateY(-20vh) rotate(360deg);
                opacity: 0;
            }
        }
        
        .confirm-card {
            background: #fffef7;
            border-radius: 40px;
            padding: 2.5rem;
            text-align: center;
            max-width: 550px;
            width: 100%;
            position: relative;
            z-index: 10;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            border: 2px solid #fde2e4;
            animation: fadeInUp 0.6s ease-out;
        }
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        /* Icono de éxito animado */
        .success-icon {
            width: 100px;
            height: 100px;
            background: linear-gradient(135deg, #10b981, #059669);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            animation: pulse 0.8s ease-out;
            box-shadow: 0 10px 25px -5px rgba(16, 185, 129, 0.3);
        }
        
        @keyframes pulse {
            0% {
                transform: scale(0);
                opacity: 0;
            }
            50% {
                transform: scale(1.1);
            }
            100% {
                transform: scale(1);
                opacity: 1;
            }
        }
        
        .success-icon i {
            font-size: 3.5rem;
            color: white;
        }
        
        h1 {
            font-family: 'DynaPuff', cursive;
            color: #db2777;
            font-size: 2rem;
            margin-bottom: 0.5rem;
        }
        
        .lead {
            color: #4a5568;
            font-size: 1.1rem;
            margin-bottom: 1.5rem;
        }
        
        .total-box {
            background: linear-gradient(135deg, #fce7f3, #fef3c7);
            border-radius: 20px;
            padding: 1rem;
            margin: 1.5rem 0;
            border: 1px solid #fde2e4;
        }
        
        .total-label {
            color: #db2777;
            font-family: 'DynaPuff', cursive;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        .total-amount {
            font-size: 2.5rem;
            font-weight: bold;
            background: linear-gradient(135deg, #10b981, #059669);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            font-family: 'DynaPuff', cursive;
        }
        
        .info-message {
            background: #f0fdf4;
            border-radius: 15px;
            padding: 1rem;
            margin: 1rem 0;
            border-left: 4px solid #10b981;
            text-align: left;
        }
        
        .info-message p {
            margin: 0;
            color: #166534;
            font-size: 0.9rem;
        }
        
        .info-message i {
            color: #10b981;
            margin-right: 8px;
        }
        
        .btn-seguir {
            background: linear-gradient(135deg, #fbbf24, #f59e0b);
            color: white;
            padding: 12px 30px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: bold;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            border: none;
            font-size: 1rem;
            margin-top: 0.5rem;
        }
        
        .btn-seguir:hover {
            background: linear-gradient(135deg, #f59e0b, #ea580c);
            transform: scale(1.05);
            box-shadow: 0 10px 25px -5px rgba(245, 158, 11, 0.4);
            color: white;
        }
        
        .confetti {
            position: fixed;
            width: 10px;
            height: 10px;
            background: #f472b6;
            position: absolute;
            animation: confettiFall 3s linear forwards;
            z-index: 100;
        }
        
        @keyframes confettiFall {
            0% {
                transform: translateY(-100vh) rotate(0deg);
                opacity: 1;
            }
            100% {
                transform: translateY(100vh) rotate(360deg);
                opacity: 0;
            }
        }
        
        hr {
            border: none;
            height: 2px;
            background: linear-gradient(90deg, transparent, #fde2e4, transparent);
            margin: 1.5rem 0;
        }
        
        /* Emojis decorativos */
        .emoji-decoration {
            position: absolute;
            font-size: 2rem;
            opacity: 0.6;
        }
        
        .emoji-1 {
            top: 10%;
            left: 5%;
            animation: bounce 3s ease-in-out infinite;
        }
        
        .emoji-2 {
            bottom: 15%;
            right: 8%;
            animation: bounce 2.5s ease-in-out infinite reverse;
        }
        
        .emoji-3 {
            top: 20%;
            right: 12%;
            animation: bounce 3.5s ease-in-out infinite;
        }
        
        @keyframes bounce {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-15px);
            }
        }
        
        @media (max-width: 768px) {
            .confirm-card {
                padding: 1.5rem;
            }
            
            h1 {
                font-size: 1.5rem;
            }
            
            .total-amount {
                font-size: 2rem;
            }
            
            .success-icon {
                width: 70px;
                height: 70px;
            }
            
            .success-icon i {
                font-size: 2.5rem;
            }
            
            .emoji-decoration {
                display: none;
            }
        }
    </style>
</head>
<body>
    <!-- Frutas flotantes de fondo -->
    <div id="frutas-container"></div>
    
    <!-- Emojis decorativos -->
    <div class="emoji-decoration emoji-1">🍓</div>
    <div class="emoji-decoration emoji-2">🥭</div>
    <div class="emoji-decoration emoji-3">🍍</div>
    
    <div class="container">
        <div class="confirm-card mx-auto">
            <div class="success-icon">
                <i class="bi bi-check-lg"></i>
            </div>
            
            <h1>¡Gracias por tu compra! 🎉</h1>
            <p class="lead">Tu pedido ha sido confirmado exitosamente</p>
            
            <div class="total-box">
                <div class="total-label">Total pagado</div>
                <div class="total-amount">$<?php echo number_format($total, 2); ?></div>
            </div>
            
            <div class="info-message">
                <p class="mt-2"><i class="bi bi-envelope-fill"></i> Te enviaremos un correo con los detalles de tu pedido</p>
                <p class="mt-2"><i class="bi bi-clock-fill"></i> Tiempo estimado de entrega: 30-45 minutos</p>
            </div>
            
            <hr>
            
            <a href="index.php" class="btn-seguir">
                <i class="bi bi-shop"></i> Seguir comprando
            </a>
            
            <p class="mt-4 text-muted small">
                <i class="bi bi-heart-fill text-pink-500"></i> ¡Disfruta tu Tecamocha!
            </p>
        </div>
    </div>
    
    <script>
        // Generar frutas flotantes aleatorias
        function crearFrutasFlotantes() {
            const container = document.getElementById('frutas-container');
            if (!container) return;
            
            const frutas = ['🍓', '🍌', '🥭', '🍍', '🍊', '🍎', '🍉', '🥝', '🍒', '🍑', '🍋'];
            
            for (let i = 0; i < 25; i++) {
                const fruta = document.createElement('div');
                fruta.className = 'floating-fruit';
                fruta.textContent = frutas[Math.floor(Math.random() * frutas.length)];
                
                const size = Math.random() * 2 + 0.8;
                const left = Math.random() * 100;
                const duration = Math.random() * 8 + 4;
                const delay = Math.random() * 10;
                const rotation = Math.random() * 360;
                
                fruta.style.cssText = `
                    left: ${left}%;
                    font-size: ${size}rem;
                    animation-duration: ${duration}s;
                    animation-delay: -${delay}s;
                    transform: rotate(${rotation}deg);
                    opacity: ${Math.random() * 0.4 + 0.1};
                `;
                
                container.appendChild(fruta);
            }
        }
        
        // Generar confeti
        function crearConfeti() {
            const colors = ['#f472b6', '#fbbf24', '#10b981', '#60a5fa', '#fb7185'];
            
            for (let i = 0; i < 100; i++) {
                const confetti = document.createElement('div');
                confetti.className = 'confetti';
                confetti.style.left = Math.random() * 100 + '%';
                confetti.style.width = Math.random() * 8 + 4 + 'px';
                confetti.style.height = Math.random() * 8 + 4 + 'px';
                confetti.style.background = colors[Math.floor(Math.random() * colors.length)];
                confetti.style.animationDelay = Math.random() * 2 + 's';
                confetti.style.animationDuration = Math.random() * 2 + 2 + 's';
                document.body.appendChild(confetti);
                
                // Eliminar confeti después de la animación
                setTimeout(() => {
                    confetti.remove();
                }, 4000);
            }
        }
        
        // Inicializar al cargar la página
        document.addEventListener('DOMContentLoaded', () => {
            crearFrutasFlotantes();
            crearConfeti();
        });
    </script>
</body>
</html>