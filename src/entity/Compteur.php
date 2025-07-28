<?php

namespace Woyofal\Entity;

use DevNoKage\Abstract\AbstractEntity;
use DevNoKage\App;

class Compteur extends AbstractEntity
{
    public function __construct(
        protected Tranche $tranche,
        protected string $numero,
        protected Client $client,
        protected int $id 
    ) {}

    public static function toObject(array $data): static
    {
        return new static(
            $data['tranche'],
            $data['numero'],
            $data['client'],
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
