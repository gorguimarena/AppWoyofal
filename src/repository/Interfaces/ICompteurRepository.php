<?php
namespace Woyofal\Repository\Interface;

use Woyofal\Entity\Compteur;

interface ICompteurRepository {
    public function select_by_numero(string $numero): ?Compteur;
    public function update_tranche(int $compteurId, int $trancheId): int;
}