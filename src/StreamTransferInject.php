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
     * @var \BEAR\Resource\TransferInterface
     */
    private $responder;

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
     * @\BEAR\Streamer\Annotation\Stream()
     */
    public function setTransfer(\BEAR\Resource\TransferInterface $responder)
    {
        $this->responder = $responder;
    }

    /**
     * @inheritdoc
     */
    public function transfer(\BEAR\Resource\TransferInterface $responder, array $server)
    {
        unset($responder);
        parent::transfer($this->responder, $server);
    }
}
