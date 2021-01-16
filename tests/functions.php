<?php

declare(strict_types=1);

/**
 * This file is part of the BEAR.Streamer package.
 */

namespace BEAR\Streamer;

use function func_get_args;

function header(string $string, bool $replace = true, ?string $http_response_code = null): void
{
    IntegrateTest::$headers[] = func_get_args();

    unset($string, $replace, $http_response_code);
}
