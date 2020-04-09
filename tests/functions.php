<?php
/**
 * This file is part of the BEAR.Streamer package.
 *
 * @license http://opensource.org/licenses/MIT MIT
 */
namespace BEAR\Streamer;

function header(string $string, bool $replace = true, string $http_response_code = null) : void
{
    IntegrateTest::$headers[] = func_get_args();

    unset($string, $replace, $http_response_code);
}
