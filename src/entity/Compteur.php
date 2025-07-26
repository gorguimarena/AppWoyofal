<?php
namespace Woyofal\Entity;

class Compteur {
    public function __construct(
        public int $id,
        public Tranche $tranche,
        public string $numero,
        public Client $client
    ) {}
}