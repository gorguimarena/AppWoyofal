<?php

namespace Woyofal\Repository;

use DevNoKage\Abstract\AbstractRepository;
use DevNoKage\Interface\IDatabase;
use Woyofal\Entity\Tranche;
use Woyofal\Repository\Interface\ITrancheRepository;

class TrancheRepository extends AbstractRepository implements ITrancheRepository
{
    private \PDO $pdo;

    public function __construct(IDatabase $database)
    {
        $this->pdo = $database->getConnexion();
    }

    public function select_by_consommation(float $kwt): ?Tranche
    {
        $sql = "SELECT * FROM tranche 
            WHERE :kwt BETWEEN cons_min AND cons_max 
            ORDER BY cons_min LIMIT 1";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['kwt' => $kwt]);
        $data = $stmt->fetch();

        return $data ? Tranche::toObject($data) : null;
    }

    
}
