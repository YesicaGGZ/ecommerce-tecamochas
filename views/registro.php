<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Tecamochas - Crear Cuenta</title>
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
            <h2 class="dynapuff text-3xl text-pink-500">¡Regístrate! ✨</h2>
            <p class="text-gray-500 text-sm">Únete a Tecamochas y pide tu fruta</p>
        </div>

        <form action="index.php?accion=registro" method="POST" class="space-y-4">
            <div>
                <label class="block text-sm font-bold text-gray-700">Nombre</label>
                <input type="text" name="nombre" required class="w-full px-4 py-2 rounded-xl border-2 border-pink-100 focus:border-pink-400 outline-none">
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700">Email</label>
                <input type="email" name="email" required class="w-full px-4 py-2 rounded-xl border-2 border-pink-100 focus:border-pink-400 outline-none">
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700">Contraseña</label>
                <input type="password" name="password" required class="w-full px-4 py-2 rounded-xl border-2 border-pink-100 focus:border-pink-400 outline-none">
            </div>
            <button type="submit" class="teca-btn w-full text-white py-3 rounded-full font-bold shadow-lg hover:scale-105 transition-transform">
                Crear mi cuenta 🍓
            </button>
        </form>

        <div class="text-center mt-6">
            <p class="text-sm text-gray-600">¿Ya tienes cuenta? <a href="index.php?accion=login" class="text-blue-500 font-bold">Inicia sesión</a></p>
        </div>
    </div>
</body>
</html>