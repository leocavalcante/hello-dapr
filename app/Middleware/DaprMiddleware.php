<?php

declare(strict_types=1);

namespace App\Middleware;

use Dapr\Actors\ActorConfig;
use Hyperf\Codec\Json;
use Hyperf\Contract\StdoutLoggerInterface;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

final class DaprMiddleware implements MiddlewareInterface
{
    public function __construct(
        private StdoutLoggerInterface $logger,
        private ContainerInterface $container,
        private ResponseFactoryInterface $responseFactory,
        private StreamFactoryInterface $streamFactory,
    ) {
    }
    
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $request_path = $request->getUri()->getPath();

        $this->logger->debug(sprintf('Request Path: %s', $request_path));
        
        return match ($request_path) {
            '/dapr/config' => $this->daprConfig(),
            default => $handler->handle($request),
        };
    }

    private function daprConfig(): ResponseInterface
    {
        return $this
            ->responseFactory
            ->createResponse(200)
            ->withBody($this
                       ->streamFactory
                       ->createStream(Json::encode($this->container->get(ActorConfig::class))));
    }
}
