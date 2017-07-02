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
$app->register(new Silex\Provider\SwiftmailerServiceProvider());

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
$app['dao.cityIndice'] = function ($app) {
    return new landingSILEX\DAO\CityIndiceDAO($app['db']);
};

$app['swiftmailer.options'] = array(
    'host' => 'smtp.sendgrid.net',
    'port' => '465',
    'username' => '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',
    'password' => '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',
    'encryption' => 'ssl',
    'auth_mode' => 'login'
);