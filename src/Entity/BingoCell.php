<?php

namespace App\Entity;

use App\Repository\BingoCellRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BingoCellRepository::class)]
class BingoCell
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    private int $id;

    #[ORM\Column(type: 'string', length: 255)]
    private string $content;

    #[ORM\ManyToOne(targetEntity: Bingo::class, inversedBy: 'cells')]
    private Bingo $bingo;

    public function getId(): int
    {
        return $this->id;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
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
}
