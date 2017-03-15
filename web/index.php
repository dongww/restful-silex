<?php
use Dongww\Rest\Http\Request;
use Dongww\Silex\RestApplication;

require_once __DIR__ . '/../vendor/autoload.php';

$app = new RestApplication();

$app['debug'] = false;

require_once __DIR__ . '/../config/main.php';

$app->run(Request::createFromGlobals());