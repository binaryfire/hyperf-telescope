<?php

declare(strict_types=1);

namespace App\Controller;

use App\Controller\AbstractController;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\RequestMapping;

#[Controller]
class HealthCheckController extends AbstractController
{
    #[RequestMapping(path: "/health", methods: "get")]
    public function check(): array
    {
        return [
            'status' => 'ok',
            'timestamp' => time(),
        ];
    }
}
