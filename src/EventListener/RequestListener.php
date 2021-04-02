<?php


namespace App\EventListener;


use Symfony\Component\HttpKernel\Event\RequestEvent;

class RequestListener
{
    public function onKernelRequest(RequestEvent $event)
    {
        $request = $event->getRequest();
        $clientIp = $request->getClientIp();

        if ('127.0.0.1' == $clientIp) {
            $request->setLocale('es_AR');
        }
        return;
    }
}