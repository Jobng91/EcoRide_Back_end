<?php

namespace App\Entity;

use App\Repository\PlainteRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlainteRepository::class)]
class Plainte
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $detail = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Covoiturage $covoiturageId = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $plaignantId = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $cibleId = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDetail(): ?string
    {
        return $this->detail;
    }

    public function setDetail(string $detail): static
    {
        $this->detail = $detail;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
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

    public function getCovoiturageId(): ?Covoiturage
    {
        return $this->covoiturageId;
    }

    public function setCovoiturageId(?Covoiturage $covoiturageId): static
    {
        $this->covoiturageId = $covoiturageId;

        return $this;
    }

    public function getPlaignantId(): ?User
    {
        return $this->plaignantId;
    }

    public function setPlaignantId(?User $plaignantId): static
    {
        $this->plaignantId = $plaignantId;

        return $this;
    }

    public function getCibleId(): ?User
    {
        return $this->cibleId;
    }

    public function setCibleId(?User $cibleId): static
    {
        $this->cibleId = $cibleId;

        return $this;
    }
}
