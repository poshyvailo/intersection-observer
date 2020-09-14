<?php

declare(strict_types=1);

namespace App\Actions;

use App\Entity\Product;
use Exception;
use Psr\Http\Message\ResponseInterface as Response;

class ViewedProductsAction extends Action
{

    /**
     * @return Response
     * @throws Exception
     */
    protected function action(): Response
    {
        $products = [];

        for($i = 0; $i < 12; $i++) {
            $products[] = Product::getRandomProduct();
        }

        \sleep($this->getQueryParam('sleep', 0)->asInt());

        return $this->asJson($products);
    }
}
