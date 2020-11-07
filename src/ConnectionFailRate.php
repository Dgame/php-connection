<?php

declare(strict_types=1);

namespace Dgame\Connection;

use function Dgame\Time\Unit\seconds;

/**
 *  high => tries = 90, wait => 2 sec => max. 180 sec => max. 3 min
 *  medium => tries = 30, wait => 5 sec => max. 150 sec => max. 2 min 30 sec
 *  low => tries = 6, wait => 10 sec => max. 60 sec => max 1 min
 */
final class ConnectionFailRate
{
    public const HIGH_FAIL_RATE_MAX_TRIES = 90;
    public const HIGH_FAIL_RATE_WAIT_TIME_IN_SECONDS = 2;

    public const MEDIUM_FAIL_RATE_MAX_TRIES = 30;
    public const MEDIUM_FAIL_RATE_WAIT_TIME_IN_SECONDS = 5;

    public const LOW_FAIL_RATE_MAX_TRIES = 6;
    public const LOW_FAIL_RATE_WAIT_TIME_IN_SECONDS = 10;

    public static function high(): ConnectionRetry
    {
        return new ConnectionRetry(
            self::HIGH_FAIL_RATE_MAX_TRIES,
            seconds(self::HIGH_FAIL_RATE_WAIT_TIME_IN_SECONDS)
        );
    }

    public static function medium(): ConnectionRetry
    {
        return new ConnectionRetry(
            self::MEDIUM_FAIL_RATE_MAX_TRIES,
            seconds(self::MEDIUM_FAIL_RATE_WAIT_TIME_IN_SECONDS)
        );
    }

    public static function low(): ConnectionRetry
    {
        return new ConnectionRetry(
            self::LOW_FAIL_RATE_MAX_TRIES,
            seconds(self::LOW_FAIL_RATE_WAIT_TIME_IN_SECONDS)
        );
    }
}
