<?php
namespace Woyofal\Controller;

use Woyofal\Controller\Interface\ICompteurController;
use Woyofal\Service\CompteurService;

class CompteurController implements ICompteurController{
    private CompteurService $compteurService;

    public function __construct(CompteurService $compteurService) {
        $this->compteurService = $compteurService;
    }

    public function enregistrer_credit(): void {
        
    }
}