<?php

namespace Woyofal\Service\Interface;

use Woyofal\Entity\Achat;

interface IAchatService {
    public function save(Achat $static) : int;
}
