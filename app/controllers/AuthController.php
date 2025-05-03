<?php
require_once '../app/models/User.php';
require_once '../config/config.php';

class AuthController {

  // Função de cadastro
  public function register() {
    if (session_status() === PHP_SESSION_NONE) session_start();

    $errors = [];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $username = trim($_POST['username']);
      $email = trim($_POST['email']);
      $password = $_POST['password'];
      $confirm_password = $_POST['confirm_password'];

      // Validações
      if (empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
        $errors[] = "Preencha todos os campos!";
      } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "E-mail inválido!";
      } elseif ($password !== $confirm_password) {
        $errors[] = "As senhas não coincidem!";
      }

      $userModel = new User($GLOBALS['pdo']);

      if ($userModel->emailExists($email)) {
        $errors[] = "Esse e-mail já está cadastrado!";
      }

      // Se passou todas as validações
      if (empty($errors)) {
        $success = $userModel->create($username, $email, $password);
        if ($success) {
          header("Location: /dedohub/public/?url=auth/login");
          exit;
        } else {
          $errors[] = "Erro ao cadastrar!";
        }
      }
    }

    require_once '../app/views/auth/register.php';
  }

  // Função de login
  public function login() {
    if (session_status() === PHP_SESSION_NONE) session_start();

    $errors = [];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $email = trim($_POST['email']);
      $password = $_POST['password'];

      // Validação
      if (empty($email) || empty($password)) {
        $errors[] = "Preencha todos os campos!";
      } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "E-mail inválido!";
      }

      if (empty($errors)) {
        $userModel = new User($GLOBALS['pdo']);
        $user = $userModel->login($email, $password);

        if ($user) {
          $_SESSION['user_id'] = $user['id'];
          $_SESSION['username'] = $user['username'];
          header("Location: /dedohub/public");
          exit;
        } else {
          $errors[] = "E-mail ou senha incorretos!";
        }
      }
    }

    require_once '../app/views/auth/login.php';
  }
  public function logout() {
    session_start();
    session_unset();
    session_destroy();
  
    header("Location: /dedohub/public/?url=auth/login");
    exit;
  }
  
}
