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
        $projects = [
            [
                'name' => 'Portfolio développeur',
                'status' => 'En cours',
                'in_progress' => true,
                'description' => 'Portfolio professionnel conçu pour présenter mes compétences, mes projets, mon CV et mon profil de développeur web.',
                'logo' => 'images/logos/logo_myPortFolio.svg',
                'dark_logo_background' => false,
                'github_url' => '#',
                'website_url' => '#',
                'technologies' => [
                    [
                        'name' => 'Symfony',
                        'icon' => 'images/icones/symfony.svg',
                    ],
                    [
                        'name' => 'PHP',
                        'icon' => 'images/icones/php-6.svg',
                    ],
                    [
                        'name' => 'Twig',
                        'icon' => 'images/icones/twig.svg',
                    ],
                    [
                        'name' => 'JavaScript',
                        'icon' => 'images/icones/javascript.svg',
                    ],
                    [
                        'name' => 'CSS',
                        'icon' => 'images/icones/css-3.svg',
                    ],
                ],
            ],
            [
                'name' => 'Shop Manager',
                'status' => 'En cours',
                'in_progress' => true,
                'description' => 'Application de gestion commerciale développée avec React. Elle permettra de gérer les produits, les catégories, les stocks et les commandes au sein d’une interface moderne.',
                'logo' => 'images/logos/logo_SM.PNG',
                'dark_logo_background' => false,
                'github_url' => '#',
                'website_url' => '#',
                'technologies' => [
                    [
                        'name' => 'React',
                        'icon' => 'images/icones/react-native-1.svg',
                    ],
                    [
                        'name' => 'Tailwind CSS',
                        'icon' => 'images/icones/tailwind-css.svg',
                    ],
                ],
            ],
            [
                'name' => 'Irregular Verbs',
                'status' => 'Terminé',
                'in_progress' => false,
                'description' => 'Application pédagogique permettant d’apprendre, de réviser et de tester les verbes irréguliers anglais grâce à différents exercices interactifs.',
                'logo' => 'images/logos/logo_Verbe.PNG',
                'dark_logo_background' => false,
                'github_url' => '#',
                'website_url' => '#',
                'technologies' => [
                    [
                        'name' => 'HTML5',
                        'icon' => 'images/icones/html5.svg',
                    ],
                    [
                        'name' => 'CSS3',
                        'icon' => 'images/icones/css-3.svg',
                    ],
                    [
                        'name' => 'JavaScript',
                        'icon' => 'images/icones/javascript.svg',
                    ],
                ],
            ],
            [
                'name' => 'BPM',
                'status' => 'Terminé',
                'in_progress' => false,
                'description' => 'Application permettant de calculer et d’afficher les relevés de tension arterielle prise avec un tensiometre. ',
                'logo' => 'images/logos/logo_BPC.PNG',
                'dark_logo_background' => false,
                'github_url' => '#',
                'website_url' => '#',
                'technologies' => [
                    [
                        'name' => 'HTML5',
                        'icon' => 'images/icones/html5.svg',
                    ],
                    [
                        'name' => 'CSS3',
                        'icon' => 'images/icones/css-3.svg',
                    ],
                    [
                        'name' => 'JavaScript',
                        'icon' => 'images/icones/javascript.svg',
                    ],
                ],
            ],
            [
                'name' => 'MagScan',
                'status' => 'Terminé',
                'in_progress' => false,
                'description' => 'Projet de site vitrine réalisé pour une chaîne fictive de magasins implantés en centre-ville.',
                'logo' => 'images/logos/logo_MS.PNG',
                'dark_logo_background' => true,
                'github_url' => '#',
                'website_url' => '#',
                'technologies' => [
                    [
                        'name' => 'React',
                        'icon' => 'images/icones/react-native-1.svg',
                    ],
                    [
                        'name' => 'Tailwind CSS',
                        'icon' => 'images/icones/tailwind-css.svg',
                    ],
                ],
            ],
            [
                'name' => 'Plumbing Item',
                'status' => 'Terminé',
                'in_progress' => false,
                'description' => 'Application de gestion de produits de plomberie, du stock, des ventes et des statistiques.robotisé dans le futur',
                'logo' => 'images/logos/logo_plimbing.PNG',
                'dark_logo_background' => true,
                'github_url' => '#',
                'website_url' => '#',
                'technologies' => [
                    [
                        'name' => 'Symfony',
                        'icon' => 'images/icones/symfony.svg',
                    ],
                    [
                        'name' => 'PHP',
                        'icon' => 'images/icones/php-6.svg',
                    ],
                    [
                        'name' => 'Twig',
                        'icon' => 'images/icones/twig.svg',
                    ],
                    [
                        'name' => 'JavaScript',
                        'icon' => 'images/icones/javascript.svg',
                    ],
                    [
                        'name' => 'CSS',
                        'icon' => 'images/icones/css-3.svg',
                    ],
                ],
            ],
        ];

        return $this->render('projects/index.html.twig', [
            'projects' => $projects,
        ]);
    }
}