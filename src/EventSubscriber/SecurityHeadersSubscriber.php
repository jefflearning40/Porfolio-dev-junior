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

        /*
         * Empêche le navigateur de deviner un autre type MIME.
         */
        $response->headers->set(
            'X-Content-Type-Options',
            'nosniff'
        );

        /*
         * Empêche un autre domaine d'intégrer le portfolio
         * dans une iframe.
         */
        $response->headers->set(
            'X-Frame-Options',
            'SAMEORIGIN'
        );

        /*
         * Limite les informations transmises dans le Referer.
         */
        $response->headers->set(
            'Referrer-Policy',
            'strict-origin-when-cross-origin'
        );

        /*
         * Désactive les fonctions du navigateur inutilisées.
         */
        $response->headers->set(
            'Permissions-Policy',
            'camera=(), microphone=(), geolocation=()'
        );

        /*
         * Content Security Policy active.
         *
         * Le navigateur bloque réellement les ressources
         * qui ne respectent pas ces règles.
         */
        $contentSecurityPolicy = implode('; ', [
            /*
             * Par défaut, seules les ressources provenant
             * du portfolio sont autorisées.
             */
            "default-src 'self'",

            /*
             * JavaScript local et scripts intégrés nécessaires
             * à AssetMapper / Importmap.
             */
            "script-src 'self' 'unsafe-inline' data:",

            /*
             * Feuilles CSS locales et styles intégrés.
             */
            "style-src 'self' 'unsafe-inline'",

            /*
             * Images locales, SVG et images encodées.
             */
            "img-src 'self' data: blob:",

            /*
             * Polices locales.
             */
            "font-src 'self' data:",

            /*
             * Vidéos locales, notamment la vidéo de fond.
             */
            "media-src 'self'",

            /*
             * Autorise l'affichage local du PDF du CV
             * dans une balise <object>.
             */
            "object-src 'self'",

            /*
             * Requêtes JavaScript uniquement vers le portfolio.
             */
            "connect-src 'self'",

            /*
             * Autorise uniquement les iframes locales.
             */
            "frame-src 'self'",

            /*
             * Le portfolio ne peut être intégré que
             * depuis son propre domaine.
             */
            "frame-ancestors 'self'",

            /*
             * Empêche la modification de l'URL de base.
             */
            "base-uri 'self'",

            /*
             * Les formulaires ne peuvent envoyer leurs données
             * que vers le portfolio.
             */
            "form-action 'self'",
        ]);

        $response->headers->set(
            'Content-Security-Policy',
            $contentSecurityPolicy
        );
    }

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::RESPONSE => 'onKernelResponse',
        ];
    }
}