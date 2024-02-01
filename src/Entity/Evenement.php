<?php

namespace App\Entity;

use App\Repository\EvenementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\DBAL\Types\Types;

#[ORM\Entity(repositoryClass: EvenementRepository::class)]
class Evenement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titre = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(length: 255)]
    private ?string $lieu = null;

    #[ORM\ManyToOne(targetEntity: Utilisateur::class, inversedBy: 'evenements')]
   // #[ORM\JoinColumn(name: "organisateur_id", referencedColumnName: "id", nullable: true)]
    private ?Utilisateur $organisateur = null;

    #[ORM\ManyToMany(targetEntity: Utilisateur::class, inversedBy: 'evenements')]
    private Collection $utilisateurs;

    public function __construct()
    {
        $this->utilisateurs = new ArrayCollection();
    }

    // Getters et Setters pour chaque propriété

    // Exemple de getter et setter pour la propriété $titre
    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;
        return $this;
    }

    // Méthodes pour gérer la collection $utilisateurs
    public function addUtilisateur(Utilisateur $utilisateur): self
    {
        if (!$this->utilisateurs->contains($utilisateur)) {
            $this->utilisateurs[] = $utilisateur;
        }
        return $this;
    }

    public function removeUtilisateur(Utilisateur $utilisateur): self
    {
        $this->utilisateurs->removeElement($utilisateur);
        return $this;
    }

    // Getter et setter pour $organisateur
    public function getOrganisateur(): ?Utilisateur
    {
        return $this->organisateur;
    }

    public function setOrganisateur(?Utilisateur $organisateur): self
    {
        $this->organisateur = $organisateur;
        return $this;
    }

    /**
     * @param string|null $description
     */
    public function setDescription(?string $description): self
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    /**
     * @param \DateTimeInterface|null $date
     */
    public function setDate(?\DateTimeInterface $date): static
    {
        $this->date = $date;
        return $this;
    }

    /**
     * @param string|null $lieu
     */
    public function setLieu(?string $lieu): static
    {
        $this->lieu = $lieu;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getLieu(): ?string
    {
        return $this->lieu;
    }

    /**
     * @param int|null $id
     */
    public function setId(?int $id): static
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }
}
