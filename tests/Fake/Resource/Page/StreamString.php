<?php

namespace BEAR\Streamer\Resource\Page;

use BEAR\Resource\ResourceObject;

class StreamString extends ResourceObject
{
    /**
     * Ignore renderer, just stream $this->body
     */
    public function onGet()
    {
        $this->body = fopen(__DIR__ . '/message.txt', 'r');

        return $this;
    }
}
