<?php

namespace App\Controller\Admin;

use App\Entity\Project;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ProjectCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Project::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Projet')
            ->setEntityLabelInPlural('Projets')
            ->setPageTitle(Crud::PAGE_INDEX, 'Gestion des projets')
            ->setPageTitle(Crud::PAGE_NEW, 'Ajouter un projet')
            ->setPageTitle(Crud::PAGE_EDIT, 'Modifier un projet')
            ->setDefaultSort([
                'displayOrder' => 'ASC',
            ])
            ->setSearchFields([
                'title',
                'shortDescription',
                'description',
                'status',
            ]);
    }

    public function configureFields(string $pageName): iterable
    {
        return [

            TextField::new(
                'title',
                'Titre'
            ),

            SlugField::new(
                'slug',
                'Slug'
            )
                ->setTargetFieldName('title')
                ->hideOnIndex(),

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

            TextField::new(
                'githubUrl',
                'Lien GitHub'
            )
                ->hideOnIndex(),

            TextField::new(
                'demoUrl',
                'Lien de démonstration'
            )
                ->hideOnIndex(),

            TextField::new(
                'image',
                'Image'
            )
                ->hideOnIndex(),

            AssociationField::new(
                'skills',
                'Compétences'
            )
                ->setFormTypeOption('choice_label', 'name')
                ->setFormTypeOption('multiple', true)
                ->setFormTypeOption('expanded', true)
                ->setFormTypeOption('by_reference', false)
                ->hideOnIndex(),

            BooleanField::new(
                'logoDarkBackground',
                'Logo sur fond sombre'
            ),

            TextField::new(
                'status',
                'Statut'
            ),

            IntegerField::new(
                'displayOrder',
                'Ordre d’affichage'
            ),

            BooleanField::new(
                'isPublished',
                'Publié'
            ),

            DateTimeField::new(
                'createdAt',
                'Créé le'
            )
                ->hideOnForm(),

            DateTimeField::new(
                'updatedAt',
                'Modifié le'
            )
                ->hideOnForm(),
        ];
    }
}