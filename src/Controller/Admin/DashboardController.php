<?php

namespace App\Controller\Admin;

use App\Repository\ContactMessageRepository;
use App\Repository\ProjectRepository;
use App\Repository\SkillRepository;
use EasyCorp\Bundle\EasyAdminBundle\Attribute\AdminDashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Assets;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_ADMIN')]
#[AdminDashboard(
    routePath: '/admin',
    routeName: 'admin'
)]
class DashboardController extends AbstractDashboardController
{
    public function __construct(
        private readonly ProjectRepository $projectRepository,
        private readonly SkillRepository $skillRepository,
        private readonly ContactMessageRepository $contactMessageRepository,
        private readonly AdminUrlGenerator $adminUrlGenerator
    ) {
    }

    public function index(): Response
    {
        $projectsUrl = $this->adminUrlGenerator
            ->unsetAll()
            ->setController(ProjectCrudController::class)
            ->setAction(Action::INDEX)
            ->generateUrl();

        $skillsUrl = $this->adminUrlGenerator
            ->unsetAll()
            ->setController(SkillCrudController::class)
            ->setAction(Action::INDEX)
            ->generateUrl();

        $messagesUrl = $this->adminUrlGenerator
            ->unsetAll()
            ->setController(ContactMessageCrudController::class)
            ->setAction(Action::INDEX)
            ->generateUrl();

        return $this->render('admin/dashboard.html.twig', [
            'project_count' => $this->projectRepository->count([]),

            'published_project_count' => $this->projectRepository->count([
                'isPublished' => true,
            ]),

            'skill_count' => $this->skillRepository->count([]),

            'message_count' => $this->contactMessageRepository->count([]),

            'projects_url' => $projectsUrl,
            'skills_url' => $skillsUrl,
            'messages_url' => $messagesUrl,
        ]);
    }

    public function configureAssets(): Assets
    {
        return Assets::new()
            ->addAssetMapperEntry('app');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Portfolio - Administration');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard(
            'Tableau de bord',
            'fa fa-home'
        );

        yield MenuItem::linkTo(
            ProjectCrudController::class,
            'Projets',
            'fa fa-folder-open'
        );

        yield MenuItem::linkTo(
            ProjectTranslationCrudController::class,
            'Traductions',
            'fa fa-language'
        );

        yield MenuItem::linkTo(
            SkillCrudController::class,
            'Compétences',
            'fa fa-code'
        );

        yield MenuItem::linkTo(
            ContactMessageCrudController::class,
            'Messages',
            'fa fa-envelope'
        );

        yield MenuItem::linkToRoute(
            'Retour au portfolio',
            'fa fa-arrow-left',
            'app_home',
            [
                '_locale' => 'fr',
            ]
        );
    }
}