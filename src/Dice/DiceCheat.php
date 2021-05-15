<?php

declare(strict_types=1);

namespace siev20\Dice;

class DiceCheat extends DiceGraphic
{
    public function roll(): int
    {
        $this->roll = 6;
        return $this->roll;
    }
}
