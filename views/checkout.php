<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Pago Seguro - Tecamochas</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Comic+Neue&family=DynaPuff&display=swap" rel="stylesheet">
    <style>body { background-color: #fffbe7; font-family: 'Comic Neue', cursive; }</style>
</head>
<body class="min-h-screen flex items-center justify-center p-4">
    <div class="bg-white border-3 border-dashed border-pink-400 p-8 rounded-3xl shadow-xl w-full max-w-md">
        <h2 class="text-center text-pink-500 text-3xl font-bold mb-6" style="font-family: 'DynaPuff';">Finalizar Pedido 🍓</h2>
        <form action="index.php?accion=procesar_pago" method="POST" class="space-y-4">
            <div>
                <label class="block text-sm font-bold text-gray-700">Tarjeta (Prueba)</label>
                <input type="text" name="tarjeta" placeholder="1234567812345678" required class="w-full p-3 border-2 border-pink-100 rounded-xl focus:border-pink-500 outline-none">
            </div>
            <div class="flex gap-4">
                <div class="w-1/2">
                    <label class="block text-sm font-bold text-gray-700">CVV</label>
                    <input type="text" name="cvv" placeholder="123" required class="w-full p-3 border-2 border-pink-100 rounded-xl outline-none">
                </div>
                <div class="w-1/2 text-right">
                    <p class="text-gray-500 text-sm">Total</p>
                    <p class="text-2xl font-bold text-blue-600">$<?php echo number_format($total, 2); ?></p>
                </div>
            </div>
            <button type="submit" class="w-full bg-pink-500 text-white py-4 rounded-full font-bold text-xl shadow-lg hover:scale-105 transition-transform">¡Pagar Ahora! 💳</button>
        </form>
    </div>
</body>
</html>