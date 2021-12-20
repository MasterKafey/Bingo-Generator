<?php

namespace App\Entity;

use App\Repository\BingoCardCellRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BingoCardCellRepository::class)]
class BingoCardCell
{
    const UNCHECK_STATE = 'UNCHECK_STATE';
    const CHECK_STATE = 'CHECK_STATE';

    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    private int $id;

    #[ORM\Column(type: 'string', length: 50)]
    private string $state = self::UNCHECK_STATE;

    #[ORM\ManyToOne(targetEntity: BingoCell::class)]
    private BingoCell $bingoCell;

    #[ORM\ManyToOne(targetEntity: BingoCard::class)]
    private BingoCard $bingoCard;

    public function getId(): int
    {
        return $this->id;
    }

    public function getState(): string
    {
        return $this->state;
    }

    public function setState(string $state): self
    {
        $this->state = $state;

        return $this;
    }

    public function getBingoCell(): BingoCell
    {
        return $this->bingoCell;
    }

    public function setBingoCell(BingoCell $bingoCell): self
    {
        $this->bingoCell = $bingoCell;

        return $this;
    }

    public function getBingoCard(): BingoCard
    {
        return $this->bingoCard;
    }

    public function setBingoCard(BingoCard $bingoCard): self
    {
        $this->bingoCard = $bingoCard;

        return $this;
    }
}
