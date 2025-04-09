<?php

declare(strict_types=1);

use function Hyperf\Support\env;

return [
    /*
     * The host to use when listening for debug server connections.
     */
    'host' => env('DUMP_SERVER_HOST', 'tcp://buggregator:9912'),
];
