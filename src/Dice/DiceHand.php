<?php

declare(strict_types=1);

namespace siev20\Dice;

class DiceHand
{
    protected array $diceArr;
    protected int $sum;
    public $rolls = [];

    public function __construct($dice, $amount)
    {
        for ($i = 0; $i < $amount; $i++) {
            $this->diceArr[$i] = new $dice();
        }
        $this->sum = 0;
    }

    public function roll()
    {
        $len = count($this->diceArr);
        for ($i = 0; $i < $len; $i++) {
            $this->sum += $this->diceArr[$i]->roll();
        }
        return $this->diceArr;
    }

    public function getLastRoll()
    {
        $len = count($this->diceArr);
        $res = [];
        $sum = 0;
        for ($i = 0; $i < $len; $i++) {
            $res[$i] = $this->diceArr[$i]->getLastRoll();
            $sum += $this->diceArr[$i]->getLastRoll();
        }
        $this->rolls[] = implode(", ", $res) . " = " . $sum;
        return [$res, $sum];
    }

    public function getSum(): int
    {
        return $this->sum;
    }

    public function setSum($num)
    {
        $this->sum = $num;
    }
}
