<?php

namespace BEAR\Streamer\Resource\Page;

use BEAR\Resource\ResourceObject;

class TextString extends ResourceObject
{
    public function onGet()
    {
        $this->body = 'Hello BEAR';

        return $this;
    }
}
