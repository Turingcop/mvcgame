<?php

/**
 * Load the routes into the router, this file is included from
 * `htdocs/index.php` during the bootstrapping to prepare for the request to
 * be handled.
 */

declare(strict_types=1);

use FastRoute\RouteCollector;

$router = $router ?? new RouteCollector(
    new FastRoute\RouteParser\Std,
    new FastRoute\DataGenerator\MarkBased
);

$router->addRoute("GET", "/test", function () {
    // A quick and dirty way to test the router or the request.
    return "Testing response";
});

$router->addRoute("GET", "/", "\siev20\Controller\Index");
$router->addRoute("GET", "/debug", "\siev20\Controller\Debug");
$router->addRoute("GET", "/twig", "\siev20\Controller\TwigView");

$router->addGroup("/session", function (RouteCollector $router) {
    $router->addRoute("GET", "", ["\siev20\Controller\Session", "index"]);
    $router->addRoute("GET", "/destroy", ["\siev20\Controller\Session", "destroy"]);
});

$router->addGroup("/some", function (RouteCollector $router) {
    $router->addRoute("GET", "/where", ["\siev20\Controller\Sample", "where"]);
});

$router->addGroup("/form", function (RouteCollector $router) {
    $router->addRoute("GET", "/view", ["\siev20\Controller\Form", "view"]);
    $router->addRoute("POST", "/process", ["\siev20\Controller\Form", "process"]);
});

$router->addGroup("/dice", function (RouteCollector $router) {
    $router->addRoute("GET", "", ["\siev20\Controller\GameControl", "start"]);
    $router->addRoute("POST", "/start", ["\siev20\Controller\GameControl", "play"]);
    $router->addRoute("POST", "/player", ["\siev20\Controller\GameControl", "playerRoll"]);
    $router->addRoute("POST", "/computer", ["\siev20\Controller\GameControl", "computerRoll"]);
    $router->addRoute("POST", "/reset", ["\siev20\Controller\GameControl", "reset"]);
});

$router->addGroup("/yatzy", function (RouteCollector $router) {
    $router->addRoute("GET", "", ["\siev20\Controller\YatzyController", "start"]);
    $router->addRoute("POST", "", ["\siev20\Controller\YatzyController", "play"]);
    $router->addRoute("POST", "/restart", ["\siev20\Controller\YatzyController", "reset"]);
});
