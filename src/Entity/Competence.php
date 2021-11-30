<?php

namespace App\Entity;

use App\Repository\CompetenceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
/**
 * @ORM\Entity(repositoryClass=CompetenceRepository::class)
 */
#[ApiResource(normalizationContext:['groups' => ['read']])]
class Competence
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
    private $libelle;

    /**
     * @ORM\Column(type="integer", nullable = "true")
     */
    private $note;

    /**
     * @ORM\OneToMany(targetEntity=Atribuer::class, mappedBy="competence")
     */
    private $atribuers;

    /**
     * @ORM\ManyToOne(targetEntity=TypeCompetence::class, inversedBy="competences")
     */
        #[Groups(["read"])]
    private $typeCompetence;

    public function __construct()
    {
        $this->atribuers = new ArrayCollection();
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

    public function getNote(): ?int
    {
        return $this->note;
    }

    public function setNote(int $note): self
    {
        $this->note = $note;

        return $this;
    }

    /**
     * @return Collection|Atribuer[]
     */
    public function getAtribuers(): Collection
    {
        return $this->atribuers;
    }

    public function addAtribuer(Atribuer $atribuer): self
    {
        if (!$this->atribuers->contains($atribuer)) {
            $this->atribuers[] = $atribuer;
            $atribuer->setCompetence($this);
        }

        return $this;
    }

    public function removeAtribuer(Atribuer $atribuer): self
    {
        if ($this->atribuers->removeElement($atribuer)) {
            // set the owning side to null (unless already changed)
            if ($atribuer->getCompetence() === $this) {
                $atribuer->setCompetence(null);
            }
        }

        return $this;
    }

    public function getTypeCompetence(): ?TypeCompetence
    {
        return $this->typeCompetence;
    }

    public function setTypeCompetence(?TypeCompetence $typeCompetence): self
    {
        $this->typeCompetence = $typeCompetence;

        return $this;
    }
}
