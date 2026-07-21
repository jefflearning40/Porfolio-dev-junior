<?php

namespace App\Entity;

use App\Repository\ProjectTranslationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ProjectTranslationRepository::class)]
#[ORM\UniqueConstraint(
    name: 'UNIQ_PROJECT_TRANSLATION_LOCALE',
    columns: ['project_id', 'locale']
)]
#[UniqueEntity(
    fields: ['project', 'locale'],
    message: 'Une traduction existe déjà pour cette langue.'
)]
class ProjectTranslation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 2)]
    #[Assert\NotBlank(
        message: 'La langue est obligatoire.'
    )]
    #[Assert\Choice(
        choices: ['fr', 'en'],
        message: 'La langue doit être « fr » ou « en ».'
    )]
    private ?string $locale = null;

    #[ORM\Column(length: 180)]
    #[Assert\NotBlank(
        message: 'Le titre est obligatoire.'
    )]
    #[Assert\Length(
        max: 180,
        maxMessage: 'Le titre ne peut pas dépasser 180 caractères.'
    )]
    private ?string $title = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(
        message: 'La description courte est obligatoire.'
    )]
    #[Assert\Length(
        max: 255,
        maxMessage: 'La description courte ne peut pas dépasser 255 caractères.'
    )]
    private ?string $shortDescription = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\NotBlank(
        message: 'La description est obligatoire.'
    )]
    private ?string $description = null;

    #[ORM\ManyToOne(
        inversedBy: 'translations'
    )]
    #[ORM\JoinColumn(
        nullable: false,
        onDelete: 'CASCADE'
    )]
    #[Assert\NotNull(
        message: 'Le projet est obligatoire.'
    )]
    private ?Project $project = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLocale(): ?string
    {
        return $this->locale;
    }

    public function setLocale(string $locale): static
    {
        $this->locale = mb_strtolower(trim($locale));

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = self::normalizeSingleLine($title);

        return $this;
    }

    public function getShortDescription(): ?string
    {
        return $this->shortDescription;
    }

    public function setShortDescription(string $shortDescription): static
    {
        $this->shortDescription = self::normalizeSingleLine(
            $shortDescription
        );

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = trim($description);

        return $this;
    }

    public function getProject(): ?Project
    {
        return $this->project;
    }

    public function setProject(?Project $project): static
    {
        $this->project = $project;

        return $this;
    }

    public function __toString(): string
    {
        $locale = mb_strtoupper((string) $this->locale);
        $title = $this->title ?? 'Traduction';

        return sprintf(
            '%s — %s',
            $locale,
            $title
        );
    }

    private static function normalizeSingleLine(string $value): string
    {
        $normalizedValue = preg_replace(
            '/\s+/u',
            ' ',
            trim($value)
        );

        return $normalizedValue ?? trim($value);
    }
}