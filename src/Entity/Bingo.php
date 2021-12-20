<?php

namespace App\Entity;

use App\Repository\BingoRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BingoRepository::class)]
class Bingo
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    private int $id;

    #[ORM\Column(type: 'string', nullable: true)]
    private ?string $name;

    #[ORM\Column(type: 'datetime')]
    private \DateTime $creationDate;

    #[ORM\OneToMany(mappedBy: 'bingo', targetEntity: BingoCell::class, cascade: ['persist', 'remove'])]
    private iterable $cells;

    #[ORM\OneToMany(mappedBy: 'bingo', targetEntity: BingoCard::class, cascade: ['remove'])]
    private iterable $cards;

    #[ORM\ManyToOne(targetEntity: User::class)]
    private User $user;

    #[ORM\Column(type: 'integer')]
    private int $width = 3;

    #[ORM\Column(type: 'integer')]
    private int $height = 3;

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getCreationDate(): \DateTime
    {
        return $this->creationDate;
    }

    public function setCreationDate(\DateTime $creationDate): self
    {
        $this->creationDate = $creationDate;
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

    public function addCell(BingoCell $cell): self
    {
        $this->cells[] = $cell->setBingo($this);

        return $this;
    }

    public function getCards(): iterable
    {
        return $this->cells;
    }

    public function setCards(iterable $cards): self
    {
        $this->cards = [];

        foreach ($cards as $card) {
            $this->addCard($card);
        }

        return $this;
    }

    public function addCard(BingoCard $card): self
    {
        $this->cards[] = $card->setBingo($this);

        return $this;
    }

    public function setUser(User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function getWidth(): int
    {
        return $this->width;
    }

    public function setWidth(int $width): self
    {
        $this->width = $width;

        return $this;
    }

    public function getHeight(): int
    {
        return $this->height;
    }

    public function setHeight(int $height): self
    {
        $this->height = $height;

        return $this;
    }
}
