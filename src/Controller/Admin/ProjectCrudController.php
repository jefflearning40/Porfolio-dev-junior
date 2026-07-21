<?php

namespace App\Controller\Admin;

use App\Entity\Project;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Vich\UploaderBundle\Form\Type\VichImageType;

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
            ->setPageTitle(
                Crud::PAGE_INDEX,
                'Gestion des projets'
            )
            ->setPageTitle(
                Crud::PAGE_NEW,
                'Ajouter un projet'
            )
            ->setPageTitle(
                Crud::PAGE_EDIT,
                'Modifier un projet'
            )
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

            Field::new(
                'imageFile',
                'Image'
            )
                ->setFormType(VichImageType::class)
                ->setFormTypeOption('required', false)
                ->onlyOnForms(),

            ImageField::new(
                'image',
                'Image'
            )
                ->setBasePath('/uploads/projects')
                ->onlyOnIndex(),

            AssociationField::new(
                'skills',
                'Compétences'
            )
                ->setFormTypeOption(
                    'choice_label',
                    'name'
                )
                ->setFormTypeOption(
                    'multiple',
                    true
                )
                ->setFormTypeOption(
                    'expanded',
                    true
                )
                ->setFormTypeOption(
                    'by_reference',
                    false
                )
                ->hideOnIndex(),

            BooleanField::new(
                'logoDarkBackground',
                'Logo sur fond sombre'
            ),

            ChoiceField::new(
                'status',
                'Statut'
            )
                ->setChoices([
                    'En cours' => 'En cours',
                    'Terminé' => 'Terminé',
                ]),

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
                ->formatValue(
                    static function ($value): string {
                        return $value?->format('d/m/Y H:i') ?? '—';
                    }
                )
                ->hideOnForm(),

            DateTimeField::new(
                'updatedAt',
                'Modifié le'
            )
                ->formatValue(
                    static function ($value): string {
                        return $value?->format('d/m/Y H:i') ?? '—';
                    }
                )
                ->hideOnForm(),
        ];
    }
}