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
        private IAchatRepository $achatRepository,
        private ICompteurService $compteurService,
        private ITrancheService $trancheService
    ) {}

    public function save(Achat $achat): int
    {
        $pdo = $this->achatRepository->pdo;

        try {
            $pdo->beginTransaction();

            $compteur = $this->compteurService->get_by_numero($achat->compteur->numero);
            if (!$compteur) {
                throw new \Exception("Le compteur n'existe pas.");
            }

            $totalMois = $this->achatRepository->consommationMoisEnCours($compteur->id);
            $kwt_actuel = $this->estimerKwtParMontant($achat->prix, $compteur->tranche->prix_appro);

            $consommationTotale = $totalMois + $kwt_actuel;

            $nouvelleTranche = $this->trancheService->get_by_consommation($consommationTotale);

            if ($nouvelleTranche->id !== $compteur->tranche->id) {
                $this->compteurService->changer_tranche($compteur->id, $nouvelleTranche->id);
                $compteur->tranche = $nouvelleTranche;
            }

            // Étape 5 : Calcul du prix par kwt réel
            $achat->tranche = $compteur->tranche;
            $achat->prix_kwt = $compteur->tranche->prix_appro;

            // Étape 6 : Insertion de l’achat
            $id = $this->achatRepository->insert($achat);

            $pdo->commit();
            return $id;
        } catch (\Throwable $e) {
            $pdo->rollBack();
            return 0;
        }
    }

    private function estimerKwtParMontant(float $montant, float $prix_kwh): float
    {
        return round($montant / $prix_kwh, 2);
    }
}
