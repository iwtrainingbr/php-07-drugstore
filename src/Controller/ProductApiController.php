<?php

declare(strict_types=1);

namespace App\Controller;

use App\Connection\Connection;
use App\Model\Product;

class ProductApiController
{
  public function getAll(): void
  {
    header('Content-Type: application/json');

    $con = Connection::open();

    $products = $con->getRepository(Product::class)->findAll();

    echo json_encode($products);
  }
}
