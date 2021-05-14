<?php

declare(strict_types=1);

namespace siev20\Dice;

use PHPUnit\Framework\TestCase;

class DiceTest extends TestCase
{
    public function testCreateDice()
    {
        $controller = new Dice();
        $this->assertInstanceOf("siev20\Dice\Dice", $controller);
    }

    public function testRollDice()
    {
        $controller = new Dice();
        $res = $controller->roll();
        $exp = 6 >= $res && $res >= 1;
        $this->assertTrue($exp);
    }

    public function testLastRoll()
    {
        $controller = new Dice();
        $controller->roll();
        $exp = 6 >= $controller->getLastRoll() && 1 <= $controller->getLastRoll();
        $this->assertTrue($exp);
    }
}