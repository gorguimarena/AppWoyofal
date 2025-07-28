<?php

namespace Woyofal\Controller;

use DevNoKage\Abstract\AbstractController;
use DevNoKage\App;
use DevNoKage\Enums\ClassName;
use Woyofal\Controller\Interface\IAchatController;
use Woyofal\Service\Interface\IAchatService;
use Woyofal\Service\Interface\ILogService;

class AchatController extends AbstractController implements IAchatController
{

    public function __construct(protected IAchatService $achatService, protected ILogService $log_service) {}

    public function enregistrer_credit(): void
    {
        $response = App::getDependencie(ClassName::RESPONSE);

        try {
            $body = file_get_contents("php://input");
            $data = json_decode($body, true);

            if (empty($data['numero']) || empty($data['montant'])) {
                throw new \Exception("Le numéro et le montant sont requis.", 400);
            }

            $achat = App::getDependencie(ClassName::ACHAT);
            $compteur = App::getDependencie(ClassName::COMPTEUR);

            $compteur->numero = trim($data['numero']);
            $achat->compteur = $compteur;
            $achat->prix = floatval($data['montant']);

            $res = $this->achatService->save($achat);

            $response->code = 200;
            $response->message = "Achat effectué avec succès.";
            $response->data = $res->toArray();
        } catch (\Exception $e) {
            $response->code = $e->getCode() ?: 500;
            $response->message = $e->getMessage();
        }

        $this->renderJson($response);
    }
}
