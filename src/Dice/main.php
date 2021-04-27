<?php

require __DIR__ . "/../../vendor/autoload.php";

use siev20\Dice\Dice;
use siev20\Dice\DiceGraphic;
use siev20\Dice\DiceHand;

$dice = new Dice(20);

$graphdie = new DiceGraphic();


$diceHand = new DiceHand(10);
$diceHand->roll();
echo $diceHand->getLastRoll();
