<?php

namespace DevNoKage\Abstract;

use DevNoKage\Response;
use DevNoKage\Singleton;

abstract class AbstractController extends Singleton
{

    protected function renderJson(Response $response): void
    {
        http_response_code($response->code);
        header('Content-Type: application/json');

        header('Access-Control-Allow-Origin: *'); 
        header('Access-Control-Allow-Methods: GET, POST');
        header('Access-Control-Allow-Headers: Content-Type, Authorization');



        echo $response->toJson();
    }
}
