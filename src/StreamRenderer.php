<?php
/**
 * This file is part of the BEAR.Streamer package.
 *
 * @license http://opensource.org/licenses/MIT MIT
 */
namespace BEAR\Streamer;

use BEAR\Resource\RenderInterface;
use BEAR\Resource\ResourceObject;

final class StreamRenderer implements RenderInterface
{
    /**
     * @var RenderInterface
     */
    private $renderer;

    /**
     * Pushed stream
     *
     * @var resource[]
     */
    private $streams = [];

    /**
     * @var StreamerInterface
     */
    private $streamer;

    public function __construct(RenderInterface $renderer, StreamerInterface $streamer)
    {
        $this->renderer = $renderer;
        $this->streamer = $streamer;
    }

    /**
     * {@inheritdoc}
     */
    public function render(ResourceObject $ro)
    {
        $view = $this->getView($ro);
        $this->streamer->addStreams($this->streams);
        $ro->view = $view;

        return $view;
    }

    /**
     * {@inheritdoc}
     */
    public function getView(ResourceObject $ro) : string
    {
        if (is_array($ro->body)) {
            $this->pushArrayBody($ro);

            return $this->renderer->render($ro);
        }

        return $this->pushScalarBody($ro);
    }

    /**
     * @param resource $item
     *
     * @return string
     */
    private function pushStream($item) : string
    {
        $id = uniqid(__FUNCTION__ . mt_rand(), true) . '_';
        $this->streams[$id] = $item; // push

        return $id;
    }

    private function pushScalarBody(ResourceObject $ro) : string
    {
        if (is_resource($ro->body) && get_resource_type($ro->body) === 'stream') {
            return $this->pushStream($ro->body);
        }

        return $this->renderer->render($ro);
    }

    private function pushArrayBody(ResourceObject $ro) : void
    {
        foreach ($ro->body as &$item) {
            if (is_resource($item) && get_resource_type($item) === 'stream') {
                $item = $this->pushStream($item);
            }
        }
    }
}
