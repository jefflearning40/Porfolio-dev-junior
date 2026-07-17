<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

final class HomeController extends AbstractController
{
    #[Route(
        '/{_locale}',
        name: 'app_home',
        requirements: ['_locale' => 'fr|en'],
        defaults: ['_locale' => 'fr']
    )]
    public function index(): Response
    {
        return $this->render('home/index.html.twig');
    }

    #[Route(
        '/{_locale}/test-403',
        name: 'app_test_403',
        requirements: ['_locale' => 'fr|en']
    )]
    public function test403(): never
    {
        throw new AccessDeniedHttpException('Test de la page 403');
    }

    #[Route(
        '/{_locale}/test-500',
        name: 'app_test_500',
        requirements: ['_locale' => 'fr|en']
    )]
    public function test500(): never
    {
        throw new \RuntimeException('Test de la page 500');
    }
}