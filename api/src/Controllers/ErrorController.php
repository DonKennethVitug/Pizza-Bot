<?php

namespace bot\Controllers;

use Exception;
use Slim\Http\Request;
use Slim\Http\Response;
use bot\Interfaces\APIExceptionInterface;

class ErrorController {

    private $displayErrorDetails;

    public function __construct($displayErrorDetails) {
        $this->displayErrorDetails = $displayErrorDetails;
    }

    public function __invoke(Request $request, Response $response, Exception $exception) {
        if( $exception instanceof APIExceptionInterface )
            return $response->withJson( $exception->getDetails(), $exception->getStatus() );

        if( !$this->displayErrorDetails )
            return $response->withJson (['error' => 'Unhandled server error.'], 500);


        return $response->withJson( [
            'error' => (new \ReflectionClass($exception))->getShortName(),
            'message' => $exception->getMessage(),
            'trace' => $exception->getTrace()
        ], 500 );


    }



}
