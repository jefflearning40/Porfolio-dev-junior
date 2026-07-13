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
                'name_key' => 'projects.items.portfolio.name',
                'status_key' => 'projects.status.in_progress',
                'description_key' => 'projects.items.portfolio.description',

                'in_progress' => true,
                'dark_logo_background' => false,

                'logo' => 'images/logos/logo_myPortFolio.svg',

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
                'name_key' => 'projects.items.shop_manager.name',
                'status_key' => 'projects.status.in_progress',
                'description_key' => 'projects.items.shop_manager.description',

                'in_progress' => true,
                'dark_logo_background' => false,

                'logo' => 'images/logos/logo_SM.PNG',

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
                'name_key' => 'projects.items.irregular_verbs.name',
                'status_key' => 'projects.status.completed',
                'description_key' => 'projects.items.irregular_verbs.description',

                'in_progress' => false,
                'dark_logo_background' => false,

                'logo' => 'images/logos/logo_Verbe.PNG',

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
                'name_key' => 'projects.items.bpm.name',
                'status_key' => 'projects.status.completed',
                'description_key' => 'projects.items.bpm.description',

                'in_progress' => false,
                'dark_logo_background' => false,

                'logo' => 'images/logos/logo_BPC.PNG',

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
                'name_key' => 'projects.items.magscan.name',
                'status_key' => 'projects.status.completed',
                'description_key' => 'projects.items.magscan.description',

                'in_progress' => false,
                'dark_logo_background' => true,

                'logo' => 'images/logos/logo_MS.PNG',

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
                'name_key' => 'projects.items.plumbing_item.name',
                'status_key' => 'projects.status.completed',
                'description_key' => 'projects.items.plumbing_item.description',

                'in_progress' => false,
                'dark_logo_background' => true,

                'logo' => 'images/logos/logo_plimbing.PNG',

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