<?php

declare(strict_types=1);

use function Hyperf\Support\env;
use function FriendsOfHyperf\Helpers\base_path;

return [
    'default' => [
        'driver' => 'sqlite',
        'host' => 'localhost',
        'database' => base_path('database/'. env('DB_DATABASE', 'database.sqlite')),
        'charset' => env('DB_CHARSET','utf8'),
        'collation' => env('DB_COLLATION','utf8_unicode_ci'),
        'foreign_key_constraints' => env('DB_FOREIGN_KEYS', true),
    ],
];
