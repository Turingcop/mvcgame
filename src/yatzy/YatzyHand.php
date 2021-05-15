<?php

declare(strict_types=1);

namespace siev20\yatzy;

use siev20\Dice\DiceHand;

class YatzyHand extends DiceHand
{

    private $saveDice = [];

    public function roll()
    {
        $len = count($this->diceArr);
        for ($i = 0; $i < $len; $i++) {
            if (! in_array($i, $this->saveDice)) {
                $this->diceArr[$i]->roll();
            }
        }
        return $this->diceArr;
    }

    public function getLastGraphic(): array
    {
        $res = [];
        foreach ($this->diceArr as $dice) {
            $res[] = $dice->graphic();
        }
        return $res;
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

    public function returnSaveArr()
    {
        return $this->saveDice;
    }
}
