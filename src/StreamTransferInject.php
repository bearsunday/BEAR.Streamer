<?php

declare(strict_types=1);

namespace BEAR\Streamer;

use BEAR\Resource\RenderInterface;
use BEAR\Resource\ResourceObject;
use BEAR\Resource\TransferInterface;
use BEAR\Streamer\Annotation\Stream;
use Ray\Di\Di\Inject;

trait StreamTransferInject
{
    /** @var TransferInterface */
    private $responder;

    /** @return ResourceObject */
    #[Inject]
    public function setRenderer(#[Stream]
    RenderInterface $render,)
    {
        return parent::setRenderer($render);
    }

    #[Inject]
    public function setTransfer(#[Stream]
    TransferInterface $responder,): void
    {
        $this->responder = $responder;
    }

    /**
     * {@inheritDoc}
     */
    public function transfer(TransferInterface $responder, array $server): void
    {
        unset($responder);

        parent::transfer($this->responder, $server);
    }
}
