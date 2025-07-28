<?php

namespace DevNoKage\Abstract;

use DevNoKage\Response;

abstract class AbstractController 
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
