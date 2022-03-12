<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\PaysRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: PaysRepository::class)]
#[ApiResource(
    collectionOperations: [
        'get'=> ['normalization_context' => ['groups' => ['paysCollection:read']]],
    ],
    itemOperations: [
        'get' => ['normalization_context' => ['groups' => ['pays:read']]],
    ]
)]
class Pays
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(["pays:read", "medecin:read", "paysCollection:read"])]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(["pays:read", "medecin:read", "paysCollection:read"])]
    private $nom;

    #[ORM\OneToMany(mappedBy: 'pays', targetEntity: Departement::class, orphanRemoval: true)]
    #[Groups(["pays:read", "paysCollection:read"])]
    private $departements;

    public function __construct()
    {
        $this->departements = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * @return Collection|Departement[]
     */
    public function getDepartements(): Collection
    {
        return $this->departements;
    }

    public function addDepartement(Departement $departement): self
    {
        if (!$this->departements->contains($departement)) {
            $this->departements[] = $departement;
            $departement->setPays($this);
        }

        return $this;
    }

    public function removeDepartement(Departement $departement): self
    {
        if ($this->departements->removeElement($departement)) {
            // set the owning side to null (unless already changed)
            if ($departement->getPays() === $this) {
                $departement->setPays(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->getNom();
    }
}
