<?php
namespace Woyofal\Service;

use Woyofal\Entity\Log;
use Woyofal\Repository\Interface\ILogRepository;
use Woyofal\Service\Interface\ILogService;

class LogService implements ILogService{
    private ILogRepository $logRepository;

    public function __construct(ILogRepository $logRepository) {
        $this->logRepository = $logRepository;
    }

    public function save(Log $log): int {
        return $this->logRepository->insert($log);
    }
}