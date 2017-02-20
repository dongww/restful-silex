<?php
/**
 * User: dongww
 * Date: 2017/1/21
 * Time: 11:13
 */
namespace Dongww\Silex\Provider;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Silex\Application;
use Symfony\Component\Config\ConfigCacheFactory;
use Symfony\Component\Config\ConfigCacheInterface;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Routing\Loader\YamlFileLoader;
use Symfony\Component\Routing\RouteCollection;

class YamlRouteServiceProvider implements ServiceProviderInterface
{
    public function register(Container $app)
    {
        $app['yaml_route.cache.dir'] = '';
        $app['yaml_route.config.file'] = '';
        $app['yaml_route.prefix'] = '';

        $app['yaml_route.config.cache_factory'] = function ($app) {
            return new ConfigCacheFactory($app['debug']);
        };

        $app['yaml_route.collection'] = function ($app) {
            $loader = new YamlFileLoader(new FileLocator(dirname($app['yaml_route.config.file'])));
            $collection = $loader->load($app['yaml_route.config.file']);

            return $collection;
        };

        $app['routes'] = $app->extend('routes', function (RouteCollection $routes, Application $app) {
            if($app['yaml_route.cache.dir']) {
                $cache = $app['yaml_route.config.cache_factory']->cache($app['yaml_route.cache.dir'] . '/routes.cache.php',
                    function (ConfigCacheInterface $cache) use ($app) {
                        $collection = $app['yaml_route.collection'];
                        $cache->write(serialize($collection), $collection->getResources());
                    }
                );
                $collection = unserialize(file_get_contents($cache->getPath()));
            } else {
                $collection = $app['yaml_route.collection'];
            }
            $routes->addCollection($collection);

            return $routes;
        });
    }
}