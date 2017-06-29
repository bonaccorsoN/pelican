<?php

use Symfony\Component\Debug\ErrorHandler;
use Symfony\Component\Debug\ExceptionHandler;

// Register global error and exception handlers
ErrorHandler::register();
ExceptionHandler::register();

// Register service providers.
$app->register(new Silex\Provider\DoctrineServiceProvider());
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../views',
));
$app->register(new Silex\Provider\AssetServiceProvider(), array(
    'assets.version' => 'v1'
));

// Register services.
$app['dao.pays'] = function ($app) {
    return new landingSILEX\DAO\PaysDAO($app['db']);
};
$app['dao.paysNew'] = function ($app) {
    return new landingSILEX\DAO\PaysNewDAO($app['db']);
};
$app['dao.budget'] = function ($app) {
    return new landingSILEX\DAO\BudgetDAO($app['db']);
};
$app['dao.destination'] = function ($app) {
    return new landingSILEX\DAO\DestinationDAO($app['db']);
};
$app['dao.ville'] = function ($app) {
    return new landingSILEX\DAO\VilleDAO($app['db']);
};
$app['dao.user'] = function ($app) {
    return new landingSILEX\DAO\UserDAO($app['db']);
};