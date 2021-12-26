<?php

namespace App\Entity;

use App\Repository\UserConfigurationRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserConfigurationRepository::class)]
class UserConfiguration
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    private int $id;

    #[ORM\Column(type: 'string', length: 7)]
    private string $bingoBackgroundColor = '#ffffff';

    #[ORM\Column(type: 'string', length: 7)]
    private string $bingoButtonUncheckedColor = '#ffffff';

    #[ORM\Column(type: 'string', length: 7)]
    private string $bingoButtonCheckingColor = '#ffffff';

    #[ORM\Column(type: 'string', length: 7)]
    private string $bingoButtonCheckedColor = '#ffffff';

    public function getId(): int
    {
        return $this->id;
    }

    public function getBingoBackgroundColor(): string
    {
        return $this->bingoBackgroundColor;
    }

    public function setBingoBackgroundColor(string $bingoBackgroundColor): self
    {
        $this->bingoBackgroundColor = $bingoBackgroundColor;

        return $this;
    }

    public function getBingoButtonUncheckedColor(): string
    {
        return $this->bingoButtonUncheckedColor;
    }

    public function setBingoButtonUncheckedColor(string $bingoButtonUncheckedColor): self
    {
        $this->bingoButtonUncheckedColor = $bingoButtonUncheckedColor;

        return $this;
    }

    public function getBingoButtonCheckingColor(): string
    {
        return $this->bingoButtonCheckingColor;
    }

    public function setBingoButtonCheckingColor(string $bingoButtonCheckingColor): self
    {
        $this->bingoButtonCheckingColor = $bingoButtonCheckingColor;

        return $this;
    }

    public function getBingoButtonCheckedColor(): string
    {
        return $this->bingoButtonCheckedColor;
    }

    public function setBingoButtonCheckedColor(string $bingoButtonCheckedColor): self
    {
        $this->bingoButtonCheckedColor = $bingoButtonCheckedColor;

        return $this;
    }
}
