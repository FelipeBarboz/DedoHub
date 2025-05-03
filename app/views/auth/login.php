<?php include '../app/views/layouts/header.php'; ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Login - Dedohub</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white">
  <div class="min-h-screen flex items-center justify-center">
    <form action="" method="POST" class="bg-gray-800 p-8 rounded-xl shadow-lg w-full max-w-md">
      <h2 class="text-2xl font-bold mb-6 text-center">Entrar no Dedohub</h2>

      <?php if (!empty($errors)): ?>
        <div class="bg-red-600 text-white p-3 rounded mb-4">
          <?php foreach ($errors as $error): ?>
            <p><?= htmlspecialchars($error) ?></p>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>

      <label class="block mb-2 font-medium">E-mail</label>
      <input type="email" name="email" class="w-full p-2 mb-4 bg-gray-700 rounded" required>

      <label class="block mb-2 font-medium">Senha</label>
      <input type="password" name="password" class="w-full p-2 mb-4 bg-gray-700 rounded" required>

      <button type="submit" class="bg-purple-600 hover:bg-purple-700 w-full py-2 rounded font-bold transition-all">
        Entrar
      </button>
    </form>
  </div>

</body>
</html>
