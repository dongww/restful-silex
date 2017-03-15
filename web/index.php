<?php
use Dongww\Rest\Http\Request;
use SilexRestful\Rest\Application;

require_once __DIR__ . '/../vendor/autoload.php';

$app = new Application();
$app['debug'] = false;

require_once __DIR__ . '/../config/main.php';

$app->run(Request::createFromGlobals());