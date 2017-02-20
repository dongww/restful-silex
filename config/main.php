<?php
use Silex\Application;

$app['service.base_url'] = 'http://192.168.18.183:8090';

$app->register(new \Dongww\Silex\Provider\RestServiceProvider());

$app->register(new \Dongww\Silex\Provider\HttpClientServiceProvider(), [
    'http.base_url'       => 'http://192.168.18.183:8090',
    'http.token_callback' => $app->protect(function (Application $app) {
        return ['a' => 'b'];
    }),
]);

$app->register(new \Dongww\Silex\Provider\YamlRouteServiceProvider(), [
    'yaml_route.config.file' => __DIR__ . '/routes.yml',
    'yaml_route.cache.dir'   => __DIR__ . '/../var/cache',
]);