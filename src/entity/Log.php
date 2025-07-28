<?php
namespace Woyofal\Entity;

use DevNoKage\Abstract\AbstractEntity;
use DevNoKage\Statut;

class Log extends AbstractEntity {
    public function __construct(
        protected string $ip,
        protected int $numero_compteur,
        protected string $code_recharge,
        protected float $nombre_kwt,
        protected int $id,
        protected Statut $statut = Statut::ERROR,
    ) {}

    public static function toObject(array $data): static {
        return new static(
            $data['ip'],
            intval($data['numero_compteur'] ?? 0),
            $data['code_recharge'] ?? 0,
            floatval($data['nombre_kwt']) ?? 0,
            isset($data['id']) ? intval($data['id']) : 0,
            Statut::from($data['statut'])
        );
    }

    public function toArray(): array {
        return [
            'ip' => $this->ip,
            'statut' => $this->statut->value,
            'numero_compteur' => $this->numero_compteur,
            'code_recharge' => $this->code_recharge,
            'nombre_kwt' => $this->nombre_kwt,
        ];
    }
}
