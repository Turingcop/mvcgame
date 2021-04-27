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
    private int $round = 1;
    private int $rolls = 0;
    private ?string $disable = null;

    public function setUp()
    {
        $data = [
            "header" => "Yatzy",
            "title" => "Yatzy",
            "action" => url("/yatzy"),
            "playlabel" => "Börja",
           ];

        $this->playerhand = new DiceHand(5);
        $data["hand"] = $this->playerhand;
        $this->scoreboard = [
            1 => 0,
            2 => 0,
            3 => 0,
            4 => 0,
            5 => 0,
            6 => 0,
            "summa" => 0,
            "bonus" => 0
        ];

        $present = $this->playerhand->allSix();
        $data["present"] = "";
        foreach ($present as $die) {
            $data["present"] .= "<label>{$die}</label> ";
        }

        $data["score"] = $this->scoreboard;
        $body = renderView("layout/yatzy.php", $data);
        return $body;
    }

    public function playGame()
    {
        $data = [
            "header" => "Yatzy",
            "title" => "Yatzy",
            "action" => url("/yatzy"),
            "playlabel" => "Kasta",
           ];

        $data["hand"] = $this->playerhand;
        $this->playerhand->resetSave();
        $this->disable = null;

        if (isset($_POST["dice"])) {
            foreach ($_POST["dice"] as $val) {
                $this->playerhand->saveDice(intval($val));
            };
        }

        $this->rolls++;
        $this->playerhand->roll();

        if ($this-> rolls == 3) {
            foreach ($this->playerhand->getLastRoll() as $die) {
                if ($die == $this->round) {
                    $this->scoreboard[$this->round]++;
                }
            }
            $this->rolls = 0;
            $this->disable = "disabled";
            $this->round++;
        }
        
        if ($this->round > 6) {
            $this->disable = "disabled";
            $data["playlabel"] = "Börja om";
            $data["action"] = url("/yatzy/restart");
        }

        $this->calcScore();
        $data["checkbox"] = implode(" ", $this->playerhand->checkDice($this->disable));
        $data["score"] = $this->scoreboard;
        $body = renderView("layout/yatzy.php", $data);
        return $body;
    }

    public function scoreboard()
    {
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
            $this->scoreboard["bonus"] = 50;
        }
        $this->scoreboard["summa"] = $score;
        return $score;
    }
}
