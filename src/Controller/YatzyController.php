<?php

declare(strict_types=1);

namespace siev20\Controller;

use siev20\yatzy\{YatzyHand,
    Yatzy
};

use function Mos\Functions\{renderView,
    url,
    destroySession
};

/**
 * Controller for the yatzy route.
 */
class YatzyController extends ControllerBase
{
    public function start()
    {
        $game = new Yatzy("siev20\yatzy\YatzyHand", "siev20\Dice\DiceGraphic", 5);
        $_SESSION["game"] = $game;
        $body = $game->presentGame();
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
