<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;

require_once '../service/gameService.php';

class gameController{

    public static function getGames(Request $request, Response $response, $args){
        $game= gameService::getData();
        $view = Twig::fromRequest($request);
        return $view->render($response, 'vistaGet.twig', [
            'games' => $game]);
    }

    //Formularios

    public static function showForm(Request $request, Response $response, $args){
        $view = Twig::fromRequest($request);
        $types = gameService::getAllTypes();
        $game = null;
        if(isset($args["id"])){
            $game= gameService::getById($args["id"]);
        }

        return $view->render($response, 'vistaPost.twig', [
        'types' => $types,
        'game'=> $game
    ]);
    }

    // Create
    public static function createGame(Request $request, Response $response, $args){
        $obj = new gameService();
        $datos = $request->getParsedBody();
        $game = $obj->createData($datos);

        return $response
            ->withHeader('Location', '/')
            ->withStatus(302);
    }


    public static function updateGame(Request $request, Response $response, $args) {
        $id = $args["id"];
        $datos = $request->getParsedBody();
        gameService::updateData($id, $datos["title"], $datos["release_year"], $datos["developer"], $datos["type_id"]);

        return $response
            ->withHeader('Location', "/")
            ->withStatus(302);
}

public static function replaceGame(Request $request, Response $response, $args) {
    $id = $args["id"];
    $datos = $request->getParsedBody();

    gameService::replaceData($id, $datos["title"], $datos["release_year"], $datos["developer"], $datos["type_id"]);

    return $response
        ->withHeader('Location', "/")
        ->withStatus(302);
}



    //Delete

    public static function deleteGame(Request $request, Response $response, $args){
        $id = $args["id"];
        gameService::deleteData($id);
        return $response
            ->withHeader('Location', '/')
            ->withStatus(302);
    }


}