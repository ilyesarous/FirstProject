<?php

namespace App\Entity;

use App\Repository\ShowRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ShowRepository::class)]
#[ORM\Table(name: '`show`')]
class Show
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $numShow = null;

    #[ORM\Column]
    private ?int $nbrSeat = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateShow = null;

    #[ORM\ManyToOne(inversedBy: 'shows')]
    private ?TheaterPlay $theaterPlays = null;

    public function getNumShow(): ?int
    {
        return $this->numShow;
    }

    public function getNbrSeat(): ?int
    {
        return $this->nbrSeat;
    }

    public function setNbrSeat(int $nbrSeat): static
    {
        $this->nbrSeat = $nbrSeat;

        return $this;
    }

    public function getDateShow(): ?\DateTimeInterface
    {
        return $this->dateShow;
    }

    public function setDateShow(\DateTimeInterface $dateShow): static
    {
        $this->dateShow = $dateShow;

        return $this;
    }

    public function getTheaterPlays(): ?TheaterPlay
    {
        return $this->theaterPlays;
    }

    public function setTheaterPlays(?TheaterPlay $theaterPlays): static
    {
        $this->theaterPlays = $theaterPlays;

        return $this;
    }
}
