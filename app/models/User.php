<?php

class User {
  private $pdo;

  public function __construct($pdo) {
    $this->pdo = $pdo;
  }

  public function create($username, $email, $password) {
    $sql = "INSERT INTO users (username, email, password) VALUES (:username, :email, :password)";
    $stmt = $this->pdo->prepare($sql);
    return $stmt->execute([
      ':username' => $username,
      ':email' => $email,
      ':password' => password_hash($password, PASSWORD_DEFAULT)
    ]);
  }

  public function emailExists($email) {
    $sql = "SELECT * FROM users WHERE email = :email";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([':email' => $email]);
    return $stmt->fetch() !== false;
  }

  // Função de login agora está dentro da classe User
  public function login($email, $password) {
    $sql = "SELECT * FROM users WHERE email = :email";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([':email' => $email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
      return $user; // Retorna os dados do usuário
    }

    return false; // Senha ou e-mail incorretos
  }
}


