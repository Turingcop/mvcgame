<?php

/**
 * Standard view template to generate a simple web page, or part of a web page.
 */

declare(strict_types=1);

$header = $header ?? null;
$message = $message ?? null;
$hand = $hand ?? null;
$playform = $playform ?? null;
$nextform = $nextform ?? null;
$result = $result ?? null;
$resetform = $resetform ?? null;

?>
<div class="game21">
<h1><?= $header ?></h1>

<p><?= $message ?></p>

<div class="playbtn">
<?= $playform ?><?= $nextform ?>
</div>

<?php if ($hand) : ?>
    <p>
        <?= $throwlabel ?>
    </p>
    <p>
        <?php
        $len = count($hand->rolls);
        for ($i = 0; $i < $len; $i++) {
            echo $hand->rolls[$i] . "<br>";
        }
        ?>
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
<?= $_SESSION["playerscore"] ?>
<br>
Dator:
<?= $_SESSION["computerscore"] ?>
<br>
<p>
<?= $resetform ?>
</p>
</div>