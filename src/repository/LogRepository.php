<?php
namespace Woyofal\Repository;

use DevNoKage\Interface\IDatabase;
use Woyofal\Entity\Log;
use Woyofal\Repository\Interface\ILogRepository;

class LogRepository implements ILogRepository{
    private \PDO $pdo;

    public function __construct(IDatabase $database) {
        $this->pdo = $database->getConnexion();
    }

    public function insert(Log $log): int {
        return 0;
    }
}