<?php

declare(strict_types=1);

use function Hyperf\Support\env;

return [
    'handlers' => [
        App\Signal\WorkerStopHandler::class => PHP_INT_MIN,
    ],

    'timeout' => 10,
];
