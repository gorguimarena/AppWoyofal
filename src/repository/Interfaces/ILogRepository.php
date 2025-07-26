<?php

namespace Woyofal\Repository\Interface;

use Woyofal\Entity\Log;

interface ILogRepository {
    public function insert(Log $log): int;
}
