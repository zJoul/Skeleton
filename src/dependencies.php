<?php

use League\Container\Container;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

$container = new Container();

// PSR - HTTP
$container->share('response', Zend\Diactoros\Response::class);
$container->share('request', function () {
    return Zend\Diactoros\ServerRequestFactory::fromGlobals(
        $_SERVER, $_GET, $_POST, $_COOKIE, $_FILES
    );
});
$container->share('emitter', Zend\Diactoros\Response\SapiEmitter::class);

// Logger
$container->add('logger', function () {
    $logger = new Logger('app');
    $logger->pushHandler(new StreamHandler(__DIR__ . getenv('LOG')));

    return $logger;
});
$container->add('error-logger', function () {
    $logger = new Logger('app-error');
    $logger->pushHandler(new StreamHandler(__DIR__ . getenv('LOG_ERROR')));

    return $logger;
});

// Views
$container->add('view', function () {
    $templates = new League\Plates\Engine();

    $templates->addFolder('web', __DIR__ . '/templates/views/');
    $templates->addFolder('emails', __DIR__ . '/templates/emails/');

    // Extension
    //$templates->loadExtension(new League\Plates\Extension\Asset('/path/to/public'));
    //$templates->loadExtension(new League\Plates\Extension\URI($_SERVER['PATH_INFO']));

    return $templates;
});

return $container;