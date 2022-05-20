<?php

declare(strict_types=1);

namespace App\Controller;

use Dompdf\Dompdf;
use App\Model\Category;

class CategoryController extends AbstractController
{
    public function list(): void
    {
        // supondo que ta vindo do banco
        $categories = [];

        for ($i = 1; $i <= 20; $i++) {
          $cat = new Category('Categoria teste'.$i);
          $cat->setDescription('descrição teste');
          $cat->setId($i);

          $categories[] = $cat;
        }

        parent::render('category/list', [
          'categories' => $categories,
        ]);
    }

    public function pdf(): void
    {
      $dompdf = new Dompdf();

      $content = include '../views/category/pdf.phtml';

      $dompdf->loadHtml($content);

      $dompdf->render();
      $dompdf->stream();
    }

    public function add(): void
    {
        parent::render('category/add');
    }


}
