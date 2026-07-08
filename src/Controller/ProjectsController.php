<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ProjectsController extends AbstractController
{
    #[Route(
        '/{_locale}/projects',
        name: 'app_projects',
        requirements: ['_locale' => 'fr|en'],
        defaults: ['_locale' => 'fr']
    )]
    public function index(): Response
    {
        return $this->render('projects/index.html.twig');
    }
}