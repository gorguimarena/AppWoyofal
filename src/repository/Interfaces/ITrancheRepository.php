<?php

namespace Woyofal\Repository\Interface;

use Woyofal\Entity\Tranche;

interface ITrancheRepository {
    public function select_by_consommation(float $kwt): ?Tranche;
}
