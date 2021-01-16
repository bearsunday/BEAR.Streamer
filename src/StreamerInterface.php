<?php

declare(strict_types=1);

/**
 * This file is part of the BEAR.Streamer package.
 */

namespace BEAR\Streamer;

interface StreamerInterface
{
    /**
     * @param resource[] $streams
     */
    public function addStreams(array $streams): void;

    /**
     * Return single root stream
     *
     * @return resource
     */
    public function getStream(string $string);
}
