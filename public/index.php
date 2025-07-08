<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;


require __DIR__ . '/../vendor/autoload.php';
require_once '../controller/gameController.php';
require_once '../service/gameService.php';




$app= AppFactory::create();
$twig = Twig::create(__DIR__ . '/../templates', ['cache' => false]);
$app->add(TwigMiddleware::create($app, $twig));



$app->get('/', [gameController::class, 'getGames']);
$app->get('/videogames/new', [gameController::class, 'showForm']);
$app->post('/videogames/new', [gameController::class, 'createGame']);
$app->get('/videogames/{id}/edit', [gameController::class, 'showForm']);
$app->post('/videogames/{id}/update', [gameController::class, 'updateGame']);
$app->post('/videogames/{id}/replace', \gameController::class . 'replaceGame');
$app->post('/videogames/{id}/delete', [gameController::class, 'deleteGame']);



$app->run();

?>