<?php

declare(strict_types=1);

namespace App\Actions;

use App\Entity\Product;
use Psr\Http\Message\ResponseInterface as Response;
use Throwable;

class HomeAction extends Action
{
    /**
     * @return Response
     * @throws Throwable
     */
    protected function action(): Response
    {
        $productsCount = 36;

        $products = [];
        for ($i = 0; $i < $productsCount; $i++) {
            $products[] = Product::getRandomProduct();
        }

        return $this->render('index', ['products' => $products]);
    }
}
