<?php

namespace Woyofal\Entity;

use DevNoKage\Abstract\AbstractEntity;

class Achat extends AbstractEntity
{
    public function __construct(
        private string $prix ,
        private float $prix_kwt ,
        private string $date,
        private string $heure ,
        private Tranche $tranche,
        private Compteur $compteur,
        private int $id ,
        private string $reference = uniqid(),
        private string $code_recharge = uniqid()
    ) {}

    public static function toObject(array $data): static
    {
        return new static(
            $data['prix'] ?? 0,
            floatval($data['prix_kwt'] ?? 0),
            $data['date'] ?? '',
            $data['heure'] ?? '',
            Tranche::toObject([
                "id" => $data['tranche_id']
            ]),
            Compteur::toObject([
                "id" => $data['compteur_id']
            ]),
            isset($data['id']) ? intval($data['id']) : 0,
            $data['reference'] ?? 0,
            $data['code_recharge'] ?? 0,
        );
    }

    public function toArray(): array
    {
        return [
            'reference' => $this->reference,
            'code_recharge' => $this->code_recharge,
            'date' => $this->date,
            'heure' => $this->heure,
            'prix' => $this->prix,
            'prix_kwt' => $this->prix_kwt,
            'tranche' => $this->tranche->toArray(),
            'compteur' => $this->compteur->toArray(),
        ];
    }
}
