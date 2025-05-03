<?php
require_once '../config/config.php';

class UserController {
  public function dashboard() {
    if (session_status() === PHP_SESSION_NONE) session_start();

    if (!isset($_SESSION['user_id'])) {
      header("Location: /dedohub/public/?url=auth/login");
      exit;
    }

    require_once '../app/views/user/dashboard.php';
  }

  public function upload() {
    if (session_status() === PHP_SESSION_NONE) session_start();

    if (!isset($_SESSION['user_id'])) {
      header("Location: /dedohub/public/?url=auth/login");
      exit;
    }

    require_once '../app/views/user/upload.php';
  }

  public function handleUpload() {
    if (session_status() === PHP_SESSION_NONE) session_start();
    
    if (!isset($_SESSION['user_id'])) {
      header("Location: /dedohub/public/?url=auth/login");
      exit;
    }
  
    $userId = $_SESSION['user_id'];
    $title = $_POST['title'] ?? '';
    
    // Diretórios de upload
    $videoUploadDir = 'uploads/videos/';
    $thumbnailUploadDir = 'uploads/thumbnails/';
    
    // Verifica se o diretório de vídeos existe
    if (!is_dir($videoUploadDir)) {
      mkdir($videoUploadDir, 0755, true);
    }
  
    // Verifica se o diretório de thumbnails existe
    if (!is_dir($thumbnailUploadDir)) {
      mkdir($thumbnailUploadDir, 0755, true);
    }
  
    // Processa o upload do vídeo
    if (isset($_FILES['video']) && $_FILES['video']['error'] === UPLOAD_ERR_OK) {
      $videoTmpPath = $_FILES['video']['tmp_name'];
      $videoName = basename($_FILES['video']['name']);
      $videoPath = $videoUploadDir . uniqid() . '_' . $videoName;
      
      if (move_uploaded_file($videoTmpPath, $videoPath)) {
        // Processa o upload da thumbnail (se fornecido)
        $thumbnailPath = null;
        if (isset($_FILES['thumbnail']) && $_FILES['thumbnail']['error'] === UPLOAD_ERR_OK) {
          $thumbnailTmpPath = $_FILES['thumbnail']['tmp_name'];
          $thumbnailName = basename($_FILES['thumbnail']['name']);
          $thumbnailPath = $thumbnailUploadDir . uniqid() . '_' . $thumbnailName;
          
          move_uploaded_file($thumbnailTmpPath, $thumbnailPath);
        } else {
          // Caso o thumbnail não seja enviado, define um padrão
          $thumbnailPath = 'default-thumbnail.jpg'; // Caminho para a imagem padrão
        }
  
        // Salva no banco de dados
        $pdo = $GLOBALS['pdo'];
        $stmt = $pdo->prepare("INSERT INTO videos (user_id, title, filename, thumbnail) VALUES (?, ?, ?, ?)");
        $stmt->execute([$userId, $title, $videoPath, $thumbnailPath]);
  
        echo "<p class='text-green-400 text-center mt-8'>Vídeo enviado com sucesso!</p>";
        echo "<p class='text-center'><a href='/dedohub/public/?url=user/dashboard' class='text-purple-400 underline'>Voltar à Dashboard</a></p>";
      } else {
        echo "<p class='text-red-400 text-center mt-8'>Erro ao mover o vídeo.</p>";
      }
    } else {
      echo "<p class='text-red-400 text-center mt-8'>Erro no upload. Tente novamente.</p>";
    }
  }  
  
}
