<?php

declare(strict_types=1);

namespace siev20\yatzy;

/**
 * Class Dice.
 */
class DiceHand
{
    private array $diceArr;
    private int $sum;
    // public $rolls = 0;
    private $saveDice = [];

    public function __construct($dices = 3)
    {
        for ($i = 0; $i < $dices; $i++) {
            $this->diceArr[$i] = new DiceGraphic();
        }
        $this->sum = 0;
    }

    public function roll(): void
    {
        $len = count($this->diceArr);
        for ($i = 0; $i < $len; $i++) {
            if (! in_array($i, $this->saveDice)) {
                $this->diceArr[$i]->roll();
            }
        }
    }

    public function getLastRoll()
    {
        $len = count($this->diceArr);
        $res = [];
        for ($i = 0; $i < $len; $i++) {
            $res[$i] = $this->diceArr[$i]->getLastRoll();
        }
        return $res;
    }

    public function allSix()
    {
        foreach ($this->diceArr as $die) {
            $die->setSix();
        }
        return $this->getLastGraphic();
    }

    public function getLastGraphic(): array
    {
        $res = [];
        foreach ($this->diceArr as $dice) {
            $res[] = $dice->graphic();
        }
        return $res;
    }

    public function getSum(): int
    {
        return $this->sum;
    }

    public function checkDice($disable = null)
    {
        $res = $this->getLastGraphic();
        $die = 0;
        $checkbox = [];
        foreach ($res as $val) {
            $checkbox[] = "<input type='checkbox' {$disable} name='dice[]' value={$die} id='{$die}'/><label for='{$die}'>{$val}</label>";
            $die++;
        }
        return $checkbox;
    }


    public function saveDice($die)
    {
        $this->saveDice[] = $die;
    }

    public function resetSave()
    {
        $this->saveDice = [];
    }
}
