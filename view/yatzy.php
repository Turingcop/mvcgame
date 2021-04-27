<?php

/**
 * Standard view template to generate a simple web page, or part of a web page.
 */

declare(strict_types=1);

// use siev20\Dice\Dice;
// use siev20\Dice\DiceHand;

// $header = "Yatzy";
// $title = "Yatzy";
$message = $message ?? null;
$hand = $hand ?? null;
// $playform = $playform ?? null;
// $nextform = $nextform ?? null;
// $result = $result ?? null;
// $resetform = $resetform ?? null;
$playerroll = $playerroll ?? null;
$playerroll1 = $playerroll1 ?? null;
$checkbox = $checkbox ?? null;
$action = $action ?? null;
$playlabel = $playlabel ?? null;
$present = $present ?? null;

?>
<div class="yatzy">
<h1><?= $header ?></h1>

<!-- <p class="dice"><?= $playerroll ?></p>
<p class="dice1"><?= $playerroll1 ?></p> -->
<div>

<form method="POST" action='<?= $action ?>' class="dicecheck">
    <?= $present ?>
    <?= $checkbox ?>
    <br>
    <br>
    <input type="submit" value=<?= $playlabel ?>>
</form>
</div>


</div>

Slag
<br>
<?= $_SESSION["game"]->rolls; ?>
<br>
Poäng
<br>
<?= $_SESSION["game"]->scoreboard(); ?>
<br>
Runda
<br>
<?= $_SESSION["game"]->round ?>
<br>
Senaste slag
<br>
<?= implode(", ", $hand->getLastRoll()); ?>
<br>
<?= $_SESSION["game"]->calcSum(); ?>