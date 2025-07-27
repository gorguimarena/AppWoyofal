<?php

namespace Woyofal\Service;

use Woyofal\Entity\Tranche;
use Woyofal\Repository\Interface\ITrancheRepository;
use Woyofal\Service\Interface\ITrancheService;

class TrancheService implements ITrancheService 
{
    public function __construct(private ITrancheRepository $itranche_repository) {}

    public function get_by_consommation(float $kwt): ?Tranche
    {
        return $this->itranche_repository->select_by_consommation($kwt);
    }
}
