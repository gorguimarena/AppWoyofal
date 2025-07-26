<?php
namespace Woyofal\Repository;

use DevNoKage\Interface\IDatabase;
use Woyofal\Entity\Compteur;
use Woyofal\Repository\Interface\ICompteurRepository;

class CompteurRepository implements ICompteurRepository{
    private \PDO $pdo;

    public function __construct(IDatabase $database) {
        $this->pdo = $database->getConnexion();
    }

    public function select_by_numero(string $numero): ?Compteur {
        return null;
    }
}