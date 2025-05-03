<?php if (session_status() === PHP_SESSION_NONE) session_start(); ?>
<header class="bg-gray-800 text-white py-4 px-6 flex justify-between items-center shadow-md">
  <a href="/dedohub/public" class="text-2xl font-bold hover:text-purple-400 transition">Dedohub</a>

  <nav class="flex items-center space-x-4">
    <?php if (isset($_SESSION['user_id'])): ?>
      <a href="/dedohub/public/?url=user/dashboard" class="hover:text-purple-400 transition">
        Perfil (<?= htmlspecialchars($_SESSION['username']) ?>)
      </a>
      <form action="/dedohub/public/?url=auth/logout" method="post">
        <button type="submit" class="hover:text-purple-400 transition inline-block">Logout</button>
      </form>
    <?php else: ?>
      <a href="/dedohub/public/?url=auth/login" class="hover:text-purple-400 transition">Login</a>
      <a href="/dedohub/public/?url=auth/register" class="hover:text-purple-400 transition">Register</a>
    <?php endif; ?>
  </nav>
</header>
