<?php

declare(strict_types=1);

namespace siev20\Dice;

use PHPUnit\Framework\TestCase;

class GraphicDiceTest extends TestCase
{
    public function testCreateGraphicDice()
    {
        $controller = new DiceGraphic();
        $this->assertInstanceOf("siev20\Dice\DiceGraphic", $controller);
    }

    public function testReturnGraphic()
    {
        $controller = new DiceGraphic();
        $controller->roll();
        $res = $controller->graphic();
        $exp = $res == "⚀" ||
               $res == "⚁" ||
               $res == "⚂" ||
               $res == "⚃" ||
               $res == "⚄" ||
               $res == "⚅";
        $this->assertTrue($exp);
    }
}
