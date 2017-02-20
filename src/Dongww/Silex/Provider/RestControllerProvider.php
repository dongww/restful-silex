<?php
/**
 * User: dongww
 * Date: 2017/2/14
 * Time: 9:28
 */
namespace Dongww\Silex\Provider;

use Silex\Api\ControllerProviderInterface;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

class RestControllerProvider implements ControllerProviderInterface
{
    public function connect(Application $app)
    {
        $controllers = $app['controllers_factory'];

        $controllers->get('/{entities}', [$this, 'getEntities']);
        $controllers->post('/{entities}', [$this, 'postEntities']);

        $controllers->get('/{entities}/{id}', [$this, 'getEntity']);
        $controllers->put('/{entities}/{id}', [$this, 'putEntity']);
        $controllers->patch('/{entities}/{id}', [$this, 'patchEntity']);
        $controllers->delete('/{entities}/{id}', [$this, 'deleteEntity']);

        $controllers->get('/{entities}/{id}/{subEntity}', [$this, 'getSubEntities']);
        $controllers->post('/{entities}/{id}/{subEntity}', [$this, 'postSubEntities']);

        $controllers->get('/{entities}/{id}/{subEntity}/{id}', [$this, 'getSubEntity']);
        $controllers->put('/{entities}/{id}/{subEntity}/{id}', [$this, 'putSubEntity']);
        $controllers->patch('/{entities}/{id}/{subEntity}/{id}', [$this, 'patchSubEntity']);
        $controllers->delete('/{entities}/{id}/{subEntity}/{id}', [$this, 'deleteSubEntity']);
    }

    public function getEntities(Application $app, Request $request)
    {

    }

    public function postEntities(Application $app, Request $request)
    {

    }

    public function putEntities(Application $app, Request $request)
    {

    }

    public function deleteEntities(Application $app, Request $request)
    {

    }
}