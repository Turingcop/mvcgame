<?php

declare(strict_types=1);

namespace siev20\yatzy;

use PHPUnit\Framework\TestCase;

class YatzyHandTest extends TestCase
{
    public function testCreateYatzyHand()
    {
        $hand = new YatzyHand("siev20\Dice\DiceGraphic", 5);
        $this->assertInstanceOf(YatzyHand::class, $hand);
    }

    public function testRoll()
    {
        $hand = new YatzyHand("siev20\Dice\DiceGraphic", 5);
        $res = $hand->roll();
        foreach ($res as $die) {
            $res = $die->getLastRoll() <= 6 && $die->getLastRoll() >= 1;
            $this->assertTrue($res);
        }
    }

    public function testCheckBox()
    {
        $hand = new YatzyHand("siev20\Dice\DiceGraphic", 5);
        $hand->roll();
        $res = $hand->checkDice();
        foreach ($res as $val) {
            $this->assertStringContainsString("<input type='checkbox'", $val);
        }
    }

    public function testSaveDice()
    {
        $hand = new YatzyHand("siev20\Dice\DiceGraphic", 5);
        $hand->roll();
        $res = implode(",", $hand->getLastGraphic());
        foreach ([0, 1, 2, 3, 4] as $val) {
            $hand->saveDice($val);
        };
        $this->assertSame([0, 1, 2, 3, 4], $hand->returnSaveArr());
        $hand->roll();
        $res1 = implode(",", $hand->getLastGraphic());
        $this->assertSame($res, $res1);
    }

    public function testResetSave()
    {
        $hand = new YatzyHand("siev20\Dice\DiceGraphic", 5);
        $hand->roll();
        $res = implode(",", $hand->getLastGraphic());
        foreach ([0, 1, 2, 3, 4] as $val) {
            $hand->saveDice($val);
        };
        $this->assertSame([0, 1, 2, 3, 4], $hand->returnSaveArr());
        $hand->resetSave();
        $hand->roll();
        $res1 = implode(",", $hand->getLastGraphic());
        $this->assertNotEquals($res, $res1);
        $this->assertSame([], $hand->returnSaveArr());
    }
}
