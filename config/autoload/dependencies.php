<?php

declare(strict_types=1);

use GuzzleHttp\Psr7\HttpFactory;
use Hyperf\Framework\Logger\StdoutLogger;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Psr\Log\LoggerInterface;

/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
return [
    LoggerInterface::class => StdoutLogger::class,
    ResponseFactoryInterface::class => HttpFactory::class,
    StreamFactoryInterface::class => HttpFactory::class,
];
