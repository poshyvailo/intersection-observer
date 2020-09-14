<?php

declare(strict_types=1);

use DI\ContainerBuilder;
use Psr\Container\ContainerInterface;
use Slim\Views\PhpRenderer;

return static function (ContainerBuilder $containerBuilder) {
    $containerBuilder->addDefinitions([
        PhpRenderer::class => static function (ContainerInterface $c) {
            $view = new PhpRenderer(TEMPLATE_PATH, ['title' => 'Home']);
            $view->setLayout('layouts/layout.php');

            return $view;
        },
    ]);
};
