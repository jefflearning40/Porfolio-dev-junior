<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class CvController extends AbstractController
{
    #[Route(
        '/{_locale}/cv',
        name: 'app_cv',
        requirements: ['_locale' => 'fr|en'],
        defaults: ['_locale' => 'fr']
    )]
    public function index(): Response
    {
        return $this->render('cv/index.html.twig');
    }
}