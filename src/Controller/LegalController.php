<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class LegalController extends AbstractController
{
    #[Route(
        '/{_locale}/mentions-legales',
        name: 'app_legal_mentions',
        requirements: ['_locale' => 'fr|en'],
        defaults: ['_locale' => 'fr']
    )]
    public function mentions(): Response
    {
        return $this->render('legal/mentions.html.twig');
    }

    #[Route(
        '/{_locale}/rgpd',
        name: 'app_rgpd',
        requirements: ['_locale' => 'fr|en'],
        defaults: ['_locale' => 'fr']
    )]
    public function rgpd(): Response
    {
        return $this->render('legal/rgpd.html.twig');
    }
}