<?php

declare(strict_types=1);

use App\Logger\FilteredStdoutLogger;
use Hyperf\Contract\StdoutLoggerInterface;

/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */

return [
    StdoutLoggerInterface::class => FilteredStdoutLogger::class,    
];
