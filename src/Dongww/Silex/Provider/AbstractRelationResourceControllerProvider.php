<?php
/**
 * User: dongww
 * Date: 2017/2/14
 * Time: 9:28
 */

namespace Dongww\Silex\ProvmasterIder;

use Dongww\Silex\RestApplication;
use Silex\Api\ControllerProviderInterface;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

class AbstractResourceControllerProvider implements ControllerProviderInterface
{
    /**
     * 主资源的名字复数
     *
     * @var string
     */
    protected $masterPlural;

    /**
     * 关联资源的名字复数
     *
     * @var string
     */
    protected $relationPlural;

    public function connect(Application $app)
    {
        if(!$this->masterPlural || !$this->relationPlural) {
            throw new \Exception('资源名称未正确定义');
        }

        $controllers = $app['controllers_factory'];

        $controllers->get("/{$this->masterPlural}/{masterId}/{$this->relationPlural}", [$this, 'getResourceCollection']);
        $controllers->post("/{$this->masterPlural}/{masterId}/{$this->relationPlural}", [$this, 'postResourceCollection']);

        $controllers->get("/{$this->masterPlural}/{masterId}/{$this->relationPlural}/{relationId}", [$this, 'getResource']);
        $controllers->put("/{$this->masterPlural}/{masterId}/{$this->relationPlural}/{relationId}", [$this, 'putResource']);
        $controllers->patch("/{$this->masterPlural}/{masterId}/{$this->relationPlural}/{relationId}", [$this, 'patchResource']);
        $controllers->delete("/{$this->masterPlural}/{masterId}/{$this->relationPlural}/{relationId}", [$this, 'deleteResource']);

        return $controllers;
    }

    public function getResourceCollection(RestApplication $app, Request $request, $masterId)
    {
        $app->notImplemented();
    }

    public function postResource(RestApplication $app, Request $request, $masterId)
    {
        $app->notImplemented();
    }

    public function getResource(RestApplication $app, Request $request, $masterId, $relationId)
    {
        $app->notImplemented();
    }

    public function putResource(RestApplication $app, Request $request, $masterId, $relationId)
    {
        $app->notImplemented();
    }

    public function patchResource(RestApplication $app, Request $request, $masterId, $relationId)
    {
        $app->notImplemented();
    }

    public function deleteResource(RestApplication $app, Request $request, $masterId, $relationId)
    {
        $app->notImplemented();
    }
}