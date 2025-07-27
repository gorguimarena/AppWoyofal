<?php

namespace Woyofal\Service;

use Woyofal\Entity\Compteur;
use Woyofal\Repository\Interface\ICompteurRepository;
use Woyofal\Service\Interface\ICompteurService;

class CompteurService implements ICompteurService
{

    public function __construct(private ICompteurRepository $compteurRepository) {}

    public function get_by_numero(string $numero): ?Compteur
    {
        return $this->compteurRepository->select_by_numero($numero);
    }

    public function changer_tranche(int $compteurId, int $trancheId): int{
        return $this->compteurRepository->update_tranche($compteurId, $trancheId);
    }
}
