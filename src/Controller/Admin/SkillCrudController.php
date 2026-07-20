<?php

namespace App\Controller\Admin;

use App\Entity\Skill;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class SkillCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Skill::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Compétence')
            ->setEntityLabelInPlural('Compétences')
            ->setPageTitle(Crud::PAGE_INDEX, 'Gestion des compétences')
            ->setPageTitle(Crud::PAGE_NEW, 'Ajouter une compétence')
            ->setPageTitle(Crud::PAGE_EDIT, 'Modifier une compétence')
            ->setSearchFields([
                'name',
            ])
            ->setDefaultSort([
                'name' => 'ASC',
            ]);
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new(
                'name',
                'Nom'
            ),
        ];
    }
}