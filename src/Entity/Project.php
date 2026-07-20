<?php

namespace App\Entity;

use App\Repository\ProjectRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ProjectRepository::class)]
class Project
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180)]
    #[Assert\NotBlank(
        message: 'Le titre du projet est obligatoire.'
    )]
    #[Assert\Length(
        max: 180,
        maxMessage: 'Le titre ne peut pas dépasser 180 caractères.'
    )]
    private ?string $title = null;

    #[ORM\Column(length: 180, unique: true)]
    #[Assert\NotBlank(
        message: 'Le slug est obligatoire.'
    )]
    #[Assert\Length(
        max: 180,
        maxMessage: 'Le slug ne peut pas dépasser 180 caractères.'
    )]
    #[Assert\Regex(
        pattern: '/^[a-z0-9]+(?:-[a-z0-9]+)*$/',
        message: 'Le slug doit contenir uniquement des lettres minuscules, des chiffres et des tirets.'
    )]
    private ?string $slug = null;

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

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\Url(
        message: 'L’adresse GitHub n’est pas valide.'
    )]
    private ?string $githubUrl = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\Url(
        message: 'L’adresse de démonstration n’est pas valide.'
    )]
    private ?string $demoUrl = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\Length(
        max: 255,
        maxMessage: 'Le nom de l’image ne peut pas dépasser 255 caractères.'
    )]
    private ?string $image = null;

    #[ORM\Column(length: 50)]
    #[Assert\NotBlank(
        message: 'Le statut est obligatoire.'
    )]
    #[Assert\Length(
        max: 50,
        maxMessage: 'Le statut ne peut pas dépasser 50 caractères.'
    )]
    private ?string $status = null;

    #[ORM\Column]
    #[Assert\PositiveOrZero(
        message: 'L’ordre d’affichage doit être supérieur ou égal à zéro.'
    )]
    private int $displayOrder = 0;

    #[ORM\Column]
    private bool $isPublished = true;

    #[ORM\Column]
    private \DateTimeImmutable $createdAt;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;

    /**
     * @var Collection<int, Skill>
     */
    #[ORM\ManyToMany(targetEntity: Skill::class, inversedBy: 'projects')]
    private Collection $skills;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
        $this->skills = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): static
    {
        $this->slug = mb_strtolower(trim($slug));

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

    public function getGithubUrl(): ?string
    {
        return $this->githubUrl;
    }

    public function setGithubUrl(?string $githubUrl): static
    {
        $this->githubUrl = self::normalizeNullableString($githubUrl);

        return $this;
    }

    public function getDemoUrl(): ?string
    {
        return $this->demoUrl;
    }

    public function setDemoUrl(?string $demoUrl): static
    {
        $this->demoUrl = self::normalizeNullableString($demoUrl);

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): static
    {
        $this->image = self::normalizeNullableString($image);

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): static
    {
        $this->status = self::normalizeSingleLine($status);

        return $this;
    }

    public function getDisplayOrder(): int
    {
        return $this->displayOrder;
    }

    public function setDisplayOrder(int $displayOrder): static
    {
        $this->displayOrder = $displayOrder;

        return $this;
    }

    public function isPublished(): bool
    {
        return $this->isPublished;
    }

    public function setIsPublished(bool $isPublished): static
    {
        $this->isPublished = $isPublished;

        return $this;
    }

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeImmutable $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @return Collection<int, Skill>
     */
    public function getSkills(): Collection
    {
        return $this->skills;
    }

    public function addSkill(Skill $skill): static
    {
        if (!$this->skills->contains($skill)) {
            $this->skills->add($skill);
        }

        return $this;
    }

    public function removeSkill(Skill $skill): static
    {
        $this->skills->removeElement($skill);

        return $this;
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

    private static function normalizeNullableString(?string $value): ?string
    {
        if ($value === null) {
            return null;
        }

        $normalizedValue = trim($value);

        return $normalizedValue === ''
            ? null
            : $normalizedValue;
    }
}