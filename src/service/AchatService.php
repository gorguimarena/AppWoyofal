<?php

namespace Woyofal\Service;

use Woyofal\Entity\Achat;
use Woyofal\Repository\Interface\IAchatRepository;
use Woyofal\Service\Interface\IAchatService;
use Woyofal\Service\Interface\ICompteurService;
use Woyofal\Service\Interface\ITrancheService;

class AchatService implements IAchatService
{

    public function __construct(
        protected IAchatRepository $achatRepository,
        protected ICompteurService $compteurService,
        protected ITrancheService $trancheService
    ) {}

    public function save(Achat $achat): ?Achat
    {
        $pdo = $this->achatRepository->pdo;

        try {
            $pdo->beginTransaction();

            $compteur = $this->compteurService->get_by_numero($achat->compteur->numero);
            if (!$compteur) {
                throw new \Exception("Le compteur n'existe pas.", 404);
            }

            $achat->compteur = $compteur;

            $totalMois = $this->achatRepository->consommationMoisEnCours($compteur->id);

            $kwtActuel = $this->estimerKwtParMontant($achat->prix, $compteur->tranche->prix_appro);
            $consommationTotale = $totalMois + $kwtActuel;

            $nouvelleTranche = $this->trancheService->get_by_consommation($consommationTotale);

            if ($nouvelleTranche->id !== $compteur->tranche->id) {
                $this->compteurService->changer_tranche($compteur->id, $nouvelleTranche->id);
                $compteur->tranche = $nouvelleTranche;
            }

            $achat->tranche = $compteur->tranche;
            $achat->prix_kwt = $compteur->tranche->prix_appro;
            $achat->date = date('Y-m-d');
            $achat->heure = date('H:i:s');
            $achat->code_recharge = strtoupper(uniqid("RECHG"));
            $achat->reference = strtoupper(uniqid("ACHAT-"));

            $id = $this->achatRepository->insert($achat);
            if (!$id) {
                throw new \Exception("Erreur lors de l'enregistrement de l'achat.", 500);
            }

            $pdo->commit();
            return $achat;
        } catch (\Exception $e) {
            $pdo->rollBack();
            throw new \Exception($e->getMessage(), $e->getCode() ?: 500);
        }
    }


    private function estimerKwtParMontant(float $montant, float $prix_kwh): float
    {
        return round($montant / $prix_kwh, 2);
    }
}
