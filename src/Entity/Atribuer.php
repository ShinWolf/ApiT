<?php

namespace App\Entity;

use App\Repository\AtribuerRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=AtribuerRepository::class)
 */
#[ApiResource(denormalizationContext: ['groups' => ['write']],normalizationContext:['groups' => ['read']])]

class Atribuer
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    #[Groups(["read"])]  
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    #[Groups(["read"])]
    private $nbValider;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="atribuers")
     */
    #[Groups(["read", "write"])]
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity=Competence::class, inversedBy="atribuers")
     */
    #[Groups(["read", "write"])]
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

    public function getRow(){               
        return array($this->id, $this->nbValider, $this->competence->getLibelle(), $this->user->getIdUnique());    
    }    
    public function getHeader(){        
        return array('Identifiant', 'NbValider', 'Competence', 'User');    
    }
}
