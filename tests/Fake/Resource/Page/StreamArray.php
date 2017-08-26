<?php

namespace BEAR\Streamer\Resource\Page;

use BEAR\Resource\ResourceObject;
use BEAR\Streamer\StreamTransferInject;

class StreamArray extends ResourceObject
{
    use StreamTransferInject;

    public function onGet()
    {
        $this->body = [
            'msg' =>'hello world',
            'stream' => fopen(__DIR__ . '/message.txt', 'r')
        ];

        return $this;
    }
}
