<?php

use DI\ContainerBuilder;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../app/constants.php';

$containerBuilder = new ContainerBuilder();

// Set up view
$dependencies = require __DIR__ . '/../app/view.php';
$dependencies($containerBuilder);

$faker = Faker\Factory::create();

$container = $containerBuilder->build();

$app = AppFactory::createFromContainer($container);

// Register routes
$routes = require dirname(__DIR__) . '/app/routes.php';
$routes($app);

$app->run();
