<?php

declare(strict_types=1);

namespace App\Controller;

use App\Connection\Connection;
use App\Model\User;

class UserController extends AbstractController
{
    public function add(): void
    {
        if ($_POST) {
          $user = new User();
          $user->setName($_POST['user-name']);
          $user->setEmail($_POST['user-email']);
          $user->setPassword(
            password_hash($_POST['user-password'], PASSWORD_ARGON2I)
          );
          $user->setStatus(true);

          $con = Connection::open();

          $con->persist($user); // insert
          $con->flush(); //confirmar

          header('location: /listar-usuarios');
          return;
        }

        parent::render('/user/add');
    }

    public function list(): void
    {
        $con = Connection::open();

        // $repository = $con->getRepository(User::class);
        // $data = $repository->findAll();
        $data = $con->getRepository(User::class)->findAll();

        parent::render('/user/list', $data);
    }

    public function disable(): void
    {
      $id = $_GET['id'];

      $con = Connection::open();

      $user = $con->getRepository(User::class)->find($id);
      $user->setStatus(false);

      $con->persist($user); //UPDATE
      $con->flush();

      header('location: /listar-usuarios');
    }

    public function enable(): void
    {
      $id = $_GET['id'];

      $con = Connection::open();

      $user = $con->getRepository(User::class)->find($id);
      $user->setStatus(true);

      $con->persist($user); //UPDATE
      $con->flush();

      header('location: /listar-usuarios');
    }
}
