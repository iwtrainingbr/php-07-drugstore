<?php

declare(strict_types=1);

namespace App\Controller;

use App\Connection\Connection;
use App\Model\User;

class AuthController extends AbstractController
{
  public function login(): void
  {
    if ($_POST) {
      $email = $_POST['email'];
      $password = $_POST['password'];

      $repository = Connection::open()->getRepository(User::class);
      $user = $repository->findOneBy([
        'email' => $email,
      ]);

      if (!$user) {
        die('Usuario nao encontrado');
      }

      if ($user->getStatus() === false) {
        die('Usuario bloqueado');
      }

      if (false === password_verify($password, $user->getPassword())) {
        die('Senha incorreta');
      }

      $_SESSION['user'] = [
        'id' => $user->getId(),
        'name' => $user->getName(),
        'email' => $user->getEmail(),
      ];

      header('location: /');
    }

    $this->render('auth/login');
  }

  public function logout(): void
  {
    session_destroy();
    header('location: /login');
  }
}
