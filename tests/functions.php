<?php

declare(strict_types=1);

namespace BEAR\Streamer;

use function func_get_args;

function header(string $string, bool $replace = true, ?string $http_response_code = null): void
{
    IntegrateTest::$headers[] = func_get_args();

    unset($string, $replace, $http_response_code);
}
