<?php


namespace Example\Services;


use Example\Domains\Order\OrderInterface;

interface NotifyInterface
{
    public function newOrderCreated(OrderInterface $order);
}