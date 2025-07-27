<?php
namespace Woyofal\Service\Interface;

use Woyofal\Entity\Compteur;

interface ICompteurService {
    public function get_by_numero(string $numero): ?Compteur;
    public function changer_tranche(int $compteurId, int $trancheId): int;
}