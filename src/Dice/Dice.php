<?php

declare(strict_types=1);

namespace siev20\Dice;

class Dice
{
    protected ?int $roll = null;
    private int $faces;

    public function __construct(int $faces = 6)
    {
        $this->faces = $faces;
    }

    public function roll(): int
    {
        $this->roll = rand(1, $this->faces);
        return $this->roll;
    }

    public function getLastRoll(): int
    {
        return $this->roll;
    }
}
