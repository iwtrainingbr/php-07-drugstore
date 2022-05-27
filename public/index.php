<?php

ini_set('display_errors', 1);

include '../vendor/autoload.php';

use App\Controller\CategoryController;
use App\Controller\ProductController;
use App\Controller\ErrorController;
use App\Controller\IndexController;
use App\Controller\UserController;

$url = explode('?', $_SERVER['REQUEST_URI'])[0];

match($url) {
    '/' => (new IndexController)->home(),
    '/categorias' => (new CategoryController())->list(),
    '/categorias/pdf' => (new CategoryController())->pdf(),
    '/listar-produtos' => (new ProductController())->list(),
    '/produtos/excluir' => (new ProductController())->remove(),
    '/listar-usuarios' => (new UserController)->list(),
    '/novo-categoria' => (new CategoryController())->add(),
    '/novo-produto' => (new ProductController())->add(),
    '/usuarios/novo' => (new UserController())->add(),
    default => (new ErrorController())->notFound(),
};
