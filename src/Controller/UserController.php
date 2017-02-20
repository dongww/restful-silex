<?php
/**
 * User: dongww
 * Date: 2017/1/20
 * Time: 11:32
 */

namespace Controller;


use SilexRestful\Rest\Application;

class UserController
{
    public function all(Application $app)
    {
        $response = $app['http.client']->get('categories/roots');

//        return $app->json($response->getBody());
        return $app->unauthorized();
    }
}