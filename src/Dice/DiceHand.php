<?php

declare(strict_types=1);

namespace siev20\Dice;

/**
 * Class Dice.
 */
class DiceHand
{
    private array $diceArr;
    private int $sum;
    private $throws = [];

    public function __construct($dices = 3)
    {
        for ($i = 0; $i < $dices; $i++) {
            $this->diceArr[$i] = new Dice();
        }
        $this->sum = 0;
    }

    public function roll(): void
    {
        $len = count($this->diceArr);
        for ($i = 0; $i < $len; $i++) {
            $this->sum += $this->diceArr[$i]->roll();
        }
        $this->getLastRoll();
    }

    public function getLastRoll(): string
    {
        $len = count($this->diceArr);
        $res = [];
        $sum = 0;
        for ($i = 0; $i < $len; $i++) {
            $res[$i] = $this->diceArr[$i]->getLastRoll();
            $sum += $this->diceArr[$i]->getLastRoll();
        }
        if ($len > 1) {
            $this->throws[] = implode(", ", $res) . " = " . $sum;
            return implode(", ", $res) . " = " . $sum;
        }
        $this->throws[] = implode($res);
        return implode(", ", $res) . " = " . $sum;
    }

    public function getThrows()
    {
        $len = count($this->throws);
        for ($i = 0; $i < $len; $i++) {
            echo $this->throws[$i] . "<br>";
        }
    }

    public function getSum(): int
    {
        return $this->sum;
    }
}
