<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

require_once '../app/controllers/HomeController.php'; 
require_once '../app/controllers/AuthController.php';
require_once '../app/controllers/UserController.php';

$url = isset($_GET['url']) ? $_GET['url'] : 'home/index';
$urlParts = explode('/', $url);
$controllerName = ucfirst($urlParts[0]) . 'Controller';
$method = $urlParts[1] ?? 'index';

$controller = null;

switch ($controllerName) {
  case 'AuthController':
    $controller = new AuthController();
    break;
  case 'UserController':
    $controller = new UserController();
    break;
  case 'HomeController':
    $controller = new HomeController();
    break;
  default:
    $controller = new HomeController(); // define como padrão
    $controller->index();
    exit;
}

// Verifica se o método existe no controller
if ($controller && method_exists($controller, $method)) {
  $controller->$method();
} else {
  echo "Página não encontrada!";
}
