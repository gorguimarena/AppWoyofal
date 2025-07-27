<?php
namespace Woyofal\Repository;

use DevNoKage\Abstract\AbstractRepository;
use DevNoKage\Interface\IDatabase;
use Woyofal\Entity\Log;
use Woyofal\Repository\Interface\ILogRepository;

class LogRepository extends AbstractRepository implements ILogRepository{
    private \PDO $pdo;

    public function __construct(IDatabase $database) {
        $this->pdo = $database->getConnexion();
    }

    public function insert(Log $log): int {
        $sql = "INSERT INTO log (ip, statut, numero_compteur, code_recharge, nombre_kwt)
                VALUES (:ip, :statut, :numero_compteur, :code_recharge, :nombre_kwt)";
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':ip', $log->ip);
        $stmt->bindValue(':statut', $log->statut->value);
        $stmt->bindValue(':numero_compteur', $log->numero_compteur);
        $stmt->bindValue(':code_recharge', $log->code_recharge);
        $stmt->bindValue(':nombre_kwt', $log->nombre_kwt);

        $stmt->execute();
        return (int) $this->pdo->lastInsertId();
    }
}