<?php

namespace App\Controller;

use App\Entity\Project;
use App\Repository\ProjectRepository;
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
    public function index(
        string $_locale,
        ProjectRepository $projectRepository
    ): Response {
        $projectEntities = $projectRepository->findBy(
            [
                'isPublished' => true,
            ],
            [
                'displayOrder' => 'ASC',
            ]
        );

        $projects = array_map(
            static function (Project $project) use ($_locale): array {
                $translation = $project->getTranslation($_locale);

                return [
                    'id' => $project->getId(),

                    'title' => $translation?->getTitle()
                        ?? $project->getTitle(),

                    'shortDescription' => $translation?->getShortDescription()
                        ?? $project->getShortDescription(),

                    'description' => $translation?->getDescription()
                        ?? $project->getDescription(),

                    'status' => $project->getStatus(),

                    'githubUrl' => $project->getGithubUrl(),

                    'demoUrl' => $project->getDemoUrl(),

                    'image' => $project->getImage(),

                    'logoDarkBackground' => $project->isLogoDarkBackground(),

                    'skills' => $project->getSkills(),
                ];
            },
            $projectEntities
        );

        return $this->render('projects/index.html.twig', [
            'projects' => $projects,
        ]);
    }
}