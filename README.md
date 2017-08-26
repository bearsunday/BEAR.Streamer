# BEAR.Streamer

### A HTTP stream responder

[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/bearsunday/BEAR.Streamer/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/bearsunday/BEAR.Streamer/?branch=1.x)
[![Code Coverage](https://scrutinizer-ci.com/g/bearsunday/BEAR.Streamer/badges/coverage.png?b=1.x)](https://scrutinizer-ci.com/g/bearsunday/BEAR.Streamer/?branch=1.x)
[![Build Status](https://travis-ci.org/bearsunday/BEAR.Streamer.svg?branch=1.x)](https://travis-ci.org/bearsunday/BEAR.Streamer)

Assign stream resource to resource-body.

```php
class Image extends ResourceObject
{
    use StreamTransferInject;

    public function onGet(string $name = 'inline image') : ResourceObject
    {
        $fp = fopen(__DIR__ . '/BEAR.jpg', 'r');
        stream_filter_append($fp, 'convert.base64-encode'); // image base64 format
        $this->body = [
            'name' => $name,
            'image' => $fp
        ];

        return $this;
    }
}
```

Or assign entire body.

```php
class Download extends ResourceObject
{
    use StreamTransferInject;

    public $headers = [
        'Content-Type' => 'image/jpeg',
        'Content-Disposition' => 'attachment; filename="image.jpg"'
    ];

    public function onGet() : ResourceObject
    {
        $fp = fopen(__DIR__ . '/BEAR.jpg', 'r');
        $this->body = $fp;

        return $this;
    }
}
```

Http body will not be output at once with "echo", Instead streamed with low memory consumption.
