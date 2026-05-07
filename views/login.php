<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Tecamochas - Iniciar Sesión</title>
    <link href="https://fonts.googleapis.com/css2?family=Comic+Neue&family=DynaPuff&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { background-color: #fffbe7; font-family: 'Comic Neue', cursive; }
        .teca-card { background: white; border: 3px dashed #ff9ec6; border-radius: 30px; }
        .teca-btn { background: linear-gradient(135deg, #ff7bac, #ff758c); font-family: 'DynaPuff', cursive; }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4">
    <div class="teca-card w-full max-w-md p-8 shadow-2xl">
        <div class="text-center mb-6">
            <img src="img/logo.png" class="h-20 mx-auto mb-4" alt="Tecamochas">
            <h2 class="dynapuff text-3xl text-pink-500">¡Bienvenido!</h2>
            <p class="text-gray-500 text-sm">Entra y rescata tu fruta 🍓</p>
        </div>
        <form action="index.php?accion=login" method="POST" class="space-y-5">
            <input type="email" name="email" placeholder="Tu correo" required class="w-full px-4 py-2 rounded-xl border-2 border-pink-100 outline-none focus:border-pink-400 transition">
            <input type="password" name="password" placeholder="Tu contraseña" required class="w-full px-4 py-2 rounded-xl border-2 border-pink-100 outline-none focus:border-pink-400 transition">
            <button type="submit" class="teca-btn w-full text-white py-3 rounded-full font-bold shadow-lg hover:scale-105 transition">Entrar al catálogo 🍍</button>
        </form>
        <div class="text-center mt-6">
            <p class="text-sm">¿No tienes cuenta? <a href="index.php?accion=registro" class="text-blue-500 font-bold">Regístrate aquí</a></p>
        </div>
    </div>
</body>
</html>