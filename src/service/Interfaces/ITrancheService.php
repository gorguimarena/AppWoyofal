<?php
namespace Woyofal\Service\Interface;

use Woyofal\Entity\Tranche;

interface ITrancheService {
    public function get_by_consommation(float $kwt) : ?Tranche ;
}