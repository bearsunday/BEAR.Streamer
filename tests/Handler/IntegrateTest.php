<?php
/**
 * This file is part of the BEAR.Streamer package.
 *
 * @license http://opensource.org/licenses/MIT MIT
 */
namespace BEAR\Streamer;

use BEAR\Resource\Module\ResourceModule;
use BEAR\Resource\RenderInterface;
use BEAR\Resource\ResourceInterface;
use PHPUnit\Framework\TestCase;
use Ray\Di\Injector;

class IntegrateTest extends TestCase
{
    /**
     * @var ResourceInterface
     */
    private $resource;

    /**
     * @var RenderInterface
     */
    private $renderer;

    /**
     * @var Streamer
     */
    private $streamer;

    protected function setUp()
    {
        $injector = new Injector(new StreamModule(new ResourceModule(__NAMESPACE__)));
        $this->resource = $injector->getInstance(ResourceInterface::class);
        $this->renderer = $injector->getInstance(RenderInterface::class); // singleton renderer
        $this->streamer = $injector->getInstance(StreamerInterface::class);
    }

    public function caseProvider()
    {
        return [
            ['page://self/stream-array', '{
    "msg": "hello world",
    "stream": "Konichiwa stream !
"
}
'],
            ['page://self/stream-string', 'Konichiwa stream !
'],
            ['page://self/text-array', '{
    "greeting": "Hello BEAR"
}
'],
            ['page://self/text-string', '{
    "value": "Hello BEAR"
}
']
        ];
    }

    /**
     * @dataProvider caseProvider
     */
    public function testRender($uri, $expected)
    {
        /* @var $resource \BEAR\Resource\ResourceInterface */
        $ro = $this->resource->newInstance($uri);
        $ro->setRenderer($this->renderer);
        $view = (string) $ro->onGet();
        $stream = $this->streamer->getStream($view);
        rewind($stream);
        $view = stream_get_contents($stream);
        $this->assertSame($expected, $view);
    }
}
