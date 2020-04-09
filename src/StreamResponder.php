<?php
/**
 * This file is part of the BEAR.Streamer package.
 *
 * @license http://opensource.org/licenses/MIT MIT
 */
namespace BEAR\Streamer;

use BEAR\Resource\ResourceObject;
use BEAR\Sunday\Extension\Transfer\TransferInterface;

class StreamResponder implements TransferInterface
{
    /**
     * @var StreamerInterface
     */
    private $streamer;

    public function __construct(StreamerInterface $streamer)
    {
        $this->streamer = $streamer;
    }

    /**
     * {@inheritdoc}
     */
    public function __invoke(ResourceObject $resourceObject, array $server) : void
    {
        unset($server);
        // render
        if (! $resourceObject->view) {
            $resourceObject->toString();
        }

        // header
        foreach ($resourceObject->headers as $label => $value) {
            header("{$label}: {$value}", false);
        }

        // code
        http_response_code($resourceObject->code);

        // stream body
        $stream = $this->streamer->getStream((string) $resourceObject->view);
        rewind($stream);
        while (! feof($stream)) {
            echo fread($stream, 8192);
        }
    }
}
