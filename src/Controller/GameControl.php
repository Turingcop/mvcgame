<?php

declare(strict_types=1);

namespace siev20\Controller;

use Nyholm\Psr7\Factory\Psr17Factory;
use Psr\Http\Message\ResponseInterface;
use siev20\Dice\DiceHand;
use siev20\Dice\Game;

use function Mos\Functions\{renderView,
    url,
    destroySession
};

/**
 * Controller for the dicegame route.
 */
class GameControl extends ControllerBase
{
    public function start()
    {
        $_SESSION["game"] = new Game();
        $body = $_SESSION["game"]->setUp();
        return $this->response($body);
    }

    public function play()
    {
        $body = $_SESSION["game"]->playGame("siev20\Dice\Dice");
        return $this->response($body);
    }

    public function playerRoll()
    {
        $body = $_SESSION["game"]->roll();
        return $this->response($body);
    }

    public function computerRoll()
    {
        $body = $_SESSION["game"]->computerroll();
        return $this->response($body);
    }

    public function reset()
    {
        $_SESSION["playerscore"] = 0;
        $_SESSION["computerscore"] = 0;
        return $this->redirect(url("/dice"));
    }
}
