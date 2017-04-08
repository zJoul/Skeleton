<?php

use League\BooBoo\Formatter\HtmlTableFormatter;
use League\BooBoo\Handler\LogHandler;
use Noodlehaus\Config;

require __DIR__ . '/../../vendor/autoload.php';

// Chargement des variables d'environnement
$dotenv = new \Dotenv\Dotenv(__DIR__ . '/../');
$dotenv->load();

// Chargement de la configuration
$config = new Config(__DIR__ . '/../config/');

// Dépendences
$container = require __DIR__ . '/../dependencies.php';

// Debug mode
if ($config->get('debug')) {
    error_reporting(E_ERROR);

    $runner = new League\BooBoo\Runner();
    $runner->pushFormatter(new HtmlTableFormatter);
    $runner->pushHandler(new LogHandler($container->get('logger')));
    $runner->register(); // Registers the handlers
}

// Routes
$route = require __DIR__ . '/../routes.php';

$response = $route->dispatch($container->get('request'), $container->get('response'));
$container->get('emitter')->emit($response);