<?php

declare(strict_types=1);

namespace siev20\Dice;
use siev20\Dice\Dice;

// use function Mos\Functions\{
//     destroySession,
//     redirectTo,
//     renderView,
//     renderTwigView,
//     sendResponse,
//     url
// };

/**
 * Class Dice.
 */
class DiceGraphic extends Dice
{
    private const FACES = 6;
    private array $graphic = [
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

    // private ?int $roll = null;

    public function graphic(): string 
    {
        return $this->graphic[$this->getLastRoll()];
    }
}
