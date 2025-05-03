<?php
class Video {
  private $pdo;

  public function __construct($pdo) {
    $this->pdo = $pdo;
  }

  public function insert($userId, $title, $filename, $thumbnail) {
    $stmt = $this->pdo->prepare("INSERT INTO videos (user_id, title, filename, thumbnail) VALUES (?, ?, ?, ?)");
    return $stmt->execute([$userId, $title, $filename, $thumbnail]);
  }

  public function getAll() {
    $stmt = $this->pdo->prepare("SELECT * FROM videos ORDER BY created_at DESC");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function getByUser($userId) {
    $stmt = $this->pdo->prepare("SELECT * FROM videos WHERE user_id = ? ORDER BY created_at DESC");
    $stmt->execute([$userId]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
}

