<?php
use Dongww\Rest\Http\Request;
use SilexRestful\Rest\Application;

require_once __DIR__ . '/../vendor/autoload.php';

$app = new Application();
$app['debug'] = false;

require_once __DIR__ . '/../config/main.php';

//$app->get('/a', function (Application $app) {
//    $response = $app['http.client']->get('categories/roots');
//
//    return $app->json($response->getBody());
//});
//
//$app->post('/', function (Application $app, \Symfony\Component\HttpFoundation\Request $request) {
////    var_dump($request->get('body'));
//
////    return $app->json($request->get('body'));
//    return $app->notFound();
//});

$app->run(Request::createFromGlobals());