<?php
namespace Woyofal\Entity;

class Achat {
    public function __construct(
        public int $id,
        public string $reference,
        public string $code_recharge,
        public string $date,
        public string $heure,
        public string $prix,
        public float $prix_kwt,
        public Tranche $tranche
    ) {}
}