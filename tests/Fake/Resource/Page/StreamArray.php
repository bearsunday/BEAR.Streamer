<?php

namespace BEAR\Streamer\Resource\Page;

use BEAR\Resource\ResourceObject;

class StreamArray extends ResourceObject
{
    public function onGet()
    {
        $this->body = [
            'msg' =>'hello world',
            'stream' => fopen(__DIR__ . '/message.txt', 'r')
        ];

        return $this;
    }
}
