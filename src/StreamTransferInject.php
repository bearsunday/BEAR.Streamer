<?php
/**
 * This file is part of the BEAR.Streamer package.
 *
 * @license http://opensource.org/licenses/MIT MIT
 */
namespace BEAR\Streamer;

trait StreamTransferInject
{
    /**
     * @var \BEAR\Streamer\StreamerInterface
     */
    private $streamer;

    /**
     * @\Ray\Di\Di\Inject()
     * @\BEAR\Streamer\Annotation\Stream()
     */
    public function setRenderer(\BEAR\Resource\RenderInterface $render)
    {
        return parent::setRenderer($render);
    }

    /**
     * @\Ray\Di\Di\Inject()
     */
    public function setStreamer(\BEAR\Streamer\StreamerInterface $streamer)
    {
        $this->streamer = $streamer;
    }

    public function transfer(\BEAR\Resource\TransferInterface $responder, array $server)
    {
        unset($responder);
        $responder = new \BEAR\Streamer\StreamResponder($this->streamer);
        parent::transfer($responder, $server);
    }
}
