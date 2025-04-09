<?php

declare(strict_types=1);

namespace App\Logger;

use Hyperf\Framework\Logger\StdoutLogger;

class FilteredStdoutLogger extends StdoutLogger
{
    /**
     * Patterns to filter out
     */
    protected array $filters = [
        // Listeners
        ['type' => 'listener', 'contains' => [
            'FriendsOfHyperf\IpcBroadcaster\Listener\OnPipeMessageListener',
            'FriendsOfHyperf\Telescope\Listener',
            'Hyperf\Crontab\Listener\OnPipeMessageListener',
            'Hyperf\ModelListener\Listener',
            'Sonicstack\Hyperf\Core\Listeners\DbQueryExecutedListener',
        ]],
    ];

    /**
     * Override StdoutLogger debug method to filter out unwanted messages
     */
    public function debug($message, array $context = []): void
    {
        // Skip if the message should be filtered out
        if ($this->shouldFilter($message)) {
            return;
        }

        parent::debug($message, $context);
    }

    /**
     * Determine if a message should be filtered out based on current environment
     */
    protected function shouldFilter(string $message): bool
    {
        $filters = $this->filters;

        if (empty($filters)) {
            return false;
        }

        // Check each filter
        foreach ($filters as $filter) {
            switch ($filter['type']) {
                // Listeners
                case 'listener':
                    if (
                        str_contains($message, 'Event') &&
                        str_contains($message, 'handled by') &&
                        str_contains($message, 'listener')
                    ) {
                        foreach ($filter['contains'] as $pattern) {
                            if (str_contains($message, $pattern)) {
                                return true;
                            }
                        }
                    }
                    break;

                // Simple string matching filter
                case 'contains':

                    if (str_contains($message, $filter['pattern'])) {
                        return true;
                    }
                    break;
            }
        }

        return false;
    }
}
