<?php
/**
 * User: dongww
 * Date: 2017/2/13
 * Time: 11:15
 */
namespace Dongww\Silex\Provider;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Silex\Api\BootableProviderInterface;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class RestServiceProvider implements ServiceProviderInterface, BootableProviderInterface
{
    public function register(Container $app)
    {
        $app['rest.auto_options'] = true;
        $app['rest.auto_json'] = true;
        $app['rest.allow_origin'] = '*';

        $app['rest.default_error_messages'] = [
            400 => '参数列表错误(缺少，格式不匹配)',
            401 => '未授权',
            403 => '访问受限，授权过期',
            404 => '资源，服务未找到',
            405 => '不允许的http方法',
            409 => '资源冲突，重复的资源 ',
            500 => '系统内部错误',
            501 => '接口未实现',
        ];

        $app['rest.headers'] = [
            'Access-Control-Allow-Origin'      => $app['rest.allow_origin'],
            'Access-Control-Allow-Credentials' => 'true',
            'Access-Control-Max-Age'           => '1000',
            'Access-Control-Allow-Headers'     => 'X-Requested-With, Content-Type, Origin, Authorization, Accept, Client-Security-Token, Accept-Encoding, X-Auth-Token',
            'Access-Control-Allow-Methods'     => 'POST, GET, OPTIONS, DELETE, PUT',
            'Access-Control-Expose-Headers'    => 'X-Auth-Token',
            'Allow'                            => 'POST, GET, OPTIONS, DELETE, PUT',
        ];
    }

    public function boot(Application $app)
    {
        if($app['rest.auto_options']) {
            $app->before(function (Request $request) use ($app) {
                if($request->getMethod() == 'OPTIONS') {
                    return new Response('', 200, $app['rest.headers']);
                }
            });
        }

        if(!$app['debug']) {
            $app->error(function (\Exception $e, Request $request, $code) use ($app) {
                if($code == 500 && $app['debug']) {
                    $message = $app['rest.default_error_messages'][$code];
                } else {
                    $message = $e->getMessage() ?: $app['rest.default_error_messages'][$code];
                }

                return $app->json(
                    [
                        'code'    => $code,
                        'message' => $message,
                    ]
                );
            });
        }
    }
}