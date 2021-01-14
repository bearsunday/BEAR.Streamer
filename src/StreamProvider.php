<?php
/**
 * This file is part of the BEAR.Streamer package.
 *
 * @license http://opensource.org/licenses/MIT MIT
 */
namespace BEAR\Streamer;

use Ray\Di\ProviderInterface;
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
