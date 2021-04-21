<?php

/**
 * Standard view template to generate a simple web page, or part of a web page.
 */

declare(strict_types=1);

use siev20\Dice\Dice;
use siev20\Dice\DiceHand;

$header = $header ?? null;
$message = $message ?? null;
$hand = $hand ?? null;
$playform = $playform ?? null;
$nextform = $nextform ?? null;
$result = $result ?? null;
// $restartform = $restartform ?? null;
$resetform = $resetform ?? null;

?><h1><?= $header ?></h1>

<p><?= $message ?></p>

<?= $playform ?>
<?= $nextform ?>

<?php if ($hand !== null) : ?>
    <p>
        <?= $throwlabel ?>
        </p>
        <p>
        <?= $hand->getThrows(); ?>
        </p>
        <p>
        Summa
        <?= $hand->getSum(); ?>
    </p>
    <?php endif; ?>
<h2><?= $result ?></h2>
Ställning
<br>
Spelare: 
<?= $_SESSION["playerscore"] ?><br>
Dator:
<?= $_SESSION["computerscore"] ?><br>
<!-- <?= $restartform ?> -->
<?= $resetform ?>
