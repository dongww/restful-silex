<?php
/**
 * User: dongww
 * Date: 2017/5/24
 * Time: 10:35
 */

namespace Dongww\Silex\EventListener;


use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class AuthListener implements EventSubscriberInterface
{

    public function onKernelRequest(GetResponseEvent $event)
    {
        if($event->getRequest()->get('_auth')){

        }
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::REQUEST => [['onKernelRequest', 10]],
        ];
    }
}