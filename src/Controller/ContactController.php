<?php

namespace App\Controller;

use App\Entity\ContactMessage;
use App\Form\ContactType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ContactController extends AbstractController
{
    #[Route(
        '/{_locale}/contact',
        name: 'app_contact',
        requirements: ['_locale' => 'fr|en'],
        defaults: ['_locale' => 'fr']
    )]
    public function index(
        Request $request,
        EntityManagerInterface $entityManager
    ): Response {
        $contactMessage = new ContactMessage();

        $form = $this->createForm(
            ContactType::class,
            $contactMessage
        );

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($contactMessage);
            $entityManager->flush();

            $this->addFlash(
                'success',
                'contact.flash.success'
            );

            return $this->redirectToRoute('app_contact', [
                '_locale' => $request->getLocale(),
            ]);
        }

        return $this->render('contact/index.html.twig', [
            'contact_form' => $form,
        ]);
    }
}