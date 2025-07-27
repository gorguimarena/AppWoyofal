<?php
namespace Woyofal\Entity;

use DevNoKage\Abstract\AbstractEntity;

class Tranche extends AbstractEntity {
    public function __construct(
        private int $cons_min,
        private int $cons_max,
        private float $prix_appro,
        private int $id
    ) {}

    public static function toObject(array $data): static {
        return new static(
            intval($data['cons_min'] ?? 0),
            intval($data['cons_max']?? 0),
            floatval($data['prix_appro']?? 0),
            isset($data['id']) ? intval($data['id']) : 0
        );
    }

    public function toArray(): array {
        return [
            'cons_min' => $this->cons_min,
            'cons_max' => $this->cons_max,
            'prix_appro' => $this->prix_appro,
        ];
    }
}
