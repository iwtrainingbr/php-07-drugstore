<?php

namespace App\Controller;

use App\Security\UserSecurity;

abstract class AbstractController
{
    public function render(string $viewName, array $data = []): void
    {
        include '../views/_templates/head.phtml';

        $user = UserSecurity::getUser();
        if ($user) {
          include '../views/_templates/navbar.phtml';
        }

        include "../views/{$viewName}.phtml";
        include '../views/_templates/footer.phtml';
    }
}
