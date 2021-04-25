<?php

declare(strict_types=1);

namespace siev20\Controller;

use Nyholm\Psr7\Factory\Psr17Factory;
use Psr\Http\Message\ResponseInterface;

use function Mos\Functions\{renderView,
    url,
    destroySession
};

use siev20\Dice\DiceHand;
use siev20\Dice\Game;

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
        $body = $_SESSION["game"]->playGame();
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
        destroySession();
        return $this->redirect(url("/dice"));
    }
}
