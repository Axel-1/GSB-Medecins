<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\DepartementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: DepartementRepository::class)]
#[ApiResource(
    collectionOperations: [
        'get',
    ],
    itemOperations: [
        'get' => ['normalization_context' => ['groups' => ['departement:read']]],
    ],
)]
class Departement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(["pays:read", "departement:read", "medecin:read"])]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(["pays:read", "departement:read", "medecin:read"])]
    private $nom;

    #[ORM\OneToMany(mappedBy: 'departement', targetEntity: Medecin::class, orphanRemoval: true)]
    #[Groups(["departement:read"])]
    private $medecins;

    #[ORM\ManyToOne(targetEntity: Pays::class, inversedBy: 'departements')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(["medecin:read"])]
    private $pays;

    public function __construct()
    {
        $this->medecins = new ArrayCollection();
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
     * @return Collection|Medecin[]
     */
    public function getMedecins(): Collection
    {
        return $this->medecins;
    }

    public function addMedecin(Medecin $medecin): self
    {
        if (!$this->medecins->contains($medecin)) {
            $this->medecins[] = $medecin;
            $medecin->setDepartement($this);
        }

        return $this;
    }

    public function removeMedecin(Medecin $medecin): self
    {
        if ($this->medecins->removeElement($medecin)) {
            // set the owning side to null (unless already changed)
            if ($medecin->getDepartement() === $this) {
                $medecin->setDepartement(null);
            }
        }

        return $this;
    }

    public function getPays(): ?Pays
    {
        return $this->pays;
    }

    public function setPays(?Pays $pays): self
    {
        $this->pays = $pays;

        return $this;
    }
}
