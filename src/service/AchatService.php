<?php
namespace Woyofal\Service;

use Woyofal\Entity\Achat;
use Woyofal\Repository\Interface\IAchatRepository;
use Woyofal\Service\Interface\IAchatService;

class AchatService implements IAchatService{
    private IAchatRepository $achatRepository;

    public function __construct(IAchatRepository $achatRepository) {
        $this->achatRepository = $achatRepository;
    }

    public function save(Achat $achat): int {
        return $this->achatRepository->insert($achat);
    }
}