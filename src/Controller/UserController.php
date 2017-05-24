<?php
/**
 * User: dongww
 * Date: 2017/1/20
 * Time: 11:32
 */

namespace Controller;

use Dongww\Rest\Http\Request;
use Dongww\Silex\RestApplication;
use Firebase\JWT\JWT;

class UserController
{
    public function all(RestApplication $app, Request $request)
    {
        $response = $app['http.client']->get('categories/roots');

        return $app->json($response->getBody());
    }

    public function authentication(RestApplication $app, Request $request)
    {
        $users = [
            'admin' => 'pass',
        ];

        $username = $request->restContent['username'];
        $password = $request->restContent['password'];

        if($users[$username] != $password) {
            $app->unauthorized();
        }

        $key   = 'asdfgg';
        $token = [
            'username' => $username,
            'expires'  => (new \DateTime('+1 day'))->format('Y-m-d H:i:s'),
        ];

        $jwt = JWT::encode($token, $key);

        return $app->json([
            'token' => $jwt,
        ]);
    }
}