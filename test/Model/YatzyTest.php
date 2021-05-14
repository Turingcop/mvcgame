<?php

declare(strict_types=1);

namespace siev20\yatzy;

use PHPUnit\Framework\TestCase;

class YatzyTest extends TestCase
{
    public function testCreateYatzy()
    {
        $yatzy = new Yatzy("siev20\yatzy\YatzyHand", "siev20\Dice\DiceGraphic", 5);
        $this->assertInstanceOf(Yatzy::class, $yatzy);
    }

    public function testPresentGame()
    {
        $yatzy = new Yatzy("siev20\yatzy\YatzyHand", "siev20\Dice\DiceGraphic", 5);
        $res = $yatzy->presentGame();
        $this->assertIsString($res);
    }

    public function testPlay()
    {
        $yatzy = new Yatzy("siev20\yatzy\YatzyHand", "siev20\Dice\DiceGraphic", 5);
        $res = $yatzy->playGame();
        $this->assertIsString($res);
    }

    public function testPlayThrough()
    {
        $yatzy = new Yatzy("siev20\yatzy\YatzyHand", "siev20\Dice\DiceGraphic", 5);
        $yatzy->presentGame();
        for ($i = 0; $i <= 6; $i++) {
            for ($j = 0; $j <= 3; $j++) {
                $_POST["dice"] = [$i - 1];
                $yatzy->playGame();
            }
        }
        $res = $yatzy->calcScore();
        $this->assertIsInt($res["score"]);
    }

    public function testBonus()
    {
        $yatzy = new Yatzy("siev20\yatzy\YatzyHand", "siev20\Dice\DiceGraphic", 5);
        $yatzy->cheatScore();
        $res = $yatzy->calcScore();
        $this->assertEquals(50, $res["scoreboard"]["bonus"]);
    }
}