<?php

namespace Woyofal\Repository;

use DevNoKage\Abstract\AbstractRepository;
use DevNoKage\Interface\IDatabase;
use PDO;
use Woyofal\Entity\Client;
use Woyofal\Entity\Compteur;
use Woyofal\Entity\Tranche;
use Woyofal\Repository\Interface\ICompteurRepository;

class CompteurRepository extends AbstractRepository implements ICompteurRepository
{
    private \PDO $pdo;

    public function __construct(IDatabase $database)
    {
        $this->pdo = $database->getConnexion();
    }

    public function select_by_numero(string $numero): ?Compteur
    {
        $sql = "
        SELECT 
            c.*,
            t.cons_min, t.cons_max, t.prix_appro,
            cl.nom AS client_nom, cl.prenom AS client_prenom
        FROM compteur c
        JOIN tranche t ON c.tranche_id = t.id
        JOIN client cl ON c.client_id = cl.id
        WHERE c.numero = :numero
    ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':numero', $numero);
        $stmt->execute();

        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$data) return null;

        $tranche = Tranche::toObject([
            "id" => $data["tranche_id"] ?? $data["tranche_id"] ?? 0,
            "cons_min" => $data["cons_min"] ?? 0,
            "cons_max" => $data["cons_max"] ?? 0,
            "prix_appro" => $data["prix_appro"] ?? 0.0
        ]);

        $client = Client::toObject([
            "id" => $data["client_id"] ?? 0,
            "nom" => $data["client_nom"] ?? '',
            "prenom" => $data["client_prenom"] ?? ''
        ]);

        $compteur = Compteur::toObject([
            "id" => $data["id"] ?? 0,
            "numero" => $data["numero"] ?? '',
            "tranche" => $tranche,
            "client" => $client
        ]);

        return $compteur;
    }

    public function update_tranche(int $compteurId, int $trancheId): int
    {
        $sql = "UPDATE compteur SET tranche_id = :tranche WHERE id = :id";
        return $this->pdo->prepare($sql)->execute([
            'tranche' => $trancheId,
            'id' => $compteurId
        ]);
    }
}
