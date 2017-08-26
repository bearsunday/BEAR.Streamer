<?php

namespace BEAR\Streamer\Resource\Page;

use BEAR\Resource\ResourceObject;

class TextArray extends ResourceObject
{
    public function onGet()
    {
        $this->body =[
            'greeting' => 'Hello BEAR'
        ];

        return $this;
    }
}
