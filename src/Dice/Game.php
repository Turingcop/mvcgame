<?php

declare(strict_types=1);

namespace siev20\Dice;

use function Mos\Functions\{
    renderView,
    url
};

/**
 * Class Dice.
 */
class Game
{
    private $playerhand;
    public $computerhand;

    public function setUp()
    {
        $data = [
            "header" => "Game21",
            "title" => "Game21",
            "message" => "Välj att spela med en eller två tärningar.",
            "action" => url("/dice/start"),
            "reset" => url("/dice/reset"),
           ];
        if (! isset($_SESSION["playerscore"])) {
            $_SESSION["playerscore"] = 0;
        }
        if (! isset($_SESSION["computerscore"])) {
            $_SESSION["computerscore"] = 0;
        }

        $data["resetform"] = "<form method='post' action={$data['reset']}><input type='submit' value='Nollställ'></form>";
        $data["playurl"] = url("/dice/player");
        $data["playlabel"] = "Starta spelet";

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
        return $body;
    }

    public function playGame()
    {
        $data = [
         "header" => "Game21",
         "title" => "Game21",
         "message" => "Tryck på knappen för att göra ditt första kast.",
         "dices" => $_POST["dices"] ?? 2,
        ];

        $this->playerhand = new DiceHand("siev20\Dice\Dice", $data["dices"]);
        $this->computerhand = new DiceHand("siev20\Dice\Dice", $data["dices"]);
        $data["throw"] = url("/dice/player");
        $data["playform"] = "<form method='post' action={$data['throw']}><input type='submit' value='Kasta'></form>";

        $body = renderView("layout/dice.php", $data);
        return $body;
    }

    public function roll($cheat = null)
    {
        $data = [
            "header" => "Game21",
            "title" => "Game21",
            "throwlabel" => "Dina kast:",
            "message" => "Kasta igen eller stanna."
           ];

        $data["hand"] = $this->playerhand;
        $data["throw"] = url("/dice/player");
        $data["stop"] = url("/dice/computer");
        $data["start"] = url("/dice");

        $data["playform"] = "<form method='post' action={$data['throw']}><input type='submit' value='Kasta'></form>";
        $data["nextform"] = "<form method='post' action={$data['stop']}><input type='submit' value='Stanna'></form>";

        $this->playerhand->roll();
        $this->playerhand->getLastRoll();

        if ($cheat) {
            $this->playerhand->setSum($cheat);
        }

        if ($this->playerhand->getSum() > 21) {
            $data["result"] = "Du förlorade!";
            $data["playform"] = "<a href={$data['start']}>Nytt spel</a>";
            $_SESSION["computerscore"]++;
            $data["nextform"] = null;
        } else if ($this->playerhand->getSum() == 21) {
            $data["result"] = "Grattis!";
            $data["nextform"] = "<form method='post' action={$data['stop']}><input type='submit' value='Vidare'></form>";
            $data["playform"] = null;
        }
        $body = renderView("layout/dice.php", $data);
        return $body;
    }

    public function computerroll($cheat = null)
    {
        $data = [
            "header" => "Game21",
            "title" => "Game21",
            "throwlabel" => "Datorns kast:",
            "start" => url("/dice"),
            "hand" => $this->computerhand
        ];
        $data["playform"] = "<a href={$data['start']}>Nytt spel</a>";

        while ($this->computerhand->getSum() < 21) {
            $this->computerhand->roll();
            $this->computerhand->getLastRoll();
        }

        if ($cheat) {
            $this->computerhand->setSum($cheat);
        }

        if ($this->computerhand->getSum() == 21) {
            $data["result"] = "Datorn vinner!";
            $_SESSION["computerscore"]++;
            return renderView("layout/dice.php", $data);
        }
        $data["result"] = "Du vinner!";
        $_SESSION["playerscore"]++;
        return renderView("layout/dice.php", $data);
    }
}
