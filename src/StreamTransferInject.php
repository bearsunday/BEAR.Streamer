<?php
/**
 * This file is part of the BEAR.Streamer package.
 *
 * @license http://opensource.org/licenses/MIT MIT
 */
namespace BEAR\Streamer;

use BEAR\Resource\RenderInterface;
use BEAR\Resource\TransferInterface;
use BEAR\Streamer\Annotation\Stream;
use Ray\Di\Di\Inject;

trait StreamTransferInject
{
    /**
     * @var TransferInterface
     */
    private $responder;

    /**
     * @Inject
     * @Stream
     */
    public function setRenderer(RenderInterface $render)
    {
        return parent::setRenderer($render);
    }

    /**
     * @Inject
     * @Stream
     */
    public function setTransfer(TransferInterface $responder)
    {
        $this->responder = $responder;
    }

    /**
     * {@inheritdoc}
     */
    public function transfer(TransferInterface $responder, array $server)
    {
        unset($responder);
        parent::transfer($this->responder, $server);
    }
}
