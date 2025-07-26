<?php
namespace Woyofal\Entity;

class Log {
    public function __construct(
        public int $id,
        public string $ip,
        public Statut $statut,
        public int $numero_compteur,
        public string $code_recharge,
        public float $nombre_kwt
    ) {}
}