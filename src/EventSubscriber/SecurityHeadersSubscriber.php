<?php

namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;

final class SecurityHeadersSubscriber implements EventSubscriberInterface
{
    public function onKernelResponse(ResponseEvent $event): void
    {
        if (!$event->isMainRequest()) {
            return;
        }

        $response = $event->getResponse();

        // Empêche le navigateur d'interpréter un fichier avec un autre type MIME
        $response->headers->set(
            'X-Content-Type-Options',
            'nosniff'
        );

        // Empêche l'affichage du site dans une iframe d'un autre domaine
        $response->headers->set(
            'X-Frame-Options',
            'SAMEORIGIN'
        );

        // Limite les informations envoyées dans l'en-tête Referer
        $response->headers->set(
            'Referrer-Policy',
            'strict-origin-when-cross-origin'
        );

        // Désactive les API du navigateur inutiles
        $response->headers->set(
            'Permissions-Policy',
            'camera=(), microphone=(), geolocation=()'
        );
    }

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::RESPONSE => 'onKernelResponse',
        ];
    }
}