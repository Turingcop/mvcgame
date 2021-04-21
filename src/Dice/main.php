<?php

require __DIR__ . "/../../vendor/autoload.php";

use siev20\Dice\Dice;
use siev20\Dice\DiceGraphic;
use siev20\Dice\DiceHand;

$dice = new Dice(20);
// $dice->faces = 12;

// for ($i = 0; $i < 9; $i++) {
//     $dice->roll();
//     echo $dice->getLastRoll() . ", ";
// }

// echo "\n";
// echo $dice->getLastRoll();
// echo "\n";

$graphdie = new DiceGraphic();


$diceHand = new DiceHand(10);
$diceHand->roll();
echo $diceHand->getLastRoll();
