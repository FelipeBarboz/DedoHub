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

  public function view() {
    if (!isset($_GET['id'])) {
        echo "ID do vídeo não especificado.";
        return;
    }

    $videoId = $_GET['id'];

    $pdo = $GLOBALS['pdo'];
    $stmt = $pdo->prepare("SELECT * FROM videos WHERE id = ?");
    $stmt->execute([$videoId]);
    $video = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$video) {
        echo "Vídeo não encontrado.";
        return;
    }

    require_once '../app/views/video/view.php';
  }

  public function handleUpload() {
    if (session_status() === PHP_SESSION_NONE) session_start();

    if (!isset($_SESSION['user_id'])) {
        header("Location: /dedohub/public/?url=auth/login");
        exit;
    }

    $userId = $_SESSION['user_id'];
    $title = $_POST['title'] ?? '';
    $description = $_POST['description'] ?? ''; // Novo campo

    // Diretórios de upload
    $videoUploadDir = 'uploads/videos/';
    $thumbnailUploadDir = 'uploads/thumbnails/';

    if (!is_dir($videoUploadDir)) {
        mkdir($videoUploadDir, 0755, true);
    }

    if (!is_dir($thumbnailUploadDir)) {
        mkdir($thumbnailUploadDir, 0755, true);
    }

    if (isset($_FILES['video']) && $_FILES['video']['error'] === UPLOAD_ERR_OK) {
        $videoTmpPath = $_FILES['video']['tmp_name'];
        $videoName = basename($_FILES['video']['name']);
        $videoPath = $videoUploadDir . uniqid() . '_' . $videoName;

        if (move_uploaded_file($videoTmpPath, $videoPath)) {
            // Processa a thumbnail
            $thumbnailPath = 'default-thumbnail.jpg';
            if (isset($_FILES['thumbnail']) && $_FILES['thumbnail']['error'] === UPLOAD_ERR_OK) {
                $thumbnailTmpPath = $_FILES['thumbnail']['tmp_name'];
                $thumbnailName = basename($_FILES['thumbnail']['name']);
                $thumbnailPath = $thumbnailUploadDir . uniqid() . '_' . $thumbnailName;
                move_uploaded_file($thumbnailTmpPath, $thumbnailPath);
            }

            // Insere no banco de dados
            $pdo = $GLOBALS['pdo'];
            $stmt = $pdo->prepare("INSERT INTO videos (user_id, title, filename, thumbnail, description) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$userId, $title, $videoPath, $thumbnailPath, $description]);

            $videoId = $pdo->lastInsertId();
            header("Location: /dedohub/public/?url=user/view&id=$videoId");
            exit;

        } else {
            echo "<p class='text-red-400 text-center mt-8'>Erro ao mover o vídeo.</p>";
        }
    } else {
        echo "<p class='text-red-400 text-center mt-8'>Erro no upload. Tente novamente.</p>";
    }
  }
} 