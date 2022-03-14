<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\MedecinRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: MedecinRepository::class)]
#[ApiResource(
    collectionOperations: [
        'get' => ['normalization_context' => ['groups' => ['medecins:read']]],
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
    #[Groups(["departement:read", "medecin:read", "medecins:read", "specialite_complementaire:read", "departements:read", "specialite_complementaires:read"])]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(["departement:read", "medecin:read", "medecins:read", "specialite_complementaire:read"])]
    #[Assert\NotBlank(message: "Cette valeur ne doit pas être vide.")]
    private $nom;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(["departement:read", "medecin:read", "medecins:read", "specialite_complementaire:read"])]
    #[Assert\NotBlank(message: "Cette valeur ne doit pas être vide.")]
    private $prenom;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(["departement:read", "medecin:read", "medecins:read", "specialite_complementaire:read"])]
    #[Assert\NotBlank(message: "Cette valeur ne doit pas être vide.")]
    private $adresse;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(["departement:read", "medecin:read", "medecins:read", "specialite_complementaire:read"])]
    #[Assert\NotBlank(message: "Cette valeur ne doit pas être vide.")]
    #[Assert\Regex(
        pattern: "/(\+)(297|93|244|1264|358|355|376|971|54|374|1684|1268|61|43|994|257|32|229|226|880|359|973|1242|387|590|375|501|1441|591|55|1246|673|975|267|236|1|61|41|56|86|225|237|243|242|682|57|269|238|506|53|5999|61|1345|357|420|49|253|1767|45|1809|1829|1849|213|593|20|291|212|34|372|251|358|679|500|33|298|691|241|44|995|44|233|350|224|590|220|245|240|30|1473|299|502|594|1671|592|852|504|385|509|36|62|44|91|246|353|98|964|354|972|39|1876|44|962|81|76|77|254|996|855|686|1869|82|383|965|856|961|231|218|1758|423|94|266|370|352|371|853|590|212|377|373|261|960|52|692|389|223|356|95|382|976|1670|258|222|1664|596|230|265|60|262|264|687|227|672|234|505|683|31|47|977|674|64|968|92|507|64|51|63|680|675|48|1787|1939|850|351|595|970|689|974|262|40|7|250|966|249|221|65|500|4779|677|232|503|378|252|508|381|211|239|597|421|386|46|268|1721|248|963|1649|235|228|66|992|690|993|670|676|1868|216|90|688|886|255|256|380|598|1|998|3906698|379|1784|58|1284|1340|84|678|681|685|967|27|260|263)(9[976]\d|8[987530]\d|6[987]\d|5[90]\d|42\d|3[875]\d|2[98654321]\d|9[8543210]|8[6421]|6[6543210]|5[87654321]|4[987654310]|3[9643210]|2[70]|7|1)\d{4,20}$/",
        message: "Le numéro de téléphone doit être saisie au format international sans le 0. Ex : +33123456789")]
    private $tel;

    #[ORM\ManyToOne(targetEntity: Departement::class, inversedBy: 'medecins')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(["medecin:read"])]
    #[Assert\NotBlank(message: "Cette valeur ne doit pas être vide.")]
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

    public function setNom(?string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(?string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(?string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getTel(): ?string
    {
        return $this->tel;
    }

    public function setTel(?string $tel): self
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
