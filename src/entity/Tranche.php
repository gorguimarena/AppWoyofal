<?php
namespace Woyofal\Entity;

class Tranche {
    public function __construct(
        public int $cons_min,
        public int $cons_max,
        public float $prix_appro
    ) {}
}