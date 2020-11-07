<?php

declare(strict_types=1);

namespace Dgame\Connection\Response;

use Psr\Http\Message\ResponseInterface;

interface ResponseStatusInterpreter
{
    public function isStatusSuccess(ResponseInterface $response): bool;
}
