<?php

namespace App\Entity;

use App\Repository\CardRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CardRepository::class)]
class Card
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $number = null;

    #[ORM\Column(length: 255)]
    private ?string $suit = null;

    /**
     * @var Collection<int, Game>
     */
    #[ORM\OneToMany(targetEntity: Game::class, mappedBy: 'localCard')]
    private Collection $games;

    /**
     * @var Collection<int, Game>
     */
    #[ORM\OneToMany(targetEntity: Game::class, mappedBy: 'local_card_2')]
    private Collection $away_card_2;

    public function __construct()
    {
        $this->games = new ArrayCollection();
        $this->away_card_2 = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumber(): ?int
    {
        return $this->number;
    }

    public function setNumber(int $number): static
    {
        $this->number = $number;

        return $this;
    }

    public function getSuit(): ?string
    {
        return $this->suit;
    }

    public function setSuit(string $suit): static
    {
        $this->suit = $suit;

        return $this;
    }

    /**
     * @return Collection<int, Game>
     */
    public function getGames(): Collection
    {
        return $this->games;
    }

    public function addGame(Game $game): static
    {
        if (!$this->games->contains($game)) {
            $this->games->add($game);
            $game->setLocalCard($this);
        }

        return $this;
    }

    public function removeGame(Game $game): static
    {
        if ($this->games->removeElement($game)) {
            // set the owning side to null (unless already changed)
            if ($game->getLocalCard() === $this) {
                $game->setLocalCard(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Game>
     */
    public function getAwayCardId2(): Collection
    {
        return $this->away_card_2;
    }

    public function addAwayCardId2(Game $awayCardId2): static
    {
        if (!$this->away_card_2->contains($awayCardId2)) {
            $this->away_card_2->add($awayCardId2);
            $awayCardId2->setLocalCardId2($this);
        }

        return $this;
    }

    public function removeAwayCardId2(Game $awayCardId2): static
    {
        if ($this->away_card_2->removeElement($awayCardId2)) {
            // set the owning side to null (unless already changed)
            if ($awayCardId2->getLocalCardId2() === $this) {
                $awayCardId2->setLocalCardId2(null);
            }
        }

        return $this;
    }
}
