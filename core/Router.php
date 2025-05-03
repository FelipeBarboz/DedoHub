<?php

class Router {
  public function run() {
    $url = $_GET['url'] ?? 'home/index';
    $url = explode('/', rtrim($url, '/'));

    $controllerName = ucfirst($url[0]) . 'Controller';
    $method = $url[1] ?? 'index';

    $controllerFile = '../app/controllers/' . $controllerName . '.php';

    if (file_exists($controllerFile)) {
      require_once $controllerFile;
      $controller = new $controllerName();

      if (method_exists($controller, $method)) {
        $controller->$method();
      } else {
        echo "Método não encontrado!";
      }
    } else {
      echo "Controller não encontrado!";
    }
  }
}
