<?php

declare(strict_types=1);

namespace BEAR\Streamer;

use BEAR\Resource\RenderInterface;
use BEAR\Resource\ResourceObject;

use function assert;
use function get_resource_type;
use function is_array;
use function is_iterable;
use function is_resource;
use function mt_getrandmax;
use function random_int;
use function uniqid;

final class StreamRenderer implements RenderInterface
{
    /**
     * Pushed stream
     *
     * @var resource[]
     */
    private array $streams = [];

    public function __construct(
        private readonly RenderInterface $renderer,
        private readonly StreamerInterface $streamer,
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function render(ResourceObject $ro)
    {
        $view = $this->getView($ro);
        $this->streamer->addStreams($this->streams);
        $ro->view = $view;

        return $view;
    }

    /**
     * {@inheritDoc}
     */
    public function getView(ResourceObject $ro): string
    {
        if (is_array($ro->body)) {
            $this->pushArrayBody($ro);

            return $this->renderer->render($ro);
        }

        return $this->pushScalarBody($ro);
    }

    /** @param resource $item */
    private function pushStream($item): string
    {
        $id = uniqid(__FUNCTION__ . random_int(0, mt_getrandmax()), true) . '_';
        $this->streams[$id] = $item; // push

        return $id;
    }

    private function pushScalarBody(ResourceObject $ro): string
    {
        if (is_resource($ro->body) && get_resource_type($ro->body) === 'stream') {
            return $this->pushStream($ro->body);
        }

        return $this->renderer->render($ro);
    }

    private function pushArrayBody(ResourceObject $ro): void
    {
        assert(is_iterable($ro->body));
        foreach ($ro->body as &$item) {
            if (is_resource($item) && get_resource_type($item) === 'stream') {
                $item = $this->pushStream($item);
            }
        }
    }
}
