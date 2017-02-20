<?php
/**
 * User: dongww
 * Date: 2017/1/20
 * Time: 9:07
 */

namespace Dongww\Silex\Provider;


use Dongww\Rest\Http\Client;
use GuzzleHttp\Client as GuzzleClient;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

class HttpClientServiceProvider implements ServiceProviderInterface
{
    public function register(Container $app)
    {
        $app['http.base_url'] = '';
        $app['http.timeout'] = 2.0;

        $app['guzzle.http.client'] = function () use ($app) {
            $token = [];
            if($app['http.token_callback']) {
                $token = $app['http.token_callback']($app);
            }

            return new GuzzleClient(
                [
                    'base_uri' => $app['http.base_url'],
                    'timeout'  => $app['http.timeout'],
                    'headers'  => $token,
                ]
            );
        };

        $app['http.client'] = function () use ($app) {
            return new Client($app['guzzle.http.client']);
        };
    }
}