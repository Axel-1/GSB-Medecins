<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\MedecinRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: MedecinRepository::class)]
#[ApiResource(
    collectionOperations: [
        'get',
    ],
    itemOperations: [
        'get' => ['normalization_context' => ['groups' => ['medecin:read']]],
    ],
)]
class Medecin
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(["departement:read", "medecin:read", "specialite_complementaire:read", "departements:read", "specialite_complementaires:read"])]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(["departement:read", "medecin:read", "specialite_complementaire:read"])]
    private $nom;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(["departement:read", "medecin:read", "specialite_complementaire:read"])]
    private $prenom;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(["departement:read", "medecin:read", "specialite_complementaire:read"])]
    private $adresse;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(["departement:read", "medecin:read", "specialite_complementaire:read"])]
    private $tel;

    #[ORM\ManyToOne(targetEntity: Departement::class, inversedBy: 'medecins')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(["medecin:read"])]
    private $departement;

    #[ORM\ManyToOne(targetEntity: SpecialiteComplementaire::class, inversedBy: 'medecins')]
    #[Groups(["medecin:read"])]
    private $specialiteComplementaire;

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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getTel(): ?string
    {
        return $this->tel;
    }

    public function setTel(string $tel): self
    {
        $this->tel = $tel;

        return $this;
    }

    public function getDepartement(): ?Departement
    {
        return $this->departement;
    }

    public function setDepartement(?Departement $departement): self
    {
        $this->departement = $departement;

        return $this;
    }

    public function getSpecialiteComplementaire(): ?SpecialiteComplementaire
    {
        return $this->specialiteComplementaire;
    }

    public function setSpecialiteComplementaire(?SpecialiteComplementaire $specialiteComplementaire): self
    {
        $this->specialiteComplementaire = $specialiteComplementaire;

        return $this;
    }
}
