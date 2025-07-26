<?php
namespace Woyofal\Service;

use Woyofal\Entity\Compteur;
use Woyofal\Repository\Interface\ICompteurRepository;

class CompteurService {
    private ICompteurRepository $compteurRepository;

    public function __construct(ICompteurRepository $compteurRepository) {
        $this->compteurRepository = $compteurRepository;
    }

    public function get_by_numero(string $numero): ?Compteur {
        return $this->compteurRepository->select_by_numero($numero);
    }
}