<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class SkillsController extends AbstractController
{
    #[Route(
        '/{_locale}/skills',
        name: 'app_skills',
        requirements: ['_locale' => 'fr|en'],
        defaults: ['_locale' => 'fr']
    )]
    public function index(): Response
    {
        return $this->render('skills/index.html.twig', [
            'controller_name' => 'SkillsController',
        ]);
    }
}