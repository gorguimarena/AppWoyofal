<?php
namespace Woyofal\Repository\Interface;

use Woyofal\Entity\Achat;

interface IAchatRepository {
    public function insert(Achat $achat): int;
}
