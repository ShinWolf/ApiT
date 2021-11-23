<?php

namespace App\Entity;

use App\Repository\MatiereRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MatiereRepository::class)
 */
class Matiere
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $libelle;

    /**
     * @ORM\OneToMany(targetEntity=TypeCompetence::class, mappedBy="matiere")
     */
    private $typeCompetences;

    public function __construct()
    {
        $this->typeCompetences = new ArrayCollection();
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
     * @return Collection|TypeCompetence[]
     */
    public function getTypeCompetences(): Collection
    {
        return $this->typeCompetences;
    }

    public function addTypeCompetence(TypeCompetence $typeCompetence): self
    {
        if (!$this->typeCompetences->contains($typeCompetence)) {
            $this->typeCompetences[] = $typeCompetence;
            $typeCompetence->setMatiere($this);
        }

        return $this;
    }

    public function removeTypeCompetence(TypeCompetence $typeCompetence): self
    {
        if ($this->typeCompetences->removeElement($typeCompetence)) {
            // set the owning side to null (unless already changed)
            if ($typeCompetence->getMatiere() === $this) {
                $typeCompetence->setMatiere(null);
            }
        }

        return $this;
    }
}
