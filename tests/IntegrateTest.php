<?php

declare(strict_types=1);

namespace BEAR\Streamer;

use BEAR\Resource\Module\ResourceModule;
use BEAR\Resource\RenderInterface;
use BEAR\Resource\ResourceInterface;
use BEAR\Resource\TransferInterface;
use BEAR\Streamer\Annotation\Stream;
use BEAR\Streamer\Resource\Page\StreamArray;
use PHPUnit\Framework\TestCase;
use Ray\Di\Injector;

use function assert;
use function method_exists;
use function ob_get_clean;
use function ob_start;
use function rewind;
use function stream_get_contents;

class IntegrateTest extends TestCase
{
    /** @var array<string> */
    public static $headers = [];

    /** @var ResourceInterface */
    private $resource;

    /** @var RenderInterface */
    private $renderer;

    /** @var Streamer */
    private $streamer;

    protected function setUp(): void
    {
        $injector = new Injector(new StreamModule(new ResourceModule(__NAMESPACE__)));
        $this->resource = $injector->getInstance(ResourceInterface::class);
        $this->renderer = $injector->getInstance(RenderInterface::class, Stream::class);
        $this->streamer = $injector->getInstance(StreamerInterface::class);
    }

    public function caseProvider(): array
    {
        return [
            [
                'page://self/stream-array',
                '{
    "msg": "hello world",
    "stream": "Konichiwa stream !
"
}
',
            ],
            [
                'page://self/stream-string',
                'Konichiwa stream !
',
            ],
            [
                'page://self/text-array',
                '{
    "greeting": "Hello BEAR"
}
',
            ],
            [
                'page://self/text-string',
                '{
    "value": "Hello BEAR"
}
',
            ],
        ];
    }

    /**
     * @dataProvider caseProvider
     */
    public function testRender(string $uri, string $expected): void
    {
        $ro = $this->resource->newInstance($uri);
        $ro->setRenderer($this->renderer);
        assert(method_exists($ro, 'onGet'));
        $view = (string) $ro->onGet();
        $stream = $this->streamer->getStream($view);
        rewind($stream);
        $view = stream_get_contents($stream);
        $this->assertSame($expected, $view);
    }

    public function testTrait(): void
    {
        $injector = new Injector(new StreamModule(new ResourceModule(__NAMESPACE__)));
        $page = $injector->getInstance(StreamArray::class);
        $dummy = $this->createMock(TransferInterface::class);
        ob_start();
        $page->onGet()->transfer($dummy, []);
        $output = ob_get_clean();
        $headers = self::$headers;
        $expected = [
            [
                'Content-Type: application/json',
                false,
            ],
        ];
        $this->assertSame($expected, $headers);
        $this->assertSame('{
    "msg": "hello world",
    "stream": "Konichiwa stream !
"
}
', $output);
    }
}
