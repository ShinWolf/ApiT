<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @UniqueEntity(
 *     fields={"email"},
 *     message="Un compte est déjà associé à cette adresse email, veuillez en choisir un autre ou vous connecter."
 * )
 */
#[ApiResource(normalizationContext:['groups' => ['read']], itemOperations: ["get"=>["security"=>"is_granted('ROLE_ADMIN') or object == user"], "patch"=>["security"=>"is_granted('ROLE_ADMIN') or object == user"]], collectionOperations: ["get"=>["security"=>"is_granted('ROLE_ADMIN')"], "post"])]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    #[Groups(["read"])]
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     * @Assert\Email
     */
    #[Groups(["read"])]
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    #[Groups(["read"])]
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\OneToMany(targetEntity=Atribuer::class, mappedBy="user")
     */
    private $atribuers;

    /**
     * @ORM\Column(type="datetime")
     */
    #[Groups(["read"])]
    private $dateInscription;

    /**
     * @ORM\Column(type="string", length=25)
     */
    #[Groups(["read"])]
    private $idUnique;

    /**
     * @ORM\OneToMany(targetEntity=Contact::class, mappedBy="emetteur", orphanRemoval=true)
     */
    private $contactEmetteur;

    /**
     * @ORM\OneToMany(targetEntity=Contact::class, mappedBy="recepteur", orphanRemoval=true)
     */
    private $contactRecepteur;
   
    public function __construct()
    {
        $this->atribuers = new ArrayCollection();
        $this->contactEmetteur = new ArrayCollection();
        $this->contactRecepteur = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        
        // Si aucun rôle n'est spécifié, mettre le rôle d'utilisateur
        if (empty($roles))
        {
            $roles[] = 'ROLE_USER';
        }

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
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
            $atribuer->setUser($this);
        }

        return $this;
    }

    public function removeAtribuer(Atribuer $atribuer): self
    {
        if ($this->atribuers->removeElement($atribuer)) {
            // set the owning side to null (unless already changed)
            if ($atribuer->getUser() === $this) {
                $atribuer->setUser(null);
            }
        }

        return $this;
    }

    public function getDateInscription(): ?\DateTimeInterface
    {
        return $this->dateInscription;
    }

    public function setDateInscription(\DateTimeInterface $dateInscription): self
    {
        $this->dateInscription = $dateInscription;

        return $this;
    }

    public function getIdUnique(): ?string
    {
        return $this->idUnique;
    }

    public function setIdUnique(string $idUnique): self
    {
        $this->idUnique = $idUnique;

        return $this;
    }

    /**
     * @return Collection|Contact[]
     */
    public function getContactEmetteur(): Collection
    {
        return $this->contactEmetteur;
    }

    public function addContactEmetteur(Contact $contactEmetteur): self
    {
        if (!$this->contactEmetteur->contains($contactEmetteur)) {
            $this->contactEmetteur[] = $contactEmetteur;
            $contactEmetteur->setEmetteur($this);
        }

        return $this;
    }

    public function removeContactEmetteur(Contact $contactEmetteur): self
    {
        if ($this->contactEmetteur->removeElement($contactEmetteur)) {
            // set the owning side to null (unless already changed)
            if ($contactEmetteur->getEmetteur() === $this) {
                $contactEmetteur->setEmetteur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Contact[]
     */
    public function getContactRecepteur(): Collection
    {
        return $this->contactRecepteur;
    }

    public function addContactRecepteur(Contact $contactRecepteur): self
    {
        if (!$this->contactRecepteur->contains($contactRecepteur)) {
            $this->contactRecepteur[] = $contactRecepteur;
            $contactRecepteur->setRecepteur($this);
        }

        return $this;
    }

    public function removeContactRecepteur(Contact $contactRecepteur): self
    {
        if ($this->contactRecepteur->removeElement($contactRecepteur)) {
            // set the owning side to null (unless already changed)
            if ($contactRecepteur->getRecepteur() === $this) {
                $contactRecepteur->setRecepteur(null);
            }
        }

        return $this;
    }
}
