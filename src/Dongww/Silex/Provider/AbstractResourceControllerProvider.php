<?php
/**
 * User: dongww
 * Date: 2017/2/14
 * Time: 9:28
 */

namespace Dongww\Silex\Provider;

use Dongww\Silex\RestApplication;
use Silex\Api\ControllerProviderInterface;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

class AbstractResourceControllerProvider implements ControllerProviderInterface
{
    protected $resourcePlural;

    public function connect(Application $app)
    {
        if(!$this->resourcePlural) {
            throw new \Exception('资源名称未定义');
        }


        $controllers = $app['controllers_factory'];

        $controllers->get("/{$this->resourcePlural}", [$this, 'getResourceCollection']);
        $controllers->post("/{$this->resourcePlural}", [$this, 'postResourceCollection']);

        $controllers->get("/{$this->resourcePlural}/{id}", [$this, 'getResource']);
        $controllers->put("/{$this->resourcePlural}/{id}", [$this, 'putResource']);
        $controllers->patch("/{$this->resourcePlural}/{id}", [$this, 'patchResource']);
        $controllers->delete("/{$this->resourcePlural}/{id}", [$this, 'deleteResource']);

        return $controllers;
    }

    public function getResourceCollection(RestApplication $app, Request $request)
    {
        $app->notImplemented();
    }

    public function postResource(RestApplication $app, Request $request)
    {
        $app->notImplemented();
    }

    public function getResource(RestApplication $app, Request $request, $id)
    {
        $app->notImplemented();
    }

    public function putResource(RestApplication $app, Request $request, $id)
    {
        $app->notImplemented();
    }

    public function patchResource(RestApplication $app, Request $request, $id)
    {
        $app->notImplemented();
    }

    public function deleteResource(RestApplication $app, Request $request, $id)
    {
        $app->notImplemented();
    }
}