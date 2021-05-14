<?php

// declare(strict_types=1);

// namespace siev20\Controller;

// use PHPUnit\Framework\TestCase;
// use Psr\Http\Message\ResponseInterface;

// class YatzyControllerTest extends TestCase
// {
//     public function testStart()
//     {
//         $controller = new YatzyController();
//         $controller->start();
//         $this->assertInstanceOf("siev20\Controller\YatzyController", $controller);
//         $this->assertInstanceOf("siev20\yatzy\Yatzy", $_SESSION["game"]);
//     }

//     public function testPlay()
//     {
//         $controller = new YatzyController();
//         $exp = "\Psr\Http\Message\ResponseInterface";
//         $res = $controller->play();
//         $this->assertInstanceOf($exp, $res);
//     }

//     /**
//      * @runInSeparateProcess
//      */
//     public function testReset()
//     {
//         session_start();
//         $controller = $controller = new YatzyController();
//         $_SESSION = ["key" => "value"];

//         $this->assertEquals("value", $_SESSION["key"]);

//         $controller->reset();
//         $this->assertEmpty($_SESSION);
//     }
// }