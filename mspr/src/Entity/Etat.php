<?php

namespace App\Entity;

use App\Repository\EtatRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EtatRepository::class)]
class Etat
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $libelle = null;

    #[ORM\OneToMany(mappedBy: 'etat', targetEntity: Post::class)]
    private Collection $Post;

    public function __construct()
    {
        $this->Post = new ArrayCollection();
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
     * @return Collection<int, Post>
     */
    public function getPost(): Collection
    {
        return $this->Post;
    }

    public function addPost(Post $post): self
    {
        if (!$this->Post->contains($post)) {
            $this->Post->add($post);
            $post->setEtat($this);
        }

        return $this;
    }

    public function removePost(Post $post): self
    {
        if ($this->Post->removeElement($post)) {
            // set the owning side to null (unless already changed)
            if ($post->getEtat() === $this) {
                $post->setEtat(null);
            }
        }

        return $this;
    }
}
