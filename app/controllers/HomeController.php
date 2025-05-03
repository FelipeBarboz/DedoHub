<?php
require_once '../app/models/Video.php';
require_once '../config/config.php';

class HomeController {
  public function index() {
    $videoModel = new Video($GLOBALS['pdo']);
    $videos = $videoModel->getAll();  // Obtendo todos os vídeos

    require_once '../app/views/home/index.php';  // Passando os vídeos para a view
  }
}
