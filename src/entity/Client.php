<?php
namespace Woyofal\Entity;

use DevNoKage\Abstract\AbstractEntity;

class Client extends AbstractEntity {
    public function __construct(
        protected string $nom,
        protected string $prenom,
        protected int $id
    ) {}

    public static function toObject(array $data): static {
        return new static(
            $data['nom'] ?? '',
            $data['prenom'] ?? '',
            isset($data['id']) ? intval($data['id']) : 0
        );
    }

    public function toArray(): array {
        return [
            'nom' => $this->nom,
            'prenom' => $this->prenom,
        ];
    }
}
