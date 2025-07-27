<?php
namespace Woyofal\Service;

use Woyofal\Entity\Log;
use Woyofal\Repository\Interface\ILogRepository;
use Woyofal\Service\Interface\ILogService;

class LogService implements ILogService{

    public function __construct(private ILogRepository $logRepository) {
    }

    public function save(Log $log): int {
        return $this->logRepository->insert($log);
    }
}