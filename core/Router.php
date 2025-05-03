<?php

class Router {
  public function run() {
    // Pega a URL a partir do GET ou define 'home/index' como padrão
    $url = $_GET['url'] ?? 'home/index';

    // Separa query string (ex: view&id=3) da rota
    $urlParts = explode('?', $url);
    $route = explode('/', rtrim($urlParts[0], '/'));

    // Define nome do controller e método
    $controllerName = ucfirst($route[0]) . 'Controller'; // ex: UserController
    $method = $route[1] ?? 'index';

    // Caminho do controller
    $controllerFile = '../app/controllers/' . $controllerName . '.php';

    if (file_exists($controllerFile)) {
      require_once $controllerFile;
      $controller = new $controllerName();

      if (method_exists($controller, $method)) {
        // Chama o método sem passar os parâmetros diretamente
        // Os métodos devem usar $_GET internamente se precisarem de parâmetros
        $controller->$method();
      } else {
        echo "Método '$method' não encontrado no controlador '$controllerName'.";
      }
    } else {
      echo "Controller '$controllerName' não encontrado!";
    }
  }
}
