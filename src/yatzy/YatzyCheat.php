<?php

declare(strict_types=1);

namespace siev20\yatzy;

trait YatzyCheat
{
    public function cheatScore()
    {
        $this->scoreboard = [
            1 => 3,
            2 => 3,
            3 => 3,
            4 => 3,
            5 => 3,
            6 => 3,
            "summa" => 0,
            "bonus" => 0
        ];
    }
}
