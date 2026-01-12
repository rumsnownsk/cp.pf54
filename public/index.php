<?php
require_once "../vendor/autoload.php";

require_once "../config/config.php";
require_once "../helpers/helpers.php";

$app = new \PHPFrw\Application();
require_once CONFIG.'/routes.php';

$app->run();