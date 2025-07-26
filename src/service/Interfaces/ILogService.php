<?php

namespace Woyofal\Service\Interface;

use Woyofal\Entity\Log;

interface ILogService {
    public function save(Log $log): int;
}
