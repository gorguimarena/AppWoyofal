<?php
namespace Woyofal\Repository;

use DevNoKage\Interface\IDatabase;
use Woyofal\Entity\Achat;
use Woyofal\Repository\Interface\IAchatRepository;

class AchatRepository implements IAchatRepository{
    private \PDO $pdo;

    public function __construct(IDatabase $database) {
        $this->pdo = $database->getConnexion();
    }

    public function insert(Achat $achat): int {
        return 0;
    }
}