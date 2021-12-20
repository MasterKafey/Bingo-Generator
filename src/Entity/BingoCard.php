<?php

namespace App\Entity;

use App\Repository\BingoCardRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BingoCardRepository::class)]
class BingoCard
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    private int $id;

    #[ORM\ManyToOne(targetEntity: Bingo::class)]
    private Bingo $bingo;

    #[ORM\OneToMany(mappedBy: 'bingoCard', targetEntity: BingoCardCell::class, cascade: ['persist', 'remove'])]
    private iterable $cells;

    #[ORM\Column(type: 'datetime')]
    private \DateTime $creationDateTime;

    #[ORM\Column(type: 'datetime')]
    private \DateTime $lastUpdateDateTime;

    public function getId(): int
    {
        return $this->id;
    }

    public function getBingo(): Bingo
    {
        return $this->bingo;
    }

    public function setBingo(Bingo $bingo): self
    {
        $this->bingo = $bingo;

        return $this;
    }

    public function getCells(): iterable
    {
        return $this->cells;
    }

    public function setCells(iterable $cells): self
    {
        $this->cells = [];

        foreach ($cells as $cell) {
            $this->addCell($cell);
        }

        return $this;
    }

    public function addCell(BingoCardCell $cell): self
    {
        $this->cells[] = $cell->setBingoCard($this);

        return $this;
    }

    public function getCreationDateTime(): \DateTime
    {
        return $this->creationDateTime;
    }

    public function setCreationDateTime(\DateTime $creationDateTime): self
    {
        $this->creationDateTime = $creationDateTime;

        return $this;
    }

    public function getLastUpdateDateTime(): \DateTime
    {
        return $this->lastUpdateDateTime;
    }

    public function setLastUpdateDateTime(\DateTime $lastUpdateDateTime): self
    {
        $this->lastUpdateDateTime = $lastUpdateDateTime;

        return $this;
    }
}
