<?php

declare(strict_types=1);

namespace siev20\Controller;

use PHPUnit\Framework\TestCase;

class GameControllerTest extends TestCase
{
    public function testresponse()
    {
        $controller = new GameControl();
        $exp = "\Psr\Http\Message\ResponseInterface";
        $res = $controller->start();
        $this->assertInstanceOf(GameControl::class, $controller);
        $this->assertInstanceOf($exp, $res);
    }

    public function testplay()
    {
        $controller = new GameControl();
        $res = $controller->play();
        $exp = "\Psr\Http\Message\ResponseInterface";

        $this->assertInstanceof($exp, $res);
    }

    public function testPlayerRoll()
    {
        $controller = new GameControl();
        $controller->start();
        $controller->play();
        $res = $controller->playerRoll();
        $exp = "\Psr\Http\Message\ResponseInterface";

        $this->assertInstanceof($exp, $res);
    }

    public function testComputerRoll()
    {
        $controller = new GameControl();
        $controller->start();
        $controller->play();
        $res = $controller->computerRoll();
        $exp = "\Psr\Http\Message\ResponseInterface";

        $this->assertInstanceof($exp, $res);
    }

    public function testReset()
    {
        $controller = new GameControl();
        $controller->start();
        $controller->play();
        $controller->playerRoll();
        $controller->computerRoll();

        $res = $_SESSION["computerscore"] > 0 || $_SESSION["playerscore"] > 0;
        $this->assertTrue($res);

        $controller->reset();
        $res = $_SESSION["computerscore"] == 0 && $_SESSION["playerscore"] == 0;
        $this->assertTrue($res);
    }
}
