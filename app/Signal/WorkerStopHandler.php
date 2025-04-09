<?php

declare(strict_types=1);

namespace App\Signal;

use Hyperf\Contract\ConfigInterface;
use Hyperf\Contract\StdoutLoggerInterface;
use Hyperf\Signal\SignalHandlerInterface;
use Psr\Container\ContainerInterface;
use Swoole;

class WorkerStopHandler implements SignalHandlerInterface
{
    protected ConfigInterface $config;

    public function __construct(
        protected ContainerInterface $container,
        protected StdoutLoggerInterface $logger
    )
    {
        $this->config = $container->get(ConfigInterface::class);
    }

    /**
     * Get the signals to listen for.
     */
    public function listen(): array
    {
        return [
            [self::WORKER, SIGTERM],
            [self::WORKER, SIGINT],
        ];
    }

    /**
     * Handle the given signals.
     */
    public function handle(int $signal): void
    {
        if ($signal !== SIGINT) {
            $time = $this->config->get('server.settings.max_wait_time', 3);
            sleep($time);
        }

        $pid = getmypid();
        $this->logger->info("Stopping worker PID {$pid}...");

        // Disable Swoole deadlock checks to prevent error messages during shutdowns.
        // These errors are just costmetic in signal handlers and can be safely ignored.
        Swoole\Coroutine::set(['enable_deadlock_check' => false]);

        $this->container->get(Swoole\Server::class)->stop();
    }
}
