<?php
/**
 * User: dongww
 * Date: 2017/1/20
 * Time: 11:32
 */
namespace Controller;

use Dongww\Rest\Http\Request;
use Dongww\Silex\RestApplication;

class UserController
{
    public function all(RestApplication $app, Request $request)
    {
        $response = $app['http.client']->get('categories/roots');

        return $app->json($response->getBody());
    }
}