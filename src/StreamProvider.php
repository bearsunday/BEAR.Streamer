<?php
/**
 * This file is part of the BEAR.Streamer package.
 *
 * @license http://opensource.org/licenses/MIT MIT
 */
namespace BEAR\Streamer;

use Ray\Di\ProviderInterface;

class StreamProvider implements ProviderInterface
{
    /**
     * {@inheritdoc}
     *
     * @return resource
     */
    public function get()
    {
        return fopen('php://temp/', 'r+');
    }
}
