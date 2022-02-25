<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\SpecialiteComplementaireRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: SpecialiteComplementaireRepository::class)]
#[ApiResource(
    collectionOperations: [
        'get' => ['normalization_context' => ['groups' => ['specialite_complementaires:read']]],
    ],
    itemOperations: [
        'get' => ['normalization_context' => ['groups' => ['specialite_complementaire:read']]],
    ],
)]
class SpecialiteComplementaire
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(["departement", "medecin:read", "specialite_complementaire:read", "specialite_complementaires:read"])]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(["departement", "medecin:read", "specialite_complementaire:read", "specialite_complementaires:read"])]
    private $libelle;

    #[ORM\OneToMany(mappedBy: 'specialiteComplementaire', targetEntity: Medecin::class)]
    #[Groups(["specialite_complementaire:read", "specialite_complementaires:read"])]
    private $medecins;

    public function __construct()
    {
        $this->medecins = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

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
            $medecin->setSpecialiteComplementaire($this);
        }

        return $this;
    }

    public function removeMedecin(Medecin $medecin): self
    {
        if ($this->medecins->removeElement($medecin)) {
            // set the owning side to null (unless already changed)
            if ($medecin->getSpecialiteComplementaire() === $this) {
                $medecin->setSpecialiteComplementaire(null);
            }
        }

        return $this;
    }
}
