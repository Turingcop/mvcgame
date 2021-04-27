<?php

declare(strict_types=1);

namespace siev20\Controller;

use Nyholm\Psr7\Factory\Psr17Factory;
use Psr\Http\Message\ResponseInterface;
use siev20\Dice\DiceHand;
use siev20\yatzy\Yatzy;

use function Mos\Functions\{renderView,
    url,
    destroySession
};

/**
 * Controller for the dicegame route.
 */
class YatzyController extends ControllerBase
{
    public function start()
    {
        $_SESSION["game"] = new Yatzy();
        $body = $_SESSION["game"]->setUp();
        return $this->response($body);
    }

    public function play()
    {
        $body = $_SESSION["game"]->playGame();
        return $this->response($body);
    }

    public function reset()
    {
        destroySession();
        return $this->redirect(url("/yatzy"));
    }
}
