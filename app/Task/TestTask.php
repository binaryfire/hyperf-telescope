<?php

declare(strict_types=1);

namespace App\Task;

use Hyperf\Contract\StdoutLoggerInterface;
use Hyperf\Crontab\Annotation\Crontab;

class TestTask
{
    public function __construct(
        protected StdoutLoggerInterface $logger,
    ) {}

    /**
     * Execute the task.
     */
    #[Crontab(
        name: "test-tast",
        rule: "* * * * *",  // Every minute
        memo: "Test task"
    )]
    public function execute(): void
    {
            $this->logger->info('TestTask executed at ' . date('Y-m-d H:i:s'));
    }
}
