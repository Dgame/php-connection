<?php

declare(strict_types=1);

namespace Dgame\Connection;

use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Message\ResponseInterface;

final class RequestResult
{
    public ?ResponseInterface $response = null;
    public ?ClientExceptionInterface $exception = null;

    private function __construct(?ResponseInterface $response, ?ClientExceptionInterface $exception)
    {
        $this->response = $response;
        $this->exception = $exception;
    }

    public static function withResponse(ResponseInterface $response): self
    {
        return new self($response, null);
    }

    public static function withClientException(ClientExceptionInterface $exception): self
    {
        return new self(null, $exception);
    }
}
