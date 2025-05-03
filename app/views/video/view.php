<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white min-h-screen">
    <?php include '../app/views/layouts/header.php'; ?>

    <main class="p-8 max-w-4xl mx-auto">
  <video class="w-full rounded-lg" controls>
    <source src="/dedohub/public/<?= htmlspecialchars($video['filename']) ?>" type="video/mp4">
    Seu navegador não suporta vídeos.
  </video>

  <h1 class="text-2xl font-bold mt-4"><?= $video['title'] ?></h1>
  <p class="text-gray-400"><?= $video['description'] ?></p>

  <div class="flex justify-between mt-4">
    <div>
      <button class="bg-blue-600 px-4 py-2 rounded-lg">👍 Like</button>
      <button class="bg-red-600 px-4 py-2 rounded-lg">👎 Dislike</button>
    </div>
    <button class="bg-gray-700 px-6 py-2 rounded-lg">🔔 Inscrever-se</button>
  </div>

  <section class="mt-8">
    <h2 class="text-xl font-semibold mb-2">Comentários</h2>
    <!-- Aqui você listaria e adicionaria comentários -->
  </section>
</main>
</body>
</html>