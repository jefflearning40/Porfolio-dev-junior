<?php

namespace App\Command;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[AsCommand(
    name: 'app:create-admin',
    description: 'Crée ou met à jour un compte administrateur.',
)]
final class CreateAdminCommand extends Command
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
        private readonly UserRepository $userRepository,
        private readonly UserPasswordHasherInterface $passwordHasher
    ) {
        parent::__construct();
    }

    protected function execute(
        InputInterface $input,
        OutputInterface $output
    ): int {
        $io = new SymfonyStyle($input, $output);

        $email = mb_strtolower(
            trim(
                $io->ask(
                    'Adresse e-mail de l’administrateur'
                ) ?? ''
            )
        );

        if ($email === '') {
            $io->error(
                'L’adresse e-mail est obligatoire.'
            );

            return Command::FAILURE;
        }

        if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            $io->error(
                'L’adresse e-mail indiquée n’est pas valide.'
            );

            return Command::FAILURE;
        }

        $existingUser = $this->userRepository->findOneBy([
            'email' => $email,
        ]);

        if ($existingUser !== null) {
            $io->note(
                'Ce compte existe déjà. Son mot de passe et son rôle vont être mis à jour.'
            );
        }

        $passwordQuestion = new Question(
            'Mot de passe de l’administrateur'
        );

        $passwordQuestion->setHidden(true);
        $passwordQuestion->setHiddenFallback(false);
        $passwordQuestion->setValidator(
            static function (?string $password): string {
                $password = (string) $password;

                if (mb_strlen($password) < 12) {
                    throw new \RuntimeException(
                        'Le mot de passe doit contenir au moins 12 caractères.'
                    );
                }

                return $password;
            }
        );

        $password = $io->askQuestion(
            $passwordQuestion
        );

        $confirmationQuestion = new Question(
            'Confirmez le mot de passe'
        );

        $confirmationQuestion->setHidden(true);
        $confirmationQuestion->setHiddenFallback(false);

        $passwordConfirmation = $io->askQuestion(
            $confirmationQuestion
        );

        if ($password !== $passwordConfirmation) {
            $io->error(
                'Les deux mots de passe ne correspondent pas.'
            );

            return Command::FAILURE;
        }

        $admin = $existingUser ?? new User();

        $admin
            ->setEmail($email)
            ->setRoles([
                'ROLE_ADMIN',
            ]);

        $admin->setPassword(
            $this->passwordHasher->hashPassword(
                $admin,
                $password
            )
        );

        if ($existingUser === null) {
            $this->entityManager->persist($admin);
        }

        $this->entityManager->flush();

        if ($existingUser !== null) {
            $io->success(
                sprintf(
                    'Le compte administrateur %s a été mis à jour.',
                    $email
                )
            );

            return Command::SUCCESS;
        }

        $io->success(
            sprintf(
                'Le compte administrateur %s a été créé.',
                $email
            )
        );

        return Command::SUCCESS;
    }
}