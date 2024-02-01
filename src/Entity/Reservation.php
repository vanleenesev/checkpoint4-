<?php

namespace App\Entity;

use App\Repository\ReservationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReservationRepository::class)]
class Reservation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;


    #[ORM\Column]
    private ?int $UtilisateurID = null;

    #[ORM\Column]
    private ?int $ÉvénementID = null;

    #[ORM\Column]
    private ?int $NbrBilletMax = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $DateReservation = null;

    #[ORM\ManyToOne(inversedBy: 'Evenement')]
    private ?Utilisateur $Utilisateur = null;

    #[ORM\ManyToOne(inversedBy: 'reservations')]
    private ?Utilisateur $utilisateur = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setID(int $ID): static
    {
        $this->ID = $ID;

        return $this;
    }

    public function getUtilisateurID(): ?int
    {
        return $this->UtilisateurID;
    }

    public function setUtilisateurID(int $UtilisateurID): static
    {
        $this->UtilisateurID = $UtilisateurID;

        return $this;
    }

    public function getÉvénementID(): ?int
    {
        return $this->ÉvénementID;
    }

    public function setÉvénementID(int $ÉvénementID): static
    {
        $this->ÉvénementID = $ÉvénementID;

        return $this;
    }

    public function getNbrBilletMax(): ?int
    {
        return $this->NbrBilletMax;
    }

    public function setNbrBilletMax(int $NbrBilletMax): static
    {
        $this->NbrBilletMax = $NbrBilletMax;

        return $this;
    }

    public function getDateReservation(): ?\DateTimeInterface
    {
        return $this->DateReservation;
    }

    public function setDateReservation(\DateTimeInterface $DateReservation): static
    {
        $this->DateReservation = $DateReservation;

        return $this;
    }

    public function getUtilisateur(): ?Utilisateur
    {
        return $this->Utilisateur;
    }

    public function setUtilisateur(?Utilisateur $Utilisateur): static
    {
        $this->Utilisateur = $Utilisateur;

        return $this;
    }
}
