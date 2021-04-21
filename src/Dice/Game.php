<?php

declare(strict_types=1);

namespace siev20\Dice;

use function Mos\Functions\{
    redirectTo,
    renderView,
    sendResponse,
    destroySession,
    url
};

/**
 * Class Dice.
 */
class Game
{
    private $data;
    private $playerhand;
    private $computerhand;

    public function resetScore()
    {
    }

    public function setUp()
    {
        $data = [
            "header" => "Dice",
            "message" => "Välj att spela med en eller två tärningar.",
            "action" => url("/dice/start"),
            "reset" => url("/dice/reset"),
            "dices" => $_SESSION["dices"] ?? null,
           ];
        if (! isset($_SESSION["playerscore"])) {
            $_SESSION["playerscore"] = 0;
        }
        if (! isset($_SESSION["computerscore"])) {
            $_SESSION["computerscore"] = 0;
        }

        $data["resetform"] = "<form method='post' action={$data['reset']}><input type='submit' value='Nollställ'></form>";

        $data["playform"] = "<form method='post' action={$data['action']}>
        <p>
            <input type='radio' name='dices' value=1 checked='checked'>
            <label for=1>1</label>
        </p>
        <p>
            <input type='radio' name='dices' value=2>
            <label for=2>2</label>
        </p>
    
        <p>
            <input type='submit' value='Starta spelet'>
        </p>
    
        </form>";

        $body = renderView("layout/dice.php", $data);
        sendResponse($body);
    }

    public function playGame(): void
    {
        $data = [
         "header" => "Dice",
         "message" => "Tryck på knappen för att göra ditt första kast.",
         "dices" => $_SESSION["dices"] ?? null,
        ];

        $this->playerhand = new DiceHand($data["dices"]);
        $this->computerhand = new DiceHand($data["dices"]);
        $data["throw"] = url("/dice/player");
        $data["playform"] = "<form method='post' action={$data['throw']}><input type='submit' value='kasta'></form>";

        $body = renderView("layout/dice.php", $data);
        sendResponse($body);
    }

    public function roll()
    {
        $data = [
            "header" => "Dice",
            "throwlabel" => "Dina kast:",
           ];

        $data["hand"] = $this->playerhand;
        $data["throw"] = url("/dice/player");
        $data["stop"] = url("/dice/computer");
        $data["start"] = url("/dice");

        $data["playform"] = "<form method='post' action={$data['throw']}><input type='submit' value='kasta'></form>";
        $data["nextform"] = "<form method='post' action={$data['stop']}><input type='submit' value='stanna'></form>";

        $this->playerhand->roll();

        if ($this->playerhand->getSum() > 21) {
            $data["result"] = "Du förlorade!";
            $data["playform"] = "<a href={$data['start']}>Nytt spel</a>";
            $_SESSION["computerscore"]++;
            $data["nextform"] = null;
        } else if ($this->playerhand->getSum() == 21) {
            $data["result"] = "Grattis!";
            $data["playform"] = null;
        }
        $body = renderView("layout/dice.php", $data);
        sendResponse($body);
    }

    public function computerroll()
    {
        $data = [
            "header" => "Dice",
            "throwlabel" => "Datorns kast:",
            "start" => url("/dice")
        ];

        $data["hand"] = $this->computerhand;

        while ($this->computerhand->getSum() < 21) {
            $this->computerhand->roll();
        }

        if ($this->computerhand->getSum() == 21) {
            $data["result"] = "Datorn vinner!";
            $_SESSION["computerscore"]++;
            $data["playform"] = "<a href={$data['start']}>Nytt spel</a>";
        } else {
            $data["result"] = "Du vinner!";
            $_SESSION["playerscore"]++;
            $data["playform"] = "<a href={$data['start']}>Nytt spel</a>";
        }
        $body = renderView("layout/dice.php", $data);
        sendResponse($body);
    }
}
