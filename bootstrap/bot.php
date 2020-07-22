<?php
/**
 * Giga AI - Rapid Messenger Bot Framework
 *
 * @package  GigaAI
 * @author   GigaAI <hello@giga.ai>
 */
/*
|--------------------------------------------------------------------------
| Register The Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader for
| our application. We just need to utilize it! We'll simply require it
| into the script here so that we don't have to worry about manual
| loading any of our classes later on. It feels nice to relax.
|
*/

require __DIR__ . '/../vendor/autoload.php';

/*
|--------------------------------------------------------------------------
| Load The Configuration
|--------------------------------------------------------------------------
|
*/

GigaAI\Core\Config::loadFromFile(__DIR__ . '/../config.php');

/*
|--------------------------------------------------------------------------
| Bootstrap Your Bot
|--------------------------------------------------------------------------
|
*/

$bot = new GigaAI\MessengerBot;

/*
|--------------------------------------------------------------------------
| Bot Is Ready With You
|--------------------------------------------------------------------------
|
*/
return $bot;