<?php if (session_status() === PHP_SESSION_NONE) session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>  
</head>

<?php include '../app/views/layouts/header.php'; ?>

<body class="bg-gray-900 text-white">
<main class="max-w-4xl mx-auto mt-10 p-6 bg-gray-900 text-white rounded shadow">
  <h1 class="text-2xl font-bold mb-6">Bem-vindo, <?= htmlspecialchars($_SESSION['username']) ?> 👋</h1>

  <p class="mb-4">Aqui é sua base secreta dos vídeos dedilhísticos. Em breve, você poderá subir seus vídeos aqui.</p>

  <a href="/dedohub/public/?url=user/upload" class="bg-purple-600 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded transition">
    Enviar novo vídeo
  </a>
</main>    
</body>
</html>
