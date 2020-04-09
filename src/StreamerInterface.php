<?php
/**
 * This file is part of the BEAR.Streamer package.
 *
 * @license http://opensource.org/licenses/MIT MIT
 */
namespace BEAR\Streamer;

use BEAR\Streamer\Annotation\Stream;

interface StreamerInterface
{
    /**
     * @param resource[] $streams
     */
    public function addStreams(array $streams) : void;

    /**
     * Return single root stream
     *
     * @return resource
     */
    public function getStream(string $string);
}
