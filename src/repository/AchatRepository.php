<?php

namespace Woyofal\Repository;

use DevNoKage\Abstract\AbstractRepository;
use DevNoKage\Interface\IDatabase;
use PDO;
use Woyofal\Entity\Achat;
use Woyofal\Repository\Interface\IAchatRepository;

class AchatRepository extends AbstractRepository implements IAchatRepository
{
    protected \PDO $pdo;

    public function __construct(IDatabase $database)
    {
        $this->pdo = $database->getConnexion();
    }

    public function insert(Achat $achat): int
    {
        $sql = "INSERT INTO achat (
                reference, code_recharge, date, heure, prix, prix_kwt, tranche_id, compteur_id
            ) VALUES (
                :reference, :code_recharge, :date, :heure, :prix, :prix_kwt, :tranche_id, :compteur_id
            )";


        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':reference', $achat->reference);
        $stmt->bindValue(':code_recharge', $achat->code_recharge);
        $stmt->bindValue(':date', $achat->date);
        $stmt->bindValue(':heure', $achat->heure);
        $stmt->bindValue(':prix', $achat->prix);
        $stmt->bindValue(':prix_kwt', $achat->prix_kwt);
        $stmt->bindValue(':tranche_id', $achat->tranche->id, PDO::PARAM_INT);
        $stmt->bindValue(':compteur_id', $achat->compteur->id, PDO::PARAM_INT);

        $stmt->execute();

        return (int) $this->pdo->lastInsertId();
    }


    public function consommationMoisEnCours(int $compteurId): float
    {
        $debutMois = date('Y-m-01');
        $debutMoisSuivant = date('Y-m-01', strtotime('+1 month'));

        $sql = "
        SELECT SUM(prix / prix_kwt) AS total_kwt 
        FROM achat 
        WHERE compteur_id = :id 
          AND date >= :debut 
          AND date < :fin
    ";


        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            'id' => $compteurId,
            'debut' => $debutMois,
            'fin' => $debutMoisSuivant
        ]);

        return (float) ($stmt->fetchColumn() ?? 0.0);
    }
}
