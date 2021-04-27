<?php

/**
 * Standard view template to generate a simple web page, or part of a web page.
 */

declare(strict_types=1);

$message = $message ?? null;
$checkbox = $checkbox ?? null;
$action = $action ?? null;
$playlabel = $playlabel ?? null;
$present = $present ?? null;
$score = $score ?? null;

?>
<div class="yatzy">
<h1><?= $header ?></h1>
<div>

<form method="POST" action='<?= $action ?>' class="dicecheck">
    <?= $present ?>
    <?= $checkbox ?>
    <br>
    <br>
    <input type="submit" value='<?= $playlabel ?>'>
</form>
</div>

<table style="width:100%">
  <tr>
    <th colspan="2">Poäng</th>
  </tr>
<tr>
    <td>Ettor</td>
    <td><?= $score[1] * 1 ?></td>
</tr>
<tr>
    <td>Tvåor</td>
    <td><?= $score[2] * 2 ?></td>
</tr>
<tr>
    <td>Treor</td>
    <td><?= $score[3] * 3 ?></td>
</tr>
<tr>
    <td>Fyror</td>
    <td><?= $score[4] * 4 ?></td>
</tr>
<tr>
    <td>Femor</td>
    <td><?= $score[5] * 5 ?></td>
</tr>
<tr>
    <td>Sexor</td>
    <td><?= $score[6] * 6 ?></td>
</tr>
<tr>
    <td>Summa</td>
    <td><?= $score["summa"]?></td>
</tr>
<tr>
    <td>Bonus</td>
    <td><?= $score["bonus"]?></td>
</tr>
</table> 
</div>