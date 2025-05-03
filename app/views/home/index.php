<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Home - Dedohub</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white min-h-screen">
  <?php include '../app/views/layouts/header.php'; ?>

  <main class="p-8 max-w-full mx-auto mt-12">
  <h1 class="text-4xl font-bold text-center mb-10">Bem-vindo ao Dedohub 🐵📹</h1>

    <!-- Container de vídeos, estilo horizontal -->
    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
      <?php foreach ($videos as $video): ?>
        <div class="video-box bg-gray-800 rounded-lg overflow-hidden shadow-lg">
          <a href="/dedohub/public/?url=video/view&id=<?= $video['id'] ?>" class="block">
            <!-- Thumbnail -->
            <a href="/dedohub/public/?url=user/view&id=<?= $video['id'] ?>">
              <img src="/dedohub/public/<?= $video['thumbnail'] ?>" alt="Thumbnail do vídeo" class="w-full h-48 object-cover">
            </a>
            <!-- Título -->
            <div class="p-4">
              <h2 class="text-lg font-semibold"><?= htmlspecialchars($video['title']) ?></h2>
            </div>
          </a>
        </div>
      <?php endforeach; ?>
    </div>
  </main>
</body>
</html>

