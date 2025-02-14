<?php

namespace App\Entity;

use App\Repository\GameRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GameRepository::class)]
class Game
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'games')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $Local = null;

    #[ORM\Column(nullable: true)]
    private ?int $result = null;

    #[ORM\ManyToOne(inversedBy: 'games')]
    private ?User $away = null;

    #[ORM\ManyToOne(inversedBy: 'games')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Card $localCard = null;

    #[ORM\ManyToOne(inversedBy: 'games')]
    private ?Card $awayCard = null;

    #[ORM\ManyToOne(inversedBy: 'away_card_id_2')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Card $local_card_2 = null;

    #[ORM\ManyToOne]
    private ?Card $away_card_2 = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLocal(): ?User
    {
        return $this->Local;
    }

    public function setLocal(?User $Local): static
    {
        $this->Local = $Local;

        return $this;
    }

    public function getResult(): ?int
    {
        return $this->result;
    }

    public function setResult(?int $result): static
    {
        $this->result = $result;

        return $this;
    }

    public function getAway(): ?User
    {
        return $this->away;
    }

    public function setAway(?User $away): static
    {
        $this->away = $away;

        return $this;
    }

    public function getLocalCard(): ?Card
    {
        return $this->localCard;
    }

    public function setLocalCard(?Card $localCard): static
    {
        $this->localCard = $localCard;

        return $this;
    }

    public function getAwayCard(): ?Card
    {
        return $this->awayCard;
    }

    public function setAwayCard(?Card $awayCard): static
    {
        $this->awayCard = $awayCard;

        return $this;
    }

    public function getLocalCard2(): ?Card
    {
        return $this->local_card_2;
    }

    public function setLocalCard2(?Card $local_card_2): static
    {
        $this->local_card_2 = $local_card_2;

        return $this;
    }

    public function getAwayCardId2(): ?Card
    {
        return $this->away_card_2;
    }

    public function setAwayCardId2(?Card $away_card_2): static
    {
        $this->away_card_2 = $away_card_2;

        return $this;
    }
}
