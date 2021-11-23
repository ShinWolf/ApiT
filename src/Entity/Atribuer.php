<?php

namespace App\Entity;

use App\Repository\AtribuerRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AtribuerRepository::class)
 */
class Atribuer
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nbValider;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="atribuers")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity=Competence::class, inversedBy="atribuers")
     */
    private $competence;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNbValider(): ?int
    {
        return $this->nbValider;
    }

    public function setNbValider(?int $nbValider): self
    {
        $this->nbValider = $nbValider;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getCompetence(): ?Competence
    {
        return $this->competence;
    }

    public function setCompetence(?Competence $competence): self
    {
        $this->competence = $competence;

        return $this;
    }
}
