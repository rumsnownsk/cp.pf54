<?php
define("HOST", $_SERVER['HTTP_HOST']);
define("ROOT", dirname(__DIR__));

$dotenv = Dotenv\Dotenv::createImmutable(ROOT);
$dotenv->safeLoad();

define("APP_DEBUG", (bool)$_ENV['APP_DEBUG']);

//dd(gettype(APP_DEBUG));
if (APP_DEBUG === true) {
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
}

if (PHP_MAJOR_VERSION < 8){
    die("Require PHP version >= 8");
}

const WWW = ROOT.'/public';
const CONFIG = ROOT.'/config';
const HELPERS = ROOT.'/helpers';

const APP = ROOT.'/app';
const CORE = ROOT.'/core';
const VIEWS = APP.'/Views';
const ERROR_LOGS = ROOT.'/tmp/errors.log';
const CACHE =ROOT.'/tmp/cache';
const LAYOUT = 'default';
const IMAGES = WWW.'/images';

const DB_SETTINGS = [
    'options' => [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]
];

const PAGINATION_SETTINGS = [
    'perPage' => 12,
    'midSize' => 1,
    'maxPages' => 7,
    'tpl' => 'pagination/base'
];

$whoops = new \Whoops\Run;
if (APP_DEBUG) {
    $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler())->register();
} else {
    $whoops->pushHandler(new \Whoops\Handler\CallbackHandler(function (Throwable $e){
        error_log(
            PHP_EOL."______ [" . date('Y-m-d H:i:s'). "]______"
            . PHP_EOL."  Error: {$e->getMessage()};"
            . PHP_EOL."  File: {$e->getFile()};"
            . PHP_EOL. "  Line: {$e->getLine()};",3, ERROR_LOGS);
        abort('Some error', 500);
    }))->register();
}
$whoops->register();