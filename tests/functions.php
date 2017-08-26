<?php
/**
 * This file is part of the BEAR.Streamer package.
 *
 * @license http://opensource.org/licenses/MIT MIT
 */
namespace BEAR\Streamer;

function header($string, $replace = true, $http_response_code = null)
{
    IntegrateTest::$headers[] = func_get_args();

    unset($string, $replace, $http_response_code);
}
