<?php

namespace DevNoKage;

use DevNoKage\Abstract\AbstractController;

class ErrorController extends AbstractController
{
    public function _404(): void {
        $res = new Response('Ressource not found !');
        $this->renderJson($res);
    }
}
