<?php

declare(strict_types=1);

use App\Actions\HomeAction;
use App\Actions\ViewedProductsAction;
use Slim\App;

return static function (App $app) {
    $app->get('/', HomeAction::class);
    $app->get('/api/get-viewed-products', ViewedProductsAction::class);
};
