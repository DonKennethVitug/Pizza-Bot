<?php
// DIC configuration

use bot\Config;
use bot\Services\RedbeanFactory;
use bot\Controllers\ErrorController;

$container = $app->getContainer();


$container['errorHandler'] = function ($c) {
    return new ErrorController(true);
};

// monolog
$container['logger'] = function ($c) {
    $settings = $c->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], Monolog\Logger::DEBUG));
    return $logger;
};

$container['RedbeanFactory'] = function ($c) {
    $settings = $c->get('settings')['database-development'];
    return new RedbeanFactory($settings['DSN'], $settings['USERNAME'], $settings['PASSWORD']);
};
