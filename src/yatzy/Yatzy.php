<?php

declare(strict_types=1);

namespace siev20\yatzy;

use function Mos\Functions\{
    redirectTo,
    renderView,
    sendResponse,
    url
};

class Yatzy
{
    private $playerhand;
    private array $scoreboard;
    public int $round = 1;
    public int $rolls = 0;
    private ?string $disable = null;

    public function setUp()
    {
        $data = [
            "header" => "Yatzy",
            "title" => "Yatzy",
            "action" => url("/yatzy"),
            "playlabel" => "Börja"
           ];
        
        $this->playerhand = new DiceHand(5);
        $data["hand"] = $this->playerhand;
        $this->scoreboard = [
            1 => 0,
            2 => 0,
            3 => 0,
            4 => 0,
            5 => 0,
            6 => 0
        ];

        $present = $this->playerhand->allSix();
        $data["present"] = ""; 
        foreach ($present as $die) {
            $data["present"] .= "<label>{$die}</label> ";
        }

        $body = renderView("layout/yatzy.php", $data);
        return $body;
    }

    public function playGame()
    {
        $data = [
            "header" => "Yatzy",
            "title" => "Yatzy",
            "action" => url("/yatzy"),
            "playlabel" => "Kasta"
           ];

        $data["hand"] = $this->playerhand;
        $this->playerhand->resetSave();
        $this->rolls++;
        $this->disable = null;

        if (isset($_POST["dice"])) {
            foreach ($_POST["dice"] as $val) {
                $this->playerhand->saveDice(intval($val));
            };
        }

        if ($this->rolls < 3) {
            $this->playerhand->roll();
        } elseif ($this->rolls == 3 && $this->round < 6) {
            foreach ($this->playerhand->getLastRoll() as $die) {
                if ($die == $this->round) {
                    $this->scoreboard[$this->round]++;
                }
            }
            $this->rolls = 0;
            $this->disable = "disabled";
            $this->round++;
        } else {
            $this->calcScore();
        }

        $data["checkbox"] = implode(" ", $this->playerhand->checkDice($this->disable));
        $body = renderView("layout/yatzy.php", $data);
        return $body;
    }

    public function scoreboard() {
        return implode(", ", $this->scoreboard);
    }

    public function calcScore(): int
    {
        $score = 0;
        for ($i = 1; $i <= 6; $i++) {
            $score += $this->scoreboard[$i] * $i;
        }
        if ($score >= 63) {
            $score += 50;
        }
        return $score;
    }

}
