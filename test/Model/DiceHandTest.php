<?php

declare(strict_types=1);

namespace siev20\Dice;

use PHPUnit\Framework\TestCase;

class DiceHandTest extends TestCase
{
    public function testCreateDiceHand()
    {
        $controller = new DiceHand("siev20\Dice\Dice", 3);
        $this->assertInstanceOf("siev20\Dice\DiceHand", $controller);
    }

    public function testRollDiceHand()
    {
        $controller = new DiceHand("siev20\Dice\Dice", 2);
        $res = $controller->roll();
        $exp = $res[0]->getLastRoll() <= 6 && $res[0]->getLastRoll() >= 1;
        $exp1 = $res[1]->getLastRoll() <= 6 && $res[1]->getLastRoll() >= 1;
        $this->assertTrue($exp);
        $this->assertTrue($exp1);
    }

    public function testGetLastRoll()
    {
        $controller = new DiceHand("siev20\Dice\Dice", 2);
        $controller->roll();
        $res = $controller->getLastRoll();
        $exp = $res[0][0] + $res[0][1] == $res[1];
        
        $this->assertTrue($exp);
    }

    public function testGetSum()
    {
        $controller = new DiceHand("siev20\Dice\Dice", 1);
        $controller->roll();
        $res = $controller->getSum();
        $exp = $res <= 6 && $res >= 1;
        $this->assertTrue($exp); 

        $controller = new DiceHand("siev20\Dice\Dice", 3);
        $controller->roll();
        $res = $controller->getSum();
        $exp = $res <= 18 && $res >= 3;
        $this->assertTrue($exp); 
    }

    public function testSetSum()
    {
        $controller = new DiceHand("siev20\Dice\Dice", 1);
        $controller->setSum(21);
        $this->assertEquals(21, $controller->getSum());
    }
}