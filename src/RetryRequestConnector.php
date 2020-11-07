<?php

declare(strict_types=1);

namespace Dgame\Connection;

use Dgame\Connection\Response\ResponseStatusInterpreter;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use UnexpectedValueException;

final class RetryRequestConnector
{
    private ClientInterface $client;
    private ResponseStatusInterpreter $statusInterpreter;

    public function __construct(ClientInterface $client, ResponseStatusInterpreter $statusInterpreter)
    {
        $this->client = $client;
        $this->statusInterpreter = $statusInterpreter;
    }

    /**
     * @param RequestInterface $request
     * @param ConnectionRetry $connectionRetry
     *
     * @return ResponseInterface
     *
     * @throws ClientExceptionInterface|UnexpectedValueException
     */
    public function sendRequest(RequestInterface $request, ConnectionRetry $connectionRetry): ResponseInterface
    {
        $waitTimeInSeconds = (int) ceil($connectionRetry->getWaitTime()->inSeconds()->getAmount());
        $tries = $connectionRetry->getMaxTries();

        do {
            $result = $this->trySendRequest($request);

            if ($result->response !== null && $this->statusInterpreter->isStatusSuccess($result->response)) {
                break;
            }

            $tries--;

            sleep($waitTimeInSeconds);
        } while ($tries > 0);

        if ($result->exception !== null) {
            throw $result->exception;
        }

        if ($result->response === null) {
            throw new UnexpectedValueException('No Response was generated');
        }

        return $result->response;
    }

    private function trySendRequest(RequestInterface $request): RequestResult
    {
        try {
            $response = $this->client->sendRequest($request);

            return RequestResult::withResponse($response);
        } catch (ClientExceptionInterface $exception) {
            return RequestResult::withClientException($exception);
        }
    }
}
