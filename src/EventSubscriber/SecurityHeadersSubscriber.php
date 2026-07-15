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
         * CSP en mode test.
         *
         * Elle signale les violations dans la console,
         * mais ne bloque encore aucune ressource.
         */
        $contentSecurityPolicy = implode('; ', [
            "default-src 'self'",

            /*
             * AssetMapper / Importmap génère des scripts intégrés
             * et peut utiliser des URL data: pour certains imports CSS.
             */
            "script-src 'self' 'unsafe-inline' data:",

            /*
             * Autorise les feuilles CSS locales et les éventuels
             * styles intégrés nécessaires au fonctionnement actuel.
             */
            "style-src 'self' 'unsafe-inline'",

            /*
             * Images locales, SVG et images encodées en data:.
             */
            "img-src 'self' data: blob:",

            /*
             * Polices locales uniquement.
             */
            "font-src 'self' data:",

            /*
             * Vidéos locales, notamment la vidéo de fond.
             */
            "media-src 'self'",

            /*
             * Autorise l'aperçu local du CV en PDF dans <object>.
             */
            "object-src 'self'",

            /*
             * Requêtes effectuées par JavaScript vers le site.
             */
            "connect-src 'self'",

            /*
             * Autorise seulement les iframes locales.
             */
            "frame-src 'self'",

            /*
             * Seul le portfolio peut intégrer ses propres pages.
             */
            "frame-ancestors 'self'",

            /*
             * Empêche la modification de l'URL de base du document.
             */
            "base-uri 'self'",

            /*
             * Les formulaires ne peuvent être envoyés
             * que vers le portfolio.
             */
            "form-action 'self'",
        ]);

        $response->headers->set(
            'Content-Security-Policy-Report-Only',
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