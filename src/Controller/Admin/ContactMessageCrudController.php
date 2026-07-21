<?php

namespace App\Controller\Admin;

use App\Entity\ContactMessage;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ContactMessageCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ContactMessage::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Message')
            ->setEntityLabelInPlural('Messages')
            ->setPageTitle(
                Crud::PAGE_INDEX,
                'Messages reçus'
            )
            ->setPageTitle(
                Crud::PAGE_DETAIL,
                'Consulter le message'
            )
            ->setDefaultSort([
                'createdAt' => 'DESC',
            ])
            ->setSearchFields([
                'lastName',
                'firstName',
                'email',
                'subject',
                'message',
            ]);
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->disable(
                Action::NEW,
                Action::EDIT
            )
            ->add(
                Crud::PAGE_INDEX,
                Action::DETAIL
            );
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new(
                'lastName',
                'Nom'
            ),

            TextField::new(
                'firstName',
                'Prénom'
            ),

            EmailField::new(
                'email',
                'Adresse e-mail'
            ),

            TextField::new(
                'subject',
                'Sujet'
            ),

            TextareaField::new(
                'message',
                'Message'
            )
                ->hideOnIndex(),

            DateTimeField::new(
                'createdAt',
                'Reçu le'
            ),
        ];
    }
}