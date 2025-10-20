<?php

namespace App\Entity;

use App\Repository\TarifRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;

#[ORM\Entity(repositoryClass: TarifRepository::class)]
#[ApiResource(
    formats: [
        'json' => ['application/json', 'application/ld+json', 'application/merge-patch+json']
    ]
)]
class Tarif
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $service = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    private ?string $prix = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $unite = null;

    #[ORM\Column(length: 255)]
private ?string $categorie = null;

     #[ORM\Column(length: 255, nullable: true)]
private ?string $image = null;

public function getImage(): ?string
{
    return $this->image;
}

public function setImage(?string $image): static
{
    $this->image = $image;
    return $this;
}

public function getCategorie(): ?string
{
    return $this->categorie;
}

public function setCategorie(string $categorie): static
{
    $this->categorie = $categorie;
    return $this;
}

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getService(): ?string
    {
        return $this->service;
    }

    public function setService(string $service): static
    {
        $this->service = $service;

        return $this;
    }

    public function getPrix(): ?string
    {
        return $this->prix;
    }

    public function setPrix(string $prix): static
    {
        $this->prix = $prix;

        return $this;
    }

    public function getUnite(): ?string
    {
        return $this->unite;
    }

    public function setUnite(?string $unite): static
    {
        $this->unite = $unite;

        return $this;
    }
}
