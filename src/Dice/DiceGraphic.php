<?php

declare(strict_types=1);

namespace siev20\Dice;

class DiceGraphic extends Dice
{
    protected const FACES = 6;
    protected array $graphic = [
        1 => "⚀",
        2 => "⚁",
        3 => "⚂",
        4 => "⚃",
        5 => "⚄",
        6 => "⚅"
    ];

    public function __construct()
    {
        parent::__construct(self::FACES);
    }

    public function graphic(): string
    {
        return $this->graphic[$this->getLastRoll()];
    }
}
