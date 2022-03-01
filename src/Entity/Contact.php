<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ContactRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ContactRepository::class)
 */
#[ApiResource(normalizationContext:['groups' => ['read']], itemOperations: ["get", "patch"=>["security"=>"is_granted('ROLE_ADMIN') or object == user"]])]
class Contact
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="contacts")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Util1;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="contacts")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Util2;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $message;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateMessage;

    /**
     * @ORM\Column(type="boolean")
     */
    private $vu;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUtil1(): ?User
    {
        return $this->Util1;
    }

    public function setUtil1(?User $Util1): self
    {
        $this->Util1 = $Util1;

        return $this;
    }

    public function getUtil2(): ?User
    {
        return $this->Util2;
    }

    public function setUtil2(?User $Util2): self
    {
        $this->Util2 = $Util2;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }

    public function getDateMessage(): ?\DateTimeInterface
    {
        return $this->dateMessage;
    }

    public function setDateMessage(\DateTimeInterface $dateMessage): self
    {
        $this->dateMessage = $dateMessage;

        return $this;
    }

    public function getVu(): ?bool
    {
        return $this->vu;
    }

    public function setVu(bool $vu): self
    {
        $this->vu = $vu;

        return $this;
    }
}
