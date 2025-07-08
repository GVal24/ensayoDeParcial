<?php
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;


class authMiddleware{

    public function __invoke(Request $request, RequestHandler $handler): Response{
       
       if(!$__Session){
            $response = $app->getResponseFactory()->createResponse();
            $response->getBody()->write('Usuario no autorizado');
            return $response->withStatus(401);
       } else{
            $response= $handler->handle($request);
            return $response;
        }
     
    }

}
