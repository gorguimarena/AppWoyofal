<?php

namespace Woyofal\Controller;

use DevNoKage\Abstract\AbstractController;
use Woyofal\Controller\Interface\IAchatController;
use Woyofal\Service\Interface\IAchatService;
use Woyofal\Service\Interface\ILogService;

class AchatController extends AbstractController implements IAchatController
{

    public function __construct(private IAchatService $compteurService, private ILogService $log_service) {}

    public function enregistrer_credit(): void {
        
    }
}
