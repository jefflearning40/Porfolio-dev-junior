<?php

namespace App\Controller\Admin;

use App\Entity\ProjectTranslation;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ProjectTranslationCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ProjectTranslation::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Traduction')
            ->setEntityLabelInPlural('Traductions')
            ->setPageTitle(
                Crud::PAGE_INDEX,
                'Traductions des projets'
            )
            ->setPageTitle(
                Crud::PAGE_NEW,
                'Ajouter une traduction'
            )
            ->setPageTitle(
                Crud::PAGE_EDIT,
                'Modifier une traduction'
            )
            ->setSearchFields([
                'project.title',
                'locale',
                'title',
                'shortDescription',
                'description',
            ])
            ->setDefaultSort([
                'id' => 'ASC',
            ]);
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new(
                'id',
                'ID'
            )
                ->hideOnForm(),

            AssociationField::new(
                'project',
                'Projet'
            )
                ->setRequired(true),

            ChoiceField::new(
                'locale',
                'Langue'
            )
                ->setChoices([
                    'Français' => 'fr',
                    'Anglais' => 'en',
                ])
                ->setRequired(true),

            TextField::new(
                'title',
                'Titre'
            ),

            TextField::new(
                'shortDescription',
                'Description courte'
            )
                ->hideOnIndex(),

            TextareaField::new(
                'description',
                'Description'
            )
                ->hideOnIndex(),
        ];
    }
}