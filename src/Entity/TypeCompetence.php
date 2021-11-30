<?php

namespace App\Entity;

use App\Repository\TypeCompetenceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
   
/**
 * @ORM\Entity(repositoryClass=TypeCompetenceRepository::class)
 */
#[ApiResource(normalizationContext:['groups' => ['read']], itemOperations:['GET'], collectionOperations:['GET'])]

class TypeCompetence
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
     #[Groups(["read"])]
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    #[Groups(["read"])]
    private $libelle;

    /**
     * @ORM\OneToMany(targetEntity=Competence::class, mappedBy="typeCompetence")
     */
    #[Groups(["read"])]
    private $competences;

    /**
     * @ORM\ManyToOne(targetEntity=Matiere::class, inversedBy="typeCompetences")
     */
    #[Groups(["read"])]
    private $matiere;

    public function __construct()
    {
        $this->competences = new ArrayCollection();
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
     * @return Collection|Competence[]
     */
    public function getCompetences(): Collection
    {
        return $this->competences;
    }

    public function addCompetence(Competence $competence): self
    {
        if (!$this->competences->contains($competence)) {
            $this->competences[] = $competence;
            $competence->setTypeCompetence($this);
        }

        return $this;
    }

    public function removeCompetence(Competence $competence): self
    {
        if ($this->competences->removeElement($competence)) {
            // set the owning side to null (unless already changed)
            if ($competence->getTypeCompetence() === $this) {
                $competence->setTypeCompetence(null);
            }
        }

        return $this;
    }

    public function getMatiere(): ?Matiere
    {
        return $this->matiere;
    }

    public function setMatiere(?Matiere $matiere): self
    {
        $this->matiere = $matiere;

        return $this;
    }
}
