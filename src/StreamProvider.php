<?php

declare(strict_types=1);

/**
 * This file is part of the BEAR.Streamer package.
 */

namespace BEAR\Streamer;

use Ray\Di\ProviderInterface;

use function assert;
use function fopen;
use function is_resource;

class StreamProvider implements ProviderInterface
{
    /**
     * {@inheritdoc}
     *
     * @return resource
     */
    public function get()
    {
        $resource = fopen('php://temp/', 'r+');
        assert(is_resource($resource));

        return $resource;
    }
}
