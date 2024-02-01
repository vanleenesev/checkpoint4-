<?php

namespace App\Entity;

use App\Repository\UtilisateurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UtilisateurRepository::class)]
#[UniqueEntity(fields: ['name'], message: 'There is already an account with this name')]
class Utilisateur implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $password = null;

    #[ORM\Column(length: 255)]
    private ?array $role = null;

    #[ORM\ManyToMany(targetEntity: Evenement::class, mappedBy: 'organisateur')]
    private Collection $evenements;

    #[ORM\OneToMany(mappedBy: 'Utilisateur', targetEntity: Reservation::class)]
    private Collection $evenement;

    #[ORM\Column(type: 'boolean')]
    private $isVerified = false;

    #[ORM\OneToMany(mappedBy: 'utilisateur', targetEntity: Reservation::class)]
    private Collection $reservations;

    #[ORM\OneToMany(mappedBy: 'utilisateur', targetEntity: Evenement::class)]
    private Collection $evenementss;

    public function __construct()
    {
        $this->evenements = new ArrayCollection();
        $this->evenement = new ArrayCollection();
        $this->reservations = new ArrayCollection();
        $this->evenementss = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setID(int $ID): static
    {
        $this->ID = $ID;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    public function getRole(): ?array
    {
        return $this->role;
    }

    public function setRole(array $role): static
    {
        $this->role = $role;

        return $this;
    }

    /**
     * @return Collection<int, Evenement>
     */
    public function getEvenements(): Collection
    {
        return $this->evenements;
    }

    public function addEvenement(Evenement $evenement): static
    {
        if (!$this->evenements->contains($evenement)) {
            $this->evenements->add($evenement);
            $evenement->addOrganisateur($this);
        }

        return $this;
    }

    public function removeEvenement(Evenement $evenement): static
    {
        if ($this->evenements->removeElement($evenement)) {
            $evenement->removeOrganisateur($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Reservation>
     */
    public function getEvenement(): Collection
    {
        return $this->evenement;
    }


    public function getSalt()
    {
        // Pas nécessaire si vous utilisez bcrypt ou argon2i
        return null;
    }

    public function getUsername()
    {
        // Utilisez la propriété qui représente votre identifiant utilisateur
        return $this->email;
    }

    public function getRoles(): array
    {
        return [];
        // TODO: Implement getRoles() method.
    }

    public function eraseCredentials(): void
    {
        // TODO: Implement eraseCredentials() method.
    }

    public function getUserIdentifier(): string
    {
        return '';
        // TODO: Implement getUserIdentifier() method.
    }

    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): static
    {
        $this->isVerified = $isVerified;

        return $this;
    }

    /**
     * @return Collection<int, Reservation>
     */
    public function getReservations(): Collection
    {
        return $this->reservations;
    }

    public function addReservation(Reservation $reservation): static
    {
        if (!$this->reservations->contains($reservation)) {
            $this->reservations->add($reservation);
            $reservation->setUtilisateur($this);
        }

        return $this;
    }

    public function removeReservation(Reservation $reservation): static
    {
        if ($this->reservations->removeElement($reservation)) {
            // set the owning side to null (unless already changed)
            if ($reservation->getUtilisateur() === $this) {
                $reservation->setUtilisateur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Evenement>
     */
    public function getEvenementss(): Collection
    {
        return $this->evenementss;
    }

    public function addEvenementss(Evenement $evenementss): static
    {
        if (!$this->evenementss->contains($evenementss)) {
            $this->evenementss->add($evenementss);
            $evenementss->setUtilisateur($this);
        }

        return $this;
    }

    public function removeEvenementss(Evenement $evenementss): static
    {
        if ($this->evenementss->removeElement($evenementss)) {
            // set the owning side to null (unless already changed)
            if ($evenementss->getUtilisateur() === $this) {
                $evenementss->setUtilisateur(null);
            }
        }

        return $this;
    }
}


