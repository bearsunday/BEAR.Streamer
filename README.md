# A HTTP stream transfer for BEAR.Sunday

[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/bearsunday/BEAR.Streamer/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/bearsunday/BEAR.Streamer/?branch=1.x)
[![Code Coverage](https://scrutinizer-ci.com/g/bearsunday/BEAR.Streamer/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/bearsunday/BEAR.Streamer/?branch=1.x)
[![Build Status](https://travis-ci.org/bearsunday/BEAR.Streamer.svg?branch=1.x)](https://travis-ci.org/bearsunday/BEAR.Streamer)

Assign stream to resource-body.

```php
class Index extends ResourceObject
{
    public function onGet(string $name) : ResourceObject
    {
        $fp = fopen(__DIR__ . '/image.jpg', 'r');
        stream_filter_append($fp, 'convert.base64-encode'); // image base64 format
        $this->body = [
            'name' => $name,
            'image' => $fp
        ];

        return $this;
    }
}
```

```php
// set renderer
$streamer = new Streamer;
$resourceObject->setRenderer(new StreamRenderer($renderer, $streamer)); // JSON/HTML

// render to string
(string) $resourceObject; 

// convert string view to php stream
$stream = $streamer->getStream($resourceObject->view);

// output stream
rewind($stream);
while (feof($stream)) {
    echo fread($stream, 8192);
}
```