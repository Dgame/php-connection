<?php

declare(strict_types=1);

namespace Dgame\Connection;

use Dgame\Time\Unit\TimeUnitInterface;

final class ConnectionRetry
{
    private int $maxTries;
    private TimeUnitInterface $waitTime;

    public function __construct(int $maxTries, TimeUnitInterface $waitTime)
    {
        assert($waitTime->inSeconds()->getAmount() > 0, 'Wait-Time in seconds must be > 0');
        $this->maxTries = $maxTries;
        $this->waitTime = $waitTime;
    }

    public function getMaxTries(): int
    {
        return $this->maxTries;
    }

    public function getWaitTime(): TimeUnitInterface
    {
        return $this->waitTime;
    }
}
