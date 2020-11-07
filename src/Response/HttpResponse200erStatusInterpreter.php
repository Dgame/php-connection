<?php

declare(strict_types=1);

namespace Dgame\Connection\Response;

use Psr\Http\Message\ResponseInterface;

final class HttpResponse200erStatusInterpreter implements ResponseStatusInterpreter
{
    public function isStatusSuccess(ResponseInterface $response): bool
    {
        $statusCode = $response->getStatusCode();

        return $statusCode >= 200 && $statusCode < 300;
    }

    public function isStatusFailure(ResponseInterface $response): bool
    {
        $statusCode = $response->getStatusCode();

        return $statusCode >= 400;
    }
}
