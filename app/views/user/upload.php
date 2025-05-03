<?php if (session_status() === PHP_SESSION_NONE) session_start(); ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Upload de Vídeo</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white min-h-screen">
  <?php include '../app/views/layouts/header.php'; ?>

  <main class="p-8 max-w-xl mx-auto mt-12 bg-gray-800 rounded-lg shadow">
    <h1 class="text-2xl font-bold mb-4">Enviar novo vídeo</h1>

    <form action="/dedohub/public/?url=user/handleUpload" method="post" enctype="multipart/form-data" class="space-y-4">
      <div>
        <label class="block text-sm font-medium mb-1">Título do vídeo:</label>
        <input type="text" name="title" required class="w-full px-3 py-2 rounded bg-gray-700 border border-gray-600 focus:outline-none focus:ring focus:ring-purple-500">
      </div>

      <div class="mb-4">
        <label for="description" class="block mb-1 font-semibold">Descrição</label>
        <textarea id="description" name="description" rows="4" class="w-full p-2 bg-gray-700 rounded text-white"></textarea>
      </div>

      <div>
        <label class="block text-sm font-medium mb-1">Arquivo do vídeo:</label>
        <input type="file" name="video" accept="video/*" required class="w-full">
      </div>

      <div>
        <label class="block text-sm font-medium mb-1">Thumbnail (opcional):</label>
        <input type="file" name="thumbnail" accept="image/*" class="w-full">
      </div>

      <button type="submit" class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded">Enviar</button>
    </form>
  </main>
</body>
</html>
