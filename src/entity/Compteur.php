<?php

namespace Woyofal\Entity;

use DevNoKage\Abstract\AbstractEntity;
use DevNoKage\App;

class Compteur extends AbstractEntity
{
    public function __construct(
        private Tranche $tranche,
        private string $numero,
        private Client $client,
        private int $id 
    ) {}

    public static function toObject(array $data): static
    {
        return new static(
            Tranche::toObject($data),
            $data['numero'],
            Client::toObject($data),
            isset($data['id']) ? intval($data['id']) : 0
        );
    }

    public function toArray(): array
    {
        return [
            'tranche' => $this->tranche->toArray(),
            'numero' => $this->numero,
            'client' => $this->client->toArray(),
        ];
    }
}
