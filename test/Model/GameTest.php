<?php

declare(strict_types=1);

namespace siev20\Dice;

use PHPUnit\Framework\TestCase;

class GameTest extends TestCase
{
    public function testCreateDiceGame()
    {
        $game = new Game;
        $this->assertInstanceOf(Game::class, $game);
    }

    public function testSetup()
    {
        $game = new Game;
        $res = $game->setUp();
        $this->assertIsString($res);
    }

    public function testPlay()
    {
        $game = new Game;
        $res = $game->playGame();
        $this->assertIsString($res);
    }

    public function testPlayerWin()
    {
        $game = new Game;
        $game->playGame();
        $game->roll(21);
        $game->computerRoll(22);
        $exp = $_SESSION["playerscore"] == 1 && $_SESSION["computerscore"] == 0;
        $this->assertTrue($exp);
    }

    public function testComputerWin()
    {
        $game = new Game;
        $game->playGame();
        $game->roll(20);
        $game->computerRoll(21);
        $exp = $_SESSION["computerscore"] == 1;
        $this->assertTrue($exp);
    }

    public function testPlayerOver21()
    {
        $game = new Game;
        $game->playGame();
        $game->roll(22);
        $exp = $_SESSION["computerscore"] == 2;
        $this->assertTrue($exp);
    }

}